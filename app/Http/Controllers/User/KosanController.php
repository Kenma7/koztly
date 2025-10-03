<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kosan;
use App\Models\Booking;
use App\Models\Kamar;

class KosanController extends Controller
{
<<<<<<< HEAD:app/Http/Controllers/KosanController.php
    // Tambahan di KosanController
    public function landing(Request $request)
    {
        $perPage = $request->get('per_page', 3); // tampil 6 kosan misalnya
        $kosan = Kosan::where('status', 'aktif')->paginate($perPage);

        // arahkan ke view landing.index
        return view('landing.index', compact('kosan'));
    }

    //Daftar Kosan
=======
    // Daftar Kosan
>>>>>>> pipahz-fix:app/Http/Controllers/User/KosanController.php
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 9);
        
        $kosan = Kosan::where('status', 'aktif')
            ->withCount([
                'kamar as total_kamar_count',
                'kamar as sisa_kamar_count' => function($query) {
                    $query->where('status', 'tersedia');
                }
            ])
            ->paginate($perPage);
            
        return view('kosan.index', compact('kosan'));
    }

    // Detail Kosan
    public function show($id)
    {
        $kos = Kosan::withCount([
                'kamar as total_kamar_count',
                'kamar as sisa_kamar_count' => function($query) {
                    $query->where('status', 'tersedia');
                }
            ])
            ->findOrFail($id);
            
        return view('kosan.show', compact('kos'));
    }

    // Form booking kosan
    public function bookingForm($id)
    {
        $kos = Kosan::with(['kamar' => function($query){
            $query->where('status','tersedia');
        }])->findOrFail($id);
        
        return view('kosan.booking', compact('kos'));
    }

    // Proses booking (test pake dummy)
    public function bookingSubmit(Request $request, $id)
    {
        // validasi input
        $request->validate([
            'id_kamar' => 'required|exists:kamar,id_kamar',
            'nama'=> 'required|string|max:255',
            'no_hp'=> 'required|string|max:20',
            'tanggal_masuk'=> 'required|date',
            'lama_sewa'=> 'required|integer|min:1',
        ]);

        // Cari kosan dan kamar
        $kosan = Kosan::findOrFail($id);
        $kamar = Kamar::findOrFail($request->id_kamar);

        // create booking
        Booking::create([
            'id_user' => 'auth()->id() ?? 1',
            'id_kos'=> $id,
            'id_kamar' => $request->id_kamar,
            'harga'=> $kosan->harga * $request->lama_sewa,
            'tanggal_masuk'=> $request->tanggal_masuk,
            'lama_sewa'=> $request->lama_sewa,
            'status_pembayaran' => 'belum dibayar',
            'status_sewa' => 'menunggu'
        ]);

        // Update status kamar jadi dipesan
        $kamar->update(['status' => 'dipesan']);

        return redirect()->route('kosan.show', $id)->with('success','Booking berhasil! Nama :' . $request->nama .'');
    }
}