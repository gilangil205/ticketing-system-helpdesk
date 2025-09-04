<nav class="navbar bg-white shadow-sm fixed w-full z-10">
    <!-- Gunakan w-full agar logo tetap di kiri -->
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <!-- Left side with logo and toggle -->
            <div class="flex items-center space-x-4 min-w-0">
                <button id="sidebarToggle" class="text-gray-500 hover:text-gray-700 focus:outline-none block lg:hidden">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="flex items-center truncate">
                    <img src="/images/logo.png" alt="THE PRIME" class="h-12 w-auto hover:opacity-80 transition-opacity">
                </div>
            </div>

            <!-- Right side with icons and full name -->
            <div class="flex items-center space-x-4 flex-shrink-0">
                <!-- Notification Bell Icon -->
                <button class="p-1 rounded-full text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span class="sr-only">View notifications</span>
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </button>

                <!-- Display Full Name -->
                <div class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                    <svg class="h-5 w-5 text-gray-900" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ Auth::user()->full_name }}</span>
                </div>
            </div>
        </div>
    </div>
</nav>
