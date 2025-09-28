<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Kosan;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    
       // Ambil semua kosan untuk dropdown
        $kosanList = Kosan::all();

        // Definisikan query awal kamar beserta relasi kosan dan booking_kos.user
        $query = Kamar::with('kosan', 'booking_kos.user');

        // Filter pencarian nomor kamar
        if ($request->has('search') && $request->search != '') {
            $query->where('nomor_kamar', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kosan
        if ($request->has('kosan') && $request->kosan != '') {
            $query->where('id_kos', $request->kosan);
        }

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Ambil hasil query
        $kamar = $query->get();

        // Statistik
        $totalKamar = Kamar::count();
        $tersedia = Kamar::where('status', 'tersedia')->count();
        $terisi = Kamar::where('status', 'dibooking')->count();

        // Persentase
        $persentaseTersedia = $totalKamar > 0 ? round(($tersedia / $totalKamar) * 100) : 0;
        $persentaseTerisi = $totalKamar > 0 ? round(($terisi / $totalKamar) * 100) : 0;

        // Top 3 Kosan berdasarkan jumlah kamar terbanyak
        $topKosan = Kosan::orderByDesc('jumlah_kamar')
                ->take(3)
                ->get();

        return view('admin.kamar.index', compact(
            'kamar', 'kosanList',
            'totalKamar', 'tersedia', 'terisi', 
            'persentaseTersedia', 'persentaseTerisi', 'topKosan'
        ));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nomor_kamar' => 'required|int',
            'id_kos' => 'required|exists:kosan,id_kos',
            'status' => 'required|in:tersedia,dibooking',
        ]);
        
        // Ambil kosan yang dipilih
        $kosan = Kosan::findOrFail($request->id_kos);
        
        // Hitung jumlah kamar yang sudah ada di kosan itu
        $jumlahKamarSekarang = Kamar::where('id_kos', $kosan->id_kos)->count();
        
        // Cek apakah sudah melebihi kapasitas
        if ($jumlahKamarSekarang >= $kosan->jumlah_kamar) {
            return redirect()->back()->with('error', 'Kamar tidak bisa ditambahkan. Jumlah kamar di kosan "' . $kosan->nama_kos . '" sudah penuh.');
        }
        
        // Jika belum penuh, tambah kamar
        Kamar::create([
            'nomor_kamar' => $request->nomor_kamar,
            'id_kos' => $request->id_kos,
            'status' => $request->status,
        ]);
        
        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'nomor_kamar' => 'required|string|max:50',
            'id_kos' => 'required|exists:kosan,id_kos',
            'status' => 'required|in:tersedia,dibooking',
        ]);
        
        
        $kamar = Kamar::findOrFail($id);
        $kamar->update([
            'nomor_kamar' => $request->nomor_kamar,
            'id_kos' => $request->id_kos,
            'status' => $request->status,
        ]);
        
        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kamar = Kamar::findOrFail($id);
        $kamar->delete();
        
        return redirect()->back()->with('success', 'Kamar berhasil dihapus.');
    }
}
