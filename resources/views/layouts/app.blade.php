<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Koztly')</title>
    <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <!-- Simple Session Data Pass -->
    <script>
        // Clean version tanpa complex logic
        @if(Session::has('sweet_success'))
            window.sweetSuccess = '{{ Session::get("sweet_success") }}';
        @endif
        
        @if(Session::has('sweet_error'))
            window.sweetError = '{{ Session::get("sweet_error") }}';
        @endif
        
        @if(Session::has('sweet_warning'))
            window.sweetWarning = '{{ Session::get("sweet_warning") }}';
        @endif

        // Debug info
        console.log('Session Data:', {
            sweetSuccess: window.sweetSuccess || 'none',
            sweetError: window.sweetError || 'none', 
            sweetWarning: window.sweetWarning || 'none'
        });
    </script>

    @vite([
        'resources/css/app.css', 
        'resources/css/sidebar.css', 
        'resources/js/app.js',
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

    <!-- SIMPLE ALERTS - CLEAN VERSION -->
    @if(Session::has('success'))
        <div class="alert-auto-close fixed top-20 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50 max-w-sm">
            ✅ {{ Session::get('success') }}
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert-auto-close fixed top-20 right-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg z-50 max-w-sm">
            ❌ {{ Session::get('error') }}
        </div>
    @endif

    @if(Session::has('warning'))
        <div class="alert-auto-close fixed top-20 right-4 bg-yellow-500 text-white px-4 py-2 rounded-lg shadow-lg z-50 max-w-sm">
            ⚠️ {{ Session::get('warning') }}
        </div>
    @endif

    @if(Session::has('info'))
        <div class="alert-auto-close fixed top-20 right-4 bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg z-50 max-w-sm">
            ℹ️ {{ Session::get('info') }}
        </div>
    @endif

    <!-- Load SweetAlert & Simple Notification Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Simple Notification System yang PASTI WORK
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Notification system initialized');
            
            // SweetAlert Notifications
            if (window.sweetSuccess) {
                console.log('Showing SweetAlert Success:', window.sweetSuccess);
                Swal.fire({
                    icon: 'success',
                    title: window.sweetSuccess,
                    timer: 3000,
                    showConfirmButton: false,
                    position: 'top-end',
                    toast: true,
                    background: '#f0f9ff'
                });
            }
            
            if (window.sweetError) {
                console.log('Showing SweetAlert Error:', window.sweetError);
                Swal.fire({
                    icon: 'error',
                    title: window.sweetError,
                    timer: 4000,
                    showConfirmButton: true,
                    confirmButtonColor: '#ef4444'
                });
            }
            
            if (window.sweetWarning) {
                console.log('Showing SweetAlert Warning:', window.sweetWarning);
                Swal.fire({
                    icon: 'warning',
                    title: window.sweetWarning,
                    timer: 4000,
                    showConfirmButton: false,
                    position: 'top-end',
                    toast: true
                });
            }

            // Simple Alerts Auto Close
            const alerts = document.querySelectorAll('.alert-auto-close');
            console.log('Found simple alerts:', alerts.length);
            
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transition = 'opacity 0.5s ease-out';
                    setTimeout(() => {
                        if (alert.parentNode) {
                            alert.remove();
                        }
                    }, 500);
                }, 4000);
            });
        });
    </script>

<script>
// DEBUG PROFILE DROPDOWN
document.addEventListener('DOMContentLoaded', function() {
    console.log('=== DEBUG PROFILE DROPDOWN ===');
    
    const profileBtn = document.getElementById('profile-menu-button');
    const profileDropdown = document.getElementById('profile-dropdown');
    
    console.log('Profile button:', profileBtn);
    console.log('Profile dropdown:', profileDropdown);
    console.log('Auth check:', {{ Auth::check() ? 'true' : 'false' }});
    
    if (profileBtn && profileDropdown) {
        console.log('✅ Elements found, adding event listener...');
        
        profileBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('🎯 Profile button clicked!');
            console.log('Before toggle - hidden:', profileDropdown.classList.contains('hidden'));
            
            profileDropdown.classList.toggle('hidden');
            
            console.log('After toggle - hidden:', profileDropdown.classList.contains('hidden'));
        });
        
        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!profileBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
                profileDropdown.classList.add('hidden');
                console.log('👋 Close dropdown (click outside)');
            }
        });
    } else {
        console.log('❌ Elements not found!');
        console.log('Profile button exists:', !!profileBtn);
        console.log('Profile dropdown exists:', !!profileDropdown);
    }
    
    // Test manual toggle
    window.debugProfile = function() {
        if (profileDropdown) {
            profileDropdown.classList.toggle('hidden');
            console.log('Manual toggle - hidden:', profileDropdown.classList.contains('hidden'));
        }
    }
});
</script>

</body>
</html>

<!--ini apa?
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        // Fonts 
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        // Scripts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="dark:bg-gray-900">

            // Page Heading 
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            // Page Content 
            <main>
            </main>
        </div>
    </body>
</html>
</html>
