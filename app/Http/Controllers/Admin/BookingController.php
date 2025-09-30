<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Kosan;
use App\Models\Kamar;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'kost', 'kamar']);

        // Filter username
        if ($request->filled('username')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('username', 'like', '%' . $request->username . '%');
            });
        }

        // Filter kosan
        if ($request->filled('kosan_id')) {
            $query->where('id_kos', $request->kosan_id);
        }

        // Filter status sewa
        if ($request->filled('status')) {
            $query->whereRaw('LOWER(status_sewa) = ?', [strtolower($request->status)]);
        }

        // Filter status pembayaran
        if ($request->filled('status_pembayaran')) {
            $query->whereRaw('LOWER(status_pembayaran) = ?', [strtolower($request->status_pembayaran)]);
        }

        // Pagination
        $bookings = $query->paginate(10);


        // Statistik
        $totalBooking = Booking::count();
        $menunggu     = Booking::whereRaw('LOWER(status_sewa) = ?', ['menunggu'])->count();
        $aktif        = Booking::whereRaw('LOWER(status_sewa) = ?', ['aktif'])->count();
        $selesai      = Booking::whereRaw('LOWER(status_sewa) = ?', ['selesai'])->count();
        $batal        = Booking::whereRaw('LOWER(status_sewa) = ?', ['batal'])->count();
        $belumDibayar = Booking::whereRaw('LOWER(status_pembayaran) = ?', ['belum dibayar'])->count();
        $sudahDibayar = Booking::whereRaw('LOWER(status_pembayaran) = ?', ['sudah dibayar'])->count();

        // Grafik booking per bulan
        $bulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        $jumlahBooking = array_fill(0, 12, 0);
        foreach(Booking::all() as $b){
            $monthIndex = Carbon::parse($b->created_at)->month - 1;
            $jumlahBooking[$monthIndex]++;
        }

        // List Kosan
        $kosanList = Kosan::all();

        return view('admin.booking.index', compact(
            'bookings', 'bulan', 'jumlahBooking',
            'totalBooking', 'menunggu', 'aktif', 'selesai', 'batal',
            'belumDibayar', 'sudahDibayar',
            'kosanList'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Bisa ditambahkan jika ingin create booking manual via admin
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Bisa ditambahkan jika ingin create booking manual via admin
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        // Data detail booking, sudah termasuk user.gender, jumlah_penghuni, catatan
        $booking = Booking::with(['user', 'kost', 'kamar'])->findOrFail($id);
        return view('admin.booking.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Bisa ditambahkan untuk edit booking via form
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status_sewa' => 'required|in:menunggu,aktif,selesai,batal',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->status_sewa = $request->status_sewa;

        // Opsional: logika tambahan jika status aktif dan pembayaran belum dibayar
        if ($request->status_sewa === 'aktif' && $booking->status_pembayaran === 'belum dibayar') {
            // bisa tambahkan logika pembayaran
        }

        $booking->save();

        return redirect()->route('admin.booking.index')
                         ->with('success', 'Status booking berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.booking.index')
                         ->with('success', 'Booking berhasil dihapus.');
    }
}
