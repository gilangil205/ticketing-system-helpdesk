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
           <a href="{{ route('tickets.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 {{ request()->routeIs('tickets.index') ? 'text-gray-900' : 'text-white' }}">
    <div class="flex items-center w-full px-3 py-2 rounded-lg {{ request()->routeIs('tickets.index') ? 'bg-gray-200 border-l-4 border-blue-500' : 'hover:bg-gray-400 hover:bg-opacity-50 hover:text-gray-900' }} transition-colors duration-200">
        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('tickets.index') ? 'text-gray-700' : 'text-white' }}" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M1.5 6.375c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v3.026a.75.75 0 01-.375.65 2.249 2.249 0 000 3.898.75.75 0 01.375.65v3.026c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 17.625v-3.026a.75.75 0 01.374-.65 2.249 2.249 0 000-3.898.75.75 0 01-.374-.65V6.375zm15-1.125a.75.75 0 01.75.75v.75a.75.75 0 01-1.5 0V6a.75.75 0 01.75-.75zm.75 4.5a.75.75 0 00-1.5 0v.75a.75.75 0 001.5 0v-.75zm-.75 3a.75.75 0 01.75.75v.75a.75.75 0 01-1.5 0v-.75a.75.75 0 01.75-.75zm.75 4.5a.75.75 0 00-1.5 0V18a.75.75 0 001.5 0v-.75zM6 12a.75.75 0 01.75-.75H12a.75.75 0 010 1.5H6.75A.75.75 0 016 12zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z" clip-rule="evenodd" />
        </svg>
        Manage Tickets
    </div>
</a>


            <!-- Clients -->
            <a href="{{ route('clients.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 {{ request()->routeIs('clients.*') ? 'text-gray-900' : 'text-white' }}">
                <div class="flex items-center w-full px-3 py-2 rounded-lg {{ request()->routeIs('clients.*') ? 'bg-gray-200 border-l-4 border-blue-500' : 'hover:bg-gray-400 hover:bg-opacity-50 hover:text-gray-900' }} transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('clients.*') ? 'text-gray-700' : 'text-white' }}" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z" clip-rule="evenodd" />
                        <path d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 013.57-4.047zM20.226 19.389a8.287 8.287 0 00-1.308-5.135 3.75 3.75 0 013.57 4.047l-.01.121a.563.563 0 01-.373.486l-.115.04c-.567.2-1.156.349-1.764.441z" />
                    </svg>
                    Manage Clients
                </div>
            </a>

            <!-- Employees -->
            <a href="{{ route('employees.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 {{ request()->routeIs('employees') ? 'text-gray-900' : 'text-white' }}">
                <div class="flex items-center w-full px-3 py-2 rounded-lg {{ request()->routeIs('employees') ? 'bg-gray-200 border-l-4 border-blue-500' : 'hover:bg-gray-400 hover:bg-opacity-50 hover:text-gray-900' }} transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('employees') ? 'text-gray-700' : 'text-white' }}" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z" clip-rule="evenodd" />
                    </svg>
                    Manage Employees
                </div>
            </a>

            <!-- Projects -->
         <a href="{{ route('projects') }}"
            class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 {{ request()->routeIs('projects.index') ? 'text-gray-900' : 'text-white' }}">
                <div class="flex items-center w-full px-3 py-2 rounded-lg 
                            {{ request()->routeIs('projects.index') 
                                ? 'bg-gray-200 border-l-4 border-blue-500' 
                                : 'hover:bg-gray-400 hover:bg-opacity-50 hover:text-gray-900' }} 
                            transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('projects.index') ? 'text-gray-700' : 'text-white' }}"
                        fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" 
                            d="M5.625 1.5H9a3.75 3.75 0 013.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 013.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 01-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875zM9.75 14.25a.75.75 0 000 1.5H15a.75.75 0 000-1.5H9.75z" 
                            clip-rule="evenodd" />
                        <path d="M14.25 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0016.5 7.5h-1.875a.375.375 0 01-.375-.375V5.25z" />
                    </svg>
                    Projects
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