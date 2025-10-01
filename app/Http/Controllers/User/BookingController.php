<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        // Ambil ID user yang sedang login
        $userId = Auth::id();
        
        $query = Booking::with(['kamar.kosan', 'user'])
            ->where('id_user', $userId)
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan search
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

        $bookings = Booking::with(['kamar.kosan'])
                 ->where('id_user', $userId)
                 ->get();


        // Statistik berdasarkan status_sewa
        $totalBookings = Booking::where('id_user', $userId)->count();
        $menungguBookings = Booking::where('id_user', $userId)->where('status_sewa', 'menunggu')->count();
        $aktifBookings = Booking::where('id_user', $userId)->where('status_sewa', 'aktif')->count();
        $selesaiBookings = Booking::where('id_user', $userId)->where('status_sewa', 'selesai')->count();
        $batalBookings = Booking::where('id_user', $userId)->where('status_sewa', 'batal')->count();
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
        // Ambil ID user yang sedang login
        $userId = Auth::id();
        
        $booking = Booking::with(['kamar.kosan', 'user'])
            ->where('id_booking', $id)
            ->where('id_user', $userId)
            ->firstOrFail();

        return view('user.booking.show', compact('booking'));
    }

    public function edit($id)
    {
        // Ambil ID user yang sedang login
        $userId = Auth::id();
        
        $booking = Booking::with(['kamar.kosan', 'user'])
            ->where('id_booking', $id)
            ->where('id_user', $userId)
            ->firstOrFail();

        // Cek apakah booking bisa diedit (hanya yang status menunggu, belum dibayar, dan belum upload bukti)
        if ($booking->status_sewa !== 'menunggu' || 
            $booking->status_pembayaran !== 'belum dibayar' || 
            $booking->bukti_tf !== null) {
            return redirect()->route('user.booking.show', $id)
                ->with('error', 'Booking ini tidak dapat diedit. Hanya booking dengan status menunggu dan belum upload bukti transfer yang bisa diubah.');
        }

        return view('user.booking.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        // Ambil ID user yang sedang login
        $userId = Auth::id();
        
        $booking = Booking::where('id_booking', $id)
            ->where('id_user', $userId)
            ->firstOrFail();

        // Validasi: hanya booking dengan status menunggu, belum bayar, dan belum upload bukti yang bisa diupdate
        if ($booking->status_sewa !== 'menunggu' || 
            $booking->status_pembayaran !== 'belum dibayar' || 
            $booking->bukti_tf !== null) {
            return redirect()->route('user.booking.show', $id)
                ->with('error', 'Booking ini tidak dapat diubah.');
        }

        // Validasi input
        $validated = $request->validate([
            'lama_sewa' => 'required|integer|min:1|max:12',
            'catatan' => 'nullable|string|max:500'
        ], [
            'lama_sewa.required' => 'Durasi sewa harus diisi',
            'lama_sewa.integer' => 'Durasi sewa harus berupa angka',
            'lama_sewa.min' => 'Durasi sewa minimal 1 bulan',
            'lama_sewa.max' => 'Durasi sewa maksimal 12 bulan',
            'catatan.max' => 'Catatan maksimal 500 karakter'
        ]);

        // Update booking
        $booking->lama_sewa = $validated['lama_sewa'];
        
        // Jika ada kolom catatan di database, update juga
        if (isset($validated['catatan'])) {
            $booking->catatan = $validated['catatan'];
        }
        
        $booking->save();

        return redirect()->route('user.booking.show', $id)
            ->with('success', 'Booking berhasil diupdate. Total pembayaran: Rp ' . number_format($booking->harga * $booking->lama_sewa, 0, ',', '.'));
    }

    public function cancel($id)
    {
        $userId = Auth::id();
        
        $booking = Booking::where('id_booking', $id)
            ->where('id_user', $userId)
            ->where('status_pembayaran', 'belum dibayar')
            ->firstOrFail();

        $booking->status_sewa = 'batal';
        $booking->save();

        return redirect()->route('user.booking.index')
            ->with('success', 'Booking berhasil dibatalkan.');
    }

    public function destroy($id)
    {
        $userId = Auth::id();
        
        $booking = Booking::where('id_booking', $id)
            ->where('id_user', $userId)
            ->where('status_sewa', 'batal')
            ->firstOrFail();

        // Hapus bukti transfer jika ada
        if ($booking->bukti_tf) {
            $filePath = public_path('uploads/' . $booking->bukti_tf);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $booking->delete();

        return redirect()->route('user.booking.index')
            ->with('success', 'Booking berhasil dihapus.');
    }

    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_tf' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $booking = Booking::findOrFail($id);

        if ($request->hasFile('bukti_tf')) {
            $file = $request->file('bukti_tf');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);

            $booking->bukti_tf = $filename;
            $booking->status_pembayaran = 'sudah dibayar'; // ✅ otomatis update status
            $booking->save();
        }

        // balik lagi ke halaman sebelumnya (detail booking)
        return redirect()->back()->with('success', 'Bukti transfer berhasil diupload!');
    }
}