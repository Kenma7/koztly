@extends('layouts.app')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Koztly</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fa;
            color: #333;
        }

        .main-container {
            margin-left: 220px;
            padding: 30px;
        }

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 5px;
        }

        .header p {
            color: #718096;
            font-size: 14px;
        }

        /* Statistics Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .stat-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .stat-icon.blue {
            background: #ebf5ff;
            color: #4299e1;
        }

        .stat-icon.green {
            background: #e6f7ed;
            color: #48bb78;
        }

        .stat-icon.yellow {
            background: #fef7e6;
            color: #ed8936;
        }

        .stat-icon.red {
            background: #fff0f0;
            color: #f56565;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #718096;
            font-size: 14px;
        }

        /* Filter Tabs */
        .filter-container {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .filter-tabs {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 10px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            background: white;
            color: #4a5568;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .filter-tab:hover {
            border-color: #b7cbf0;
            color: #4299e1;
        }

        .filter-tab.active {
            background: #4299e1;
            border-color: #4299e1;
            color: white;
        }

        /* Booking List */
        .booking-grid {
            display: grid;
            glid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 25px;
        }

        .booking-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
            width: 95%; /* pakai 100% supaya mengikuti grid */
            padding: 5px; /* <-- untuk jarak di dalam card */
            margin-bottom: 20px;
        }


        .booking-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .booking-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            position: relative;
        }

        .booking-price {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #4299e1;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
        }

        .booking-content {
            padding: 20px;
        }

        .booking-title {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 5px;
        }

        .booking-location {
            color: #718096;
            font-size: 13px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .booking-info {
            margin-bottom: 15px;
        }

        .booking-info-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
        }

        .booking-info-label {
            color: #718096;
        }

        .booking-info-value {
            font-weight: 500;
            color: #2d3748;
        }

        .booking-status {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-pending {
            background: #fef7e6;
            color: #ed8936;
        }

        .status-paid {
            background: #e6f7ed;
            color: #48bb78;
        }

        .status-rejected {
            background: #fff0f0;
            color: #f56565;
        }

        .booking-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .btn {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        .btn-edit {
            background: #ebf5ff;
            color: #4299e1;
        }

        .btn-edit:hover {
            background: #4299e1;
            color: white;
        }

        .btn-delete {
            background: #fff0f0;
            color: #f56565;
        }

        .btn-delete:hover {
            background: #f56565;
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 12px;
        }

        .empty-state i {
            font-size: 64px;
            color: #cbd5e0;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            color: #2d3748;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #718096;
        }

        @media (max-width: 768px) {
            .main-container {
                margin-left: 0;
                padding: 20px;
            }

            .booking-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 10px; /* <-- ganti dari 5px ke 10px */
            }
        }

        .size-logo {
            width: 140px;
            /* atur lebar sesuai kebutuhan */
            height: auto;
            /* tinggi menyesuaikan */
            margin-left: -10px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body class="bg-gray-50">


    <!-- Main Content -->
    <div class="sm:ml-64">

        <!-- Main Content -->
        <main class="mt-20 p-6">

            <!-- Statistik Booking (berdasarkan status_sewa) -->
            <div class="grid grid-cols-1 md:grid-cols-5 lg:grid-cols-5 gap-4 mb-6">

                <!-- Total Bookings -->
                <div
                    class="bg-white rounded-xl shadow p-6 border-t-4 border-pink-500 transition duration-200 ease-in-out transform hover:-translate-y-0.5 hover:shadow-lg">
                    <h3 class="text-sm font-semibold mb-4 text-gray-700 flex items-center gap-2">
                        <i class="fas fa-list text-pink-500"></i>
                        Total Booking
                    </h3>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Jumlah keseluruhan</span>
                        <span class="bg-pink-100 text-pink-800 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ $totalBookings ?? 0 }}
                        </span>
                    </div>
                </div>

                <!-- Menunggu -->
                <div
                    class="bg-white rounded-xl shadow p-6 border-t-4 border-yellow-500 transition duration-200 ease-in-out transform hover:-translate-y-0.5 hover:shadow-lg">
                    <h3 class="text-sm font-semibold mb-4 text-gray-700 flex items-center gap-2">
                        <i class="fas fa-clock text-yellow-500"></i>
                        Menunggu
                    </h3>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Belum diproses</span>
                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ $menungguBookings ?? 0 }}
                        </span>
                    </div>
                </div>

                <!-- Aktif -->
                <div
                    class="bg-white rounded-xl shadow p-6 border-t-4 border-green-500 transition duration-200 ease-in-out transform hover:-translate-y-0.5 hover:shadow-lg">
                    <h3 class="text-sm font-semibold mb-4 text-gray-700 flex items-center gap-2">
                        <i class="fas fa-play text-green-500"></i>
                        Aktif
                    </h3>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Sedang berjalan</span>
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ $aktifBookings ?? 0 }}
                        </span>
                    </div>
                </div>

                <!-- Selesai -->
                <div
                    class="bg-white rounded-xl shadow p-6 border-t-4 border-blue-500 transition duration-200 ease-in-out transform hover:-translate-y-0.5 hover:shadow-lg">
                    <h3 class="text-sm font-semibold mb-4 text-gray-700 flex items-center gap-2">
                        <i class="fas fa-check-circle text-blue-500"></i>
                        Selesai
                    </h3>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Sudah selesai</span>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ $selesaiBookings ?? 0 }}
                        </span>
                    </div>
                </div>

                <!-- Batal -->
                <div
                    class="bg-white rounded-xl shadow p-6 border-t-4 border-red-500 transition duration-200 ease-in-out transform hover:-translate-y-0.5 hover:shadow-lg">
                    <h3 class="text-sm font-semibold mb-4 text-gray-700 flex items-center gap-2">
                        <i class="fas fa-times-circle text-red-500"></i>
                        Batal
                    </h3>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Dibatalkan</span>
                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ $batalBookings ?? 0 }}
                        </span>
                    </div>
                </div>
                

            </div>



            <div class="filter-container">
                <div class="flex flex-col md:flex-row md:items-center gap-2">

                    <!-- Search Box -->
                    <form method="GET" action="{{ route('user.bookings.index') }}" class="flex items-center flex-1">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari kos atau lokasi..."
                            class="w-full border border-gray-300 rounded-l-lg px-4 py-2
                                focus:border-pink-300 focus:outline-none transition">
                        <button type="submit"
                            class="bg-pink-500 text-white px-4 py-3 rounded-r-lg hover:bg-pink-600 transition">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>

                    <!-- Dropdown Filter -->
                    <div x-data="{ open: false }" class="relative inline-block text-left md:ml-2">
                        <!-- Trigger Button -->
                        <button @mouseenter="open = true" @mouseleave="open = false"
                            class="filter-tab flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg bg-white hover:bg-blue-100 transition">
                            <i class="fas fa-filter"></i>
                            <span>
                                @if (request('status') == 'menunggu')
                                    Menunggu
                                @elseif(request('status') == 'aktif')
                                    Aktif
                                @elseif(request('status') == 'selesai')
                                    Selesai
                                @elseif(request('status') == 'batal')
                                    Batal
                                @else
                                    Semua
                                @endif
                            </span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>

                        <!-- Dropdown Items -->
                        <div x-show="open" @mouseenter="open = true" @mouseleave="open = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-2"
                            class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-50">

                            <a href="{{ route('user.bookings.index') }}"
                                class="block px-4 py-2 text-sm hover:bg-gray-100 {{ !request('status') ? 'font-semibold text-pink-500' : '' }}">
                                <i class="fas fa-list"></i> Semua
                            </a>
                            <a href="{{ route('user.bookings.index', ['status' => 'menunggu']) }}"
                                class="block px-4 py-2 text-sm hover:bg-gray-100 {{ request('status') == 'menunggu' ? 'font-semibold text-pink-500' : '' }}">
                                <i class="fas fa-clock"></i> Menunggu
                            </a>
                            <a href="{{ route('user.bookings.index', ['status' => 'aktif', 'search' => request('search')]) }}"
                                class="block px-4 py-2 text-sm hover:bg-gray-100 {{ request('status') == 'aktif' ? 'font-semibold text-pink-500' : '' }}">
                                <i class="fas fa-play"></i> Aktif
                            </a>
                            <a href="{{ route('user.bookings.index', ['status' => 'selesai']) }}"
                                class="block px-4 py-2 text-sm hover:bg-gray-100 {{ request('status') == 'selesai' ? 'font-semibold text-pink-500' : '' }}">
                                <i class="fas fa-check-circle"></i> Selesai
                            </a>
                            <a href="{{ route('user.bookings.index', ['status' => 'batal']) }}"
                                class="block px-4 py-2 text-sm hover:bg-gray-100 {{ request('status') == 'batal' ? 'font-semibold text-pink-500' : '' }}">
                                <i class="fas fa-times-circle"></i> Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alpine.js -->
            <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

            <!-- Booking Grid -->
            @if ($bookings && $bookings->count() > 0)
                <div class="booking-grid">
                    @foreach ($bookings as $booking)
                        <div class="booking-card"
                            onclick="window.location.href='{{ route('user.bookings.detail', $booking->id_booking) }}'">

                            <!-- Image Section -->
                            <div style="position: relative;">
                                @if ($booking->kamar && $booking->kamar->kosan && $booking->kamar->kosan->gambar_kos)
                                    <img src="{{ asset('uploads/kosan/' . $booking->kamar->kosan->gambar_kos) }}"
                                        alt="{{ $booking->kamar->kosan->nama_kos }}"
                                        class="w-full h-48 object-cover rounded-t-xl">
                                @else
                                    <img src="https://via.placeholder.com/800x400" alt="Kos"
                                        class="w-full h-48 object-cover rounded-t-xl">
                                @endif

                                <!-- Status Badge - Top Left -->
                                <div class="absolute top-3 left-3">
                                    @if ($booking->status_sewa === 'menunggu')
                                        <span class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-yellow-500 text-white shadow-md">
                                            <i class="fas fa-clock"></i> Menunggu
                                        </span>
                                    @elseif ($booking->status_sewa === 'aktif')
                                        <span class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-green-500 text-white shadow-md">
                                            <i class="fas fa-play"></i> Aktif
                                        </span>
                                    @elseif ($booking->status_sewa === 'selesai')
                                        <span class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-blue-500 text-white shadow-md">
                                            <i class="fas fa-check-circle"></i> Selesai
                                        </span>
                                    @elseif ($booking->status_sewa === 'batal')
                                        <span class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-500 text-white shadow-md">
                                            <i class="fas fa-times-circle"></i> Batal
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Content Section -->
                            <div class="p-4">
                                <!-- Title -->
                                <h3 class="text-xl font-bold text-gray-800 mb-1 line-clamp-1">
                                    {{ $booking->kamar->kosan->nama_kos }}
                                </h3>

                                <!-- Location -->
                                <div class="flex items-center text-gray-600 text-sm mb-3">
                                    <i class="fas fa-map-marker-alt text-blue-500 mr-1"></i>
                                    <span class="line-clamp-1">{{ $booking->kamar->kosan->lokasi_kos }}</span>
                                </div>

                                <!-- Divider -->
                                <hr class="my-3 border-gray-200">

                                <!-- Booking Details -->
                                <div class="space-y-2 mb-3">
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
                                            {{ number_format(($booking->harga ?? 0), 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Divider -->
                                <hr class="my-3.5 border-gray-200">

                                <!-- Facilities -->
                                @if ($booking->kamar->kosan->fasilitas)
                                    <div class="flex items-center gap-2 text-sm text-gray-600 flex-wrap">
                                        @php
                                            $fasilitasArray = explode(',', $booking->kamar->kosan->fasilitas);
                                            $iconMap = [
                                                'wifi' => 'fa-wifi',
                                                'ac' => 'fa-snowflake',
                                                'kasur' => 'fa-bed',
                                                'lemari' => 'fa-door-closed',
                                                'meja' => 'fa-table',
                                                'kursi' => 'fa-chair',
                                                'tv' => 'fa-tv',
                                                'kamar mandi' => 'fa-bath',
                                                'dapur' => 'fa-utensils',
                                                'parkir' => 'fa-parking',
                                                'motor' => 'fa-motorcycle',
                                                'mobil' => 'fa-car',
                                                'laundry' => 'fa-tshirt',
                                                'kulkas' => 'fa-temperature-low',
                                            ];

                                            // Ambil maksimal 2 fasilitas pertama
                                            $displayFasilitas = array_slice($fasilitasArray, 0, 2);
                                        @endphp

                                        @foreach ($displayFasilitas as $fasilitas)
                                            @php
                                                $fasilitasLower = strtolower(trim($fasilitas));
                                                $icon = 'fa-check-circle'; // default icon

                                                // Cari icon yang sesuai
                                                foreach ($iconMap as $keyword => $iconClass) {
                                                    if (strpos($fasilitasLower, $keyword) !== false) {
                                                        $icon = $iconClass;
                                                        break;
                                                    }
                                                }
                                            @endphp

                                            <div class="flex items-center gap-1 bg-gray-100 px-2 py-1 rounded-md">
                                                <i class="fas {{ $icon }} text-blue-500 text-xs"></i>
                                                <span class="text-xs">{{ ucfirst(trim($fasilitas)) }}</span>
                                            </div>
                                        @endforeach

                                        @if (count($fasilitasArray) > 2)
                                            <div class="flex items-center gap-1 bg-blue-100 px-2 py-1 rounded-md">
                                                <span class="text-xs font-semibold text-blue-700">
                                                    +{{ count($fasilitasArray) - 2 }} more
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <h3>No Bookings Found</h3>
                    <p>You don't have any bookings yet. Start exploring and book your ideal accommodation!</p>
                </div>
            @endif

            <style>
                .booking-grid {
                    display: grid;
                    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                    gap: 20px;
                }

                .booking-card {
                    background: white;
                    border-radius: 16px;
                    overflow: hidden;
                    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                    transition: all 0.3s ease;
                    cursor: pointer;
                }

                .booking-card:hover {
                    transform: translateY(-8px);
                    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
                }

                .line-clamp-1 {
                    display: -webkit-box;
                    -webkit-line-clamp: 1;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                }

                @media (max-width: 640px) {
                    .booking-grid {
                        grid-template-columns: 1fr;
                    }
                }

                @media (min-width: 641px) and (max-width: 1024px) {
                    .booking-grid {
                        grid-template-columns: repeat(2, 1fr);
                    }
                }
            </style>
        </main>

    </div>

</body>

</html>

<script>
    // Toggle Profile Dropdown
    const profileDropdown = document.getElementById('profileDropdown');
    const profileMenu = document.getElementById('profileMenu');

    profileDropdown.addEventListener('click', (e) => {
        e.stopPropagation();
        profileMenu.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!profileDropdown.contains(e.target) && !profileMenu.contains(e.target)) {
            profileMenu.classList.add('hidden');
        }
    });

    // Toggle Sidebar for Mobile
    const toggleSidebar = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');

    if (toggleSidebar && sidebar) {
        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    }
</script>