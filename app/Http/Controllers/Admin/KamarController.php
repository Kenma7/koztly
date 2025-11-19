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
    $kosanList = Kosan::all();

    // Query awal
    $query = Kamar::with('kosan', 'booking_kos.user');

    // Filter pencarian nomor kamar
    if ($request->filled('search')) {
        $query->where('nomor_kamar', 'like', '%' . $request->search . '%');
    }

    // Filter berdasarkan kosan
    if ($request->filled('kosan')) {
        $query->where('id_kos', $request->kosan);
    }

    // Filter status terbaru
    if ($request->filled('status')) {
        if ($request->status === 'tersedia') {
            $query->whereDoesntHave('booking_kos', function($q){
                $q->where('status_sewa', 'aktif');
            });
        } elseif ($request->status === 'dibooking') {
            $query->whereHas('booking_kos', function($q){
                $q->where('status_sewa', 'aktif');
            });
        }
    }

    // Pagination 5 kamar per halaman
    $kamar = $query->paginate(5)->withQueryString();

    // Tambahkan status terbaru untuk view
    foreach ($kamar as $k) {
        $latestBooking = $k->booking_kos->sortByDesc('created_at')->first();
        if ($latestBooking) {
            $k->status_terbaru = $latestBooking->status_sewa === 'aktif' ? 'dibooking' : 'tersedia';
        } else {
            $k->status_terbaru = $k->status;
        }
    }

    // Statistik
    $totalKamar = Kamar::count();
    $tersedia   = Kamar::whereDoesntHave('booking_kos', function($q){
        $q->where('status_sewa', 'aktif');
    })->count();
    $terisi     = $totalKamar - $tersedia;
    $persentaseTersedia = $totalKamar > 0 ? round(($tersedia / $totalKamar) * 100) : 0;
    $persentaseTerisi   = $totalKamar > 0 ? round(($terisi / $totalKamar) * 100) : 0;

    // Top 3 kosan
    $topKosan = Kosan::orderByDesc('jumlah_kamar')->take(3)->get();

    return view('admin.kamar.index', compact(
        'kamar', 'kosanList', 'totalKamar', 'tersedia', 'terisi',
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
    
        $kamar = Kamar::findOrFail($id);
        
        // Validasi input
        $request->validate([
            'nomor_kamar' => 'required|integer|min:1',
            'id_kos' => 'required|exists:kosan,id_kos',
            'status' => 'required|in:tersedia,dibooking',
            'alasan' => 'array' // hanya jika status tersedia yang dipilih
        ]);
        
        // Update data kamar
        $kamar->nomor_kamar = $request->nomor_kamar;
        $kamar->id_kos = $request->id_kos;
        $kamar->status = $request->status;
        $kamar->save();
        
        // Ambil booking terbaru
        $latestBooking = $kamar->booking_kos()->latest()->first();
        
        if ($request->status === 'tersedia' && $latestBooking) {
            if ($request->has('alasan')) {
                if (in_array('booking selesai', $request->alasan)) {
                    $latestBooking->status_sewa = 'selesai';
                } elseif (in_array('booking dibatalkan', $request->alasan)) {
                    $latestBooking->status_sewa = 'batal';
                } elseif (in_array('booking menunggu', $request->alasan)) {
                    $latestBooking->status_sewa = 'menunggu';
                }
                $latestBooking->save();
            }
        } elseif ($request->status === 'dibooking') {
            if ($latestBooking) {
                $latestBooking->status_sewa = 'aktif';
                $latestBooking->save();
            }
        }
        
        return redirect()->route('admin.kamar.index')->with('success', 'Data kamar berhasil diperbarui.');
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
