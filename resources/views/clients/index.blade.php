<x-app-layout>
    <x-slot name="header">
        @section('title', 'Client Management')
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Client Management') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto ">
            <!-- Search and Filter Bar -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
                <form method="GET" action="{{ route('clients.index') }}" class="w-full sm:w-auto">
                    <div class="flex flex-col sm:flex-row gap-2">
                        <!-- Search Input -->
                        <div class="relative flex-grow">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                name="search" 
                                placeholder="Search clients..." 
                                value="{{ request('search') }}"
                                class="block w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            >
                        </div>
                        
                        <!-- Status Filter -->
                        <div class="flex-shrink-0">
                            <select 
                                name="filter"
                                class="block w-full px-3 py-2 pr-8 border border-gray-300 rounded-lg text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white"
                                onchange="this.form.submit()"
                            >
                                <option value="">All Status</option>
                                <option value="Active" {{ request('filter') === 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ request('filter') === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        
                        <!-- Clear Filters -->
                        @if(request('search') || request('filter'))
                        <div class="flex-shrink-0">
                            <a 
                                href="{{ route('clients.index') }}" 
                                class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                                <svg class="h-4 w-4 mr-1.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Clear
                            </a>
                        </div>
                        @endif
                    </div>
                </form>
                
                <!-- Add Client Button -->
                <div class="w-full sm:w-auto">
                    <a 
                        href="{{ route('clients.create') }}" 
                        class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Add Client
                    </a>
                </div>
            </div>

            <!-- Clients Table -->
            <div class="bg-white shadow rounded-lg overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Contact</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Address</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Created</th>
                                <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($clients as $client)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($client->picture)
                                        <div class="flex-shrink-0 h-8 w-8">
                                            <img class="h-8 w-8 rounded-full object-cover" src="{{ asset('storage/'.$client->picture) }}" alt="{{ $client->username }}">
                                        </div>
                                        @else
                                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                            <span class="text-blue-600 text-xs font-medium">{{ substr($client->username, 0, 1) }}</span>
                                        </div>
                                        @endif
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">{{ $client->username }}</div>
                                            <div class="text-xs text-gray-500 sm:hidden">{{ $client->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap hidden sm:table-cell">
                                    <div class="text-sm text-gray-900">{{ $client->full_name }}</div>
                                    <div class="text-xs text-gray-500">{{ $client->email }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell truncate max-w-[160px]">
                                    {{ $client->alamat }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <form action="{{ route('clients.toggle-status', $client) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-2 py-1 text-xs rounded-full font-medium 
                                            {{ $client->status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $client->status }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $client->nohp }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 hidden lg:table-cell">
                                    {{ $client->created_at->format('d M Y') }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('clients.show', $client->id) }}" class="text-blue-600 hover:text-blue-900 p-1" title="View">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('clients.edit', $client->id) }}" class="text-indigo-600 hover:text-indigo-900 p-1" title="Edit">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="text-red-600 hover:text-red-900 p-1 btn-delete" title="Delete" data-id="{{ $client->id }}">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-4 py-4 text-center text-sm text-gray-500">
                                    No clients found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $clients->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                const form = this.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
    </script>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#3085d6',
                });
            });
        </script>
    @endif
</x-app-layout>