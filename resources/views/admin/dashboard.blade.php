<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Koztly</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">

    <!-- Notifikasi -->
    @if(session('success'))
    <div id="alert-success" class="m-8 p-4 rounded-lg bg-green-100 text-green-800 transition-opacity duration-700">
        {{ session('success') }}
    </div>
    @endif

    <!-- Header Dashboard -->
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-pink-500 m-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold mb-3">Dashboard Admin</h1>
                <p class="text-sm text-gray-600">
                    Selamat datang di sistem manajemen <span class="font-bold text-[#E93B81]">Koztly</span>. Kelola semua data kosan Anda dengan mudah.
                </p>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 flex items-center gap-2 text-sm">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Statistik Utama -->
    <div class="m-8">
        <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
            <i class="fas fa-chart-line text-pink-500"></i>
            Statistik Utama
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Total Kosan -->
            <div class="bg-white rounded-xl shadow p-6 border-l-4 border-pink-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Kosan</p>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $totalKosan }}</h3>
                    </div>
                    <div class="bg-pink-100 p-4 rounded-full">
                        <i class="fas fa-home text-pink-500 text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Booking -->
            <div class="bg-white rounded-xl shadow p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Booking</p>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $totalBooking }}</h3>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-full">
                        <i class="fas fa-calendar-check text-blue-500 text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total User -->
            <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total User</p>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $totalUser }}</h3>
                    </div>
                    <div class="bg-green-100 p-4 rounded-full">
                        <i class="fas fa-users text-green-500 text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Kamar -->
            <div class="bg-white rounded-xl shadow p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Kamar</p>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $totalKamar }}</h3>
                    </div>
                    <div class="bg-purple-100 p-4 rounded-full">
                        <i class="fas fa-door-open text-purple-500 text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Kosan -->
    <div class="m-8">
        <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
            <i class="fas fa-building text-pink-500"></i>
            Statistik Kosan
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Kategori Kosan -->
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-sm font-semibold mb-4 text-gray-700">Berdasarkan Kategori</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-venus text-pink-500"></i>
                            <span class="text-sm">Kosan Wanita</span>
                        </div>
                        <span class="bg-pink-100 text-pink-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $kosanWanita }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-mars text-blue-500"></i>
                            <span class="text-sm">Kosan Pria</span>
                        </div>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $kosanPria }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-venus-mars text-purple-500"></i>
                            <span class="text-sm">Kosan Bebas</span>
                        </div>
                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $kosanBebas }}</span>
                    </div>
                </div>
            </div>

            <!-- Status Kosan -->
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-sm font-semibold mb-4 text-gray-700">Berdasarkan Status</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span class="text-sm">Kosan Aktif</span>
                        </div>
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $kosanAktif }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-times-circle text-red-500"></i>
                            <span class="text-sm">Kosan Non Aktif</span>
                        </div>
                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $kosanNonaktif }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Booking & Kamar -->
    <div class="m-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Status Booking -->
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-sm font-semibold mb-4 text-gray-700 flex items-center gap-2">
                    <i class="fas fa-clipboard-list text-blue-500"></i>
                    Status Booking
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-clock text-yellow-500"></i>
                            <span class="text-sm">Pending</span>
                        </div>
                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $bookingPending }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check text-green-500"></i>
                            <span class="text-sm">Konfirmasi</span>
                        </div>
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $bookingKonfirmasi }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-double text-blue-500"></i>
                            <span class="text-sm">Selesai</span>
                        </div>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $bookingSelesai }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-times text-red-500"></i>
                            <span class="text-sm">Batal</span>
                        </div>
                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $bookingBatal }}</span>
                    </div>
                </div>
            </div>

            <!-- Status Kamar -->
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-sm font-semibold mb-4 text-gray-700 flex items-center gap-2">
                    <i class="fas fa-door-open text-purple-500"></i>
                    Status Kamar
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span class="text-sm">Kamar Tersedia</span>
                        </div>
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $kamarTersedia }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-user-check text-blue-500"></i>
                            <span class="text-sm">Kamar Terisi</span>
                        </div>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $kamarTerisi }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Terbaru -->
    <div class="m-8">
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                <i class="fas fa-history text-pink-500"></i>
                Booking Terbaru
            </h3>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600 text-sm">ID</th>
                            <th class="px-4 py-2 text-left text-gray-600 text-sm">User</th>
                            <th class="px-4 py-2 text-left text-gray-600 text-sm">Kosan</th>
                            <th class="px-4 py-2 text-left text-gray-600 text-sm">No. Kamar</th>
                            <th class="px-4 py-2 text-left text-gray-600 text-sm">Tanggal</th>
                            <th class="px-4 py-2 text-left text-gray-600 text-sm">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookingTerbaru as $booking)
                        <tr class="border-b">
                            <td class="px-4 py-3 text-sm">{{ $booking->id_booking }}</td>
                            <td class="px-4 py-3 text-sm">{{ $booking->user->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $booking->kost->nama_kos ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $booking->kamar->nomor_kamar ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $booking->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-sm">
                                @if($booking->status_pembayaran == 'belum dibayar')
                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Belum Dibayar</span>
                                @else
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Sudah Dibayar</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-gray-400">
                                <i class="fas fa-inbox text-3xl mb-2"></i>
                                <p class="text-sm">Belum ada data booking</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Kosan Terbaru -->
    <div class="m-8 mb-12">
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                <i class="fas fa-home text-pink-500"></i>
                Kosan Terbaru
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                @forelse($kosanTerbaru as $kosan)
                <div class="border rounded-lg p-4 hover:shadow-lg transition">
                    @if($kosan->gambar_kos)
                        <img src="{{ asset('uploads/kosan/'.$kosan->gambar_kos) }}" alt="{{ $kosan->nama_kos }}" class="w-full h-32 object-cover rounded mb-3">
                    @else
                        <div class="w-full h-32 bg-gray-200 rounded mb-3 flex items-center justify-center">
                            <i class="fas fa-home text-gray-400 text-3xl"></i>
                        </div>
                    @endif
                    <h4 class="font-semibold text-sm mb-1">{{ $kosan->nama_kos }}</h4>
                    <p class="text-xs text-gray-600 mb-2">{{ $kosan->lokasi_kos }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-semibold text-pink-600">Rp {{ number_format($kosan->harga, 0, ',', '.') }}</span>
                        @if($kosan->status == 'aktif')
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Aktif</span>
                        @else
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Non Aktif</span>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-span-5 py-8 text-center text-gray-400">
                    <i class="fas fa-home text-3xl mb-2"></i>
                    <p class="text-sm">Belum ada data kosan</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Script alert auto hide -->
    <script>
        setTimeout(() => {
            const success = document.getElementById('alert-success');
            if (success) {
                success.classList.add('opacity-0');
                setTimeout(() => success.remove(), 500);
            }
        }, 3000);
    </script>

</body>
</html>