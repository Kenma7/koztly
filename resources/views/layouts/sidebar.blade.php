<!-- Sidebar -->
<div id="sidebar" class="w-64 bg-white h-[calc(100vh-3rem)] fixed left-0 top-12 transition-all duration-300 border-r border-gray-200 shadow-sm">
    <!-- User Info Section -->
    <div class="p-4 border-b border-gray-100 sidebar-user-info">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center shadow-sm">
                <i class="fas fa-user text-white text-sm"></i>
            </div>
            <div class="sidebar-text">
                <p class="font-semibold text-gray-800 text-sm">Isal</p>
                <p class="text-xs text-gray-500">User</p>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="p-3 space-y-1">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="flex items-center py-2.5 px-3 rounded-lg transition-all duration-200 group border-l-4
           {{ request()->routeIs('dashboard') 
                ? 'bg-blue-50 text-blue-600 border-blue-500' 
                : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600 border-transparent hover:border-blue-500' }}">
            <i class="fas fa-home w-5 
                {{ request()->routeIs('dashboard') ? 'text-blue-500' : 'text-gray-400 group-hover:text-blue-500' }} transition-colors"></i>
            <span class="ml-3 sidebar-text font-medium">Dashboard</span>
        </a>

      <!-- Daftar Kost -->
<a href="{{ route('kosan.index') }}"
   class="flex items-center py-2.5 px-3 rounded-lg transition-all duration-200 group border-l-4
   {{ request()->routeIs('kosan.index') || request()->routeIs('kosan.show')
        ? 'bg-blue-50 text-blue-600 border-blue-500'
        : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600 border-transparent hover:border-blue-500' }}">
    <i class="fas fa-building w-5
        {{ request()->routeIs('kosan.index') || request()->routeIs('kosan.show')
            ? 'text-blue-500'
            : 'text-gray-400 group-hover:text-blue-500' }} transition-colors"></i>
    <span class="ml-3 sidebar-text font-medium">Daftar Kost</span>
</a>

<!-- Bookings -->
<a href="{{ route('kosan.booking.form', ['id' => 1]) }}"
   class="flex items-center py-2.5 px-3 rounded-lg transition-all duration-200 group border-l-4
   {{ request()->routeIs('kosan.booking.*')
        ? 'bg-blue-50 text-blue-600 border-blue-500'
        : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600 border-transparent hover:border-blue-500' }}">
    <i class="fas fa-calendar-check w-5
        {{ request()->routeIs('kosan.booking.*')
            ? 'text-blue-500'
            : 'text-gray-400 group-hover:text-blue-500' }} transition-colors"></i>
    <span class="ml-3 sidebar-text font-medium">Bookings</span>
</a>


        <!-- Chat -->
        <a href="#"
           class="flex items-center py-2.5 px-3 rounded-lg transition-all duration-200 group border-l-4
           {{ request()->routeIs('chat') 
                ? 'bg-blue-50 text-blue-600 border-blue-500' 
                : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600 border-transparent hover:border-blue-500' }}">
            <i class="fas fa-comment-dots w-5 
                {{ request()->routeIs('chat') ? 'text-blue-500' : 'text-gray-400 group-hover:text-blue-500' }} transition-colors"></i>
            <span class="ml-3 sidebar-text font-medium">Chat</span>
        </a>

        <!-- Settings -->
        <a href="#"
           class="flex items-center py-2.5 px-3 rounded-lg transition-all duration-200 group border-l-4
           {{ request()->routeIs('settings') 
                ? 'bg-blue-50 text-blue-600 border-blue-500' 
                : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600 border-transparent hover:border-blue-500' }}">
            <i class="fas fa-cog w-5 
                {{ request()->routeIs('settings') ? 'text-blue-500' : 'text-gray-400 group-hover:text-blue-500' }} transition-colors"></i>
            <span class="ml-3 sidebar-text font-medium">Settings</span>
        </a>
    </nav>
</div>
