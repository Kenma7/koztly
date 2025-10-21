<nav class="fixed top-0 left-0 right-0 bg-white shadow-sm z-[100] border-b border-gray-200">
    <div class="flex items-center justify-between px-4 py-2">
        <!-- Left Section: Burger + Logo -->
        <div class="flex items-center space-x-3">
            <button id="navbar-toggle-sidebar" class="p-1.5 rounded-md hover:bg-gray-100 transition-colors">
                <i class="fas fa-bars text-gray-600 text-sm"></i>
            </button>
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/logo-koztly.png') }}" alt="Koztly Logo" class="h-7 w-auto">
            </div>
        </div>

        <!-- Right Section: Profile -->
        <div class="flex items-center space-x-3">
            <div class="relative">
                <button id="profile-menu-button"
                    class="flex items-center space-x-1 p-1.5 rounded-md hover:bg-gray-100 transition-colors">
                    @auth
                    <div class="w-6 h-6 bg-gradient-to-r from-[#ea3882] to-[#d12670] rounded-full 
                            flex items-center justify-center text-white text-xs font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    @else
                    <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-gray-500 text-xs"></i>
                    </div>
                    @endauth
                    <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                </button>

                <!-- Dropdown Menu -->
                <div id="profile-dropdown"
                    class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
                    @auth
                    <!-- User Info -->
                    <div class="px-4 py-3 border-b border-gray-100">
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                    @endauth

                    <!-- Menu Items -->
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                        <i class="fas fa-user text-[#ea3882] w-4"></i>
                        <span>Profile Saya</span>
                    </a>

                    <a href="{{ route('user.bookings.index') }}"
                        class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                        <i class="fas fa-history text-[#ea3882] w-4"></i>
                        <span>Riwayat Booking</span>
                    </a>

                    <hr class="my-2">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition w-full text-left">
                            <i class="fas fa-sign-out-alt w-4"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    document.getElementById('profile-menu-button').addEventListener('click', function() {
        document.getElementById('profile-dropdown').classList.toggle('hidden');
    });
</script>