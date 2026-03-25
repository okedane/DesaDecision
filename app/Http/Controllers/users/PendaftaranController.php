<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelamar;
use App\Models\Pendaftaran;

class PendaftaranController extends Controller
{
    public function store()
    {
        $pelamar = Pelamar::where('user_id', auth()->id())->first();

        if (!$pelamar) {
            return back()->with('error', 'Isi data pelamar dulu');
        }

        Pendaftaran::create([
            'pelamar_id' => $pelamar->id,
            'tanggal_daftar' => now(),
            'status' => 'menunggu',
        ]);

        return back()->with('success', 'Berhasil mendaftar');
    }
}
