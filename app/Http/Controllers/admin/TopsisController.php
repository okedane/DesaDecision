<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelamar;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\HasilSeleksi;

class TopsisController extends Controller
{
    // -------------------------------------------------------
    // Helper: hitung TOPSIS, kembalikan data lengkap
    // -------------------------------------------------------
    private function hitungTopsis()
    {
        $kriterias = Kriteria::orderBy('kode')->get();

        $pelamars = Pelamar::whereHas('pendaftaran', function ($q) {
                $q->where('status', 'lolos');
            })
            ->with(['user', 'penilaians'])
            ->get()
            ->filter(function ($pelamar) use ($kriterias) {
                $dinilaiIds = $pelamar->penilaians->pluck('kriteria_id')->toArray();
                foreach ($kriterias as $k) {
                    if (!in_array($k->id, $dinilaiIds)) return false;
                }
                return true;
            })
            ->values();

        if ($pelamars->isEmpty() || $kriterias->isEmpty()) {
            return null;
        }

        // Matriks keputusan awal
        $matrix = [];
        foreach ($pelamars as $pelamar) {
            foreach ($kriterias as $k) {
                $p = $pelamar->penilaians->firstWhere('kriteria_id', $k->id);
                $matrix[$pelamar->id][$k->id] = $p ? (float) $p->nilai : 0;
            }
        }

        // Normalisasi
        $divider = [];
        foreach ($kriterias as $k) {
            $sumSq = 0;
            foreach ($pelamars as $pelamar) {
                $sumSq += pow($matrix[$pelamar->id][$k->id], 2);
            }
            $divider[$k->id] = sqrt($sumSq);
        }

        $normalized = [];
        foreach ($pelamars as $pelamar) {
            foreach ($kriterias as $k) {
                $div = $divider[$k->id];
                $normalized[$pelamar->id][$k->id] = $div > 0
                    ? $matrix[$pelamar->id][$k->id] / $div
                    : 0;
            }
        }

        // Matriks terbobot
        $weighted = [];
        foreach ($pelamars as $pelamar) {
            foreach ($kriterias as $k) {
                $weighted[$pelamar->id][$k->id] =
                    ($k->bobot / 100) * $normalized[$pelamar->id][$k->id];
            }
        }

        // Solusi ideal
        $idealPositif = [];
        $idealNegatif = [];
        foreach ($kriterias as $k) {
            $colValues = [];
            foreach ($pelamars as $pelamar) {
                $colValues[] = $weighted[$pelamar->id][$k->id];
            }
            if ($k->sifat === 'benefit') {
                $idealPositif[$k->id] = max($colValues);
                $idealNegatif[$k->id] = min($colValues);
            } else {
                $idealPositif[$k->id] = min($colValues);
                $idealNegatif[$k->id] = max($colValues);
            }
        }

        // Jarak & skor
        $dPlus  = [];
        $dMinus = [];
        $scores = [];
        foreach ($pelamars as $pelamar) {
            $sumPlus = $sumMinus = 0;
            foreach ($kriterias as $k) {
                $v        = $weighted[$pelamar->id][$k->id];
                $sumPlus  += pow($v - $idealPositif[$k->id], 2);
                $sumMinus += pow($v - $idealNegatif[$k->id], 2);
            }
            $dPlus[$pelamar->id]  = sqrt($sumPlus);
            $dMinus[$pelamar->id] = sqrt($sumMinus);
            $denom = $dPlus[$pelamar->id] + $dMinus[$pelamar->id];
            $scores[$pelamar->id] = $denom > 0 ? $dMinus[$pelamar->id] / $denom : 0;
        }

        // Ranking
        arsort($scores);
        $ranking = [];
        $rank    = 1;
        foreach ($scores as $pelamarId => $score) {
            $pelamar   = $pelamars->firstWhere('id', $pelamarId);
            $ranking[] = [
                'rank'    => $rank++,
                'pelamar' => $pelamar,
                'dPlus'   => $dPlus[$pelamarId],
                'dMinus'  => $dMinus[$pelamarId],
                'score'   => $score,
                'status'  => $score >= 0.5 ? 'lolos' : 'tidak_lolos',
            ];
        }

        return compact(
            'kriterias', 'pelamars', 'matrix', 'divider',
            'normalized', 'weighted', 'idealPositif', 'idealNegatif',
            'dPlus', 'dMinus', 'scores', 'ranking'
        );
    }

    // -------------------------------------------------------
    // index — tampilkan proses perhitungan TOPSIS
    // -------------------------------------------------------
    public function index()
    {
        $data = $this->hitungTopsis();

        // Cek apakah hasil sudah pernah disimpan
        $sudahDisimpan = HasilSeleksi::exists();

        if (!$data) {
            return view('pages.admin.topsis.index', [
                'error'        => 'Data pelamar atau penilaian belum lengkap untuk dihitung.',
                'sudahDisimpan'=> $sudahDisimpan,
            ]);
        }

        return view('pages.admin.topsis.index', array_merge($data, [
            'sudahDisimpan' => $sudahDisimpan,
        ]));
    }

    // -------------------------------------------------------
    // simpan — setujui hasil & simpan ke tabel hasil_seleksi
    // -------------------------------------------------------
    public function simpan(Request $request)
    {
        $request->validate([
            'tanggal_pengumuman' => 'required|date',
        ]);

        $data = $this->hitungTopsis();

        if (!$data) {
            return redirect()->back()
                ->with('error', 'Data belum lengkap, tidak bisa menyimpan hasil.');
        }

        foreach ($data['ranking'] as $item) {
            $keterangan = sprintf(
                'Ranking ke-%d | Skor: %s | D+: %s | D-: %s',
                $item['rank'],
                number_format($item['score'], 6),
                number_format($item['dPlus'], 6),
                number_format($item['dMinus'], 6)
            );

            HasilSeleksi::updateOrCreate(
                ['pelamar_id' => $item['pelamar']->id],
                [
                    'status'             => $item['status'],
                    'keterangan'         => $keterangan,
                    'tanggal_pengumuman' => $request->tanggal_pengumuman,
                ]
            );
        }

        return redirect()->route('topsis.index')
            ->with('success', 'Hasil seleksi berhasil disimpan.');
    }
}