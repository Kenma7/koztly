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
        <form action="{{ route('kosan.index') }}" method="GET" class="mt-6 flex items-center justify-center">
            <div
                class="bg-white shadow-sm flex items-center w-[900px] max-w-[95%] overflow-hidden border border-gray-200">

                {{-- Lokasi --}}
                <div class="flex items-center gap-2 px-4 py-3 flex-1">
                    <i class="fas fa-map-marker-alt text-pink-500"></i>
                    <select name="lokasi"
                        class="w-full text-sm text-gray-700 focus:outline-none bg-transparent border-none appearance-none">
                        <option value="">Pilih Lokasi</option>
                        <option value="Yogyakarta" {{ request('lokasi') == 'Yogyakarta' ? 'selected' : '' }}>Yogyakarta
                        </option>
                        <option value="Jakarta" {{ request('lokasi') == 'Jakarta' ? 'selected' : '' }}>Jakarta</option>
                        <option value="Karawang" {{ request('lokasi') == 'Karawang' ? 'selected' : '' }}>Karawang
                        </option>
                        <option value="Bandung" {{ request('lokasi') == 'Bandung' ? 'selected' : '' }}>Bandung</option>
                        <option value="Surabaya" {{ request('lokasi') == 'Surabaya' ? 'selected' : '' }}>Surabaya
                        </option>
                    </select>
                </div>

                {{-- Harga --}}
                <div class="flex items-center gap-2 px-4 py-3 flex-1 border-l border-gray-100">
                    <i class="fas fa-dollar-sign text-pink-500"></i>
                    <select name="harga"
                        class="w-full text-sm text-gray-700 focus:outline-none bg-transparent border-none appearance-none">
                        <option value="">Pilih Rentang Harga</option>
                        <option value="0-1000000" {{ request('harga') == '0-1000000' ? 'selected' : '' }}>Rp 0 -
                            1.000.000</option>
                        <option value="1000000-2000000" {{ request('harga') == '1000000-2000000' ? 'selected' : '' }}>Rp
                            1.000.000 - 2.000.000</option>
                        <option value="2000000-3000000" {{ request('harga') == '2000000-3000000' ? 'selected' : '' }}>Rp
                            2.000.000 - 3.000.000</option>
                        <option value="3000000-999999999"
                            {{ request('harga') == '3000000-999999999' ? 'selected' : '' }}>Rp 3.000.000+</option>
                    </select>
                </div>

                {{-- Nama Kos --}}
                <div class="flex items-center gap-2 px-4 py-3 flex-1 border-l border-gray-100">
                    <i class="fas fa-home text-pink-500"></i>
                    <input type="text" name="search" placeholder="Cari nama kos..." value="{{ request('search') }}"
                        class="w-full text-sm text-gray-700 focus:outline-none bg-transparent border-none placeholder-gray-400">
                </div>

                {{-- Tombol Cari --}}
                <div class="px-3"> {{-- kasih jarak kanan --}}
                    <button type="submit"
                        class="bg-pink-600 hover:bg-pink-700 transition-all text-white font-semibold px-8 py-3 text-sm rounded-full">
                        <i class="fas fa-search mr-2"></i> Cari
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- jarak bawah sebelum grid --}}
    <div class="mt-8"></div>


    <!-- Grid Kosan -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($kosan as $kos)
        <a href="{{ route('kosan.show', $kos->id_kos ) }}"
            class="bg-white rounded-2xl shadow-md hover:shadow-xl transform hover:-translate-y-2 transition-all duration-300 flex flex-col overflow-hidden">

            <!-- Gambar -->
            <div class="relative h-56 w-full overflow-hidden">
                <img src="{{ $kos->gambar_kos 
                        ? (filter_var($kos->gambar_kos, FILTER_VALIDATE_URL) 
                            ? $kos->gambar_kos 
                            : asset('uploads/kosan/'.$kos->gambar_kos)) 
                        : 'https://via.placeholder.com/800x400' }}" alt="{{ $kos->nama_kos }}"
                    class="object-cover w-full h-full hover:scale-105 transition-transform duration-300">

                <!-- Badge -->
                <div class="absolute top-3 left-3 flex gap-2">
                    <span class="text-white text-xs font-semibold px-3 py-1 rounded-full 
                    @if(strtoupper($kos->kategori) == 'PRIA') bg-blue-500 
                    @elseif(strtoupper($kos->kategori) == 'WANITA') bg-pink-500 
                    @else bg-green-500 @endif">
                        {{ $kos->kategori }}
                    </span>
                    <span class="bg-gray-800 text-white text-xs font-semibold px-3 py-1 rounded-full">Kost</span>
                </div>

                <!-- Icon Love - ALTERNATIVE FIX -->
                <button
                    class="absolute top-3 right-3 text-gray-200 hover:text-red-500 transition-colors duration-300 love-btn">
                    <i class="fas fa-heart"></i>
                </button>
            </div>

            <!-- Konten -->
            <div class="p-4 flex flex-col flex-grow">
                <div class="flex items-baseline gap-1">
                    <span class="text-lg font-bold text-gray-900">Rp
                        {{ number_format($kos->harga, 0, ',', '.') }}</span>
                    <span class="text-sm text-gray-500">/bulan</span>
                </div>

                <h3 class="font-semibold text-gray-800 mt-2">{{ Str::limit($kos->nama_kos, 35) }}</h3>

                <p class="text-sm text-gray-500 mt-1 flex items-center">
                    <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                    {{ Str::limit($kos->lokasi_kos, 40) }}
                </p>

                <div class="flex items-center text-sm text-gray-600 mt-3">
                    <i class="fas fa-bed mr-2 text-indigo-500"></i>
                    {{ $kos->sisa_kamar_count }} Kamar Tersisa
                </div>


                <div class="border-t mt-4 pt-3 flex gap-3 text-gray-400 text-lg">
                    <i class="fas fa-wifi"></i>
                    <i class="fas fa-snowflake"></i>
                    <i class="fas fa-motorcycle"></i>
                    <i class="fas fa-utensils"></i>
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
            <a href="{{ $kosan->previousPageUrl() }}"
                class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
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
            <a href="{{ $url }}"
                class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                {{ $page }}
            </a>
            @endif
            @endforeach

            <!-- Next Button -->
            @if ($kosan->hasMorePages())
            <a href="{{ $kosan->nextPageUrl() }}"
                class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
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
                <option value="{{ request()->fullUrlWithQuery(['per_page' => 3]) }}"
                    {{ request('per_page', 3) == 3 ? 'selected' : '' }}>3</option>
                <option value="{{ request()->fullUrlWithQuery(['per_page' => 5]) }}"
                    {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                <option value="{{ request()->fullUrlWithQuery(['per_page' => 10]) }}"
                    {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
            </select>
            items per page
        </div>


    </div>

    <!-- Banner -->
    <div class="mt-12 flex justify-center">
        <img src="{{ asset('images/Banner.png') }}" alt="Cari Kosan Lebih Mudah"
            class="rounded-lg shadow-lg w-full max-w-5xl object-cover">
    </div>



</div>
@endsection