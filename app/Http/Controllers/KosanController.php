<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kosan;
use App\Models\Booking;

class KosanController extends Controller
{
    //Daftar Kosan
    public function index()
    {
        $kosan = Kosan::where('status', 'aktif')->paginate(8);
        return view('kosan.index', compact('kosan'));
    }

    //Detail Kosan
    public function show($id)
    {
        $kos = Kosan::findOrFail($id);
        return view('kosan.show', compact('kos'));
    }

    //Form booking kosan
    public function bookingForm($id)
    {
        $kos = Kosan::findOrFail($id);
        return view('kosan.booking', compact('kos'));
    }


    //Proses booking (test pake dummy)
    public function bookingSubmit(Request $request, $id)
    {
        //validasi input
        $request->validate([
            'nama'=> 'required|string|max:255',
            'no_hp'=> 'required|string|max:20',
            'tanggal_masuk'=> 'required|date',
            'lama_sewa'=> 'required|integer|min:1',
        ]);

        Booking::create([
            'id_kos'=> $id,
            'nama'=> $request->nama,
            'no_hp'=> $request->no_hp,
            'tanggal_mulai'=> $request->tanggal_mulai,
            'lama_sewa'=> $request->lama_sewa,
        ]);

        //dummy, nanti simpen ke table booking
        return redirect()->route('kosan.show')->with('success','Booking berhasil! Nama :' . $request->nama .'');
    }
}
