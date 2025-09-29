<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kosan;
use App\Models\Booking;
use App\Models\User;
use App\Models\Kamar;

class DashboardController extends Controller
{
    public function index()
    {
        // DEFINISIKAN SEMUA VARIABEL SATU PER SATU
        $totalKosan = Kosan::count();
        $totalBooking = Booking::count();
        $totalUser = User::count();
        $totalKamar = Kamar::count();

        $kosanWanita = Kosan::where('kategori', 'wanita')->count();
        $kosanPria = Kosan::where('kategori', 'pria')->count();
        $kosanBebas = Kosan::where('kategori', 'bebas')->count();

        $kosanAktif = Kosan::where('status', 'aktif')->count();
        $kosanNonaktif = Kosan::where('status', 'nonaktif')->count();

        $bookingPending = Booking::where('status_pembayaran', 'belum dibayar')->count();
        $bookingKonfirmasi = Booking::where('status_pembayaran', 'sudah dibayar')->count();
        $bookingSelesai = Booking::where('status_sewa', 'selesai')->count();
        $bookingBatal = Booking::where('status_sewa', 'batal')->count();

        $kamarTersedia = Kamar::where('status', 'tersedia')->count();
        $kamarTerisi = Kamar::where('status', 'terisi')->count();

        $bookingTerbaru = Booking::with(['user', 'kamar', 'kost'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $kosanTerbaru = Kosan::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // RETURN VIEW - COPY PASTE PERSIS SEPERTI INI
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
            'bookingPending',
            'bookingKonfirmasi',
            'bookingSelesai',
            'bookingBatal',
            'kamarTersedia',
            'kamarTerisi',
            'bookingTerbaru',
            'kosanTerbaru'
        ));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Berhasil logout dari sistem admin');
    }
}