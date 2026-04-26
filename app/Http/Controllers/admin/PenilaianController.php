<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Penilaian;
use App\Models\Pelamar;
use App\Models\Kriteria;
use App\Models\SubKriteria;
 
class PenilaianController extends Controller
{
    /**
     * Tampilkan daftar pelamar yang siap dinilai
     */
    public function index()
    {
        // Ambil pelamar yang pendaftarannya sudah lolos/aktif
        $pelamar = Pelamar::whereHas('pendaftaran', function ($q) {
            $q->where('status', 'lolos'); // sesuaikan status pendaftaran Anda
        })->with(['user', 'penilaians'])->get();

        $kriterias = Kriteria::with('subkriteria')->orderBy('kode')->get();
 
        return view('pages.admin.penilaian.index', compact('pelamar', 'kriterias'));
    }
 
    /**
     * Form input penilaian per pelamar
     */
    public function create($pelamar_id)
    {
        $pelamar   = Pelamar::with('user')->findOrFail($pelamar_id);
        $kriterias = Kriteria::with('subkriteria')->get();
 
        // Ambil nilai yang sudah ada (untuk pre-fill form)
        $existingPenilaian = Penilaian::where('pelamar_id', $pelamar_id)
            ->pluck('nilai', 'kriteria_id');
 
        return view('pages.admin.penilaian.create', compact('pelamar', 'kriterias', 'existingPenilaian'));
    }
 
    /**
     * Simpan atau update penilaian
     */
    public function store(Request $request)
    {
        $request->validate([
            'pelamar_id' => 'required|exists:pelamar,id',
            'nilai'   => 'required|array',
            'nilai.*' => 'required|exists:sub_kriterias,id',
        ]);

        $pelamar_id = $request->pelamar_id;
 
        $pelamar = Pelamar::findOrFail($pelamar_id);
 
        $selectedSubkriteria = SubKriteria::whereIn('id', array_values($request->nilai))
            ->get()
            ->keyBy('id');

        foreach ($request->nilai as $kriteria_id => $subkriteria_id) {
            $subkriteria = $selectedSubkriteria->get((int) $subkriteria_id);

            if (!$subkriteria || (int) $subkriteria->kriteria_id !== (int) $kriteria_id) {
                return back()
                    ->withErrors(['nilai' => 'Subkriteria tidak sesuai dengan kriteria yang dipilih.'])
                    ->withInput();
            }

            Penilaian::updateOrCreate(
                [
                    'pelamar_id'  => $pelamar_id,
                    'kriteria_id' => $kriteria_id,
                ],
                [
                    'nilai' => $subkriteria->bobot,
                ]
            );
        }
 
        return redirect()->route('penilaian.index')
            ->with('success', "Penilaian untuk {$pelamar->user->name} berhasil disimpan.");
    }
 
    /**
     * Tampilkan detail penilaian satu pelamar
     */
    public function show($pelamar_id)
    {
        $pelamar   = Pelamar::with('user')->findOrFail($pelamar_id);
        $penilaian = Penilaian::where('pelamar_id', $pelamar_id)
            ->with('kriteria')
            ->get();
 
        return view('pages.admin.penilaian.show', compact('pelamar', 'penilaian'));
    }
 
    /**
     * Form edit penilaian (alias ke create dengan data existing)
     */
    public function edit($pelamar_id)
    {
        return $this->create($pelamar_id);
    }
 
    /**
     * Update penilaian (alias ke store)
     */
    public function update(Request $request, $pelamar_id)
    {
        return $this->store($request, $pelamar_id);
    }
 
    /**
     * Hapus seluruh penilaian seorang pelamar
     */
    public function destroy($pelamar_id)
    {
        Penilaian::where('pelamar_id', $pelamar_id)->delete();
 
        return redirect()->route('penilaian.index')
            ->with('success', 'Penilaian berhasil dihapus.');
    }
}
 
