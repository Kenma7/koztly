<!-- resources/views/layouts/app-with-sidebar.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Koztly - Cari Kosan')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Simple Navbar -->
    @include('layouts.navbar')
    
    <main class="pt-16 flex">
        <!-- SIDEBAR -->
        <div class="w-64 bg-white shadow-lg min-h-screen p-6 fixed left-0 top-16 bottom-0 overflow-y-auto">
            <h3 class="font-bold text-lg mb-6">Filter Pencarian</h3>
            
            <!-- Section Filter yang bisa di-override oleh child views -->
            @yield('sidebar-content')
            
            <!-- Default Sidebar Content kalau child gak override -->
            @hasSection('sidebar-content')
            @else
            <div class="mb-6">
                <h4 class="font-semibold mb-3">Kategori</h4>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="kategori[]" value="PRIA" class="mr-2 rounded">
                        <span class="text-sm">PRIA</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="kategori[]" value="WANITA" class="mr-2 rounded">
                        <span class="text-sm">WANITA</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="kategori[]" value="CAMPURAN" class="mr-2 rounded">
                        <span class="text-sm">CAMPURAN</span>
                    </label>
                </div>
            </div>

            <div class="mb-6">
                <h4 class="font-semibold mb-3">Range Harga</h4>
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Minimal</label>
                        <input type="number" placeholder="Rp 500.000" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Maksimal</label>
                        <input type="number" placeholder="Rp 2.000.000" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    </div>
                </div>
            </div>

            <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 font-semibold">
                Terapkan Filter
            </button>
            @endif
        </div>

        <!-- MAIN CONTENT -->
        <div class="flex-1 ml-64"> <!-- margin left sama dengan width sidebar -->
            <div class="container mx-auto px-6 py-8">
                @yield('content')
            </div>
        </div>
    </main>
    
    <!-- Footer -->
    @include('layouts.footer')
</body>
</html>