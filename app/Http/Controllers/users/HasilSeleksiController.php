<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\HasilSeleksi;
use Illuminate\Support\Facades\Auth;

class HasilSeleksiController extends Controller
{
    public function index()
    {
        $hasil = HasilSeleksi::whereHas('pelamar', function($query) {
            $query->where('user_id', Auth::id());
        })->first();

        return view('pages.users.hasil.hasil-seleksi', compact('hasil'));
    }
}
