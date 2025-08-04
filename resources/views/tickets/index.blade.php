<x-app-layout>
    <x-slot name="header">
        @section('title', 'Ticket Management')
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Ticket Management</h2>
            <div class="flex space-x-2">
                <x-primary-button>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    New Ticket
                </x-primary-button>
                <x-secondary-button>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    Export
                </x-secondary-button>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto">
            <!-- Filters -->
            <div class="bg-white rounded-lg shadow-sm mb-6 p-4">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div class="relative w-full md:w-64">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Search tickets...">
                    </div>
                    
                    <div class="flex flex-wrap gap-3">
                        <select class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            <option>All Topics</option>
                            <option>Technical Support</option>
                            <option>Billing</option>
                            <option>Account</option>
                        </select>
                        
                        <select class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            <option>All Status</option>
                            <option>Open</option>
                            <option>Pending</option>
                            <option>Resolved</option>
                        </select>
                        
                        <select class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            <option>Sort by: Newest</option>
                            <option>Sort by: Oldest</option>
                            <option>Sort by: Priority</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Tickets Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Topic</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requester</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($tickets as $ticket)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2m5-5a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $ticket->title }}</div>
                                            <div class="text-sm text-gray-500">#{{ $ticket->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $ticket->topic === 'Technical' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $ticket->topic === 'Billing' ? 'bg-purple-100 text-purple-800' : '' }}
                                        {{ $ticket->topic === 'Account' ? 'bg-green-100 text-green-800' : '' }}">
                                        {{ $ticket->topic }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $ticket->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $ticket->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $ticket->status === 'Open' ? 'bg-red-100 text-red-800' : '' }}
                                        {{ $ticket->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $ticket->status === 'Resolved' ? 'bg-green-100 text-green-800' : '' }}">
                                        {{ $ticket->status ?? 'Open' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $ticket->created_at->format('d M Y') }}<br>
                                    <span class="text-gray-400">{{ $ticket->created_at->format('H:i') }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                    {{-- Tombol Lihat --}}
                                    <a href="{{ route('tickets.show', $ticket->id) }}" 
                                    class="text-gray-600 hover:text-blue-600" 
                                    title="Lihat Tiket">
                                        <svg xmlns="http://www.w3.org/2000/svg" 
                                            class="h-5 w-5" viewBox="0 0 20 20" 
                                            fill="currentColor">
                                            <path fill-rule="evenodd" 
                                                d="M10 2C5 2 1.73 7.11 1.05 8.17a1 1 0 000 .66C1.73 10.89 5 16 10 16s8.27-5.11 8.95-6.17a1 1 0 000-.66C18.27 7.11 15 2 10 2zM10 14c-2.64 0-4.77-2.49-5.73-4C5.23 8.49 7.36 6 10 6s4.77 2.49 5.73 4c-.96 1.51-3.09 4-5.73 4zM10 8a2 2 0 100 4 2 2 0 000-4z" 
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tiket ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-800" 
                                                title="Hapus Tiket">
                                            <svg xmlns="http://www.w3.org/2000/svg" 
                                                class="h-5 w-5" viewBox="0 0 20 20" 
                                                fill="currentColor">
                                                <path fill-rule="evenodd" 
                                                    d="M6 2a1 1 0 00-1 1v1H3a1 1 0 000 2h.293l.854 12.708A2 2 0 006.142 20h7.716a2 2 0 001.995-1.292L16.707 6H17a1 1 0 000-2h-2V3a1 1 0 00-1-1H6zm2 4a1 1 0 112 0v9a1 1 0 11-2 0V6zm4 0a1 1 0 112 0v9a1 1 0 11-2 0V6z" 
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing
                                <span class="font-medium">1</span>
                                to
                                <span class="font-medium">10</span>
                                of
                                <span class="font-medium">20</span>
                                results
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Previous</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="#" aria-current="page" class="z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                    1
                                </a>
                                <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                    2
                                </a>
                                <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                    3
                                </a>
                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Next</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>