<!DOCTYPE html>
<html lang="en">
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
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
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
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
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
            border-color: #4299e1;
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
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
        }

        .booking-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }

        .booking-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
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
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    
    <!-- Sidebar -->
    <aside id="sidebar" class="fixed left-0 top-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-white shadow-lg">
        <div class="flex flex-col h-full px-3 py-4">
            
            <!-- Logo -->
            <div class="flex items-center justify-center mb-8 mt-4">
                <h1 class="text-2xl font-bold text-[#E93B81]">KOZTLY</h1>
            </div>
            
            <!-- Menu (flex-1 biar ngisi ruang kosong) -->
            <ul class="space-y-2 font-medium flex-1">
                <li>
                    <a href="{{ route('user.dashboard') }}" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-th-large w-5"></i>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.booking.index') }}" class="flex items-center p-3 text-white bg-pink-500 rounded-lg hover:bg-pink-600">
                        <i class="fas fa-home w-5"></i>
                        <span class="ml-3">Riwayat Booking</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.profile') }}" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-door-open w-5"></i>
                        <span class="ml-3">Profile</span>
                    </a>
                </li>
            </ul>

            <!-- Logout -->
            <form action="{{ route('user.logout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="flex items-center p-3 w-full text-red-600 rounded-lg hover:bg-red-50">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span class="ml-3">Logout</span>
                </button>
            </form>

        </div>
    </aside>

    <!-- Main Content -->
    <div class="sm:ml-64">
        <!-- Navbar -->
        <nav class="bg-white border-b border-gray-200 fixed top-0 z-30 w-full sm:w-[calc(100%-16rem)] ">
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <button id="toggleSidebar" class="text-gray-600 sm:hidden">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h2 class="text-xl font-semibold text-gray-800">Riwayat Booking</h2>
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-gray-600">Admin</span>
                        <div class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center text-white font-bold">
                            A
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="mt-20 p-6">
            
        <!-- Statistik Booking -->
        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-4 mb-6">
            
            <!-- Total Bookings -->
            <div class="bg-white rounded-xl shadow p-6 border-l-4 border-pink-500 transition duration-200 ease-in-out transform hover:-translate-y-0.5 hover:shadow-lg">
                <h3 class="text-sm font-semibold mb-4 text-gray-700 flex items-center gap-2">
                    <i class="fas fa-list text-pink-500"></i>
                    Total Bookings
                </h3>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Jumlah keseluruhan</span>
                    <span class="bg-pink-100 text-pink-800 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $totalBookings ?? 0 }}
                    </span>
                </div>
            </div>

            <!-- Paid Bookings -->
            <div class="bg-white rounded-xl shadow p-6 border-l-4 border-blue-500 transition duration-200 ease-in-out transform hover:-translate-y-0.5 hover:shadow-lg">
                <h3 class="text-sm font-semibold mb-4 text-gray-700 flex items-center gap-2">
                    <i class="fas fa-check-circle text-blue-500"></i>
                    Paid Bookings
                </h3>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Pembayaran berhasil</span>
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $paidBookings ?? 0 }}
                    </span>
                </div>
            </div>

            <!-- Pending Payment -->
            <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-500 transition duration-200 ease-in-out transform hover:-translate-y-0.5 hover:shadow-lg">
                <h3 class="text-sm font-semibold mb-4 text-gray-700 flex items-center gap-2">
                    <i class="fas fa-clock text-green-500"></i>
                    Pending Payment
                </h3>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Menunggu pembayaran</span>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $pendingBookings ?? 0 }}
                    </span>
                </div>
            </div>

            <!-- Rejected -->
            <div class="bg-white rounded-xl shadow p-6 border-l-4 border-purple-500 transition duration-200 ease-in-out transform hover:-translate-y-0.5 hover:shadow-lg">
                <h3 class="text-sm font-semibold mb-4 text-gray-700 flex items-center gap-2">
                    <i class="fas fa-times-circle text-purple-500"></i>
                    Rejected
                </h3>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Ditolak</span>
                    <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $rejectedBookings ?? 0 }}
                    </span>
                </div>
            </div>

        </div>


        <!-- Filter Tabs -->
        <div class="filter-container">
            <div class="filter-tabs">
                <a href="{{ route('user.booking.index') }}" class="filter-tab {{ !request('status') ? 'active' : '' }}">
                    <i class="fas fa-list"></i> All Bookings
                </a>
                <a href="{{ route('user.booking.index', ['status' => 'paid']) }}" class="filter-tab {{ request('status') == 'paid' ? 'active' : '' }}">
                    <i class="fas fa-check-circle"></i> Paid
                </a>
                <a href="{{ route('user.booking.index', ['status' => 'pending']) }}" class="filter-tab {{ request('status') == 'pending' ? 'active' : '' }}">
                    <i class="fas fa-clock"></i> Pending
                </a>
                <a href="{{ route('user.booking.index', ['status' => 'rejected']) }}" class="filter-tab {{ request('status') == 'rejected' ? 'active' : '' }}">
                    <i class="fas fa-times-circle"></i> Rejected
                </a>
            </div>
        </div>
        

        <!-- Booking Grid -->
        @if($bookings && $bookings->count() > 0)
        <div class="booking-grid">
            @foreach($bookings as $booking)
            <div class="booking-card" onclick="window.location.href='{{ route('user.bookings.show', $booking->id_booking) }}'">
                <div style="position: relative;">
                    <img src="{{ $booking->kost->foto_kos ?? 'https://via.placeholder.com/400x250?text=Kos+Image' }}" alt="{{ $booking->kost->nama_kos ?? 'Kos' }}" class="booking-image">
                    <div class="booking-price">Rp {{ number_format($booking->harga ?? 0, 0, ',', '.') }}/{{ $booking->lama_sewa ?? 0 }} bulan</div>
                </div>
                <div class="booking-content">
                    <h3 class="booking-title">{{ $booking->kost->nama_kos ?? 'Nama Kos' }}</h3>
                    <div class="booking-location">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $booking->kost->alamat ?? 'Alamat' }}
                    </div>

                    <div class="booking-info">
                        <div class="booking-info-item">
                            <span class="booking-info-label">Booking Date</span>
                            <span class="booking-info-value">{{ $booking->created_at ? $booking->created_at->format('d M Y') : '-' }}</span>
                        </div>
                        <div class="booking-info-item">
                            <span class="booking-info-label">Duration</span>
                            <span class="booking-info-value">{{ $booking->lama_sewa ?? 0 }} Months</span>
                        </div>
                        <div class="booking-info-item">
                            <span class="booking-info-label">Total Payment</span>
                            <span class="booking-info-value">Rp {{ number_format($booking->harga ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="booking-info-item">
                            <span class="booking-info-label">Status</span>
                            <span class="booking-info-value">
                                @if($booking->status_pembayaran == 'paid')
                                    <span class="booking-status status-paid">Paid</span>
                                @elseif($booking->status_pembayaran == 'pending')
                                    <span class="booking-status status-pending">Pending</span>
                                @else
                                    <span class="booking-status status-rejected">Rejected</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    @if($booking->status_pembayaran != 'paid')
                    <div class="booking-actions" onclick="event.stopPropagation()">
                        <a href="{{ route('user.bookings.edit', $booking->id_booking) }}" class="btn btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('user.bookings.destroy', $booking->id_booking) }}" method="POST" style="flex: 1;" onsubmit="return confirm('Are you sure you want to delete this booking?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" style="width: 100%;">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
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
        </main>

    </div>
    
</body>
</html>