<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kosan;
use App\Models\Booking;
use App\Models\User;
use App\Models\Kamar;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Total
        $totalKosan = Kosan::count();
        $totalBooking = Booking::count();
        $totalUser = User::count();
        $totalKamar = Kamar::count();

        // Statistik Kosan berdasarkan kategori
        $kosanWanita = Kosan::where('kategori', 'wanita')->count();
        $kosanPria = Kosan::where('kategori', 'pria')->count();
        $kosanBebas = Kosan::where('kategori', 'bebas')->count();

        // Statistik Kosan berdasarkan status
        $kosanAktif = Kosan::where('status', 'aktif')->count();
        $kosanNonaktif = Kosan::where('status', 'nonaktif')->count();

        // Statistik Booking berdasarkan status_sewa
        $bookingAktif = Booking::where('status_sewa', 'aktif')->count();
        $bookingSelesai = Booking::where('status_sewa', 'selesai')->count();
        $bookingBatal = Booking::where('status_sewa', 'batal')->count();

        // Statistik Pembayaran
        $bookingBelumBayar = Booking::where('status_pembayaran', 'belum dibayar')->count();
        $bookingSudahBayar = Booking::where('status_pembayaran', 'sudah dibayar')->count();

        // Statistik Kamar
        $kamarTersedia = Kamar::where('status', 'tersedia')->count();
        $kamarTerisi = Kamar::where('status', 'terisi')->count();

        // Booking Terbanyak (Kosan dengan booking terbanyak)
        $bookingTerbanyak = Booking::select('id_kos', DB::raw('count(*) as total_booking'))
            ->with('kost')
            ->groupBy('id_kos')
            ->orderBy('total_booking', 'desc')
            ->limit(5)
            ->get();

        // Booking Terbaru
        $bookingTerbaru = Booking::with(['user', 'kamar', 'kost'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Kosan Terbaru
        $kosanTerbaru = Kosan::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalKosan',
            'totalBooking',
            'totalUser',
            'totalKamar',
            'kosanWanita',
            'kosanPria',
            'kosanBebas',
            'kosanAktif',
            'kosanNonaktif',
            'bookingAktif',
            'bookingSelesai',
            'bookingBatal',
            'bookingBelumBayar',
            'bookingSudahBayar',
            'kamarTersedia',
            'kamarTerisi',
            'bookingTerbanyak',
            'bookingTerbaru',
            'kosanTerbaru'
        ));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('success', 'Berhasil logout dari sistem admin');
    }
}