@extends('layouts.app')

@section('title', 'Cari Kosan - Koztly')

@section('with-sidebar')

@endsection

@section('content')

<!-- MAIN CONTENT -->
<div class="container mx-auto px-4 py-8">

    <!-- Search Bar -->
    <div class="flex justify-center mb-6">
        <div class="flex items-center w-full md:w-2/3 bg-white rounded-full shadow px-4 py-2">
            <input type="text" placeholder="Cari nama properti / alamat / daerah / kota"
                class="flex-grow px-2 py-1 text-sm focus:outline-none">
            <button class="flex items-center bg-blue-300 text-black font-semibold px-4 py-2 rounded-full hover:bg-[#B6C9F0]">
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
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">
        @foreach ($kosan as $kos)
        <a href="{{ route('kosan.show', $kos->id_kos ) }}"
            class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                <!-- Gambar -->
                <!--<img src="{{ asset('storage/'.$kos->gambar_kos) }}" alt="{{ $kos->nama_kos }}"
                     class="w-full h-40 object-cover"> -->
                 <img src="{{ $kos->gambar_kos 
              ? (filter_var($kos->gambar_kos, FILTER_VALIDATE_URL) 
                    ? $kos->gambar_kos 
                    : asset('storage/'.$kos->gambar_kos)) 
              : 'https://via.placeholder.com/800x400' }}"  
                    class="w-full h-48 object-cover" 
                    alt="{{ $kos->nama_kos }}">

                <div class="p-4">
                    <!-- Kategori -->
                    <span class="text-xs font-bold uppercase 
                        @if(strtoupper($kos->kategori) == 'PRIA') text-[#B6C9F0]
                        @elseif(strtoupper($kos->kategori) == 'WANITA') text-[#E93B81] 
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
            </a>
        @endforeach
        {{ $kosan->links() }}
    </div>


  <!-- pagination -->
<div class="mt-6 flex justify-center">
    <div class="flex items-center space-x-1">
        <!-- Previous Button -->
        @if ($kosan->onFirstPage())
            <span class="px-3 py-2 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed">
                &laquo;
            </span>
        @else
            <a href="{{ $kosan->previousPageUrl() }}" class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                &laquo;
            </a>
        @endif

        <!-- Page Numbers -->
        @foreach ($kosan->getUrlRange(1, $kosan->lastPage()) as $page => $url)
            @if ($page == $kosan->currentPage())
                <span class="px-3 py-2 border border-blue-600 bg-blue-600 text-white rounded-lg">
                    {{ $page }}
                </span>
            @else
                <a href="{{ $url }}" class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                    {{ $page }}
                </a>
            @endif
        @endforeach

        <!-- Next Button -->
        @if ($kosan->hasMorePages())
            <a href="{{ $kosan->nextPageUrl() }}" class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                &raquo;
            </a>
        @else
            <span class="px-3 py-2 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed">
                &raquo;
            </span>
        @endif
    </div>
</div>

    <!-- Tambah di atas atau bawah pagination -->
<div class="flex justify-between items-center mt-4">
    <div class="text-sm text-gray-600">
        Show 
        <select class="border rounded px-2 py-1 mx-1" onchange="window.location.href = this.value">
            <option value="{{ request()->fullUrlWithQuery(['per_page' => 9]) }}" {{ request('per_page', 9) == 9 ? 'selected' : '' }}>9</option>
            <option value="{{ request()->fullUrlWithQuery(['per_page' => 15]) }}" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
            <option value="{{ request()->fullUrlWithQuery(['per_page' => 24]) }}" {{ request('per_page') == 24 ? 'selected' : '' }}>24</option>
        </select>
        items per page
    </div>
    
   
</div>

    <!-- Banner -->
    <div class="mt-12 bg-indigo-100 p-8 rounded-lg text-center shadow">
        <h2 class="text-2xl font-bold text-indigo-700 mb-2">Promo Spesial Bulan Ini!</h2>
        <p class="text-gray-700">Soon! ntar gua bikin</p>
    </div>



</div>
@endsection
