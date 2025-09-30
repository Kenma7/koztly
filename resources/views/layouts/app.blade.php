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
        <div class="main-content bg-gray-50 flex-1 ml-64 min-h-screen transition-all duration-300">
            <div class="px-6 py-6 transition-all duration-400">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- FOOTER -->
   

</body>
</html class="h-full">
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
            </main>
        </div>
    </body>
</html>
