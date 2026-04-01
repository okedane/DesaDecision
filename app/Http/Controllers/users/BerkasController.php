<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Berkas;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerkasController extends Controller
{
    public function index()
    {
        // Ambil berkas milik user yang login
        $userId = Auth::id();
        $berkas = Berkas::whereHas('pelamar', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();
        
        return view('pages.users.syarat.berkas', compact('berkas'));
    }

    public function store(Request $request)
    {
        try {
            // Dapatkan pelamar berdasarkan user yang login
            $pelamar = Pelamar::where('user_id', Auth::id())->first();
            
            if (!$pelamar) {
                return redirect()->back()->with('error', 'Data pelamar tidak ditemukan. Silahkan lengkapi profil terlebih dahulu.');
            }

            $validated = $request->validate([
                'jenis' => 'required|in:ktp,ijazah,pas_foto,cv,surat_sehat',
                'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048'
            ]);

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('berkas', $filename, 'public');
                $validated['file'] = $filename;
            }

            $validated['pelamar_id'] = $pelamar->id;
            
            Berkas::create($validated);
            return redirect()->route('berkas.index')->with('success', 'Berkas berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan berkas: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $berkas = Berkas::findOrFail($id);

            $validated = $request->validate([
                'jenis' => 'required|in:ktp,ijazah,pas_foto,cv,surat_sehat',
                'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
            ]);

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('berkas', $filename, 'public');
                $validated['file'] = $filename;
            }

            $berkas->update($validated);
            return redirect()->route('berkas.index')->with('success', 'Berkas berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui berkas: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $berkas = Berkas::findOrFail($id);
            $berkas->delete();
            return redirect()->route('berkas.index')->with('success', 'Berkas berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus berkas: ' . $e->getMessage());
        }
    }
}
