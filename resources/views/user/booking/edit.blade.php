@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl">
        <!-- Header -->
        <div class="bg-gradient-to-r from-[#ea3882] to-[#d12670] p-6 rounded-t-xl">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-white mb-1">Edit Booking</h2>
                    <p class="text-pink-100 text-sm">ID: #{{ str_pad($booking->id_booking, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
                <a href="{{ route('user.booking.show', $booking->id_booking) }}" 
                   class="text-white hover:text-pink-100 transition">
                    <i class="fas fa-times text-2xl"></i>
                </a>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('error'))
        <div class="mx-6 mt-6 bg-red-50 border-l-4 border-red-500 text-red-800 px-4 py-3 rounded">
            <div class="flex items-center gap-2">
                <i class="fas fa-exclamation-circle"></i>
                <span class="text-sm">{{ session('error') }}</span>
            </div>
        </div>
        @endif

        @if($errors->any())
        <div class="mx-6 mt-6 bg-red-50 border-l-4 border-red-500 text-red-800 px-4 py-3 rounded">
            <div class="flex items-start gap-2">
                <i class="fas fa-exclamation-circle mt-0.5"></i>
                <div>
                    <p class="font-semibold text-sm mb-1">Terdapat kesalahan:</p>
                    <ul class="text-sm list-disc list-inside">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <!-- Form -->
        <form action="{{ route('user.booking.update', $booking->id_booking) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <!-- Booking Info Summary -->
            <div class="bg-[#ffe6e2] border border-[#f5acca] rounded-lg p-4 mb-6">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 bg-[#ea3882] rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-info-circle text-white"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-800 mb-2 text-sm">Informasi Booking</h3>
                        <div class="grid grid-cols-2 gap-3 text-xs text-gray-700">
                            <div>
                                <span class="text-gray-500">Kos:</span>
                                <p class="font-semibold">{{ $booking->kost->nama_kos ?? '-' }}</p>
                            </div>
                            <div>
                                <span class="text-gray-500">Kamar:</span>
                                <p class="font-semibold">{{ $booking->kamar->nomor_kamar ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Fields -->
            <div class="space-y-5">
                <!-- Harga per Bulan (Read Only) -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-money-bill-wave text-[#ea3882] mr-1"></i>
                        Harga per Bulan
                    </label>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-3">
                        <p class="font-bold text-gray-800">Rp {{ number_format($booking->harga, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-500 mt-1">Harga tidak dapat diubah</p>
                    </div>
                </div>

                <!-- Lama Sewa -->
                <div>
                    <label for="lama_sewa" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar-alt text-[#ea3882] mr-1"></i>
                        Lama Sewa (Bulan) <span class="text-red-500">*</span>
                    </label>
                    <select name="lama_sewa" id="lama_sewa" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#ea3882] focus:border-transparent transition"
                            onchange="updateTotal()">
                        <option value="">-- Pilih Durasi --</option>
                        @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ old('lama_sewa', $booking->lama_sewa) == $i ? 'selected' : '' }}>
                            {{ $i }} Bulan
                        </option>
                        @endfor
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Minimal 1 bulan, maksimal 12 bulan</p>
                </div>

                <!-- Total Pembayaran (Auto Calculate) -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calculator text-[#ea3882] mr-1"></i>
                        Total Pembayaran
                    </label>
                    <div class="bg-[#ffe6e2] border-2 border-[#f5acca] rounded-lg px-4 py-3">
                        <p id="total_display" class="font-bold text-[#ea3882] text-xl">
                            Rp {{ number_format($booking->harga * $booking->lama_sewa, 0, ',', '.') }}
                        </p>
                        <p class="text-xs text-gray-600 mt-1">Total otomatis dihitung berdasarkan durasi sewa</p>
                    </div>
                </div>

                <!-- Periode Sewa Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h4 class="font-semibold text-sm text-gray-800 mb-3 flex items-center gap-2">
                        <i class="fas fa-calendar-check text-blue-600"></i>
                        Estimasi Periode Sewa
                    </h4>
                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div>
                            <p class="text-gray-600">Mulai:</p>
                            <p class="font-bold text-gray-800">{{ $booking->created_at->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Berakhir:</p>
                            <p id="end_date_display" class="font-bold text-gray-800">
                                {{ $booking->created_at->copy()->addMonths($booking->lama_sewa)->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Catatan -->
                <div>
                    <label for="catatan" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-sticky-note text-[#ea3882] mr-1"></i>
                        Catatan (Opsional)
                    </label>
                    <textarea name="catatan" id="catatan" rows="3"
                              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#ea3882] focus:border-transparent transition resize-none"
                              placeholder="Tambahkan catatan khusus jika diperlukan...">{{ old('catatan', $booking->catatan ?? '') }}</textarea>
                </div>
            </div>

            <!-- Warning Info -->
            <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                <div class="flex items-start gap-3">
                    <i class="fas fa-exclamation-triangle text-yellow-600 mt-0.5"></i>
                    <div class="text-xs text-yellow-800">
                        <p class="font-semibold mb-1">Perhatian:</p>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Perubahan akan mempengaruhi total pembayaran</li>
                            <li>Pastikan data yang Anda masukkan sudah benar</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 mt-6 pt-6 border-t border-gray-200">
                <a href="{{ route('user.booking.show', $booking->id_booking) }}" 
                   class="flex-1 bg-white border-2 border-gray-300 text-gray-700 font-semibold py-3 px-4 rounded-lg hover:bg-gray-50 transition text-center">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </a>
                <button type="submit" 
                        class="flex-1 bg-gradient-to-r from-[#ea3882] to-[#d12670] hover:from-[#d12670] hover:to-[#b81e5a] text-white font-semibold py-3 px-4 rounded-lg transition">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Auto calculate total
function updateTotal() {
    const lamaSewa = document.getElementById('lama_sewa').value;
    const harga = {{ $booking->harga }};
    
    if (lamaSewa) {
        const total = harga * parseInt(lamaSewa);
        document.getElementById('total_display').textContent = 
            'Rp ' + total.toLocaleString('id-ID');
        
        // Update end date
        const startDate = new Date('{{ $booking->created_at->format('Y-m-d') }}');
        const endDate = new Date(startDate);
        endDate.setMonth(endDate.getMonth() + parseInt(lamaSewa));
        
        const options = { day: 'numeric', month: 'short', year: 'numeric' };
        document.getElementById('end_date_display').textContent = 
            endDate.toLocaleDateString('id-ID', options);
    }
}

// Confirm before submit
document.querySelector('form').addEventListener('submit', function(e) {
    const lamaSewa = document.getElementById('lama_sewa').value;
    const total = {{ $booking->harga }} * parseInt(lamaSewa);
    
    if (!confirm(`Anda yakin ingin mengubah booking ini?\n\nDurasi: ${lamaSewa} bulan\nTotal: Rp ${total.toLocaleString('id-ID')}\n\nPerubahan tidak dapat dibatalkan setelah disimpan.`)) {
        e.preventDefault();
    }
});
</script>
@endsection