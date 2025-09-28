<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Koztly')</title>
    @vite('resources/css/app.css')

    <!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <!-- NAVBAR -->
     @include('layouts.navbar')

 <main class="pt-16">
        @hasSection('with-sidebar')
        <!-- Layout dengan Sidebar -->
        <div class="flex">
            <!-- Sidebar -->
            <div class="w-64 bg-white shadow-lg min-h-screen">
                @include('layouts.sidebar')
            </div>

    <!-- MAIN CONTENT -->
    <div class="flex-1">
                <div class="container mx-auto px-6 py-8">
                    @yield('content')
                </div>
            </div>
        </div>
        @else
        <!-- Layout tanpa Sidebar -->
        <div class="container mx-auto px-4 py-8">
            @yield('content')
        </div>
        @endif
    </main>

</body>
</html>
