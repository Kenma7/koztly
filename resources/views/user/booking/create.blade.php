@extends('layouts.app')

@section('title', 'Konfirmasi Booking - ' . $kos->nama_kos)

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="mb-6">
        <a href="{{ route('kosan.show', $kos->id_kos) }}" class="text-blue-600 hover:text-blue-800">
            &larr; Kembali ke Detail Kosan
        </a>
    </div>

    <h1 class="text-2xl font-bold mb-2">Konfirmasi Booking</h1>
    <p class="text-gray-600 mb-6">{{ $kos->nama_kos }} - {{ $kos->lokasi_kos }}</p>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Informasi Kosan & Biaya -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Informasi Kosan & Biaya</h2>
            
            <div class="space-y-3 mb-6">
                <div class="flex justify-between">
                    <span class="font-medium">Nama Kosan:</span>
                    <span>{{ $kos->nama_kos }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium">Lokasi:</span>
                    <span class="text-right">{{ $kos->lokasi_kos }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium">Kategori:</span>
                    <span>{{ $kos->kategori }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium">Harga per bulan:</span>
                    <span>Rp {{ number_format($kos->harga, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Rincian Biaya -->
            <div class="pt-4 border-t">
                <h3 class="font-semibold mb-3">Rincian Biaya</h3>
                <div class="flex justify-between mb-2">
                    <span>Lama sewa:</span>
                    <span>{{ $bookingData['lama_sewa'] }} bulan</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Tanggal mulai:</span>
                    <span>{{ \Carbon\Carbon::parse($bookingData['tanggal_mulai'])->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between font-semibold text-lg mt-3 pt-3 border-t">
                    <span>Total Biaya:</span>
                    <span>Rp {{ number_format($totalBiaya, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Informasi Penyewa & Form Tambahan -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Informasi Penyewa</h2>
            
            <form action="{{ route('booking.store', $kos->id_kos) }}" method="POST">
                @csrf
                <!-- Hidden fields untuk data dari quick booking -->
                <input type="hidden" name="lama_sewa" value="{{ $bookingData['lama_sewa'] }}">
                <input type="hidden" name="tanggal_mulai" value="{{ $bookingData['tanggal_mulai'] }}">
                <input type="hidden" name="total_biaya" value="{{ $totalBiaya }}">
                
                <div class="space-y-4">
                    <!-- Data User (Read-only) -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                        <input type="text" value="{{ $user->name }}" class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100" readonly>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium mb-1">No. HP</label>
                        <input type="tel" value="{{ $user->phone_number }}" class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100" readonly>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" value="{{ $user->email }}" class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100" readonly>
                    </div>

                    <!-- Field Tambahan untuk Database -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Jumlah Penghuni *</label>
                        <select name="jumlah_penghuni" class="w-full border border-gray-300 rounded px-3 py-2" required>
                            <option value="1">1 Orang</option>
                            <option value="2">2 Orang</option>
                            <option value="3">3 Orang</option>
                            <option value="4">4 Orang</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Maksimal 4 orang per kamar</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium mb-1">Catatan untuk Pemilik (Opsional)</label>
                        <textarea name="catatan" rows="3" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Contoh: Membawa kulkas kecil, ada kendaraan motor, dll."></textarea>
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-semibold">
                        Konfirmasi & Ajukan Sewa
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection