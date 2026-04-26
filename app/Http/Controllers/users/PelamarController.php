<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelamar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PelamarController extends Controller
{
    public function index()
    {
        $pelamars = Pelamar::where('user_id', Auth::id())->get();
        return view('pages.users.pelamar.pelamar', compact('pelamars'));
    }

    public function syarat()
    {
        return view('pages.users.syarat.index');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                // 'user_id' => 'required|exists:users,id',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'nama_lengkap' => 'required|string|max:255',
                'nik' => 'required|string|max:20|unique:pelamar,nik',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'status_pernikahan' => 'nullable|in:Belum Menikah,Menikah',
                'agama' => 'nullable|in:Islam,Kristen,Hindu,Buddha',
                'alamat' => 'required|string',
                'no_hp' => 'required|string|max:15',
                // 'surat-lamaran-kerja' => 'nullable|file|mimes:pdf,doc,docx',
                // 'cv' => 'nullable|file|mimes:pdf,doc,docx',
            ]);

            $data = [
                'user_id' => Auth::id(),
                'nama_lengkap' => $request->nama_lengkap,
                'nik' => $request->nik,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'status_pernikahan' => $request->status_pernikahan,
                'agama' => $request->agama,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
            ];

            // Handle file uploads
            if ($request->hasFile('foto')) {
                $data['foto'] = $request->file('foto')->store('pelamar/foto', 'public');
            }
          

            Pelamar::create($data);
            return redirect()->back()->with('success', 'Pelamar created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to create pelamar: ' . $th->getMessage());
        }
    }

    public function update(Request $request, Pelamar $pelamar)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'nik' => 'required|unique:pelamar,nik,' . $pelamar->id,
        ]);

        $data = $request->only([
            'nama_lengkap',
            'nik',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'status_pernikahan',
            'agama',
            'alamat',
            'no_hp'
        ]);

        if ($request->hasFile('foto')) {

            // 🔥 hapus foto lama
            if ($pelamar->foto) {
                Storage::disk('public')->delete($pelamar->foto);
            }

            $data['foto'] = $request->file('foto')->store('pelamar/foto', 'public');
        }

        $pelamar->update($data);

        return back()->with('success', 'Data berhasil diupdate');
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
