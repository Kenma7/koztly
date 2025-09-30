<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-pink-50 hover:text-pink-600 hover:text-pink-600 transition" title="Dashboard">
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
                    <a href="{{ route('admin.booking.index') }}" class="flex items-center p-3 text-white bg-pink-500 rounded-lg hover:bg-pink-600 transition" title="Kelola Booking">
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
        <div class="mb-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Sukses! </strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.style.display='none';">
                        <i class="fas fa-times"></i>
                    </span>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Error! </strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.style.display='none';">
                        <i class="fas fa-times"></i>
                    </span>
                </div>
            @endif
        </div>

        <!-- Header -->
        <div class="bg-white rounded-xl shadow p-6 border-l-4 border-blue-400 mb-6">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                <div>
                    <h1 class="text-2xl font-bold text-pink-500">Kelola Booking</h1>
                    <p class="text-gray-600 mt-2">
                        Lihat dan kelola semua <span class="font-semibold text-blue-400">booking</span> di Koztly beserta statusnya.
                    </p>
                </div>
            </div>
        </div>

        <!-- Statistik + Grafik -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Grafik Booking -->
            <div class="bg-white rounded-xl border-l-4 border-pink-400 shadow p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Grafik Booking Per Bulan</h2>
                <canvas id="bookingChart" class="h-64"></canvas>
            </div>

            <!-- Statistik -->
            <div class="grid grid-cols-3 gap-4">
                @php
                    $stats = [
                        ['label' => 'Total', 'value' => $totalBooking, 'color' => 'pink', 'icon' => 'fa-calendar-check'],
                        ['label' => 'Menunggu', 'value' => $menunggu, 'color' => 'yellow', 'icon' => 'fa-clock'],
                        ['label' => 'Aktif', 'value' => $aktif, 'color' => 'green', 'icon' => 'fa-door-open'],
                        ['label' => 'Selesai', 'value' => $selesai, 'color' => 'gray', 'icon' => 'fa-check-circle'],
                        ['label' => 'Batal', 'value' => $batal, 'color' => 'red', 'icon' => 'fa-times-circle'],
                        ['label' => 'Belum Bayar', 'value' => $belumDibayar, 'color' => 'orange', 'icon' => 'fa-wallet'],
                        ['label' => 'Sudah Bayar', 'value' => $sudahDibayar, 'color' => 'emerald', 'icon' => 'fa-money-bill-wave'],
                    ];
                @endphp

                @foreach($stats as $s)
                    <div class="bg-white border-t-4 border-{{ $s['color'] }}-100 rounded-lg shadow p-3 flex flex-col items-center">
                        <div class="bg-{{ $s['color'] }}-100 text-{{ $s['color'] }}-500 p-2 rounded-full mb-1">
                            <i class="fas {{ $s['icon'] }}"></i>
                        </div>
                        <p class="text-xs text-gray-500">{{ $s['label'] }}</p>
                        <p class="text-lg font-bold text-gray-800">{{ $s['value'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Tombol Reset + Filter (di luar background putih tapi tetap nyambung) -->
         <div class="flex justify-end mb-6 gap-2">
            <a href="{{ route('admin.booking.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg">
                <i class="fas fa-rotate-right"></i> </a>
                <button type="submit" form="filterForm" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
                </div>

        <!-- Filter Booking -->
         <div class="bg-white rounded-xl shadow p-6 mb-2 border-l-4 border-pink-400">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Filter Booking</h2>
             <form id="filterForm" method="GET" action="{{ route('admin.booking.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Username -->
                 <div>
                    <input type="text" name="username" value="{{ request('username') }}"
                    placeholder="Cari username..." class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400">
                </div>
                
                <!-- Kosan -->
                 <div>
                    <select name="kosan_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400">
                        <option value="">Semua Kosan</option>
                        @foreach($kosanList as $kosan)
                        <option value="{{ $kosan->id }}" {{ request('kosan_id') == $kosan->id ? 'selected' : '' }}>
                            {{ $kosan->nama_kos }}
                        </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Status -->
                 <div>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400">
                        <option value="">Semua Status</option>
                        <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Batal</option>
                    </select>
                </div>
                
                <!-- Status Pembayaran -->
                 <div>
                    <select name="status_pembayaran" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400">
                        <option value="">Semua Status Bayar</option>
                        <option value="belum_bayar" {{ request('status_pembayaran') == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                        <option value="sudah_bayar" {{ request('status_pembayaran') == 'sudah_bayar' ? 'selected' : '' }}>Sudah Bayar</option>
                    </select>
                </div>
            </form>
        </div>
        
        
    <!-- Tabel Booking -->
     <div class="overflow-x-auto bg-white rounded-xl shadow p-4 border-l-4 border-pink-400">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Username</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kosan</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nomor Kamar</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status Bayar</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($bookings as $booking)
                <tr>
                    <td class="px-4 py-2">{{ $loop->iteration + ($bookings->currentPage()-1)*$bookings->perPage() }}</td>
                    <td class="px-4 py-2">{{ optional($booking->user)->username ?? '-' }}</td>
                    <td class="px-4 py-2">{{ optional($booking->kost)->nama_kos ?? '-' }}</td>
                    <td class="px-4 py-2">{{ optional($booking->kamar)->nomor_kamar ?? '-' }}</td>
                    <td class="px-4 py-2 capitalize">{{ $booking->status_sewa }}</td>
                    <td class="px-4 py-2 capitalize">{{ $booking->status_pembayaran }}</td>
                    <td class="px-4 py-2 flex gap-2">
                      <td class="px-4 py-2 flex gap-2">
    @if($booking->status_sewa == 'menunggu')
        <form action="{{ route('admin.booking.update', $booking->id_booking) }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status_sewa" value="aktif">
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm">Terima</button>
        </form>
        <form action="{{ route('admin.booking.update', $booking->id_booking) }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status_sewa" value="batal">
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm">Batal</button>
        </form>
    @elseif($booking->status_sewa == 'aktif')
        <form action="{{ route('admin.booking.update', $booking->id_booking) }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status_sewa" value="selesai">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm">Selesai</button>
        </form>
    @endif

    <!-- Tombol Lihat Detail -->
     <button onclick="openModal({{ $booking->id_booking }})"
        class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-lg text-sm flex items-center gap-1">
        <i class="fas fa-eye"></i> Detail
    </button>

    <!-- Tombol Bukti Transfer, hanya muncul kalau sudah bayar -->
     @if($booking->status_pembayaran == 'sudah dibayar')
        <button onclick="openBuktiModal({{ $booking->id_booking }})" 
        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-sm flex items-center gap-1">
        <i class="fas fa-receipt"></i> Bukti TF
    </button>
    @endif
</td>

        </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-4 py-2 text-center text-gray-500">Tidak ada booking ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4 b">
    {{ $bookings->withQueryString()->links() }} </div>
    
    
    <!-- Modal Detail Booking -->
     @foreach($bookings as $booking)
     <div id="modal-{{ $booking->id_booking }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-xl shadow-lg w-11/12 md:w-1/2 p-6 relative">
        <h2 class="text-xl font-bold mb-4">Detail Booking #{{ $booking->id_booking }}</h2>
        <ul class="text-gray-700 space-y-2">
          <li><strong>Username:</strong> {{ optional($booking->user)->username ?? '-' }}</li>
          <li><strong>Kos:</strong> {{ optional($booking->kost)->nama_kos ?? '-' }}</li>
          <li><strong>Kamar:</strong> {{ optional($booking->kamar)->nomor_kamar ?? '-' }} </li>
          <li><strong>Harga:</strong> {{ $booking->harga ?? '-' }}</li>
          <li><strong>Lama Sewa:</strong> {{ $booking->lama_sewa }}</li>
          <li><strong>Status Pembayaran:</strong> {{ $booking->status_pembayaran }}</li>
          <li><strong>Bukti Transfer:</strong> 
                @if($booking->bukti_tf)
                    <a href="{{ asset('storage/bukti_tf/' . $booking->bukti_tf) }}" target="_blank" class="text-blue-500 underline">
                        Lihat Bukti
                    </a>
                @else
                    Belum Ada
                @endif
            </li>
            <li><strong>Status Sewa:</strong> {{ $booking->status_sewa }}</li>
            <li><strong>Dibuat:</strong> {{ $booking->created_at }}</li>
            <li><strong>Diubah:</strong> {{ $booking->updated_at }}</li>
        </ul>
        <button onclick="closeModal({{ $booking->id_booking }})" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">
            <i class="fas fa-times fa-lg"></i>
        </button>
    </div>
</div>

 <!-- Modal Bukti Transfer -->
            @if($booking->bukti_tf)
                <div id="bukti-modal-{{ $booking->id_booking }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                    <div class="bg-white rounded-xl shadow-lg w-11/12 md:w-1/2 p-6 relative">
                        <h2 class="text-xl font-bold mb-4">Bukti Transfer #{{ $booking->id_booking }}</h2>
                        <img src="{{ asset('storage/bukti_tf/' . $booking->bukti_tf) }}" alt="Bukti Transfer" class="w-full rounded-lg">
                        <button onclick="closeBuktiModal({{ $booking->id_booking }})" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">
                            <i class="fas fa-times fa-lg"></i>
                        </button>
                    </div>
                </div>
            @endif
        @endforeach

    </main>


    <!-- JS -->
    <script>
    // Sidebar 
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

        // Auto hide alert
        setTimeout(() => {
            const success = document.getElementById('alert-success');
            if (success) {
                success.classList.add('opacity-0');
                setTimeout(() => success.remove(), 500);
            }
        }, 3000);

        // Responsive: Auto hide sidebar on mobile
        function checkScreenSize() {
            if (window.innerWidth < 768) {
                if (sidebarOpen) {
                    toggleBtn.click();
                }
            }
        }
        
        window.addEventListener('load', checkScreenSize);
        window.addEventListener('resize', checkScreenSize);

    function openModal(id) {
        document.getElementById('modal-' + id).classList.remove('hidden');
    }
    
    function closeModal(id) {
        document.getElementById('modal-' + id).classList.add('hidden');
    }
    
    function openBuktiModal(id) {
        document.getElementById('bukti-modal-' + id).classList.remove('hidden');
    }
    
    function closeBuktiModal(id) {
        document.getElementById('bukti-modal-' + id).classList.add('hidden');
    }

    const ctx = document.getElementById('bookingChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($bulan),
            datasets: [{
                label: 'Jumlah Booking',
                data: @json($jumlahBooking),
                fill: true,
                backgroundColor: 'rgba(236,72,153,0.1)',
                borderColor: 'rgba(236,72,153,1)',
                pointBackgroundColor: 'rgba(236,72,153,1)',
                pointBorderColor: '#fff',
                tension: 0.4,
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { mode: 'index', intersect: false }
            },
            interaction: { mode: 'nearest', axis: 'x', intersect: false },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 },
                    suggestedMax: Math.max(...@json($jumlahBooking)) + 5
                }
            }
        }
    });
    </script>

</body>
</html>
