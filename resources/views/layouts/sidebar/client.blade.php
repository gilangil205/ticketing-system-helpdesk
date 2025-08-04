<!-- Sidebar -->
<div class="sidebar bg-[#2C52CB] shadow-sm fixed h-full flex flex-col" style="width: 250px;">
    <!-- Main Menu Items with Scroll -->
    <div class="flex-1 overflow-y-auto">
       <nav class="mt-2 space-y-1">
            <!-- Dashboard Link -->
            <a href="{{ route('dashboard') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 {{ request()->routeIs('dashboard') ? 'text-gray-900' : 'text-white' }}">
                <div class="flex items-center w-full px-3 py-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-gray-200 border-l-4 border-blue-500' : 'hover:bg-gray-400 hover:bg-opacity-50 hover:text-gray-900' }} transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-gray-700' : 'text-white' }}" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                        <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                    </svg>
                    Home
                </div>
            </a>

            <!-- Tickets -->
            <a href="{{ route('client.tickets.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 {{ request()->routeIs('client.tickets.index') ? 'text-gray-900' : 'text-white' }}">
                <div class="flex items-center w-full px-3 py-2 rounded-lg {{ request()->routeIs('client.tickets.index') ? 'bg-gray-200 border-l-4 border-blue-500' : 'hover:bg-gray-400 hover:bg-opacity-50 hover:text-gray-900' }} transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('client.tickets.index') ? 'text-gray-700' : 'text-white' }}" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M1.5 6.375c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v3.026a.75.75 0 01-.375.65 2.249 2.249 0 000 3.898.75.75 0 01.375.65v3.026c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 17.625v-3.026a.75.75 0 01.374-.65 2.249 2.249 0 000-3.898.75.75 0 01-.374-.65V6.375zm15-1.125a.75.75 0 01.75.75v.75a.75.75 0 01-1.5 0V6a.75.75 0 01.75-.75zm.75 4.5a.75.75 0 00-1.5 0v.75a.75.75 0 001.5 0v-.75zm-.75 3a.75.75 0 01.75.75v.75a.75.75 0 01-1.5 0v-.75a.75.75 0 01.75-.75zm.75 4.5a.75.75 0 00-1.5 0V18a.75.75 0 001.5 0v-.75zM6 12a.75.75 0 01.75-.75H12a.75.75 0 010 1.5H6.75A.75.75 0 016 12zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z" clip-rule="evenodd" />
                    </svg>
                   Open New Tickets
                </div>
            </a>

            <!-- Tickets -->
            <a href="{{ route('client.history.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 {{ request()->routeIs('client.history.index') ? 'text-gray-900' : 'text-white' }}">
                <div class="flex items-center w-full px-3 py-2 rounded-lg {{ request()->routeIs('client.history.index') ? 'bg-gray-200 border-l-4 border-blue-500' : 'hover:bg-gray-400 hover:bg-opacity-50 hover:text-gray-900' }} transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('client.history.index') ? 'text-gray-700' : 'text-white' }}" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M1.5 6.375c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v3.026a.75.75 0 01-.375.65 2.249 2.249 0 000 3.898.75.75 0 01.375.65v3.026c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 17.625v-3.026a.75.75 0 01.374-.65 2.249 2.249 0 000-3.898.75.75 0 01-.374-.65V6.375zm15-1.125a.75.75 0 01.75.75v.75a.75.75 0 01-1.5 0V6a.75.75 0 01.75-.75zm.75 4.5a.75.75 0 00-1.5 0v.75a.75.75 0 001.5 0v-.75zm-.75 3a.75.75 0 01.75.75v.75a.75.75 0 01-1.5 0v-.75a.75.75 0 01.75-.75zm.75 4.5a.75.75 0 00-1.5 0V18a.75.75 0 001.5 0v-.75zM6 12a.75.75 0 01.75-.75H12a.75.75 0 010 1.5H6.75A.75.75 0 016 12zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z" clip-rule="evenodd" />
                    </svg>
                   History Tickets
                </div>
            </a>

        </nav>
    </div>

    <!-- Logout Button -->
    <div class="p-4 border-t border-gray-200 bg-[#2C52CB] sticky bottom-0">
        <form method="POST" action="{{ route('logout') }}" class="w-full" id="logout-form">
            @csrf
            <button type="button" id="logout-btn" class="group flex items-center w-full">
                <div class="flex items-center w-full px-3 py-2 text-sm font-medium text-white rounded-lg group-hover:bg-gray-400 group-hover:bg-opacity-50 group-hover:text-gray-900 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm10.72 4.72a.75.75 0 011.06 0l3 3a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H9a.75.75 0 010-1.5h10.94l-1.72-1.72a.75.75 0 010-1.06z" clip-rule="evenodd" />
                    </svg>
                    Logout
                </div>
            </button>
        </form>
    </div>
</div>