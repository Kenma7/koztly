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
    
    <!-- Sidebar -->
    <aside id="sidebar" class="fixed left-0 top-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-white shadow-lg">
        <div class="h-full px-3 py-4 overflow-y-auto">
            <!-- Logo -->
            <div class="flex items-center justify-center mb-8 mt-4">
                <h1 class="text-2xl font-bold text-[#E93B81]">KOZTLY</h1>
            </div>
            
            <!-- Menu -->
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                        <i class="fas fa-th-large w-5"></i>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kosan.index') }}" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-home w-5"></i>
                        <span class="ml-3">Kelola Kosan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kamar.index') }}" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-door-open w-5"></i>
                        <span class="ml-3">Kelola Kamar</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.booking.index') }}" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-calendar-check w-5"></i>
                        <span class="ml-3">Kelola Booking</span>
                    </a>
                </li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST" class="mt-8">
                        @csrf
                        <button type="submit" class="flex items-center p-3 w-full text-red-600 rounded-lg hover:bg-red-50">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span class="ml-3">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="sm:ml-64">
        <!-- Navbar -->
        <nav class="bg-white border-b border-gray-200 fixed top-0 z-30 w-full sm:w-[calc(100%-16rem)]">
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <button id="toggleSidebar" class="text-gray-600 sm:hidden">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h2 class="text-xl font-semibold text-gray-800">Dashboard Admin</h2>
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-gray-600">Admin</span>
                        <div class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center text-white font-bold">
                            A
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="mt-20 p-6">
            <!-- Notifikasi -->
            @if(session('success'))
            <div id="alert-success" class="mb-6 p-4 rounded-lg bg-green-100 text-green-800 transition-opacity duration-700">
                {{ session('success') }}
            </div>
            @endif

            <!-- Header Dashboard -->
            <div class="bg-white rounded-xl shadow p-6 border-l-4 border-pink-500 mb-6">
                <h1 class="text-2xl font-bold mb-2">Selamat Datang di Dashboard</h1>
                <p class="text-sm text-gray-600">
                    Kelola semua data <span class="font-bold text-[#E93B81]">Koztly</span> dengan mudah dalam satu tempat.
                </p>
            </div>

            <!-- Statistik Utama -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
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

            <!-- Statistik Kosan & Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <!-- Kategori Kosan -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-sm font-semibold mb-4 text-gray-700 flex items-center gap-2">
                        <i class="fas fa-building text-pink-500"></i>
                        Kategori Kosan
                    </h3>
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

                <!-- Status Sewa -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-sm font-semibold mb-4 text-gray-700 flex items-center gap-2">
                        <i class="fas fa-clipboard-list text-blue-500"></i>
                        Status Sewa Booking
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-green-500"></i>
                                <span class="text-sm">Aktif</span>
                            </div>
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $bookingAktif }}</span>
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
            </div>

            <!-- Booking Terbanyak -->
            <div class="bg-white rounded-xl shadow p-6 mb-6">
                <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                    <i class="fas fa-fire text-orange-500"></i>
                    Kosan dengan Booking Terbanyak
                </h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-gray-600 text-sm">Ranking</th>
                                <th class="px-4 py-2 text-left text-gray-600 text-sm">Nama Kosan</th>
                                <th class="px-4 py-2 text-left text-gray-600 text-sm">Lokasi</th>
                                <th class="px-4 py-2 text-left text-gray-600 text-sm">Total Booking</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookingTerbanyak as $index => $data)
                            <tr class="border-b">
                                <td class="px-4 py-3 text-sm">
                                    @if($index == 0)
                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-bold">🥇 #1</span>
                                    @elseif($index == 1)
                                        <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs font-bold">🥈 #2</span>
                                    @elseif($index == 2)
                                        <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded-full text-xs font-bold">🥉 #3</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-bold">#{{ $index + 1 }}</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm font-semibold">{{ $data->kost->nama_kos ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm">{{ $data->kost->lokasi_kos ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="bg-pink-100 text-pink-800 px-3 py-1 rounded-full text-xs font-semibold">{{ $data->total_booking }} Booking</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-gray-400">
                                    <i class="fas fa-inbox text-3xl mb-2"></i>
                                    <p class="text-sm">Belum ada data booking</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Booking Terbaru -->
            <div class="bg-white rounded-xl shadow p-6 mb-6">
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
                                <th class="px-4 py-2 text-left text-gray-600 text-sm">Harga</th>
                                <th class="px-4 py-2 text-left text-gray-600 text-sm">Status Sewa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookingTerbaru as $booking)
                            <tr class="border-b">
                                <td class="px-4 py-3 text-sm">{{ $booking->id_booking }}</td>
                                <td class="px-4 py-3 text-sm">{{ $booking->user->name ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm">{{ $booking->kost->nama_kos ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm">Rp {{ number_format($booking->harga, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-sm">
                                    @if($booking->status_sewa == 'aktif')
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Aktif</span>
                                    @elseif($booking->status_sewa == 'selesai')
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">Selesai</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Batal</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-gray-400">
                                    <i class="fas fa-inbox text-3xl mb-2"></i>
                                    <p class="text-sm">Belum ada data booking</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Kosan Terbaru -->
            <div class="bg-white rounded-xl shadow p-6 mb-6">
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
        </main>
    </div>

    <!-- Scripts -->
    <script>
        // Toggle sidebar mobile
        document.getElementById('toggleSidebar')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
        });

        // Auto hide alert
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