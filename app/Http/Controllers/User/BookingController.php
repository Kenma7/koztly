<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kosan; 
use App\Models\Booking;
use App\Models\Kamar;

class BookingController extends Controller
{
    /**
     * Halaman konfirmasi booking
     */
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

            $user = (object) [
                'name' => 'User Testing',
                'phone_number' => '08123456789',
                'gender' => 'Laki-laki',
                'email' => 'user@example.com',
            ];

            return view('kosan.booking', compact('kos', 'bookingData', 'totalBiaya', 'user'));
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem');
        }
    }

    /**
     * Process final booking
     */
    public function store(Request $request, $id)
    {
        try {
            $kosan = Kosan::find($id);
            if (!$kosan) {
                return redirect()->back()->with('error', 'Kosan tidak ditemukan!');
            }

            // Cek existing booking
            $existingBooking = Booking::where('id_user', 1)
                                    ->where('id_kos', $id)
                                    ->whereIn('status_sewa', ['menunggu', 'aktif'])
                                    ->first();
            
            if ($existingBooking) {
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

            // Cari kamar tersedia
            $kamar = Kamar::where('id_kos', $id)
                         ->where('status', 'tersedia')
                         ->first();

            if (!$kamar) {
                return redirect()->back()->with('error', 'Maaf, tidak ada kamar tersedia untuk kosan ini.');
            }

            // Create booking
            $booking = Booking::create([
                'id_user' => 1,
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

            // Update status kamar
            $kamar->update(['status' => 'dibooking']);
            
            return redirect()->route('booking.show', $booking->id_booking)
                ->with('sweet_success', 'Booking Berhasil! 🎉');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }

    /**
     * Show booking details
     */
    public function show($id)
    {
        $booking = Booking::with(['kosan', 'kamar'])->findOrFail($id);
        return view('booking.show', compact('booking'));
    }

    /**
     * Upload bukti transfer
     */
    public function uploadBukti(Request $request, $id)
    {
        try {
            $booking = Booking::findOrFail($id);
            
            // Cek status
            if ($booking->status_sewa == 'batal') {
                return redirect()->route('booking.show', $id)->with('error', 'Booking sudah dibatalkan.');
            }
            
            if ($booking->status_pembayaran == 'sudah dibayar') {
                return redirect()->route('booking.show', $id)->with('warning', 'Bukti transfer sudah diupload.');
            }

            // Validasi file
            $request->validate([
                'bukti_tf' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            if ($request->hasFile('bukti_tf')) {
                $file = $request->file('bukti_tf');
                $imagePath = $file->store('bukti_tf', 'public');

                // Update booking
                $booking->bukti_tf = $imagePath;
                $booking->status_pembayaran = 'sudah dibayar';
                $booking->save();
                
                return redirect()->route('booking.show', $id)
                    ->with('sweet_success', 'Pembayaran Berhasil! ✅');

            } else {
                return redirect()->route('booking.show', $id)->with('error', 'File tidak ditemukan.');
            }
            
        } catch (\Exception $e) {
            return redirect()->route('booking.show', $id)->with('error', 'Gagal upload bukti transfer.');
        }
    }

    /**
     * Cancel booking
     */
    public function cancel($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            
            if ($booking->status_sewa == 'batal') {
                return redirect()->route('booking.show', $id)->with('info', 'Booking sudah dibatalkan.');
            }
            
            if ($booking->status_pembayaran == 'sudah dibayar') {
                return redirect()->route('booking.show', $id)->with('sweet_warning', 'Tidak bisa batalkan booking yang sudah dibayar');
            }

            // Update status
            $booking->update(['status_sewa' => 'batal']);
            
            // Kembalikan status kamar
            if ($booking->kamar) {
                $booking->kamar->update(['status' => 'tersedia']);
            }

            return redirect()->route('booking.show', $id)->with('info', 'Booking berhasil dibatalkan.');

        } catch (\Exception $e) {
            return redirect()->route('booking.show', $id)->with('error', 'Gagal membatalkan booking.');
        }
    }

    /*
     * Riwayat booking
     
    public function index()
    {
        $bookings = Booking::where('id_user', 1)
                          ->with(['kosan', 'kamar'])
                          ->orderBy('created_at', 'desc')
                          ->get();
        
        return view('booking.index', compact('bookings'));
    }*/

    /**
     * Custom validation messages (optional)
     */
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
}