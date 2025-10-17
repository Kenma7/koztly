@extends('layouts.app')

@section('title', 'Cari Kosan - Koztly')

@section('with-sidebar')

@endsection

@section('content')

<!-- MAIN CONTENT -->
<div class="container mx-auto px-4 py-8">

    <!-- Search Bar -->

    {{-- Search Form --}}
    <div class="text-center mt-6">
    <h2 class="text-3xl font-extrabold text-pink-600">Temukan Kos Impianmu</h2>
    <p class="text-gray-500 mt-2 text-sm">Cari kos nyaman sesuai kebutuhan dan budget kamu</p>

    {{-- Search Form --}}
    <form action="{{ route('kosan.index') }}" method="GET" 
          class="mt-6 flex items-center justify-center">
        <div class="bg-white shadow-sm flex items-center w-[900px] max-w-[95%] overflow-hidden border border-gray-200">

            {{-- Lokasi --}}
            <div class="flex items-center gap-2 px-4 py-3 flex-1">
                <i class="fas fa-map-marker-alt text-pink-500"></i>
                <select name="lokasi" 
                        class="w-full text-sm text-gray-700 focus:outline-none bg-transparent border-none appearance-none">
                    <option value="">Pilih Lokasi</option>
                    <option value="Yogyakarta" {{ request('lokasi') == 'Yogyakarta' ? 'selected' : '' }}>Yogyakarta</option>
                    <option value="Jakarta" {{ request('lokasi') == 'Jakarta' ? 'selected' : '' }}>Jakarta</option>
                    <option value="Bandung" {{ request('lokasi') == 'Bandung' ? 'selected' : '' }}>Bandung</option>
                    <option value="Surabaya" {{ request('lokasi') == 'Surabaya' ? 'selected' : '' }}>Surabaya</option>
                </select>
            </div>

            {{-- Harga --}}
            <div class="flex items-center gap-2 px-4 py-3 flex-1 border-l border-gray-100">
                <i class="fas fa-dollar-sign text-pink-500"></i>
                <select name="harga" 
                        class="w-full text-sm text-gray-700 focus:outline-none bg-transparent border-none appearance-none">
                    <option value="">Pilih Rentang Harga</option>
                    <option value="0-1000000" {{ request('harga') == '0-1000000' ? 'selected' : '' }}>Rp 0 - 1.000.000</option>
                    <option value="1000000-2000000" {{ request('harga') == '1000000-2000000' ? 'selected' : '' }}>Rp 1.000.000 - 2.000.000</option>
                    <option value="2000000-3000000" {{ request('harga') == '2000000-3000000' ? 'selected' : '' }}>Rp 2.000.000 - 3.000.000</option>
                    <option value="3000000-999999999" {{ request('harga') == '3000000-999999999' ? 'selected' : '' }}>Rp 3.000.000+</option>
                </select>
            </div>

            {{-- Nama Kos --}}
            <div class="flex items-center gap-2 px-4 py-3 flex-1 border-l border-gray-100">
                <i class="fas fa-home text-pink-500"></i>
                <input type="text" 
                       name="search" 
                       placeholder="Cari nama kos..."
                       value="{{ request('search') }}"
                       class="w-full text-sm text-gray-700 focus:outline-none bg-transparent border-none placeholder-gray-400">
            </div>

            {{-- Tombol Cari --}}
            <div class="px-3"> {{-- kasih jarak kanan --}}
                <button type="submit" 
                        class="bg-pink-600 hover:bg-pink-700 transition-all text-white font-semibold px-8 py-3 text-sm rounded-none">
                    <i class="fas fa-search mr-2"></i> Cari
                </button>
            </div>
        </div>
    </form>
</div>

{{-- jarak bawah sebelum grid --}}
<div class="mt-8"></div>





    <!-- Grid Kosan -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">
    @foreach ($kosan as $kos)
    <a href="{{ route('kosan.show', $kos->id_kos ) }}"
        class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
        
        <!-- Gambar dengan Fallback Logic -->
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
             class="w-full h-48 object-cover" 
             alt="{{ $kos->nama_kos }}"
             onerror="this.src='https://via.placeholder.com/800x400?text=Image+Error'">

        <div class="p-4">
            <!-- Kategori -->
            <span class="text-xs font-bold uppercase 
                @if(strtoupper($kos->kategori) == 'PRIA') text-[#B6C9F0]
                @elseif(strtoupper($kos->kategori) == 'WANITA') text-[#E93B81] 
                @else text-orange-600 @endif">
                {{ $kos->kategori }}
            </span>

            <!-- Nama Kos -->
            <h3 class="mt-2 font-bold">{{ $kos->nama_kos }}</h3>

            <!-- Lokasi -->
            <p class="text-sm text-gray-600">{{ $kos->lokasi_kos }}</p>

            <!-- Harga & Sisa Kamar -->
            <div class="flex justify-between items-center mt-2">
                <p class="text-gray-800 font-semibold">Rp {{ number_format($kos->harga, 0, ',', '.') }}/bulan</p>
                
                <div class="text-right">
                    <p class="text-sm font-medium 
                        @if($kos->sisa_kamar_count == 0) text-red-600
                        @elseif($kos->sisa_kamar_count <= 2) text-orange-600
                        @else text-green-600 @endif">
                        @if($kos->sisa_kamar_count == 0)
                            ❌ Penuh
                        @else
                            ✅ {{ $kos->sisa_kamar_count }} kamar tersedia
                        @endif
                    </p>
                    <p class="text-xs text-gray-500">{{ $kos->total_kamar_count }} kamar total</p>
                </div>
            </div>

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
</div>

{{ $kosan->links() }}


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
