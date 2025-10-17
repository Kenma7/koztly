@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Bagian Kiri: Detail Kos -->
    <div class="lg:col-span-2">
        <!-- Foto utama dengan Fallback Logic -->
        <div class="rounded-lg overflow-hidden shadow">
            @php
                // Cek tipe gambar
                if ($kos->gambar_kos) {
                    if (filter_var($kos->gambar_kos, FILTER_VALIDATE_URL)) {
                        // URL external
                        $imageSrc = $kos->gambar_kos;
                    } else {
                        // Local file - cek multiple paths
                        $paths = [
                            'storage/' . $kos->gambar_kos,
                            'uploads/kosan/' . $kos->gambar_kos,
                            'storage/uploads/kosan/' . $kos->gambar_kos
                        ];
                        
                        $imageSrc = 'https://via.placeholder.com/800x400'; // default fallback
                        
                        foreach ($paths as $path) {
                            if (file_exists(public_path($path))) {
                                $imageSrc = asset($path);
                                break;
                            }
                        }
                    }
                } else {
                    $imageSrc = 'https://via.placeholder.com/800x400';
                }
            @endphp

            <img src="{{ $imageSrc }}" 
                 alt="{{ $kos->nama_kos }}" 
                 class="w-full h-72 object-cover"
                 onerror="this.src='https://via.placeholder.com/800x400?text=Image+Error'">
        </div>

        <!-- Nama Kos -->
        <h1 class="mt-6 text-2xl font-bold text-gray-900">{{ $kos->nama_kos }}</h1>
        <p class="text-gray-600 mt-1">{{ $kos->lokasi_kos }}</p>

        <!-- Info tambahan -->
        <div class="flex items-center space-x-4 mt-3 text-sm text-gray-500">
            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs">
                {{ $kos->kategori }}
            </span>
            <span><i class="fas fa-map-marker-alt mr-1"></i> {{ $kos->lokasi_kos }}</span>
            <span class="text-red-500 font-medium">Tersisa {{ $kos->sisa_kamar_count }} dari {{ $kos->total_kamar_count }} kamar</span>
        </div>

        <!-- Deskripsi -->
        <div class="mt-6">
            <h2 class="text-lg font-semibold text-gray-800">Fasilitas</h2>
            <p class="mt-2 text-gray-600 leading-relaxed">
                {{ $kos->fasilitas ?? 'Belum ada deskripsi untuk kos ini.' }}
            </p>
        </div>
    </div>

    <!-- Bagian Kanan: Booking -->
    <div class="lg:col-span-1">
        <div class="p-6 bg-white shadow-lg rounded-lg sticky top-20">
            <h3 class="text-2xl font-bold text-gray-900">
                Rp{{ number_format($kos->harga ?? 0, 0, ',', '.') }}/bulan
            </h3>

            <!-- Form Booking - FIX ACTION ROUTE -->
            <form action="{{ route('booking.create', $kos->id_kos) }}" method="GET" class="mt-6 space-y-4">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal mulai</label>
                    <input type="date" name="tanggal_mulai" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                           min="{{ date('Y-m-d') }}" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Durasi sewa</label>
                    <select name="lama_sewa" id="lama_sewa"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="1">1 Bulan</option>
                        <option value="3">3 Bulan</option>
                        <option value="6">6 Bulan</option>
                        <option value="12">12 Bulan</option>
                    </select>
                </div>

                <!-- Rincian Biaya (Auto Update) -->
                <div class="bg-gray-50 p-4 rounded-lg mt-4">
                    <h4 class="font-semibold text-gray-800 mb-2">Rincian Biaya</h4>
                    <div class="flex justify-between text-sm">
                        <span>Harga per bulan:</span>
                        <span>Rp {{ number_format($kos->harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm mt-1">
                        <span>Lama sewa:</span>
                        <span id="display_lama_sewa">1 bulan</span>
                    </div>
                    <div class="border-t mt-2 pt-2">
                        <div class="flex justify-between font-semibold">
                            <span>Total:</span>
                            <span id="total_biaya">Rp {{ number_format($kos->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <button type="submit" 
                        class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-semibold mt-4">
                    Ajukan Sewa
                </button>
            </form>
        </div>
    </div>
</div>

<script>
// Update rincian biaya secara real-time
document.getElementById('lama_sewa').addEventListener('change', function() {
    const hargaPerBulan = {{ $kos->harga }};
    const lamaSewa = this.value;
    const totalBiaya = hargaPerBulan * lamaSewa;
    
    // Update display
    document.getElementById('display_lama_sewa').textContent = lamaSewa + ' bulan';
    document.getElementById('total_biaya').textContent = 'Rp ' + totalBiaya.toLocaleString('id-ID');
});

// Juga update saat page load pertama kali
document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('lama_sewa');
    select.dispatchEvent(new Event('change'));
});
</script>
@endsection