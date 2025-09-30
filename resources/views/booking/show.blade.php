@extends('layouts.app')

@section('title', 'Detail Booking #' . $booking->id_booking)

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Detail Booking</h1>
        <p class="text-gray-600">ID: #{{ $booking->id_booking }}</p>
    </div>

    <!-- Progress Bar -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-lg font-semibold mb-4">Status Booking</h2>
        
        <div class="flex items-center justify-between mb-2">
            @php
                $steps = [
                    'menunggu' => ['number' => 1, 'label' => 'Menunggu Persetujuan', 'color' => 'yellow'],
                    'disetujui' => ['number' => 2, 'label' => 'Disetujui', 'color' => 'blue'],
                    'sudah dibayar' => ['number' => 3, 'label' => 'Pembayaran', 'color' => 'purple'],
                    'aktif' => ['number' => 4, 'label' => 'Check-in', 'color' => 'green'],
                ];
                
                $currentStep = array_search($booking->status_sewa, array_keys($steps));
                if ($booking->status_pembayaran == 'sudah dibayar') {
                    $currentStep = 2; // Langsung ke step 3 kalau sudah bayar
                }
            @endphp

            @foreach($steps as $status => $step)
                <div class="text-center flex-1">
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center 
                            @if($loop->index <= $currentStep) 
                                bg-{{ $step['color'] }}-600 text-white
                            @else
                                bg-gray-300 text-gray-600
                            @endif
                            @if($loop->index == $currentStep) ring-2 ring-{{ $step['color'] }}-300 @endif">
                            {{ $step['number'] }}
                        </div>
                        <span class="text-xs mt-2 text-center @if($loop->index <= $currentStep) text-{{ $step['color'] }}-600 font-medium @else text-gray-500 @endif">
                            {{ $step['label'] }}
                        </span>
                    </div>
                </div>
                
                @if(!$loop->last)
                    <div class="flex-1 h-1 @if($loop->index < $currentStep) bg-{{ $steps[array_keys($steps)[$loop->index + 1]]['color'] }}-600 @else bg-gray-300 @endif"></div>
                @endif
            @endforeach
        </div>

        <!-- Current Status -->
        <div class="mt-4 p-4 bg-{{ $steps[$booking->status_sewa]['color'] }}-50 rounded-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    @if($booking->status_sewa == 'menunggu')
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    @elseif($booking->status_sewa == 'disetujui') 
                        <i class="fas fa-check-circle text-blue-600 text-xl"></i>
                    @elseif($booking->status_sewa == 'aktif')
                        <i class="fas fa-key text-green-600 text-xl"></i>
                    @elseif($booking->status_sewa == 'batal')
                        <i class="fas fa-times-circle text-red-600 text-xl"></i>
                    @endif
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-{{ $steps[$booking->status_sewa]['color'] }}-800">
                        Status: {{ ucfirst($booking->status_sewa) }}
                    </h3>
                    <div class="mt-1 text-sm text-{{ $steps[$booking->status_sewa]['color'] }}-700">
                        @if($booking->status_sewa == 'menunggu')
                            <p>Booking Anda sedang menunggu persetujuan admin. Biasanya membutuhkan waktu 1-2 jam.</p>
                        @elseif($booking->status_sewa == 'disetujui')
                            <p>Booking Anda telah disetujui! Silakan lanjutkan ke pembayaran.</p>
                        @elseif($booking->status_sewa == 'aktif')
                            <p>Selamat! Anda sudah bisa check-in ke kosan.</p>
                        @elseif($booking->status_sewa == 'batal')
                            <p>Booking Anda telah dibatalkan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Informasi Booking -->
        <div class="space-y-6">
            <!-- Informasi Kosan -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">Informasi Kosan</h2>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Nama Kosan:</span>
                        <span>{{ $booking->kosan->nama_kos }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Lokasi:</span>
                        <span class="text-right">{{ $booking->kosan->lokasi_kos }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Kamar:</span>
                        <span>{{ $booking->kamar->nomor_kamar ?? 'Belum dipilih' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Kategori:</span>
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                            {{ $booking->kosan->kategori }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Informasi Penyewa -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">Informasi Penyewa</h2>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Jumlah Penghuni:</span>
                        <span>{{ $booking->jumlah_penghuni }} Orang</span>
                    </div>
                    @if($booking->catatan)
                    <div class="flex justify-between items-start">
                        <span class="font-medium text-gray-600">Catatan:</span>
                        <span class="text-right bg-yellow-50 p-2 rounded text-sm">{{ $booking->catatan }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Rincian Biaya & Actions -->
        <div class="space-y-6">
            <!-- Rincian Biaya -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">Rincian Biaya</h2>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Harga per bulan:</span>
                        <span>Rp {{ number_format($booking->kosan->harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Lama sewa:</span>
                        <span>{{ $booking->lama_sewa }} bulan</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tanggal mulai:</span>
                        <span>{{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y') }}</span>
                    </div>
                    <div class="border-t pt-3">
                        <div class="flex justify-between font-semibold text-lg">
                            <span>Total Biaya:</span>
                            <span class="text-green-600">Rp {{ number_format($booking->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Status Pembayaran -->
                <div class="mt-4 p-3 rounded-lg 
                    @if($booking->status_pembayaran == 'sudah dibayar') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800 @endif">
                    <div class="flex items-center">
                        <i class="fas @if($booking->status_pembayaran == 'sudah dibayar') fa-check-circle @else fa-clock @endif mr-2"></i>
                        <span class="font-medium">Pembayaran: {{ ucfirst(str_replace('_', ' ', $booking->status_pembayaran)) }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">Selanjutnya</h2>
                
                @if($booking->status_sewa == 'menunggu')
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-blue-600 mt-1 mr-2"></i>
                            <div>
                                <p class="font-medium">Menunggu Persetujuan</p>
                                <p class="text-sm text-gray-600">Admin akan memverifikasi booking Anda dalam 1-2 jam</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-phone text-green-600 mt-1 mr-2"></i>
                            <div>
                                <p class="font-medium">Butuh Bantuan?</p>
                                <p class="text-sm text-gray-600">Hubungi admin: 0812-3456-7890</p>
                            </div>
                        </div>
                    </div>
                    
                @elseif($booking->status_sewa == 'disetujui' && $booking->status_pembayaran == 'belum dibayar')
                    <div class="space-y-4">
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <p class="text-green-800 font-medium">Booking Anda telah disetujui!</p>
                            <p class="text-green-700 text-sm mt-1">Silakan lakukan pembayaran untuk melanjutkan.</p>
                        </div>
                        <button class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-semibold">
                            Lanjutkan Pembayaran
                        </button>
                    </div>
                    
                @elseif($booking->status_sewa == 'aktif')
                    <div class="space-y-4">
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <p class="text-green-800 font-medium">Siap untuk Check-in!</p>
                            <p class="text-green-700 text-sm mt-1">Datang ke lokasi kosan dengan membawa:</p>
                            <ul class="text-green-700 text-sm mt-2 list-disc list-inside">
                                <li>KTP asli</li>
                                <li>Bukti pembayaran</li>
                                <li>Barang-barang pribadi</li>
                            </ul>
                        </div>
                        <button class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 font-semibold">
                            Lihat Panduan Check-in
                        </button>
                    </div>
                @endif

                <!-- Back to List -->
                <div class="mt-4 pt-4 border-t">
                    <a href="{{ route('booking.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                        ← Kembali ke Daftar Booking
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection