@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl">
    <!-- Back Button -->
    <a href="{{ route('user.booking.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-6">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Riwayat Booking
    </a>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
        {{ session('error') }}
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-6">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold mb-2">Detail Booking</h1>
                    <p class="text-blue-100">ID Booking: #{{ $booking->id_booking }}</p>
                </div>
                <div>
                    @if($booking->status_pembayaran == 'pending')
                        <span class="px-4 py-2 bg-yellow-500 text-white text-sm font-semibold rounded-full">
                            Menunggu Pembayaran
                        </span>
                    @elseif($booking->status_pembayaran == 'lunas')
                        @if($booking->status_sewa == 'aktif')
                            <span class="px-4 py-2 bg-green-500 text-white text-sm font-semibold rounded-full">
                                Sewa Aktif
                            </span>
                        @else
                            <span class="px-4 py-2 bg-gray-500 text-white text-sm font-semibold rounded-full">
                                Sewa Selesai
                            </span>
                        @endif
                    @else
                        <span class="px-4 py-2 bg-red-500 text-white text-sm font-semibold rounded-full">
                            Dibatalkan
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Left Column: Kos Info -->
                <div>
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Informasi Kos</h2>
                    
                    <!-- Kos Image -->
                    <div class="mb-4 rounded-lg overflow-hidden">
                        @if($booking->kamar && $booking->kamar->kosan && $booking->kamar->kosan->foto)
                            <img src="{{ asset('storage/' . $booking->kamar->kosan->foto) }}" 
                                 alt="{{ $booking->kamar->kosan->nama_kos }}" 
                                 class="w-full h-64 object-cover">
                        @else
                            <img src="{{ asset('images/default-kos.jpg') }}" 
                                 alt="Default Kos" 
                                 class="w-full h-64 object-cover">
                        @endif
                    </div>

                    <!-- Kos Details -->
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-500">Nama Kos</p>
                            <p class="font-semibold text-gray-800">{{ $booking->kamar->kosan->nama_kos ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Alamat</p>
                            <p class="text-gray-800">{{ $booking->kamar->kosan->alamat ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Nomor Kamar</p>
                            <p class="font-semibold text-gray-800">{{ $booking->kamar->nama_kamar ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Tipe Kamar</p>
                            <p class="text-gray-800">{{ $booking->kamar->tipe_kamar ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Fasilitas</p>
                            <p class="text-gray-800">{{ $booking->kamar->fasilitas ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Payment Info -->
                <div>
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Informasi Pembayaran</h2>
                    
                    <div class="bg-gray-50 rounded-lg p-5 mb-6">
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Harga per Bulan</span>
                                <span class="font-semibold">Rp {{ number_format($booking->harga, 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Lama Sewa</span>
                                <span class="font-semibold">{{ $booking->lama_sewa }} Bulan</span>
                            </div>

                            <hr class="border-gray-300">

                            <div class="flex justify-between text-lg">
                                <span class="font-bold text-gray-800">Total Pembayaran</span>
                                <span class="font-bold text-blue-600">
                                    Rp {{ number_format($booking->harga * $booking->lama_sewa, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Timeline -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-800 mb-3">Timeline Booking</h3>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white text-sm font-bold mr-3">
                                    1
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Booking Dibuat</p>
                                    <p class="text-sm text-gray-500">{{ $booking->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="w-8 h-8 {{ $booking->status_pembayaran != 'pending' ? 'bg-blue-600' : 'bg-gray-300' }} rounded-full flex items-center justify-center text-white text-sm font-bold mr-3">
                                    2
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Pembayaran</p>
                                    <p class="text-sm text-gray-500">
                                        @if($booking->status_pembayaran == 'lunas')
                                            Lunas - {{ $booking->updated_at->format('d M Y, H:i') }}
                                        @else
                                            Menunggu pembayaran
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="w-8 h-8 {{ $booking->status_sewa == 'aktif' ? 'bg-blue-600' : 'bg-gray-300' }} rounded-full flex items-center justify-center text-white text-sm font-bold mr-3">
                                    3
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Status Sewa</p>
                                    <p class="text-sm text-gray-500">{{ ucfirst($booking->status_sewa) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Upload Bukti Transfer -->
                    @if($booking->status_pembayaran == 'pending')
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6">
                        <h3 class="font-semibold text-gray-800 mb-3">Upload Bukti Transfer</h3>
                        <form action="{{ route('user.booking.upload-bukti', $booking->id_booking) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="bukti_tf" accept="image/*" 
                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 mb-3">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
                                Upload Bukti
                            </button>
                        </form>
                    </div>
                    @endif

                    <!-- Bukti Transfer Preview -->
                    @if($booking->bukti_tf)
                    <div class="mt-6">
                        <h3 class="font-semibold text-gray-800 mb-3">Bukti Transfer</h3>
                        <img src="{{ asset('storage/' . $booking->bukti_tf) }}" 
                             alt="Bukti Transfer" 
                             class="w-full rounded-lg border border-gray-300">
                    </div>
                    @endif

                    <!-- Cancel Button -->
                    @if($booking->status_pembayaran == 'pending')
                    <form action="{{ route('user.booking.cancel', $booking->id_booking) }}" method="POST" class="mt-6">
                        @csrf
                        @method('PUT')
                        <button type="submit" 
                                onclick="return confirm('Yakin ingin membatalkan booking ini?')"
                                class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 rounded-lg transition">
                            Batalkan Booking
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection