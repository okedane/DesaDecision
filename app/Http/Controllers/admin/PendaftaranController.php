<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $data = Pendaftaran::with('pelamar')->get();
        return view('pages.admin.status.index', compact('data'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'pelamar_id' => 'required|exists:pelamar,id',
                'status' => 'required|in:menunggu,lolos,tidak_lolos',
            ]);

            $data = $request->all();
            $data['tanggal_daftar'] = now()->toDateString();

            Pendaftaran::create($data);
            return redirect()->back()->with('success', 'Pendaftaran created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to create pendaftaran: ' . $th->getMessage());
        }
    }

    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        try {
            $request->validate([
                'status' => 'required|in:menunggu,lolos,tidak_lolos',
            ]);

            $pendaftaran->update([
                'status' => $request->status,
            ]);
            return redirect()->back()->with('success', 'Pendaftaran updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to update pendaftaran: ' . $th->getMessage());
        }
    }

    public function destroy(Pendaftaran $pendaftaran)
    {
        try {
            $pendaftaran->delete();
            return redirect()->back()->with('success', 'Pendaftaran deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete pendaftaran: ' . $th->getMessage());
        }
    }
}
