@extends('layouts.app')

@section('without-alert')
@endsection

@section('with-sidebar')
@endsection

<!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

@section('content')
    <div class="px-4 rounded-lg">
        <div class="container mx-auto px-4" style="max-width: 1400px;">

            <a href="{{ route('user.bookings.index') }}"
                class="inline-flex items-center gap-2 text-[#ea3882] hover:text-[#d12670] font-semibold mb-6">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Daftar Booking</span>
            </a>

            {{--


            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-lg mb-6">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle text-xl"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-lg mb-6">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-exclamation-circle text-xl"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            --}}

            <!-- Status Booking -->
            <div class="bg-white rounded-lg shadow p-6 mb-6 border border-gray-100">
                <h2 class="text-lg font-semibold mb-4">Status Booking</h2>

                @php
                    // Daftar langkah status aktif
                    $steps = [
                        1 => ['label' => 'Menunggu Pembayaran', 'color' => 'yellow'],
                        2 => ['label' => 'Menunggu Konfirmasi', 'color' => 'blue'],
                        3 => ['label' => 'Check-in', 'color' => 'green'],
                    ];

                    // Tentukan langkah aktif
                    if ($booking->status_sewa == 'batal') {
                        $currentStep = 0;
                    } elseif ($booking->status_pembayaran == 'belum dibayar') {
                        $currentStep = 1;
                    } elseif ($booking->status_pembayaran == 'sudah dibayar' && $booking->status_sewa == 'menunggu') {
                        $currentStep = 2;
                    } elseif ($booking->status_sewa == 'aktif') {
                        $currentStep = 3;
                    } elseif ($booking->status_sewa == 'selesai') {
                        $currentStep = 4;
                    } else {
                        $currentStep = 1;
                    }
                @endphp

                {{-- ✅ Jika status Dibatalkan --}}
                @if ($currentStep == 0)
                    <div class="p-5 rounded-lg bg-red-50 border border-red-200 text-center">
                        <h3 class="text-red-800 font-bold text-lg mb-1">Booking Dibatalkan</h3>
                        <p class="text-red-700 text-sm">
                            Pesanan ini telah dibatalkan. Silakan lakukan pemesanan ulang jika diperlukan.
                        </p>
                    </div>

                    {{-- ✅ Jika status Selesai --}}
                @elseif($currentStep == 4)
                    <div class="p-5 rounded-lg bg-gray-50 border border-gray-200 text-center">
                        <h3 class="text-gray-800 font-bold text-lg mb-1">Kontrak Telah Selesai</h3>
                        <p class="text-gray-700 text-sm">
                            Kontrak Anda telah berakhir. Terima kasih telah menyewa di kos kami!
                        </p>
                    </div>

                    {{-- ✅ Jika status lain (ada progress step) --}}
                @else
                    <div class="flex items-center justify-between mb-2">
                        @foreach ($steps as $stepNumber => $step)
                            <div class="text-center flex-1">
                                <div class="flex flex-col items-center">
                                    {{-- Bulatan langkah --}}
                                    <div
                                        class="w-10 h-10 rounded-full flex items-center justify-center
                            @if ($stepNumber <= $currentStep) bg-{{ $step['color'] }}-600 text-white
                            @else bg-gray-300 text-gray-600 @endif
                            @if ($stepNumber == $currentStep) ring-2 ring-{{ $step['color'] }}-300 @endif">
                                        {{ $stepNumber }}
                                    </div>

                                    {{-- Label langkah --}}
                                    <span
                                        class="text-xs mt-2 text-center 
                            @if ($stepNumber <= $currentStep) text-{{ $step['color'] }}-600 font-medium 
                            @else text-gray-500 @endif">
                                        {{ $step['label'] }}
                                    </span>
                                </div>
                            </div>

                            @if (!$loop->last)
                                <div
                                    class="flex-1 h-1 
                        @if ($stepNumber < $currentStep) bg-{{ $steps[$stepNumber + 1]['color'] }}-600 
                        @else bg-gray-300 @endif">
                                </div>
                            @endif
                        @endforeach
                    </div>

                    {{-- Box keterangan langkah aktif --}}
                    <div
                        class="mt-4 p-4 rounded-lg
            @if ($currentStep == 1) bg-yellow-50 border border-yellow-200
            @elseif($currentStep == 2) bg-blue-50 border border-blue-200
            @elseif($currentStep == 3) bg-green-50 border border-green-200 @endif">

                        <h3
                            class="text-sm font-medium mb-1
                @if ($currentStep == 1) text-yellow-800
                @elseif($currentStep == 2) text-blue-800
                @elseif($currentStep == 3) text-green-800 @endif">
                            @if ($currentStep == 1)
                                Menunggu Pembayaran
                            @elseif($currentStep == 2)
                                Menunggu Konfirmasi Admin
                            @elseif($currentStep == 3)
                                Sedang Dihuni (Check-in)
                            @endif
                        </h3>

                        <p
                            class="text-sm
                @if ($currentStep == 1) text-yellow-700
                @elseif($currentStep == 2) text-blue-700
                @elseif($currentStep == 3) text-green-700 @endif">
                            @if ($currentStep == 1)
                                Silakan upload bukti transfer untuk melanjutkan.
                            @elseif($currentStep == 2)
                                Bukti transfer telah diupload! Menunggu verifikasi admin.
                            @elseif($currentStep == 3)
                                Anda sedang menempati kosan ini. Nikmati masa sewa Anda!
                            @endif
                        </p>
                    </div>
                @endif
            </div>





            <div class="grid lg:grid-cols-3 gap-6">

                <div class="lg:col-span-2 space-y-6">

                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="rounded-lg bg-gradient-to-r from-[#ea3882] to-[#d12670] p-6 text-white">
                            <div class="flex justify-between items-start flex-wrap gap-4 ">
                                <div>
                                    <h1 class="text-2xl font-semibold mb-1">Detail Booking</h1>
                                    <p class="text-pink-100">
                                        ID Booking: <span
                                            class="font-mono font-semibold">#{{ str_pad($booking->id_booking, 6, '0', STR_PAD_LEFT) }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="p-5 border-b border-gray-200">
                            <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                                <span class="w-8 h-8 bg-[#f5acca] rounded-lg flex items-center justify-center text-sm">
                                    <i class="fas fa-building text-[#ea3882]"></i>
                                </span>
                                Informasi Kos
                            </h2>
                        </div>

                        <div class="p-5">

                            <div class="mb-5 rounded-lg overflow-hidden border border-gray-200">
                                @if ($booking->kamar && $booking->kamar->kosan && $booking->kamar->kosan->gambar_kos)
                                    <img src="{{ asset('uploads/kosan/' . $booking->kamar->kosan->gambar_kos) }}"
                                        alt="{{ $booking->kamar->kosan->nama_kos }}"
                                        class="w-full h-[400px] object-cover rounded-t-xl cursor-pointer"
                                        onclick="openModal(this.src)">
                                @else
                                    <img src="https://via.placeholder.com/400x200?text=Kos+Image" alt="Kos"
                                        class="w-full h-[400px] object-cover rounded-t-xl cursor-pointer"
                                        onclick="openModal(this.src)">
                                @endif
                            </div>

                            <div class="grid md:grid-cols-3 gap-5 mb-5">
                                <div class="bg-white p-4 rounded-lg border-l-4 border-pink-500 shadow-md">
                                    <p class="text-xs text-[#ea3882] font-semibold mb-1 flex items-center gap-2">
                                        <i class="fas fa-home"></i> Nama Kos
                                    </p>
                                    <p class="font-bold text-gray-800">{{ $booking->kost->nama_kos ?? 'N/A' }}</p>
                                </div>

                                <div class="bg-white p-4 rounded-lg border-l-4 border-orange-500 shadow-md">
                                    <p class="text-xs text-orange-500 font-semibold mb-1 flex items-center gap-2">
                                        <i class="fas fa-door-open"></i> Nomor Kamar
                                    </p>
                                    <p class="font-bold text-gray-800">{{ $booking->kamar->nomor_kamar ?? 'N/A' }}</p>
                                </div>

                                <div class="bg-white p-4 rounded-lg border-l-4 border-purple-500 shadow-md">
                                    <p class="text-xs text-purple-500 font-semibold mb-1 flex items-center gap-2">
                                        <i class="fas fa-venus-mars"></i> Kategori Kos
                                    </p>
                                    <p class="font-bold text-gray-800">
                                        @if ($booking->kost->kategori == 'putra')
                                            Kos Putra
                                        @elseif($booking->kost->kategori == 'putri')
                                            Kos Putri
                                        @elseif($booking->kost->kategori == 'campur')
                                            Kos Campur
                                        @else
                                            {{ ucfirst($booking->kost->kategori ?? 'N/A') }}
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-5 mb-5">
                                <!-- Lokasi -->
                                <div class="bg-white p-4 rounded-lg border-l-4 border-green-500 shadow-md">
                                    <p class="text-xs text-green-600 font-semibold mb-1 flex items-center gap-2">
                                        <i class="fas fa-map-marker-alt"></i> Lokasi
                                    </p>
                                    <p class="font-bold text-gray-800">{{ $booking->kost->lokasi_kos ?? 'N/A' }}</p>
                                </div>

                                <!-- Jumlah Penghuni -->
                                <div class="bg-white p-4 rounded-lg border-l-4 border-yellow-500 shadow-md">
                                    <p class="text-xs text-yellow-600 font-semibold mb-1 flex items-center gap-2">
                                        <i class="fas fa-users"></i> Jumlah Penghuni
                                    </p>
                                    <p class="font-bold text-gray-800">{{ $booking->jumlah_penghuni ?? '-' }}</p>
                                </div>
                            </div>


                            @if ($booking->kost && $booking->kost->fasilitas)
                                <div class="p-4 rounded-lg mb-4 border-l-4 border-blue-500 shadow-md">
                                    <p class="text-xs text-[#5a7bb5] font-semibold mb-3 flex items-center gap-2">
                                        <i class="fas fa-check-circle"></i> Fasilitas
                                    </p>

                                    @php
                                        $fasilitasArray = explode(',', $booking->kost->fasilitas);
                                        $iconMap = [
                                            'wifi' => 'fa-wifi',
                                            'ac' => 'fa-snowflake',
                                            'kipas' => 'fa-fan',
                                            'kasur' => 'fa-bed',
                                            'lemari' => 'fa-door-closed',
                                            'meja' => 'fa-table',
                                            'kursi' => 'fa-chair',
                                            'tv' => 'fa-tv',
                                            'kamar mandi' => 'fa-bath',
                                            'dapur' => 'fa-utensils',
                                            'parkir' => 'fa-parking',
                                            'mesin cuci' => 'fa-tshirt',
                                            'laundry' => 'fa-tshirt',
                                            'kulkas' => 'fa-temperature-low',
                                        ];
                                    @endphp

                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($fasilitasArray as $fasilitas)
                                            @php
                                                $fasilitasLower = strtolower(trim($fasilitas));
                                                $icon = 'fa-check-circle'; // default icon

                                                foreach ($iconMap as $keyword => $iconClass) {
                                                    if (strpos($fasilitasLower, $keyword) !== false) {
                                                        $icon = $iconClass;
                                                        break;
                                                    }
                                                }
                                            @endphp

                                            <span
                                                class="flex items-center gap-1 px-3 py-1 bg-white text-[#5a7bb5] rounded-full text-xs font-medium border border-[#b8caef]">
                                                <i class="fas {{ $icon }}"></i>
                                                {{ ucfirst(trim($fasilitas)) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif


                            @if ($booking->kost && $booking->kost->deskripsi)
                                <div class="mt-4 bg-gray-50 p-4 rounded-lg border border-gray-200">
                                    <p class="text-xs text-gray-600 font-semibold mb-2 flex items-center gap-2">
                                        <i class="fas fa-info-circle"></i> Deskripsi
                                    </p>
                                    <p class="text-gray-700 text-sm leading-relaxed">{{ $booking->kost->deskripsi }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="p-5 border-b border-gray-200">
                            <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                                <span class="w-8 h-8 bg-[#b8caef] rounded-lg flex items-center justify-center text-sm">
                                    <i class="fas fa-calendar-alt text-[#5a7bb5]"></i>
                                </span>
                                Periode Sewa
                            </h2>
                        </div>

                        <div class="p-5">
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                                    <p class="text-xs text-green-700 font-semibold mb-1 flex items-center gap-2">
                                        <i class="fas fa-calendar-check"></i> Tanggal Mulai Sewa
                                    </p>
                                    <p class="font-bold text-gray-800">
                                        {{ $booking->tanggal_masuk ? \Carbon\Carbon::parse($booking->tanggal_masuk)->format('d M Y') : '-' }}
                                    </p>
                                </div>

                                <div class="bg-red-50 p-4 rounded-lg border border-red-200">
                                    <p class="text-xs text-red-700 font-semibold mb-1 flex items-center gap-2">
                                        <i class="fas fa-calendar-times"></i> Tanggal Berakhir Sewa
                                    </p>
                                    <p class="font-bold text-gray-800">
                                        @php
                                            $endDate = $booking->tanggal_masuk
                                                ? \Carbon\Carbon::parse($booking->tanggal_masuk)->addMonths(
                                                    $booking->lama_sewa,
                                                )
                                                : null;
                                        @endphp
                                        {{ $endDate ? $endDate->format('d M Y') : '-' }}
                                    </p>
                                </div>

                            </div>

                            <div class="mt-4 bg-blue-50 p-4 rounded-lg border border-blue-200">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-blue-700 font-semibold">Durasi Sewa</span>
                                    <span class="text-lg font-bold text-blue-800">{{ $booking->lama_sewa }} Bulan</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <a href="{{ route('booking.exportPDF', $booking->id_booking) }}" target="_blank"
    class="inline-flex items-center bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 mb-4">
    <i class="fas fa-file-pdf mr-2"></i> Export PDF
</a>


                    {{--
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="p-5 border-b border-gray-200">
                            <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                                <span class="w-8 h-8 bg-[#f5acca] rounded-lg flex items-center justify-center text-sm">
                                    <i class="fas fa-history text-[#ea3882]"></i>
                                </span>
                                Riwayat Proses
                            </h2>
                        </div>

                        <div class="p-5">
                            <div class="space-y-5">

                                <div class="flex gap-3">
                                    <div class="flex flex-col items-center" style="min-width: 40px;">
                                        <div
                                            class="w-10 h-10 bg-[#ea3882] rounded-full flex items-center justify-center text-white text-sm">
                                            <i class="fas fa-calendar-plus"></i>
                                        </div>
                                        <div style="width: 2px; height: 100%; background-color: #f5acca; margin-top: 8px;">
                                        </div>
                                    </div>
                                    <div class="flex-1 pb-4">
                                        <h3 class="font-bold text-gray-800">Booking Dibuat</h3>
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ $booking->created_at ? $booking->created_at->format('d F Y, H:i') : '-' }}
                                            WIB
                                        </p>
                                        <p class="text-gray-600 text-sm mt-2">Booking telah dibuat dan menunggu pembayaran
                                            dari Anda</p>
                                    </div>
                                </div>

                                <div class="flex gap-3">
                                    <div class="flex flex-col items-center" style="min-width: 40px;">
                                        <div
                                            class="w-10 h-10 rounded-full flex items-center justify-center text-white text-sm {{ $booking->status_pembayaran == 'sudah dibayar' ? 'bg-green-500' : 'bg-gray-300' }}">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </div>
                                        @if ($booking->status_sewa != 'batal')
                                            <div
                                                style="width: 2px; height: 100%; margin-top: 8px; {{ $booking->status_pembayaran == 'sudah dibayar' ? 'background-color: #86efac' : 'background-color: #e5e7eb' }};">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 pb-4">
                                        <h3 class="font-bold text-gray-800">Pembayaran</h3>
                                        <p class="text-xs text-gray-500 mt-1">
                                            @if ($booking->status_pembayaran == 'sudah dibayar')
                                                Lunas -
                                                {{ $booking->updated_at ? $booking->updated_at->format('d F Y, H:i') : '-' }}
                                                WIB
                                            @else
                                                Menunggu pembayaran
                                            @endif
                                        </p>
                                        @if ($booking->status_pembayaran == 'belum dibayar')
                                            <p class="text-gray-600 text-sm mt-2">Upload bukti transfer untuk melanjutkan
                                                proses verifikasi</p>
                                        @endif
                                    </div>
                                </div>

                                @if ($booking->status_sewa != 'batal')
                                    <div class="flex gap-3">
                                        <div class="flex flex-col items-center" style="min-width: 40px;">
                                            <div
                                                class="w-10 h-10 rounded-full flex items-center justify-center text-sm {{ $booking->status_sewa == 'aktif' || $booking->status_sewa == 'selesai' ? 'bg-[#b8caef] text-[#5a7bb5]' : 'bg-gray-300 text-white' }}">
                                                <i class="fas fa-key"></i>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="font-bold text-gray-800">Status Sewa</h3>
                                            <p class="text-xs text-gray-500 mt-1">
                                                @if ($booking->status_sewa == 'aktif')
                                                    Sedang Aktif
                                                @elseif($booking->status_sewa == 'selesai')
                                                    Masa Sewa Selesai
                                                @else
                                                    Menunggu Konfirmasi Admin
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    --}}
                </div>

                <div class="lg:col-span-1 space-y-6 sticky top-20">

                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="bg-gradient-to-r from-[#ea3882] to-[#d12670] p-5 text-white">
                            <h2 class="text-lg font-bold flex items-center gap-2">
                                <i class="fas fa-receipt"></i>
                                Ringkasan Pembayaran
                            </h2>
                        </div>

                        <div class="p-5">

                            <div class="mb-4 bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <p class="text-xs text-gray-600 font-semibold mb-2">Status Pembayaran</p>
                                @if ($booking->status_pembayaran == 'sudah dibayar')
                                    <span
                                        class="px-3 py-1 bg-green-100 text-green-800 text-sm font-semibold rounded-full inline-flex items-center gap-2">
                                        <i class="fas fa-check-circle"></i> Sudah Dibayar
                                    </span>
                                @else
                                    <span
                                        class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-semibold rounded-full inline-flex items-center gap-2">
                                        <i class="fas fa-clock"></i> Belum Dibayar
                                    </span>
                                @endif
                            </div>

                            <div class="space-y-3">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-600">
                                        <i class="far fa-calendar text-gray-400 mr-1"></i> Tanggal Booking
                                    </span>
                                    <span class="font-semibold text-gray-800">
                                        {{ $booking->created_at ? $booking->created_at->format('d M Y') : '-' }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-600">
                                        <i class="far fa-clock text-gray-400 mr-1"></i> Durasi
                                    </span>
                                    <span class="font-semibold text-gray-800">
                                        {{ $booking->lama_sewa ?? 0 }} Bulan
                                    </span>
                                </div>
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-600">
                                        <i class="fas fa-money-bill-wave text-gray-400 mr-1"></i> Total Harga
                                    </span>
                                    <span class="font-semibold text-blue-600">
                                        Rp
                                        {{ number_format($booking->harga ?? 0, 0, ',', '.') }}
                                    </span>
                                </div>

                                @if ($booking->kost && $booking->kost->no_rek)
                                    <div class="mt-4 bg-blue-50 p-4 rounded-lg border border-blue-200">
                                        <p class="text-xs text-blue-700 font-semibold mb-2 flex items-center gap-2">
                                            <i class="fas fa-university"></i> Nomor Rekening
                                        </p>
                                        <p class="font-mono font-bold text-gray-800 text-sm">{{ $booking->kost->no_rek }}
                                        </p>
                                    </div>
                                @endif

                                {{-- Upload Bukti Transfer (hanya muncul kalau belum bayar) --}}
                                @if ($booking->status_pembayaran == 'belum dibayar' && $booking->status_sewa == 'menunggu')
                                    <div
                                        class="mt-5 border-2 border-dashed border-[#f5acca] rounded-lg p-5 bg-[#ffe6e2] bg-opacity-40">
                                        <h3 class="font-bold text-gray-800 mb-3 text-sm flex items-center gap-2">
                                            <i class="fas fa-upload text-[#ea3882]"></i>
                                            Upload Bukti Transfer
                                        </h3>
                                        <form action="{{ route('booking.upload-bukti', $booking->id_booking) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <input type="file" name="bukti_tf" accept="image/*" required
                                                    class="block w-full text-xs text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#ea3882] file:text-white hover:file:bg-[#d12670] file:cursor-pointer cursor-pointer border border-gray-300 rounded-lg">
                                            </div>
                                            <button type="submit"
                                                class="w-full bg-gradient-to-r from-[#ea3882] to-[#d12670] hover:from-[#d12670] hover:to-[#b81e5a] text-white font-bold py-2 px-4 rounded-lg text-sm flex items-center justify-center gap-2">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                                Upload Bukti
                                            </button>
                                        </form>
                                    </div>
                                @endif

                                {{-- Bukti Transfer (hanya tampil kalau sudah ada bukti) --}}
                                {{-- Bukti Transfer --}}
                                @if ($booking->bukti_tf)
                                    <div class="mt-5">
                                        <h3 class="font-bold text-gray-800 mb-2 text-sm flex items-center gap-2">
                                            <i class="fas fa-image text-green-600"></i>
                                            Bukti Transfer
                                        </h3>

                                        <div class="rounded-lg overflow-hidden border-2 border-green-300">
                                            {{-- Gunakan Storage::url() --}}
                                            <img src="{{ Storage::url($booking->bukti_tf) }}" alt="Bukti Transfer"
                                                class="w-full">
                                        </div>
                                    </div>
                                @endif

                                {{-- Tombol Edit & Batalkan (hanya muncul kalau belum bayar) --}}
                                @if ($booking->status_pembayaran == 'belum dibayar' && $booking->status_sewa == 'menunggu')
                                    <a href="{{ route('user.booking.edit', $booking->id_booking) }}"
                                        class="block w-full mt-3 mb-3 bg-[#b8caef] hover:bg-[#9ab5e8] text-white font-bold py-2 px-4 rounded-lg text-center text-sm">
                                        <i class="fas fa-edit mr-1"></i>
                                        Edit Booking
                                    </a>

                                    <form id="cancel-form-{{ $booking->id_booking }}"
                                        action="{{ route('booking.cancel', $booking->id_booking) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" onclick="confirmCancel('{{ $booking->id_booking }}')"
                                            class="w-full bg-white hover:bg-red-50 text-red-600 border-2 border-red-600 font-bold py-2 px-4 rounded-lg text-sm flex items-center justify-center gap-2">
                                            <i class="fas fa-times-circle"></i>
                                            Batalkan Booking
                                        </button>
                                    </form>
                                @endif


                                @if ($booking->status_sewa == 'batal')
                                    <form id="delete-form-{{ $booking->id_booking }}"
                                        action="{{ route('user.booking.destroy', $booking->id_booking) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete('{{ $booking->id_booking }}')"
                                            class="w-full bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg text-sm flex items-center justify-center gap-2">
                                            <i class="fas fa-trash-alt"></i>
                                            Hapus Booking
                                        </button>
                                    </form>
                                @endif
                            </div>

                        </div>

                        {{-- Informasi Penting --}}
                        @if ($booking->status_pembayaran == 'belum dibayar')
                            <div class="bg-yellow-50 rounded-lg p-3 border-2 border-yellow-200 shadow">
                                <div class="flex items-start gap-3">
                                    <div
                                        class="w-10 h-10 bg-yellow-400 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-info-circle text-yellow-900"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-800 mb-2 text-sm">Informasi Penting</h3>
                                        <ul class="text-xs text-gray-700 space-y-2">
                                            <li class="flex items-start gap-2">
                                                <i class="fas fa-check text-green-600 mt-0.5"></i>
                                                <span>Upload bukti transfer untuk verifikasi pembayaran</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <i class="fas fa-check text-green-600 mt-0.5"></i>
                                                <span>Verifikasi pembayaran 1x24 jam</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <i class="fas fa-check text-green-600 mt-0.5"></i>
                                                <span>Hubungi admin jika ada kendala</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @elseif($booking->status_pembayaran == 'sudah dibayar')
                            <div class="bg-yellow-50 rounded-lg p-2 border-2 border-yellow-200 shadow">
                                <div class="flex items-start p-3 gap-3">
                                    <div
                                        class="w-10 h-10 bg-yellow-400 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-info-circle text-yellow-900"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-800 mb-2 text-sm">Informasi Penting</h3>
                                        <ul class="text-xs text-gray-700 space-y-2">
                                            <li class="flex items-start gap-2">
                                                <i class="fas fa-check text-green-600 mt-0.5"></i>
                                                <span>Patuhi aturan kos yang berlaku (jam malam, kebersihan, dll)</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <i class="fas fa-check text-green-600 mt-0.5"></i>
                                                <span>Hubungi admin jika ada kendala atau kebutuhan mendesak</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <i class="fas fa-check text-green-600 mt-0.5"></i>
                                                <span>Perpanjangan sewa bisa dilakukan sebelum masa sewa habis</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
<!-- Modal untuk gambar -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="relative bg-white rounded-lg shadow-lg p-2 inline-block">
        <span class="absolute top-2 right-3 text-gray-800 text-2xl cursor-pointer"
            onclick="closeModal()">&times;</span>
        <img id="modalImg" class="max-w-[70vw] max-h-[70vh] object-contain rounded-lg">
    </div>
</div>



<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>

<script>
    function openModal(src) {
        document.getElementById('modalImg').src = src;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }
</script>
<script>
    function confirmCancel(bookingId) {
        Swal.fire({
            title: 'Yakin ingin membatalkan booking ini?',
            text: "Booking ini akan dibatalkan dan tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e11d48', // merah
            cancelButtonColor: '#6b7280', // abu-abu
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya, Batalkan',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('cancel-form-' + bookingId).submit();
            }
        });
    }

    function confirmDelete(bookingId) {
        Swal.fire({
            title: 'Yakin ingin menghapus booking ini?',
            text: "Data booking akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626', // merah tua
            cancelButtonColor: '#6b7280',
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya, Hapus',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + bookingId).submit();
            }
        });
    }
</script>
