<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Koztly')</title>

    @vite([
        'resources/css/app.css', 
        'resources/css/sidebar.css', 
        'resources/js/sidebar.js'
    ])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-white text-gray-900 sidebar-transitioning">
    <!-- NAVBAR -->
    @include('layouts.navbar')

    <main class="pt-12 flex"> 
    <!-- Sidebar -->
    <div class="fixed left-0 top-12 bottom-0 z-30"> 
        @include('layouts.sidebar')
    </div>

     <!-- Main Content -->
        <div class="main-content bg-pink-50 flex-1 ml-64 min-h-screen transition-all duration-300">
            <div class="px-6 py-6 transition-all duration-400">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- FOOTER -->
   

</body>
</html>