<?php

namespace App\Http\Controllers;

use App\Models\HasilSeleksi;
use Illuminate\Support\Facades\Auth;

class HasilSeleksiController extends Controller
{
    public function index()
    {
        // Ambil data hasil seleksi berdasarkan user yang login
        $user = Auth::user();
        
        // Sesuaikan dengan relationship di model User/Pelamar Anda
        $hasil = HasilSeleksi::whereHas('pelamar', function ($query) use ($user) {
            $query->where('user_id', $user->id); // atau sesuaikan kolom yang menghubungkan
        })->first();

        return view('pages.users.hasil.hasil-seleksi', compact('hasil'));
    }
}