<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pelamar;
use Illuminate\Http\Request;


class PelamarController extends Controller
{
    public function index()
    {
        $pelamar = Pelamar::all();
        return view('pages.admin.data-pelamar.index', compact('pelamar'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'nik' => 'required|string|max:20|unique:pelamar,nik',
                'nama_lengkap' => 'required|string|max:255',
                'no_hp' => 'required|string|max:15',
                'surat-lamaran-kerja' => 'nullable|file|mimes:pdf,doc,docx',
                'cv' => 'nullable|file|mimes:pdf,doc,docx',
            ]);
            Pelamar::create($request->all());
            return redirect()->back()->with('success', 'Pelamar created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to create pelamar: ' . $th->getMessage());
        }
    }

    public function update(Request $request, Pelamar $pelamar)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'nik' => 'required|string|max:20|unique:pelamar,nik,' . $pelamar->id,
                'nama_lengkap' => 'required|string|max:255',
                'no_hp' => 'required|string|max:15',
                'surat-lamaran-kerja' => 'nullable|file|mimes:pdf,doc,docx',
                'cv' => 'nullable|file|mimes:pdf,doc,docx',
            ]);
            $pelamar->update($request->all());
            return redirect()->back()->with('success', 'Pelamar updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to update pelamar: ' . $th->getMessage());
        }
    }

    public function destroy(Pelamar $pelamar)
    {
        try {
            $pelamar->delete();
            return redirect()->back()->with('success', 'Pelamar deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete pelamar: ' . $th->getMessage());
        }
    }
}
