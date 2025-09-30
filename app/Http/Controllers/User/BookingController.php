<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        // UNTUK TESTING: Hardcode user_id = 1
        // Nanti ganti jadi: Auth::id() kalau sudah ada login
        $userId = 1; 
        
        $query = Booking::with(['kamar.kosan', 'user'])
            ->where('id_user', $userId)
            ->orderBy('created_at', 'desc');

        // 🔍 Filter berdasarkan search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('kamar.kosan', function ($q) use ($search) {
                $q->where('nama_kos', 'like', "%{$search}%")
                ->orWhere('lokasi_kos', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan status_sewa
        if ($request->has('status') && $request->status !== null) {
            if ($request->status === 'menunggu') {
                $query->where('status_sewa', 'menunggu');
            } elseif ($request->status === 'aktif') {
                $query->where('status_sewa', 'aktif');
            } elseif ($request->status === 'selesai') {
                $query->where('status_sewa', 'selesai');
            } elseif ($request->status === 'batal') {
                $query->where('status_sewa', 'batal');
            }
        }

        $bookings = $query->paginate(9);

        // Statistik berdasarkan status_sewa
        $totalBookings    = Booking::where('id_user', $userId)->count();
        $menungguBookings = Booking::where('id_user', $userId)->where('status_sewa', 'menunggu')->count();
        $aktifBookings    = Booking::where('id_user', $userId)->where('status_sewa', 'aktif')->count();
        $selesaiBookings  = Booking::where('id_user', $userId)->where('status_sewa', 'selesai')->count();
        $batalBookings    = Booking::where('id_user', $userId)->where('status_sewa', 'batal')->count();
        $belumBayarBookings = Booking::where('id_user', $userId)->where('status_pembayaran', 'belum dibayar')->count();
        $sudahBayarBookings = Booking::where('id_user', $userId)->where('status_pembayaran', 'sudah dibayar')->count();


        return view('user.booking.index', compact(
            'bookings',
            'totalBookings',
            'menungguBookings',
            'aktifBookings',
            'selesaiBookings',
            'batalBookings',
            'belumBayarBookings',
            'sudahBayarBookings'
        ));

    }

    public function show($id)
    {
        $userId = 1; // Hardcode untuk testing
        
        $booking = Booking::with(['kamar.kosan', 'user'])
            ->where('id_booking', $id)
            ->where('id_user', $userId)
            ->firstOrFail();

        return view('user.booking.show', compact('booking'));
    }

    public function cancel($id)
    {
        $userId = 1; // Hardcode untuk testing
        
        $booking = Booking::where('id_booking', $id)
            ->where('id_user', $userId)
            ->where('status_pembayaran', 'belum dibayar')
            ->firstOrFail();

        $booking->status_sewa = 'batal';
        $booking->save();

        return redirect()->route('user.booking.index')
            ->with('success', 'Booking berhasil dibatalkan.');
    }
}