<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Booking - Koztly</title>
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
    </style>
</head>
<body class="bg-gray-50">
    
    <!-- Sidebar -->
    <aside id="sidebar" class="fixed left-0 top-0 z-40 w-64 h-screen bg-white shadow-lg sidebar-bg">
        <div class="h-full px-3 py-4 overflow-y-auto relative">
            <!-- Logo Section -->
            <div class="flex items-center justify-center mb-8 mt-4">
                <img src="/images/logo-koztly.png" alt="Logo" class="w-32 h-auto">
            </div>
            
            <!-- Menu -->
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-pink-50 hover:text-pink-600 transition">
                        <i class="fas fa-th-large w-5"></i>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kosan.index') }}" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-pink-50 hover:text-pink-600 transition">
                        <i class="fas fa-home w-5"></i>
                        <span class="ml-3">Kelola Kosan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kamar.index') }}" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-pink-50 hover:text-pink-600 transition">
                        <i class="fas fa-door-open w-5"></i>
                        <span class="ml-3">Kelola Kamar</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.booking.index') }}" class="flex items-center p-3 text-white bg-pink-500 rounded-lg hover:bg-pink-600 transition">
                        <i class="fas fa-calendar-check w-5"></i>
                        <span class="ml-3">Kelola Booking</span>
                    </a>
                </li>
            </ul>

            <!-- Logout Button at Bottom -->
            <div class="absolute bottom-4 left-3 right-3">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center p-3 w-full text-red-600 rounded-lg hover:bg-red-50 transition">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span class="ml-3">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div id="main-content" class="ml-64 transition-all duration-300">
        <!-- Navbar Biru -->
        <nav class="bg-blue-300 shadow-md fixed top-0 z-20 right-0 left-64 transition-all duration-300" id="navbar">
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <!-- Hamburger Button dan Logo Mini -->
                    <div class="flex items-center gap-4">
                        <button id="toggleSidebar" class="text-white hover:bg-blue-700 p-2 rounded-lg transition">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                    <h2 class="text-xl font-semibold text-white">Kelola Booking</h2>
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
            <!-- Konten halaman booking akan ditambahkan di sini -->
            <div class="bg-white rounded-xl shadow p-6 border-l-4 border-pink-500">
                <h1 class="text-2xl font-bold mb-3">Kelola Booking</h1>
                <p class="text-sm text-gray-600">
                    Kelola semua pemesanan dan booking <span class="font-bold text-[#E93B81]">Koztly</span> dalam satu tempat.
                </p>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script>
        let sidebarOpen = true;
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const navbar = document.getElementById('navbar');
        const toggleBtn = document.getElementById('toggleSidebar');

        toggleBtn.addEventListener('click', function() {
            sidebarOpen = !sidebarOpen;
            
            if (sidebarOpen) {
                // Show sidebar
                sidebar.style.transform = 'translateX(0)';
                mainContent.classList.remove('ml-0');
                mainContent.classList.add('ml-64');
                navbar.classList.remove('left-0');
                navbar.classList.add('left-64');
            } else {
                // Hide sidebar
                sidebar.style.transform = 'translateX(-100%)';
                mainContent.classList.remove('ml-64');
                mainContent.classList.add('ml-0');
                navbar.classList.remove('left-64');
                navbar.classList.add('left-0');
            }
        });

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
    </script>
</body>
</html>