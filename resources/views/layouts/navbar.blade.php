<!-- resources/views/layouts/navbar.blade.php -->
<nav class="bg-white shadow-lg fixed top-0 left-0 right-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-3">
            <!-- Logo & Mobile Menu Button -->
            <div class="flex items-center">
                <!-- Mobile Menu Button (hanya tampil di mobile) -->
                <button id="sidebar-toggle" class="md:hidden text-gray-700 mr-3">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">
                    <i class="fas fa-home mr-2"></i>Koztly
                </a>
            </div>

            <!-- Profile/Login -->
            <div class="flex items-center space-x-4">
               //auth login nanti 
                    <i class="fas fa-user-circle text-xl"></i>
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- JavaScript untuk Mobile Sidebar Toggle -->
<script>
document.getElementById('sidebar-toggle').addEventListener('click', function() {
    const sidebar = document.querySelector('.fixed.left-0');
    sidebar.classList.toggle('-translate-x-full');
});
</script>