<x-app-layout>
    <x-slot name="header">
        @section('title', 'Clients Management')
        <h2 class="text-lg font-semibold text-gray-800 leading-tight">
            {{ __('Client Management') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-3 gap-2">
                <form method="GET" action="{{ route('clients.index') }}" class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-2 w-full sm:w-auto">
                    <div class="relative w-full sm:w-48">
                        <input type="text" name="search" placeholder="Search clients..." 
                               value="{{ request('search') }}"
                               class="border border-gray-300 rounded-lg pl-8 pr-3 py-1.5 text-sm w-full focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <select name="filter" class="border border-gray-300 rounded-lg pr-8  px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 w-full sm:w-auto bg-white"
                            onchange="this.form.submit()">
                        <option value="">All Status</option>
                        <option value="Active" {{ request('filter') === 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ request('filter') === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    
                    @if(request('search') || request('filter'))
                    <a href="{{ route('clients.index') }}" class="text-sm text-gray-500 hover:text-gray-700 flex items-center">
                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Clear
                    </a>
                    @endif
                </form>
                
                <a href="{{ route('clients.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg flex items-center text-sm w-full sm:w-auto justify-center transition duration-150 ease-in-out">
                    <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Add Client
                </a>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden border border-gray-200">
                <div class="overflow-x-auto w-full">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Contact</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Address</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Created</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($clients as $client)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($client->picture)
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/'.$client->picture) }}" alt="{{ $client->username }}">
                                        </div>
                                        @else
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <span class="text-blue-600 text-sm font-medium">{{ substr($client->username, 0, 1) }}</span>
                                        </div>
                                        @endif
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $client->username }}</div>
                                            <div class="text-xs text-gray-500 sm:hidden">{{ $client->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 hidden sm:table-cell">
                                    <div class="text-sm text-gray-900">{{ $client->full_name }}</div>
                                    <div class="text-xs text-gray-500">{{ $client->email }}</div>
                                </td>
                                <td class="px-4 py-4 hidden md:table-cell text-sm text-gray-500">
                                    {{ $client->alamat }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <form action="{{ route('clients.toggle-status', $client) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $client->status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $client->status }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $client->nohp }}
                                </td>
                                <td class="px-4 py-4 hidden lg:table-cell text-sm text-gray-500">
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
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
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