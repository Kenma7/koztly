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
        'status_sewa' => 'required|in:menunggu,disetujui,aktif,selesai,batal',
    ]);

    $booking = Booking::with('kamar')->findOrFail($id);
    $booking->status_sewa = $request->status_sewa;
    $booking->save();

    // 🧠 Tambahan logika otomatis:
    if (in_array($request->status_sewa, ['selesai', 'batal'])) {
        // Kalau booking selesai atau dibatalkan → kamar jadi tersedia
        if ($booking->kamar) {
            $booking->kamar->status = 'tersedia';
            $booking->kamar->save();
        }
    } elseif ($request->status_sewa === 'aktif') {
        // Kalau booking diaktifkan → kamar otomatis terisi
        if ($booking->kamar) {
            $booking->kamar->status = 'dibooking';
            $booking->kamar->save();
        }
    }

    return redirect()->route('admin.booking.index')
                     ->with('success', 'Status booking berhasil diperbarui.');
}


    /**
     * Remove the specified resource from storage.
     */


    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status_sewa' => 'batal']);
            if ($booking->kamar) {
                $booking->kamar->update(['status' => 'tersedia']);
            }

        return redirect()->route('admin.booking.index')
                     ->with('success', 'Booking berhasil dibatalkan.');
    }



    public function destroy(string $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.booking.index')
                     ->with('success', 'Booking berhasil dihapus permanen.');
    }

    public function selesaikan($id)
{
    $booking = Booking::with('kamar')->findOrFail($id);

    // Ubah status booking jadi selesai
    $booking->status_sewa = 'selesai';
    $booking->save();

    // Ubah status kamar jadi tersedia kembali
    if ($booking->kamar) {
        $booking->kamar->status = 'tersedia';
        $booking->kamar->save();
    }

    return redirect()->route('admin.booking.index')->with('success', 'Booking diselesaikan dan kamar tersedia kembali.');
}

}
