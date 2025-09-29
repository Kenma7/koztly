<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of user bookings
     */
    public function index(Request $request)
    {
        $query = Booking::with(['kamar.kosan', 'user'])
            ->where('id_user', Auth::id())
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan status jika ada
        if ($request->has('status')) {
            if ($request->status === 'pending') {
                $query->where('status_pembayaran', 'pending');
            } elseif ($request->status === 'aktif') {
                $query->where('status_pembayaran', 'lunas')
                      ->where('status_sewa', 'aktif');
            } elseif ($request->status === 'selesai') {
                $query->where('status_sewa', 'selesai');
            }
        }

        $bookings = $query->paginate(9);

        return view('user.booking.index', compact('bookings'));
    }

    /**
     * Display the specified booking detail
     */
    public function show($id)
    {
        $booking = Booking::with(['kamar.kosan', 'user'])
            ->where('id_booking', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        return view('user.booking.show', compact('booking'));
    }

    /**
     * Upload bukti transfer
     */
    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_tf' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $booking = Booking::where('id_booking', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        if ($request->hasFile('bukti_tf')) {
            // Hapus file lama jika ada
            if ($booking->bukti_tf && file_exists(storage_path('app/public/' . $booking->bukti_tf))) {
                unlink(storage_path('app/public/' . $booking->bukti_tf));
            }

            // Simpan file baru
            $path = $request->file('bukti_tf')->store('bukti_transfer', 'public');
            $booking->bukti_tf = $path;
            $booking->save();

            return redirect()->back()->with('success', 'Bukti transfer berhasil diupload!');
        }

        return redirect()->back()->with('error', 'Gagal mengupload bukti transfer.');
    }

    /**
     * Cancel booking
     */
    public function cancel($id)
    {
        $booking = Booking::where('id_booking', $id)
            ->where('id_user', Auth::id())
            ->where('status_pembayaran', 'pending')
            ->firstOrFail();

        $booking->status_pembayaran = 'dibatalkan';
        $booking->save();

        return redirect()->route('user.booking.index')
            ->with('success', 'Booking berhasil dibatalkan.');
    }
}