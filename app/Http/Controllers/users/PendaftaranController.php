<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Berkas;
use App\Models\Pelamar;
use App\Models\Pendaftaran;

class PendaftaranController extends Controller
{
    public function store()
    {
        $pelamar = Pelamar::where('user_id', Auth::id())->first();

        if (!$pelamar) {
            return back()->with('error', 'Isi data pelamar dulu');
        }

        $existingPendaftaran = Pendaftaran::where('pelamar_id', $pelamar->id)
            ->latest('id')
            ->first();

        if ($existingPendaftaran) {
            return back()->with('error', 'Anda sudah melakukan pendaftaran administrasi.');
        }

        $requiredJenis = ['ktp', 'ijazah', 'pas_foto', 'cv', 'surat_sehat'];
        $uploadedJenis = Berkas::where('pelamar_id', $pelamar->id)
            ->pluck('jenis')
            ->unique()
            ->toArray();

        $missingJenis = array_diff($requiredJenis, $uploadedJenis);

        if (!empty($missingJenis)) {
            return back()->with('error', 'Lengkapi semua berkas sebelum mendaftar test administrasi.');
        }

        Pendaftaran::create([
            'pelamar_id' => $pelamar->id,
            'tanggal_daftar' => now(),
            'status' => 'menunggu',
        ]);

        return back()->with('success', 'Berhasil mendaftar test administrasi. Silakan tunggu verifikasi admin.');
    }
}
