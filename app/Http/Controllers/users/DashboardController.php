<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pelamar;
use App\Models\Pendaftaran;

class DashboardController extends Controller
{
    public function index()
    {
    $user = Auth::user();

    $pelamar = Pelamar::where('user_id', $user->id)->first();

    $pendaftaran = null;

    if ($pelamar) {
        $pendaftaran = Pendaftaran::where('pelamar_id', $pelamar->id)->first();
    }

        return view('pages.users.dashboard.dashboard', compact('pendaftaran', 'pelamar'));
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'nik' => 'required',
                'nama_lengkap' => 'required',
                'no_hp' => 'required',
            ]);

            $pelamar = new Pelamar();
            $pelamar->user_id = auth()->id();
            $pelamar->nik = $request->nik;
            $pelamar->nama_lengkap = $request->nama_lengkap;
            $pelamar->no_hp = $request->no_hp;

            if ($request->hasFile('cv')) {
                $pelamar->cv = $request->file('cv')->store('cv');
            }

            $pelamar->save();

            return redirect()->route('dashboard.user')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    



}