<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
     public function index($id)
    {
        $subKriteria = SubKriteria::where('kriteria_id', $id)->orderBy('created_at', 'asc')->get();
        $kriteria = Kriteria::findOrFail($id);
        return view('pages.admin.sub-kriteria.index', compact('subKriteria', 'kriteria'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'kriteria_id' => 'required|exists:kriterias,id',
                'nama' => 'required|string|max:255',
                'min_value' => 'nullable|integer',
                'max_value' => 'nullable|integer',
                'bobot' => 'required|integer|min:1|max:100',
            ]);

            SubKriteria::create($validated);

            return redirect()->back()->with('success', 'Sub Kriteria created successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menambahkan Sub Kriteria. Silakan coba lagi.: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $subKriteria = SubKriteria::findOrFail($id);

            // Validasi dasar
            $validated = $request->validate([
                // 'kriteria_id' => 'required|exists:kriterias,id',
                'nama' => 'required|string|max:255',
                'min_value' => 'nullable|integer',
                'max_value' => 'nullable|integer',
                'bobot' => 'required|integer|min:1|max:100',
            ]);

            $subKriteria->update($validated);

            return redirect()->back()->with('success', 'Sub Kriteria berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui Sub Kriteria. Silakan coba lagi.' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $subKriteria = SubKriteria::findOrFail($id);
            $subKriteria->delete();

            return redirect()->back()->with('success', 'Sub Kriteria berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menghapus Sub Kriteria. Silakan coba lagi.' . $e->getMessage());
        }
    }
}
