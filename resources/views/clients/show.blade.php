<x-app-layout>
    <x-slot name="header">
        @section('title', 'show_client')
        <h2 class="text-lg font-semibold text-gray-800 leading-tight">
            {{ __('Client Details') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto">
            <div class="bg-white shadow rounded-lg border border-gray-200">
                <!-- Header Section -->
                <div class="px-4 py-3 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            @if($client->picture)
                                <img src="{{ asset('storage/'.$client->picture) }}" alt="Client Picture" class="h-10 w-10 rounded-full object-cover">
                            @else
                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <h3 class="text-md font-medium text-gray-900">
                                    {{ $client->full_name }}
                                </h3>
                                <span class="mt-1 inline-flex px-2 text-xs leading-4 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $client->username }}
                                </span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('clients.edit', $client->id) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Delete" onclick="return confirm('Delete this client?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="px-4 py-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-4">
                            <!-- Account Information -->
                            <div>
                                <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">Account Information</h4>
                                <div class="bg-gray-50 rounded-md p-3 space-y-2">
                                    <div class="flex">
                                        <span class="text-sm font-medium text-gray-500 w-32">Username</span>
                                        <span class="text-sm">{{ $client->username }}</span>
                                    </div>
                                    <div class="flex">
                                        <span class="text-sm font-medium text-gray-500 w-32">Email</span>
                                        <span class="text-sm">{{ $client->email }}</span>
                                    </div>
                                    <div class="flex">
                                        <span class="text-sm font-medium text-gray-500 w-32">Full Name</span>
                                        <span class="text-sm">{{ $client->full_name }}</span>
                                    </div>
                                    <div class="flex">
                                        <span class="text-sm font-medium text-gray-500 w-32">Phone Number</span>
                                        <span class="text-sm">{{ $client->nohp ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Address -->
                            @if($client->alamat)
                            <div>
                                <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">Address</h4>
                                <div class="bg-gray-50 rounded-md p-3">
                                    <p class="text-sm">{{ $client->alamat }}</p>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-4">
                            <!-- Logo -->
                            @if($client->logo)
                            <div>
                                <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">Logo</h4>
                                <div class="bg-gray-50 rounded-md p-3 flex justify-center">
                                    <img src="{{ asset('storage/'.$client->logo) }}" alt="Client Logo" class="h-32 object-contain">
                                </div>
                            </div>
                            @endif

                            <!-- Activity -->
                            <div>
                                <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">Activity</h4>
                                <div class="bg-gray-50 rounded-md p-3 space-y-2">
                                    <div class="flex">
                                        <span class="text-sm font-medium text-gray-500 w-32">Last Login</span>
                                        <span class="text-sm">
                                            {{ $client->last_login ? $client->last_login->format('M d, Y H:i') : 'Never' }}
                                        </span>
                                    </div>
                                    <div class="flex">
                                        <span class="text-sm font-medium text-gray-500 w-32">Created At</span>
                                        <span class="text-sm">
                                            {{ $client->created_at->format('M d, Y H:i') }}
                                        </span>
                                    </div>
                                    <div class="flex">
                                        <span class="text-sm font-medium text-gray-500 w-32">Updated At</span>
                                        <span class="text-sm">
                                            {{ $client->updated_at->format('M d, Y H:i') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Section -->
                    <div class="mt-6">
                        <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">Status</h4>
                        <div class="bg-gray-50 p-3 rounded-md">
                            @if($client->last_login && $client->last_login->diffInDays(now()) < 30)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Active (Recent login)
                                </span>
                            @elseif($client->last_login)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <svg class="mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Inactive ({{ $client->last_login->diffForHumans() }})
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                    <svg class="mr-1.5 h-2 w-2 text-gray-400" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Never logged in
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Footer Section -->
                <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                    <a href="{{ route('clients.index') }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 -ml-0.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Clients
                    </a>
                    <div class="text-xs text-gray-500">
                        Client ID: {{ $client->id }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>