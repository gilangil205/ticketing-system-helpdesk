<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'IT Support Center'))</title>
    @stack('styles')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        .sidebar {
            width: 280px;
            transition: all 0.3s;
            background: linear-gradient(to bottom, #2C52CB, #1E40AF);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            font-family: 'Figtree', sans-serif;
        }
        .sidebar-collapsed {
            margin-left: -280px;
        }
        .content-area {
            transition: all 0.3s;
        }
        .navbar {
            height: 64px;
        }
        .main-content {
            margin-top: 64px;
        }
        .menu-item {
            transition: all 0.2s ease;
            font-weight: 500;
        }
        .menu-item:hover {
            transform: translateX(5px);
        }
        .active-menu {
            background: rgba(255, 255, 255, 0.15);
            border-left: 4px solid white;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100">
<div class="min-h-screen">
    <!-- Navbar -->
    @switch(auth()->user()->role)
        @case('Admin')
        @case('Project Manager')
        @case('QA Tester')
            @include('layouts.navbar.admin')
            @break

        @case('Developer')
            @include('layouts.navbar.developer')
            @break

        @case('Client')
            @include('layouts.navbar.client')
            @break
    @endswitch

    <div class="flex pt-16">
        <!-- Sidebar -->
        @switch(auth()->user()->role)
            @case('Admin')
            @case('Project Manager')
            @case('QA Tester')
                @include('layouts.sidebar.admin')
                @break

            @case('Developer')
                @include('layouts.sidebar.developer')
                @break

            @case('Client')
                @include('layouts.sidebar.client')
                @break
        @endswitch

        <!-- Main Content -->
        <div class="content-area flex-1 ml-72 main-content pt-0">
            <h1 class="text-3xl font-bold mx-5 mt-6 mb-4 text-gray-800">@yield('title')</h1>
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</div>

<!-- Toggle Sidebar -->
<script>
    document.getElementById('sidebarToggle')?.addEventListener('click', function () {
        const sidebar = document.querySelector('.sidebar');
        const content = document.querySelector('.content-area');

        sidebar.classList.toggle('sidebar-collapsed');
        content.classList.toggle('ml-72');
        content.classList.toggle('ml-0');
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            document.getElementById('sidebar')?.classList.remove('hidden');
        }
    });
</script>

<!-- SweetAlert2 Logout Confirmation -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const logoutBtn = document.getElementById('logout-btn');
        const logoutForm = document.getElementById('logout-form');

        logoutBtn?.addEventListener('click', function () {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logged out from this session.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, logout',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    logoutForm.submit();
                }
            });
        });
    });
</script>

@livewireScripts
@stack('scripts')
</body>
</html>
