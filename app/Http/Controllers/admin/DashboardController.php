<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pelamar;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $countPelamar = Pelamar::count();
        $countKandidat = Pelamar::whereHas('pendaftaran', function ($q) {
            $q->where('status', 'lolos');
        })->count();
        $countKriteria = Kriteria::count();
        $countSubKriteria = SubKriteria::count();

        $user = Auth::user();

        return view('pages.admin.dashboard.dashboard', compact(
            'countPelamar',
            'countKandidat',
            'countKriteria',
            'countSubKriteria',
            'user'
        ));
    }
}
