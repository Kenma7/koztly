<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kosan; 
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Halaman konfirmasi booking (menerima data dari form quick booking)
     */
    public function create(Request $request, $id)
    {
        $kos = Kosan::findOrFail($id);
        
        // Validasi data dari query parameters (dari form quick booking)
        $validated = $request->validate([
            'tanggal_mulai' => 'required|date',
            'lama_sewa' => 'required|integer|min:1',
        ]);

        $bookingData = [
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'lama_sewa' => $validated['lama_sewa'],
        ];

        $totalBiaya = $kos->harga * $bookingData['lama_sewa'];

        // Dummy user data
        $user = (object) [
            'name' => 'User Testing',
            'phone_number' => '08123456789',
            'gender' => 'Laki-laki',
            'email' => 'user@example.com',
        ];

        return view('kosan.booking', compact('kos', 'bookingData', 'totalBiaya', 'user'));
    }

    /**
     * Process final booking (dari halaman konfirmasi)
     */
    public function store(Request $request, $id)
    {
        logger('=== DEBUG BOOKING STORE ===');
        logger('Kosan ID: ' . $id);

         $kosan = Kosan::find($id);
    if (!$kosan) {
        logger('Kosan not found for ID: ' . $id);
        return back()->with('error', 'Kosan tidak ditemukan!');
    }
    logger('Kosan found: ' . $kosan->nama_kos);

        $request->validate([
            'jumlah_penghuni' => 'required|integer|min:1|max:4',
            'catatan' => 'nullable|string|max:500',
            'lama_sewa' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'total_biaya' => 'required|integer'
        ]);

         logger('Validation passed');

        // Cari kamar yang tersedia
        $kamar = \App\Models\Kamar::where('id_kos', $id)
                                 ->where('status', 'tersedia')
                                 ->first();
        
          logger('Kamar found:', [$kamar ? $kamar->toArray() : 'NULL']);

           if (!$kamar) {
        logger('No available kamar for kos: ' . $id);
        return back()->with('error', 'Maaf, tidak ada kamar tersedia untuk kosan ini.');
    }

        if (!$kamar) {
            return back()->with('error', 'Maaf, tidak ada kamar tersedia untuk kosan ini.');
        }

        // Create booking dengan field tambahan
        $booking = Booking::create([
            'id_user' => 1, // dummy user_id
            'id_kos' => $id,
            'id_kamar' => $kamar->id_kamar,
            'harga' => $request->total_biaya,
            'lama_sewa' => $request->lama_sewa,
            'tanggal_masuk' => $request->tanggal_mulai,
            'jumlah_penghuni' => $request->jumlah_penghuni,
            'catatan' => $request->catatan,
            'status_pembayaran' => 'belum dibayar',
            'bukti_tf' => null,
            'status_sewa' => 'menunggu',
        ]);

        // Update status kamar jadi dipesan
        $kamar->update(['status' => 'dibooking']);

        return redirect()->route('booking.show', $booking->id_booking)
            ->with('success', 'Booking berhasil diajukan! Status: Menunggu persetujuan. ID: ' . $booking->id_booking);
    }

    // Detail booking
    public function show($id)
    {
        $booking = Booking::with(['kosan', 'kamar'])->findOrFail($id);
        return view('booking.show', compact('booking'));
    }

    // Riwayat booking
    public function index()
    {
        $bookings = Booking::where('id_user', 1)
                          ->with(['kosan', 'kamar'])
                          ->orderBy('created_at', 'desc')
                          ->get();
        return view('booking.index', compact('bookings'));
    }
}