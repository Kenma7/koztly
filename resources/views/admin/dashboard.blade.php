<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Koztly</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar-bg {
            background-image: url('data:image/svg+xml,%3Csvg width="100" height="100" xmlns="http://www.w3.org/2000/svg"%3E%3Cdefs%3E%3Cpattern id="pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"%3E%3Ccircle cx="10" cy="10" r="1.5" fill="rgba(233, 59, 129, 0.1)"/%3E%3C/pattern%3E%3C/defs%3E%3Crect width="100" height="100" fill="url(%23pattern)"/%3E%3C/svg%3E');
            background-size: 200px 200px;
        }
        #sidebar {
            transition: transform 0.3s ease-in-out;
        }
        #main-content {
            transition: margin-left 0.3s ease-in-out;
        }
        .sidebar-mini {
            width: 80px;
        }
        .sidebar-full {
            width: 256px;
        }
        .menu-text {
            transition: opacity 0.2s ease-in-out;
        }
        .sidebar-mini .menu-text {
            opacity: 0;
            display: none;
        }
    </style>
</head>
<body class="bg-gray-50">
    
    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar-full fixed left-0 top-0 z-40 h-screen bg-white shadow-lg sidebar-bg transition-all duration-300">
        <div class="h-full px-3 py-4 overflow-y-auto relative">
            <!-- Logo Section -->
            <div class="flex items-center justify-center mb-8 mt-4">
                <img id="logo-full" src="/images/logo-koztly.png" alt="Logo" class="w-32 h-auto transition-all duration-300">
                <img id="logo-mini" src="/images/logo-koztly.png" alt="Logo" class="w-10 h-auto hidden transition-all duration-300">
            </div>
            
            <!-- Menu -->
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 text-white bg-pink-500 rounded-lg hover:bg-pink-600 transition" title="Dashboard">
                        <i class="fas fa-th-large w-5 text-center"></i>
                        <span class="ml-3 menu-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kosan.index') }}" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-pink-50 hover:text-pink-600 transition" title="Kelola Kosan">
                        <i class="fas fa-home w-5 text-center"></i>
                        <span class="ml-3 menu-text">Kelola Kosan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kamar.index') }}" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-pink-50 hover:text-pink-600 transition" title="Kelola Kamar">
                        <i class="fas fa-door-open w-5 text-center"></i>
                        <span class="ml-3 menu-text">Kelola Kamar</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.booking.index') }}" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-pink-50 hover:text-pink-600 transition" title="Kelola Booking">
                        <i class="fas fa-calendar-check w-5 text-center"></i>
                        <span class="ml-3 menu-text">Kelola Booking</span>
                    </a>
                </li>
            </ul>

            <!-- Logout Button at Bottom -->
            <div class="absolute bottom-4 left-3 right-3">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center p-3 w-full text-red-600 rounded-lg hover:bg-red-50 transition" title="Logout">
                        <i class="fas fa-sign-out-alt w-5 text-center"></i>
                        <span class="ml-3 menu-text">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Overlay untuk mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden"></div>

    <!-- Main Content -->
    <div id="main-content" class="ml-64 transition-all duration-300">
        <!-- Navbar Biru -->
        <nav class="bg-blue-300 shadow-md fixed top-0 z-20 right-0 left-64 transition-all duration-300" id="navbar">
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <!-- Hamburger Button -->
                    <button id="toggleSidebar" class="text-white hover:bg-pink-500 p-2 rounded-lg transition">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h2 class="text-xl font-semibold text-white">Dashboard Admin</h2>
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-white">Admin</span>
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-blue-600 font-bold">
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
            <div class="bg-white rounded-xl shadow p-6 border-l-4 border-blue-300 mb-6">
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
                <div class="bg-white rounded-xl shadow p-6 border-l-4 border-blue-300">
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
                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-bold">#1</span>
                                    @elseif($index == 1)
                                        <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs font-bold">#2</span>
                                    @elseif($index == 2)
                                        <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded-full text-xs font-bold">#3</span>
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
        let sidebarOpen = true;
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const navbar = document.getElementById('navbar');
        const overlay = document.getElementById('sidebar-overlay');
        const toggleBtn = document.getElementById('toggleSidebar');
        const logoFull = document.getElementById('logo-full');
        const logoMini = document.getElementById('logo-mini');

        toggleBtn.addEventListener('click', function() {
            sidebarOpen = !sidebarOpen;
            
            if (sidebarOpen) {
                // Full sidebar
                sidebar.classList.remove('sidebar-mini');
                sidebar.classList.add('sidebar-full');
                mainContent.classList.remove('ml-20');
                mainContent.classList.add('ml-64');
                navbar.classList.remove('left-20');
                navbar.classList.add('left-64');
                logoFull.classList.remove('hidden');
                logoMini.classList.add('hidden');
            } else {
                // Mini sidebar (icon only)
                sidebar.classList.remove('sidebar-full');
                sidebar.classList.add('sidebar-mini');
                mainContent.classList.remove('ml-64');
                mainContent.classList.add('ml-20');
                navbar.classList.remove('left-64');
                navbar.classList.add('left-20');
                logoFull.classList.add('hidden');
                logoMini.classList.remove('hidden');
            }
        });

        // Auto hide alert
        setTimeout(() => {
            const success = document.getElementById('alert-success');
            if (success) {
                success.classList.add('opacity-0');
                setTimeout(() => success.remove(), 500);
            }
        }, 3000);

        // Responsive: Full sidebar on desktop, mini on mobile initially
        function checkScreenSize() {
            if (window.innerWidth < 768) {
                if (sidebarOpen) {
                    toggleBtn.click();
                }
            }
        }
        
        window.addEventListener('load', checkScreenSize);
        window.addEventListener('resize', checkScreenSize);
    </script>
</body>
</html>