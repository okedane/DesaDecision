<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berkas;

class SyaratController extends Controller
{
    public function index()
    {
        $berkas = Berkas::all();
        return view('pages.users.syarat.berkas', compact('berkas'));
    }
}
