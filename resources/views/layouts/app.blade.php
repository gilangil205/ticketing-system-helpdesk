<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'IT Support Center'))</title>
    @stack('styles')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .sidebar {
            width: 250px;
            transition: all 0.3s;
            background: rgba(44, 82, 203, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .sidebar-collapsed {
            margin-left: -250px;
        }
        .content-area {
            transition: all 0.3s;
        }
        .navbar {
            height: 64px; /* Fixed navbar height */
        }
        .main-content {
            margin-top: 64px; /* To account for fixed navbar */
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        <!-- Combined Navbar -->
        @if(in_array(auth()->user()->role, ['Admin', 'Project Manager', 'Developer', 'QA Tester']))
            {{-- Navbar untuk Admin, Project Manager, Developer, QA Tester --}}
            @include('layouts.navbar.admin')
        @elseif(auth()->user()->role === 'Client')
            {{-- Navbar untuk Client --}}
            @include('layouts.navbar.client')
        @endif

        <div class="flex pt-16"> <!-- Added pt-16 to account for navbar height -->
            <!-- Sidebar -->
            @if(in_array(auth()->user()->role, ['Admin', 'Project Manager', 'Developer', 'QA Tester']))
                {{-- Sidebar untuk Admin, Project Manager, Developer, QA Tester --}}
                @include('layouts.sidebar.admin')
            @elseif(auth()->user()->role === 'Client')
                {{-- Sidebar untuk Client --}}
                @include('layouts.sidebar.client')
            @endif

            <!-- Main Content -->
            <div class="content-area flex-1 ml-64 main-content pt-0">
                <h1 class="text-4xl font-bold mx-5">@yield('title')</h1>
                <!-- Page Content -->
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
            content.classList.toggle('ml-64');
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

    @stack('scripts')
</body>
</html>
