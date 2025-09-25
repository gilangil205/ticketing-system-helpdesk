<x-app-layout>
    <x-slot name="header">
        @section('title', 'Dashboard')
        <h2 class="text-xl font-semibold text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4 px-2 sm:px-4">
        <div class="mx-auto max-w-7xl">
            <h1 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6 px-2">Welcome to IT Support Center, {{ Auth::user()->full_name }}</h1>

            <!-- Ticket Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8 px-2">
                <!-- Open Ticket Card -->
                <div class="bg-white p-4 sm:p-6 rounded-lg shadow">
                    <h3 class="text-base sm:text-lg font-semibold mb-2">Open Ticket</h3>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl sm:text-3xl font-bold">{{ $openTickets }}</span>
                        <a href="{{ route('client.tickets.history') }}" class="text-blue-600 hover:text-blue-800 text-sm sm:text-base">Show more &gt;</a>
                    </div>
                </div>

                <!-- Closed Ticket Card -->
                <div class="bg-white p-4 sm:p-6 rounded-lg shadow">
                    <h3 class="text-base sm:text-lg font-semibold mb-2">Closed Ticket</h3>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl sm:text-3xl font-bold">{{ $closedTickets }}</span>
                        <a href="{{ route('client.tickets.history') }}" class="text-blue-600 hover:text-blue-800 text-sm sm:text-base">Show more &gt;</a>
                    </div>
                </div>

                <!-- Total Ticket Card -->
                <div class="bg-white p-4 sm:p-6 rounded-lg shadow">
                    <h3 class="text-base sm:text-lg font-semibold mb-2">Total Ticket</h3>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl sm:text-3xl font-bold">{{ $totalTickets }}</span>
                        <a href="{{ route('client.tickets.history') }}" class="text-blue-600 hover:text-blue-800 text-sm sm:text-base">Show more &gt;</a>
                    </div>
                </div>
            </div>

            <!-- History Ticket Table -->
            <div class="bg-white p-4 sm:p-6 rounded-lg shadow mx-2 sm:mx-0">
                <h2 class="text-lg sm:text-xl font-semibold mb-4">History Ticket</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Ticket</th>
                                <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Email</th>
                                <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Topic</th>
                                <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($tickets as $ticket)
                                <tr>
                                    <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                                    <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500">#{{ $ticket->ticket_number }}</td>
                                    <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">{{ $ticket->email }}</td>
                                    <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ Str::limit($ticket->topic, 20) }}</td>
                                    <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($ticket->status === 'Open') bg-blue-100 text-blue-700
                                            @elseif($ticket->status === 'In Progress') bg-yellow-100 text-yellow-800
                                            @elseif($ticket->status === 'Closed') bg-green-100 text-green-700
                                            @else bg-gray-100 text-gray-700 @endif">
                                            {{ $ticket->status }}
                                        </span>
                                    </td>
                                    <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="{{ route('client.tickets.show', $ticket->ticket_number) }}" class="text-blue-600 hover:underline">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-gray-500 py-4">Belum ada tiket</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>