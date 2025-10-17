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
                        1 => ['label' => 'Menunggu Pembayaran', 'color' => 'yellow'],
                        2 => ['label' => 'Menunggu Konfirmasi', 'color' => 'blue'],
                        3 => ['label' => 'Check-in', 'color' => 'green'],
                    ];

                    // LOGIC YANG BENAR:
                    if ($booking->status_pembayaran == 'belum dibayar') {
                        $currentStep = 1; // Step 1: Menunggu Pembayaran
                    } elseif ($booking->status_pembayaran == 'sudah dibayar' && $booking->status_sewa == 'menunggu') {
                        $currentStep = 2; // Step 2: Sudah bayar, menunggu konfirmasi admin
                    } elseif ($booking->status_sewa == 'aktif') {
                        $currentStep = 3; // Step 3: Sudah dikonfirmasi, bisa check-in
                    } else {
                        $currentStep = 1; // Default
                    }
                @endphp

                @foreach ($steps as $stepNumber => $step)
                    <div class="text-center flex-1">
                        <div class="flex flex-col items-center">
                            <div
                                class="w-10 h-10 rounded-full flex items-center justify-center 
                        @if ($stepNumber <= $currentStep) bg-{{ $step['color'] }}-600 text-white
                        @else
                            bg-gray-300 text-gray-600 @endif
                        @if ($stepNumber == $currentStep) ring-2 ring-{{ $step['color'] }}-300 @endif">
                                {{ $stepNumber }}
                            </div>
                            <span
                                class="text-xs mt-2 text-center @if ($stepNumber <= $currentStep) text-{{ $step['color'] }}-600 font-medium @else text-gray-500 @endif">
                                {{ $step['label'] }}
                            </span>
                        </div>
                    </div>

                    @if (!$loop->last)
                        <div
                            class="flex-1 h-1 @if ($stepNumber < $currentStep) bg-{{ $steps[$stepNumber + 1]['color'] }}-600 @else bg-gray-300 @endif">
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Current Status -->
            <div
                class="mt-4 p-4 
    @if ($currentStep == 0) bg-yellow-50 border border-yellow-200
    @elseif($currentStep == 1) bg-blue-50 border border-blue-200  
    @elseif($currentStep == 2) bg-green-50 border border-green-200
    @else bg-gray-50 border border-gray-200 @endif 
    rounded-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        @if ($currentStep == 0)
                            <i class="fas fa-clock text-yellow-600 text-xl"></i>
                        @elseif($currentStep == 1)
                            <i class="fas fa-hourglass-half text-blue-600 text-xl"></i>
                        @elseif($currentStep == 2)
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        @endif
                    </div>
                    <div class="ml-3">
                        <h3
                            class="text-sm font-medium 
                @if ($currentStep == 0) text-yellow-800
                @elseif($currentStep == 1) text-blue-800
                @elseif($currentStep == 2) text-green-800
                @else text-gray-800 @endif">
                            @if ($currentStep == 0)
                                Menunggu Pembayaran
                            @elseif($currentStep == 1)
                                Menunggu Konfirmasi Admin
                            @elseif($currentStep == 2)
                                Siap untuk Check-in!
                            @endif
                        </h3>
                        <div
                            class="mt-1 text-sm 
                @if ($currentStep == 0) text-yellow-700
                @elseif($currentStep == 1) text-blue-700
                @elseif($currentStep == 2) text-green-700
                @else text-gray-700 @endif">
                            @if ($currentStep == 0)
                                <p>Silakan upload bukti transfer untuk melanjutkan.</p>
                            @elseif($currentStep == 1)
                                <p>Bukti transfer telah diupload! Menunggu verifikasi admin. Biasanya membutuhkan waktu 1-2
                                    jam.</p>
                            @elseif($currentStep == 2)
                                <p>Booking Anda telah dikonfirmasi! Silakan check-in ke kosan.</p>
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
                        @if ($booking->catatan)
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
                    <div
                        class="mt-4 p-3 rounded-lg 
                    @if ($booking->status_pembayaran == 'sudah dibayar') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800 @endif">
                        <div class="flex items-center">
                            <i
                                class="fas @if ($booking->status_pembayaran == 'sudah dibayar') fa-check-circle @else fa-clock @endif mr-2"></i>
                            <span class="font-medium">Pembayaran:
                                {{ ucfirst(str_replace('_', ' ', $booking->status_pembayaran)) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold mb-4">Selanjutnya</h2>

                    {{-- DEBUG SECTION --}}
                    <div class="bg-red-100 p-4 mb-4 rounded-lg">
                        <p class="font-semibold">🔍 Debug Status:</p>
                        <p>status_sewa: <strong>"{{ $booking->status_sewa }}"</strong></p>
                        <p>status_pembayaran: <strong>"{{ $booking->status_pembayaran }}"</strong></p>
                    </div>
                    {{-- END DEBUG --}}

                    @if ($booking->status_sewa == 'menunggu')
                        <div class="space-y-4">
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <p class="text-blue-800 font-medium">Lanjutkan Pembayaran</p>
                                <p class="text-blue-700 text-sm mt-1">Upload bukti transfer untuk proses persetujuan admin.
                                </p>
                            </div>
                            <!-- TOMBOL UPLOAD BUKTI TF -->
                            <button onclick="openUploadModal({{ $booking->id_booking }})"
                                class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-semibold">
                                <i class="fas fa-upload mr-2"></i>Upload Bukti TF
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
                </div>

                <!-- Back to List -->
                <div class="mt-6 pt-6 border-t">
                    <a href="{{ route('kosan.index') }}"
                        class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Daftar Kosan
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal Upload Bukti TF -->
    <div id="upload-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-xl shadow-lg w-11/12 md:w-1/3 p-6 relative">
            <h2 class="text-xl font-bold mb-4">Upload Bukti Transfer</h2>

            <!-- Info Booking -->
            <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                <h3 class="font-semibold mb-2">Detail Booking:</h3>
                <p><strong>Kosan:</strong> {{ $booking->kosan->nama_kos }}</p>
                <p><strong>Kamar:</strong> {{ $booking->kamar->nomor_kamar }}</p>
                <p><strong>Total:</strong> Rp {{ number_format($booking->harga) }}</p>
            </div>

            <!-- Info Rekening -->
            <div class="mb-4 p-4 bg-blue-50 rounded-lg">
                <h3 class="font-semibold mb-2">Transfer ke:</h3>
                <p><strong>Bank:</strong> BCA</p>
                <p><strong>No. Rek:</strong> {{ $booking->kosan->no_rek ?? '123-456-789' }}</p>
                <p><strong>Atas Nama:</strong> Admin Koztly</p>
            </div>

            <!-- Form Upload -->
            <form id="upload-form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Pilih File Bukti Transfer</label>
                    <input type="file" name="bukti_tf" class="w-full border border-gray-300 rounded-lg px-3 py-2"
                        accept="image/*" required>
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG (Max: 2MB)</p>
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="flex-1 bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg font-semibold">
                        Upload & Konfirmasi
                    </button>
                    <button type="button" onclick="closeUploadModal()"
                        class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 rounded-lg">
                        Batal
                    </button>
                </div>
            </form>

            <button onclick="closeUploadModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">
                <i class="fas fa-times fa-lg"></i>
            </button>
        </div>
    </div>

    <script>
        let currentBookingId = null;

        function openUploadModal(bookingId) {
            currentBookingId = bookingId;
            const form = document.getElementById('upload-form');
            form.action = `/booking/${bookingId}/upload-bukti`;
            document.getElementById('upload-modal').classList.remove('hidden');
        }

        function closeUploadModal() {
            document.getElementById('upload-modal').classList.add('hidden');
            currentBookingId = null;
        }

        // Close modal ketika klik outside
        document.getElementById('upload-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeUploadModal();
            }
        });
    </script>

@endsection
