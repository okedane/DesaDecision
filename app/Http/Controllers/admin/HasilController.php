<?php
 
namespace App\Http\Controllers\admin;
 
use App\Http\Controllers\Controller;
use App\Models\HasilSeleksi;
use Illuminate\Http\Request;
 
class HasilController extends Controller
{
    public function index()
    {
        $hasil = HasilSeleksi::with('pelamar.user')
            ->orderByRaw("FIELD(status, 'lolos', 'tidak_lolos')")
            ->get();
 
        $totalLolos      = $hasil->where('status', 'lolos')->count();
        $totalTidakLolos = $hasil->where('status', 'tidak_lolos')->count();
 
        return view('pages.admin.hasil.index', compact('hasil', 'totalLolos', 'totalTidakLolos'));
    }
 
    public function destroy($id)
    {
        try {
            HasilSeleksi::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Data hasil seleksi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }
 
    public function resetAll()
    {
        HasilSeleksi::truncate();
        return redirect()->route('hasil.index')
            ->with('success', 'Semua data hasil seleksi berhasil direset.');
    }
}
 
