<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kosan;
use Illuminate\Support\Str; 


class KostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

       $query = Kosan::query();

    // Filter pencarian nama atau lokasi
    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function($q) use ($search) {
            $q->where('nama_kos', 'like', "%$search%")
              ->orWhere('lokasi_kos', 'like', "%$search%");
        });
    }

    // Filter status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filter kategori
    if ($request->filled('kategori')) {
        $query->where('kategori', $request->kategori);
    }

    $kosan = $query->get();

    // Statistik sederhana
    $totalKosan = Kosan::count();
    $kosanWanita = Kosan::where('kategori', 'wanita')->count();
    $kosanPria = Kosan::where('kategori', 'pria')->count();

    return view('admin.kosan.index', compact('kosan', 'totalKosan', 'kosanWanita', 'kosanPria'));
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
        // Validasi input
        $request->validate([
            'nama_kos' => 'required|string|max:255',
            'lokasi_kos' => 'required|string|max:255',
            'jumlah_kamar' => 'required|integer|min:1',
            'fasilitas' => 'nullable|string',
            'kategori' => 'required|in:wanita,pria,bebas',
            'harga' => 'required|integer|min:0',
            'gambar_kos' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'no_rek' => 'required|string|max:50',
        ]);

        // Upload gambar
        if ($request->hasFile('gambar_kos')) {
            $file = $request->file('gambar_kos');
            $filename = time().'_'.Str::slug($request->nama_kos).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/kosan'), $filename);
        } else {
            $filename = null;
        }

        // Simpan data
        Kosan::create([
            'nama_kos' => $request->nama_kos,
            'lokasi_kos' => $request->lokasi_kos,
            'jumlah_kamar' => $request->jumlah_kamar,
            'fasilitas' => $request->fasilitas,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'gambar_kos' => $filename,
            'no_rek' => $request->no_rek,
            'status' => 'aktif', // default
        ]);

        return redirect()->route('admin.kosan.index')->with('success', 'Kosan berhasil ditambahkan!');
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
       $kosan = Kosan::findOrFail($id);

        // Validasi input
        $request->validate([
            'nama_kos' => 'required|string|max:255',
            'lokasi_kos' => 'required|string|max:255',
            'jumlah_kamar' => 'required|integer|min:1',
            'kategori' => 'required|in:wanita,pria,bebas',
            'harga' => 'required|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
            'no_rek' => 'required|string|max:50',
            'gambar_kos' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Update data biasa
        $kosan->nama_kos = $request->nama_kos;
        $kosan->lokasi_kos = $request->lokasi_kos;
        $kosan->jumlah_kamar = $request->jumlah_kamar;
        $kosan->kategori = $request->kategori;
        $kosan->harga = $request->harga;
        $kosan->status = $request->status;
        $kosan->no_rek = $request->no_rek;

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar_kos')) {
            // Hapus gambar lama jika ada
            if ($kosan->gambar_kos && file_exists(public_path('uploads/kosan/'.$kosan->gambar_kos))) {
                unlink(public_path('uploads/kosan/'.$kosan->gambar_kos));
            }

            $file = $request->file('gambar_kos');
            $filename = time().'_'.Str::slug($request->nama_kos).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/kosan'), $filename);
            $kosan->gambar_kos = $filename;
        }

        $kosan->save();

        return redirect()->route('admin.kosan.index')->with('success', 'Data kosan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        //
        $kosan = Kosan::findOrFail($id);
        $kosan->delete();

        return redirect()->route('admin.kosan.index')->with('success', 'Kosan berhasil dihapus!');
    }
}
