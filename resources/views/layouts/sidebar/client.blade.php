<!-- Sidebar -->
<div class="sidebar bg-gradient-to-b from-[#2C52CB] to-[#1A3AA8] shadow-lg fixed h-full flex flex-col z-40" style="width: 280px;"
     :class="{ 'open': sidebarOpen }" x-data="{ sidebarOpen: window.innerWidth > 768 }"
     @resize.window="sidebarOpen = window.innerWidth > 768">

    <!-- Mobile Toggle Button -->
    <button class="md:hidden absolute -right-10 top-4 p-2 bg-blue-600 text-white rounded-r" 
            @click="sidebarOpen = !sidebarOpen">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path x-show="!sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            <path x-show="sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" style="display: none;" />
        </svg>
    </button>

    <!-- Main Menu Items with Scroll -->
    <div class="flex-1 overflow-y-auto py-4">
        <nav class="space-y-1 px-3">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="group flex items-center text-base font-medium rounded-lg {{ request()->routeIs('dashboard') ? 'bg-white text-blue-700 shadow-sm' : 'text-blue-100 hover:bg-blue-500 hover:bg-opacity-30 hover:text-white' }} transition-all duration-200 ease-in-out">
                <div class="flex items-center w-full px-4 py-3">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                        <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                    </svg>
                    <span class="sidebar-text">Dashboard</span>
                </div>
            </a>

            <!-- Open New Tickets -->
            <a href="{{ route('client.tickets.index') }}" class="group flex items-center text-base font-medium rounded-lg {{ request()->routeIs('client.tickets.index') ? 'bg-white text-blue-700 shadow-sm' : 'text-blue-100 hover:bg-blue-500 hover:bg-opacity-30 hover:text-white' }} transition-all duration-200 ease-in-out">
                <div class="flex items-center w-full px-4 py-3">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="sidebar-text">Open New Tickets</span>
                </div>
            </a>

            <!-- History Tickets -->
            <a href="{{ route('client.tickets.history') }}" class="group flex items-center text-base font-medium rounded-lg {{ request()->routeIs('client.tickets.history') ? 'bg-white text-blue-700 shadow-sm' : 'text-blue-100 hover:bg-blue-500 hover:bg-opacity-30 hover:text-white' }} transition-all duration-200 ease-in-out">
                <div class="flex items-center w-full px-4 py-3">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="sidebar-text">History Tickets</span>
                </div>
            </a>

            <!-- Settings -->
            <div x-data="{ open: false }" class="mt-2">
                <button @click="open = !open" class="group flex items-center w-full text-base font-medium rounded-lg text-blue-100 hover:bg-blue-500 hover:bg-opacity-30 hover:text-white transition-all duration-200 ease-in-out">
                    <div class="flex items-center justify-between w-full px-4 py-3">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="sidebar-text">Settings</span>
                        </div>
                        <svg x-show="!open" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                        <svg x-show="open" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                        </svg>
                    </div>
                </button>

                <!-- Submenu -->
                <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="ml-6 mt-1 space-y-1 border-l border-blue-400 border-opacity-30 pl-3 py-1">
                    <a href="{{ route('client.password.change') }}" class="flex items-center px-3 py-2 text-sm sm:text-base text-blue-100 rounded-lg hover:bg-blue-500 hover:bg-opacity-30 hover:text-white transition-colors duration-200">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        <span class="sidebar-text">Change Password</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Logout Button -->
    <div class="p-4 border-t border-blue-400 border-opacity-30 bg-blue-600 sticky bottom-0">
        <form method="POST" action="{{ route('logout') }}" id="sidebar-logout-form">
            @csrf
            <button type="button" id="sidebar-logout-btn" class="group flex items-center w-full">
                <div class="flex items-center w-full px-3 py-2 text-base font-medium text-white rounded-lg hover:bg-blue-500 hover:bg-opacity-30 transition-colors duration-200">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm10.72 4.72a.75.75 0 011.06 0l3 3a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H9a.75.75 0 010-1.5h10.94l-1.72-1.72a.75.75 0 010-1.06z" clip-rule="evenodd" />
                    </svg>
                    <span class="sidebar-text">Logout</span>
                </div>
            </button>
        </form>
    </div>
</div>

<!-- Mobile Overlay -->
<div class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden" x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300" 
     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300" 
     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     @click="sidebarOpen = false" style="display: none;">
</div>

<!-- SweetAlert2 -->
<script>
document.addEventListener('click', function(e) {
    if (e.target.closest('#sidebar-logout-btn')) {
        e.preventDefault();
        Swal.fire({
            title: 'Logout?',
            text: 'Apakah Anda yakin ingin keluar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, logout',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('sidebar-logout-form').submit();
            }
        });
    }
});

// Close sidebar when clicking outside on mobile
document.addEventListener('click', function(e) {
    const sidebar = document.querySelector('.sidebar');
    const toggleBtn = document.querySelector('[@click="sidebarOpen = !sidebarOpen"]');
    
    if (window.innerWidth < 768 && sidebar && toggleBtn) {
        if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target) && sidebar.classList.contains('open')) {
            Alpine.$data(sidebar).sidebarOpen = false;
        }
    }
});
</script>

<style>
@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
    }
    .sidebar.open {
        transform: translateX(0);
    }
}

@media (max-width: 640px) {
    .sidebar {
        width: 260px !important;
    }
    .sidebar-text {
        font-size: 0.875rem;
    }
}
</style>