<nav class="fixed top-0 left-0 right-0 bg-white shadow-sm z-40 border-b border-gray-200">
    <div class="flex items-center justify-between px-4 py-2">

        <!-- Left Section: Burger + Logo -->
        <div class="flex items-center space-x-3">
            <!-- Burger -->
            <button id="navbar-toggle-sidebar" class="p-1.5 rounded-md hover:bg-gray-100 transition-colors">
                <i class="fas fa-bars text-gray-600 text-sm"></i>
            </button>

            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/logo-koztly.png') }}" alt="Koztly Logo" class="h-7 w-auto">
            </div>
        </div>

        <!-- Right Section: Profile & Settings -->
        <div class="flex items-center space-x-3">
            <!-- Profile Dropdown -->
            <div class="relative">
                <button id="profile-menu-button"
                    class="flex items-center space-x-1 p-1.5 rounded-md hover:bg-gray-100 transition-colors">
                    <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-gray-500 text-xs"></i>
                    </div>
                    <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                </button>

                <!-- Dropdown -->
                <div id="profile-dropdown"
                    class="hidden absolute right-0 mt-1 w-40 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
                    <a href="#" class="block px-3 py-1.5 text-xs text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-user mr-2 text-xs"></i>My Profile
                    </a>
                    <a href="#" class="block px-3 py-1.5 text-xs text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-cog mr-2 text-xs"></i>Settings
                    </a>
                   <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                        <button type="submit" class="w-full text-left px-3 py-1.5 text-xs text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-sign-out-alt mr-2 text-xs"></i>Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</nav>
