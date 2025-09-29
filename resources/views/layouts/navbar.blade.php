<nav class="fixed top-0 left-0 right-0 bg-white shadow-sm z-40 border-b border-gray-200">
    <div class="flex items-center justify-between px-4 py-2"> <!-- Ubah py-3 jadi py-2 -->
        <!-- Left Section: Burger Menu + Logo -->
        <div class="flex items-center space-x-3"> <!-- Kurangi space-x -->
            <!-- Burger Menu untuk toggle sidebar -->
            <button id="navbar-toggle-sidebar" class="p-1.5 rounded-md hover:bg-gray-100 transition-colors">
                <i class="fas fa-bars text-gray-600 text-sm"></i> <!-- Perkecil icon -->
            </button>
            
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <div class="w-6 h-6 bg-blue-600 rounded flex items-center justify-center"> <!-- Perkecil logo -->
                    <span class="text-white font-bold text-xs">K</span> <!-- Perkecil text -->
                </div>
                <span class="text-lg font-semibold text-gray-800">Koztly</span> <!-- Perkecil text -->
            </div>
        </div>

        <!-- Right Section: Profile & Settings -->
        <div class="flex items-center space-x-2"> <!-- Kurangi space-x -->
            <!-- Settings Button -->
            <button class="p-1.5 rounded-md hover:bg-gray-100 transition-colors">
                <i class="fas fa-cog text-gray-500 text-sm"></i> <!-- Perkecil icon -->
            </button>
            
            <!-- Profile Dropdown -->
            <div class="relative">
                <button id="profile-menu-button" class="flex items-center space-x-1 p-1.5 rounded-md hover:bg-gray-100 transition-colors">
                    <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center"> <!-- Perkecil avatar -->
                        <i class="fas fa-user text-gray-500 text-xs"></i> <!-- Perkecil icon -->
                    </div>
                    <!-- Hapus text "Profile" biar lebih minimalis -->
                    <i class="fas fa-chevron-down text-gray-400 text-xs"></i> <!-- Perkecil icon -->
                </button>
                
                <!-- Dropdown Menu (Hidden by default) -->
                <div id="profile-dropdown" class="hidden absolute right-0 mt-1 w-40 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
                    <a href="#" class="block px-3 py-1.5 text-xs text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-user mr-2 text-xs"></i>My Profile
                    </a>
                    <a href="#" class="block px-3 py-1.5 text-xs text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-cog mr-2 text-xs"></i>Settings
                    </a>
                    <a href="#" class="block px-3 py-1.5 text-xs text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-sign-out-alt mr-2 text-xs"></i>Sign Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>