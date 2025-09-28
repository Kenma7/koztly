@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">

    <!-- Search Bar -->
    <div class="flex justify-center mb-8">
        <div class="flex items-center w-full md:w-2/3 bg-white rounded-full shadow px-4 py-2">
            <input type="text" placeholder="Cari nama properti / alamat / daerah / kota"
                class="flex-grow px-2 py-1 text-sm focus:outline-none">
            <button class="flex items-center bg-yellow-400 text-black font-semibold px-4 py-2 rounded-full hover:bg-yellow-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                </svg>
                Cari
            </button>
        </div>
    </div>

    <!-- Grid Kosan -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($kosan as $kos)
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                <!-- Gambar -->
                <!--<img src="{{ asset('storage/'.$kos->gambar_kos) }}" alt="{{ $kos->nama_kos }}"
                     class="w-full h-40 object-cover"> -->
                <img src="https://picsum.photos/300/200?random=1"
                    class="w-full h-40 object-cover">

                <div class="p-4">
                    <!-- Kategori -->
                    <span class="text-xs font-bold uppercase 
                        @if(strtoupper($kos->kategori) == 'PRIA') text-blue-600 
                        @elseif(strtoupper($kos->kategori) == 'WANITA') text-pink-600 
                        @else text-orange-600 @endif">
                        {{ $kos->kategori }}
                    </span>

                    <!-- Lokasi -->
                    <p class="text-sm text-gray-600">{{ $kos->lokasi_kos }}</p>

                    <!-- Harga & Sisa Kamar -->
                    <p class="text-gray-800 font-semibold">Rp {{ number_format($kos->harga, 0, ',', '.') }}/bulan</p>
                    <p class="text-sm
                        @if($kos->sisaKamar() == 0) text-red-600
                        @else text-green-600 @endif">
                        sisa {{ $kos->sisaKamar() }} kamar
                    </p>

                    <!-- Nama Kos -->
                    <h3 class="mt-2 font-bold">{{ $kos->nama_kos }}</h3>

                    <!-- Statistik -->
                    <div class="flex items-center mt-2 text-sm text-gray-500 space-x-4">
                        <span class="flex items-center"><i class="fas fa-eye mr-1 text-green-600"></i> 311</span>
                        <span class="flex items-center"><i class="fas fa-heart mr-1 text-red-500"></i> 120</span>
                    </div>

                    <!-- Ikon Fasilitas -->
                    <div class="flex space-x-2 mt-3 text-gray-500">
                        <i class="fas fa-wifi"></i>
                        <i class="fas fa-snowflake"></i>
                        <i class="fas fa-motorcycle"></i>
                        <i class="fas fa-car"></i>
                        <i class="fas fa-tv"></i>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <!-- Pagination -->
    <div class="mt-8 flex justify-center">
        {{ $kosan->links() }}
    </div>

    <!-- Banner -->
    <div class="mt-12 bg-indigo-100 p-8 rounded-lg text-center shadow">
        <h2 class="text-2xl font-bold text-indigo-700 mb-2">Promo Spesial Bulan Ini!</h2>
        <p class="text-gray-700">Dapatkan diskon khusus untuk kosan pilihan tertentu</p>
    </div>

    <!-- Footer -->
    <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8 text-gray-600">
        <div>
            <h3 class="font-semibold mb-2">Tentang Kami</h3>
            <ul class="space-y-1 text-sm">
                <li><a href="#">Tentang Aplikasi</a></li>
                <li><a href="#">Kontak</a></li>
                <li><a href="#">FAQ</a></li>
            </ul>
        </div>
        <div>
            <h3 class="font-semibold mb-2">Layanan</h3>
            <ul class="space-y-1 text-sm">
                <li><a href="#">Daftar Kos</a></li>
                <li><a href="#">Booking Kos</a></li>
                <li><a href="#">Promo</a></li>
            </ul>
        </div>
    </div>

</div>
@endsection
