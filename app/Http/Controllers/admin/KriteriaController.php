<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kriteria;

class KriteriaController extends Controller
{
     public function index()
    {
        $kriteria = Kriteria::orderBy('created_at', 'asc')->get();

        return view('pages.admin.kriteria.index', compact('kriteria'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255|unique:kriterias,nama',
                'sifat' => 'required|in:benefit,cost',
                'bobot' => 'required|numeric|min:0.01|max:100',
            ]);

            $lastNumber = Kriteria::count() + 1;
            $validated['kode'] = 'C' . $lastNumber;

            Kriteria::create($validated);

            return redirect()->back()->with('success', 'Kriteria created successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menambahkan Kriteria. Silakan coba lagi.: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $kriteria = Kriteria::findOrFail($id);

            // Validasi dasar
            $validated = $request->validate([
                'nama' => 'required|string|max:255|unique:kriterias,nama,' . $id,
                'sifat' => 'required|in:benefit,cost',
                'bobot' => 'required|numeric|min:0.01|max:100',
            ]);

            $kriteria->update($validated);

            return redirect()->back()->with('success', 'Kriteria berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui Kriteria. Silakan coba lagi.' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $kriteria = Kriteria::findOrFail($id);

            // Ambil nomor dari kode (prefix 'C')
            $deletedNumber = (int) str_replace('C', '', $kriteria->kode);

            // Hapus data
            $kriteria->delete();

            // Ambil semua data setelah kode yang dihapus
            $updateKode = Kriteria::whereRaw('CAST(SUBSTRING(kode, 2) AS UNSIGNED) > ?', [$deletedNumber])
                                             ->orderByRaw('CAST(SUBSTRING(kode, 2) AS UNSIGNED)')
                                             ->get();

            // Update ulang kode-kode setelahnya
            foreach ($updateKode as $item) {
                $currentNumber = (int) str_replace('C', '', $item->kode);
                $newNumber = $currentNumber - 1;
                $item->update(['kode' => 'C' . $newNumber]);
            }

            return redirect()->back()->with('success', 'Kriteria berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus Kriteria. Silakan coba lagi: ' . $e->getMessage());
        }
    }
}
