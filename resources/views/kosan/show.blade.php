@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Bagian Kiri: Detail Kos -->
    <div class="lg:col-span-2">
        <!-- Foto utama -->
        <div class="rounded-lg overflow-hidden shadow">
            <img src="{{ $kos->gambar ?? 'https://via.placeholder.com/800x400' }}" 
                 alt="{{ $kos->nama }}" 
                 class="w-full h-72 object-cover">
        </div>

        <!-- Nama Kos -->
        <h1 class="mt-6 text-2xl font-bold text-gray-900">{{ $kos->nama }}</h1>
        <p class="text-gray-600 mt-1">{{ $kos->alamat }}</p>

        <!-- Info tambahan -->
        <div class="flex items-center space-x-4 mt-3 text-sm text-gray-500">
            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs">
                {{ $kos->tipe ?? 'Kos Campur' }}
            </span>
            <span><i class="fas fa-map-marker-alt mr-1"></i> {{ $kos->lokasi ?? 'Jakarta' }}</span>
            <span class="text-red-500 font-medium">Tersisa {{ $kos->sisa_kamar ?? 1 }} kamar</span>
        </div>

        <!-- Deskripsi -->
        <div class="mt-6">
            <h2 class="text-lg font-semibold text-gray-800">Deskripsi</h2>
            <p class="mt-2 text-gray-600 leading-relaxed">
                {{ $kos->deskripsi ?? 'Belum ada deskripsi untuk kos ini.' }}
            </p>
        </div>
    </div>

    <!-- Bagian Kanan: Booking -->
    <div class="lg:col-span-1">
        <div class="p-6 bg-white shadow-lg rounded-lg sticky top-20">
            <h3 class="text-2xl font-bold text-gray-900">
                Rp{{ number_format($kos->harga ?? 0, 0, ',', '.') }}/bulan
            </h3>

            <!-- Form Booking -->
            <form action="{{ route('kosan.booking.submit', $kos->id_kos) }}" method="POST" class="mt-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal mulai</label>
                    <input type="date" name="tanggal_mulai" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Durasi sewa</label>
                    <select name="lama_sewa" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="1">1 Bulan</option>
                        <option value="3">3 Bulan</option>
                        <option value="6">6 Bulan</option>
                        <option value="12">12 Bulan</option>
                    </select>
                </div>

                <button type="submit" 
                        class="w-full bg-green-600 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-green-700 transition">
                    Ajukan Sewa
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
