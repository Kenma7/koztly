<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kosan;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF; // DomPDF

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
        $query->where('status_sewa', $request->status);
    }

        // pakai hasil query yang sudah difilter
        $bookings = $query->get();


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

    public function create(Request $request, $id)
    {
        try {
            $kos = Kosan::findOrFail($id);
            
            $validated = $request->validate([
                'tanggal_mulai' => 'required|date',
                'lama_sewa' => 'required|integer|min:1',
            ]);

            $bookingData = [
                'tanggal_mulai' => $validated['tanggal_mulai'],
                'lama_sewa' => $validated['lama_sewa'],
            ];

            $totalBiaya = $kos->harga * $bookingData['lama_sewa'];
            $user = Auth::user();

            return view('user.booking.create', compact('kos', 'bookingData', 'totalBiaya', 'user'));
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem');
        }
    }


    public function show($id)
    {
        // Ambil ID user yang sedang login
        $userId = Auth::id();
        
        $booking = Booking::with(['kamar.kosan', 'user'])
            ->where('id_booking', $id)
            ->where('id_user', $userId)
            ->firstOrFail();

        return view('user.booking.history-detail', compact('booking'));
    }

     public function store(Request $request, $id)
{
    logger('=== BOOKING STORE START ===');
    logger('Kosan ID: ' . $id);
    logger('Request Data: ', $request->all());
    
    try {
        $kosan = Kosan::find($id);
        if (!$kosan) {
            logger('Kosan not found: ' . $id);
            return redirect()->back()->with('error', 'Kosan tidak ditemukan!');
        }
        logger('Kosan found: ' . $kosan->nama_kos);

        // Cek existing booking
        $existingBooking = Booking::where('id_user', Auth::id())
                                ->where('id_kos', $id)
                                ->whereIn('status_sewa', ['menunggu', 'aktif'])
                                ->first();
        
        if ($existingBooking) {
            logger('Existing booking found: ' . $existingBooking->id_booking);
            return redirect()->back()->with('sweet_warning', 'Anda sudah memiliki booking aktif untuk kosan ini!');
        }

        // Validasi
        $request->validate([
            'jumlah_penghuni' => 'required|integer|min:1|max:4',
            'catatan' => 'nullable|string|max:500',
            'lama_sewa' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'total_biaya' => 'required|integer'
        ]);
        logger('Validation passed');

        // Cari kamar tersedia
        $kamar = Kamar::where('id_kos', $id)
                     ->where('status', 'tersedia')
                     ->first();
        
        logger('Kamar search result: ' . ($kamar ? 'FOUND' : 'NOT FOUND'));

        if (!$kamar) {
            logger('No available kamar for kos: ' . $id);
            return redirect()->back()->with('error', 'Maaf, tidak ada kamar tersedia untuk kosan ini.');
        }

        // Create booking
        logger('Creating booking...');
        $booking = Booking::create([
            'id_user' => Auth::id(),
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
        logger('Booking created: ' . $booking->id_booking);

        // Update status kamar
        $kamar->update(['status' => 'dibooking']);
        logger('Kamar status updated');
        
        logger('=== BOOKING STORE SUCCESS ===');
        return redirect()->route('user.bookings.detail', $booking->id_booking)
            ->with('sweet_success', 'Booking Berhasil! 🎉');

    } catch (\Exception $e) {
        logger('Booking store ERROR: ' . $e->getMessage());
        logger('Error in: ' . $e->getFile() . ':' . $e->getLine());
        return redirect()->back()->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
    }
}


     public function showHistory($id)
    {
        $userId = Auth::id();
        $booking = Booking::with(['kamar.kosan', 'user'])
            ->where('id_booking', $id)
            ->where('id_user', $userId)
            ->firstOrFail();

        return view('user.booking.history-detail', compact('booking'));
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
    $userId = Auth::id();

    

    $booking = Booking::with('kamar.kosan')
        ->where('id_booking', $id)
        ->where('id_user', $userId)
        ->firstOrFail();

    $kosan = Kosan::find($booking->kosan_id); 
    
    // Hanya boleh edit kalau masih menunggu & belum bayar
    if (
        $booking->status_sewa !== 'menunggu' ||
        $booking->status_pembayaran !== 'belum dibayar' ||
        $booking->bukti_tf !== null
    ) {
        return redirect()->route('user.bookings.detail', $id)
            ->with('error', 'Booking ini tidak dapat diubah.');
    }

    $validated = $request->validate([
        'lama_sewa' => 'required|integer|min:1|max:12',
        'catatan' => 'nullable|string|max:500'
    ]);

    // Ambil harga kos per bulan dari relasi Kosan, bukan dari booking
    $hargaPerBulan = $booking->kamar->kosan->harga;

    // Hitung total harga baru
    $lamaSewaBaru = $validated['lama_sewa'];
    $totalHargaBaru = $hargaPerBulan * $lamaSewaBaru;

    // Update data booking
    $booking->update([
        'lama_sewa' => $lamaSewaBaru,
        'harga' => $totalHargaBaru,
        'catatan' => $validated['catatan'] ?? $booking->catatan,
        
        
    ]);

    return redirect()->route('user.bookings.detail', $id)
        ->with('success', 'Booking berhasil diupdate. Total pembayaran: Rp ' . number_format($totalHargaBaru, 0, ',', '.'));
}




    public function cancel($id)
    {
        try {
            $userId = Auth::id();

            $booking = Booking::where('id_booking', $id)
                ->where('id_user', $userId)
                ->firstOrFail();
            
            if ($booking->status_sewa == 'batal') {
                return redirect()->route('user.bookings.detail', $id)->with('info', 'Booking sudah dibatalkan.');
            }
            
            if ($booking->status_pembayaran == 'sudah dibayar') {
                return redirect()->route('user.booking.show', $id)->with('sweet_warning', 'Tidak bisa batalkan booking yang sudah dibayar');
            }

            // Update status
            $booking->update(['status_sewa' => 'batal']);
            
            // Kembalikan status kamar
            if ($booking->kamar) {
                $booking->kamar->update(['status' => 'tersedia']);
            }

            return redirect()->route('user.booking.show', $id)->with('info', 'Booking berhasil dibatalkan.');

        } catch (\Exception $e) {
            return redirect()->route('user.booking.show', $id)->with('error', 'Gagal membatalkan booking.');
        }
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

        return redirect()->route('user.bookings.index')
            ->with('success', 'Booking berhasil dihapus.');
    }

    public function uploadBukti(Request $request, $id)
{
    try {
        $booking = Booking::findOrFail($id);
        
        // Cek status
        if ($booking->status_sewa == 'batal') {
            return redirect()->route('user.booking.show', $id)->with('error', 'Booking sudah dibatalkan.');
        }
        
        if ($booking->status_pembayaran == 'sudah dibayar') {
            return redirect()->route('user.booking.show', $id)->with('warning', 'Bukti transfer sudah diupload.');
        }

        // Validasi file
        $request->validate([
            'bukti_tf' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('bukti_tf')) {
            $file = $request->file('bukti_tf');
            
            // Hapus bukti lama jika ada
            if ($booking->bukti_tf && Storage::exists('public/' . $booking->bukti_tf)) {
                Storage::delete('public/' . $booking->bukti_tf);
            }
            
            // Simpan file - method store() sudah otomatis tambah folder
            $imagePath = $file->store('bukti_tf', 'public');

            // Update booking
            $booking->bukti_tf = $imagePath;
            $booking->status_pembayaran = 'sudah dibayar';
            $booking->save();
            
            return redirect()->route('user.booking.show', $id)
                ->with('sweet_success', 'Pembayaran Berhasil! ✅');

        } else {
            return redirect()->route('user.bookings.show', $id)->with('error', 'File tidak ditemukan.');
        }
        
    } catch (\Exception $e) {
        return redirect()->route('user.bookings.index', $id)->with('error', 'Gagal upload bukti transfer.');
    }
}
         protected function customValidationMessages()
    {
        return [
            'bukti_tf.required' => 'Harus memilih file bukti transfer',
            'bukti_tf.image' => 'File harus berupa gambar (JPG, PNG)',
            'bukti_tf.mimes' => 'Format file harus JPG, JPEG, atau PNG',
            'bukti_tf.max' => 'Ukuran file maksimal 2MB',
            'jumlah_penghuni.required' => 'Jumlah penghuni harus diisi',
            'jumlah_penghuni.min' => 'Minimal 1 penghuni',
            'jumlah_penghuni.max' => 'Maksimal 4 penghuni',
            'lama_sewa.required' => 'Lama sewa harus diisi',
            'lama_sewa.min' => 'Minimal sewa 1 bulan',
            'tanggal_mulai.required' => 'Tanggal mulai harus diisi',
            'tanggal_mulai.date' => 'Format tanggal tidak valid',
        ];
    }

    public function exportPDF($id)
{
    $booking = Booking::with(['user', 'kosan', 'kamar'])->findOrFail($id);

 $pdf = PDF::loadView('user.booking.pdf', compact('booking'));
return $pdf->download('booking-'.$booking->id_booking.'.pdf');

}

}



