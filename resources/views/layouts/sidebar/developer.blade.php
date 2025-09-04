<!-- Sidebar Developer -->
<div class="sidebar bg-gradient-to-b from-green-800 to-green-900 shadow-xl fixed h-full flex flex-col" style="width: 280px; z-index: 40;">
    <!-- Logo Area -->
    <div class="p-5 border-b border-green-700 flex items-center">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0D8ABC&color=fff" alt="User profile">
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-white">{{ Auth::user()->full_name }}</p>
                <p class="text-xs font-medium text-green-200">{{ Auth::user()->role }}</p>
            </div>
        </div>
    </div>

    <!-- Main Menu Items with Scroll -->
    <div class="flex-1 overflow-y-auto pt-4">
        <nav class="mt-2 space-y-2 px-3">
            <!-- Dashboard Link -->
            <a href="{{ route('dashboard') }}" 
               class="group menu-item flex items-center px-4 py-3 text-base font-medium rounded-lg {{ request()->routeIs('dashboard') ? 'text-white bg-green-700 shadow' : 'text-green-100' }}">
                <div class="flex items-center w-full transition-colors duration-200">
                    <i class="fas fa-home w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-green-300' }}"></i>
                    <span class="font-semibold">Dashboard</span>
                    @if(request()->routeIs('dashboard')) 
                    <span class="ml-auto w-2 h-2 bg-green-300 rounded-full"></span>
                    @endif
                </div>
            </a>

            <!-- Manage Tickets -->
            <a href="{{ route('developer.tickets.index') }}" 
               class="group menu-item flex items-center px-4 py-3 text-base font-medium rounded-lg {{ request()->routeIs('developer.tickets.index') ? 'text-white bg-green-700 shadow' : 'text-green-100' }}">
                <div class="flex items-center w-full transition-colors duration-200">
                    <i class="fas fa-ticket-alt w-5 h-5 mr-3 {{ request()->routeIs('developer.tickets.index') ? 'text-white' : 'text-green-300' }}"></i>
                    <span class="font-semibold">Manage Tickets</span>
                    @if(request()->routeIs('developer.tickets.index')) 
                    <span class="ml-auto w-2 h-2 bg-green-300 rounded-full"></span>
                    @endif
                </div>
            </a>
        </nav>
    </div>

    <!-- User Profile & Logout -->
    <div class="p-4 border-t border-green-700 sticky bottom-0 bg-green-800">
        <form method="POST" action="{{ route('logout') }}" class="w-full" id="logout-form">
            @csrf
            <button type="button" id="logout-btn" class="group flex items-center w-full p-2 text-sm font-medium text-green-200 hover:text-white rounded-lg transition-colors duration-200">
                <i class="fas fa-sign-out-alt w-4 h-4 mr-2"></i>
                Logout
            </button>
        </form>
    </div>
</div>
