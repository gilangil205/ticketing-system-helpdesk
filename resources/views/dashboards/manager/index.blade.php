<x-app-layout>
    <x-slot name="header">
        @section('title', 'Dashboard Admin')
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto">
            <!-- Welcome Header -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900">
                    Welcome, {{ Auth::user()->full_name ?? Auth::user()->name ?? 'Guest' }}
                </h1>
            </div>

            <!-- Stat Cards Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
               @php
                    $cards = [
                        [
                            'title' => 'Total Tickets',
                            'value' => $totalTickets,
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V9.842c0-.538.214-1.055.595-1.437L20 7H15m-6 10H4l1.405-1.405A2.032 2.032 0 006 14.158V9.842c0-.538-.214-1.055-.595-1.437L4 7h5" />
                                    </svg>',
                            'color' => 'blue',
                            'trend' => $stats[0]['trend'],
                            'change' => $stats[0]['change'] ?? 'N/A'
                        ],
                        [
                            'title' => 'Open Tickets',
                            'value' => $openTickets,
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                    </svg>',
                            'color' => 'orange'
                        ],
                        [
                            'title' => 'Total Clients',
                            'value' => $clientCount ?? 10,
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M12 12a4 4 0 100-8 4 4 0 000 8z" />
                                    </svg>',
                            'color' => 'green'
                        ],
                        [
                            'title' => 'Total Employees',
                            'value' => $employeeCount ?? 5,
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>',
                            'color' => 'purple'
                        ],
                    ];
                    @endphp
                @foreach($cards as $card)
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden transition-all duration-200 hover:shadow-md">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-{{ $card['color'] }}-100 p-3 rounded-lg">
                                <div class="flex-shrink-0 bg-{{ $card['color'] }}-100 p-3 rounded-lg">
                                    {!! $card['icon'] !!}
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-sm font-medium text-gray-500">{{ $card['title'] }}</h3>
                                <p class="text-2xl font-semibold text-gray-900 mt-1">{{ $card['value'] }}</p>
                            </div>
                        </div>
                        @isset($card['trend'])
                        <div class="mt-3 text-sm {{ $card['trend'] == 'up' ? 'text-green-600' : ($card['trend'] == 'down' ? 'text-red-600' : 'text-gray-600') }}">
                            <span class="inline-flex items-center">
                                {{ $card['change'] }} from last month
                            </span>
                        </div>
                        @endisset
                    </div>
                </div>
                @endforeach

            </div>

            <!-- Side-by-Section Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Recent Tickets (2/3 width) -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden h-full">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                            <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                <svg class="h-6 w-6 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z"/>
                                </svg>
                                Recent Tickets
                            </h3>
                            <a href="{{ route('tickets.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 inline-flex items-center">
                                View all tickets
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Ticket #
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Topic
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Created
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($recentTickets as $ticket)
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                       <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                           <a href="{{ route('tickets.show', $ticket) }}" class="text-blue-600 hover:underline">
                                            {{ $ticket->ticket_number }}
                                        </a>
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-900 max-w-xs truncate">
                                           <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $ticket->topic === 'Technical' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $ticket->topic === 'Billing' ? 'bg-purple-100 text-purple-800' : '' }}
                                        {{ $ticket->topic === 'Account' ? 'bg-green-100 text-green-800' : '' }}">
                                        {{ $ticket->topic }}
                                    </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $ticket->created_at->format('M d, H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $statusClasses = [
                                                    'open' => 'bg-green-100 text-green-800',
                                                    'closed' => 'bg-gray-100 text-gray-800',
                                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                                    'resolved' => 'bg-blue-100 text-blue-800',
                                                ];
                                                $defaultClass = 'bg-gray-100 text-gray-800';
                                            @endphp
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusClasses[strtolower($ticket->status)] ?? $defaultClass }}">
                                                {{ $ticket->status }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="px-6 py-3 border-t border-gray-200 bg-gray-50 text-right">
                            <span class="text-sm text-gray-500">
                                Showing {{ count($recentTickets) }} of {{ $totalTickets }} tickets
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Ticket Status Overview (1/3 width) -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden h-full">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="h-5 w-5 text-purple-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Ticket Status Overview
                            </h3>
                        </div>
                        <div class="px-6 py-4">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-700">Open</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $openTickets }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-700">In Progress</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $inProgressTickets }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-700">Wait in Progress</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $waitInProgressTickets }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-700">Pass Test</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $passTestTickets }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-700">Resolved</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $resolvedTickets }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-700">Closed</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $closedTickets }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>