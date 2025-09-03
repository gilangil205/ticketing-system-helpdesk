<x-app-layout>
    <x-slot name="header">
        @section('title', 'My Assigned Tickets')
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('My Assigned Tickets') }}
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            View and manage tickets assigned to you.
        </p>
    </x-slot>

    <div class="py-8">
        <div class=" mx-auto">
            <div class="bg-white shadow rounded-2xl p-6">
                
                <!-- Filters / Search -->
                <div class="flex flex-col sm:flex-row justify-between gap-4 mb-6">
                    <form method="GET" class="flex flex-wrap gap-2">
                        <input type="text" name="search" placeholder="Search tickets..."
                               value="{{ request('search') }}"
                               class="border border-gray-300 focus:ring-2 focus:ring-blue-400 rounded-lg px-4 py-2 text-sm w-64">
                        <select name="status" class="border border-gray-300 focus:ring-2 focus:ring-blue-400 rounded-lg px-3 py-2 text-sm">
                            <option value="">All Status</option>
                            <option value="Open" {{ request('status')=='Open' ? 'selected' : '' }}>Open</option>
                            <option value="In Progress" {{ request('status')=='In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Resolved" {{ request('status')=='Resolved' ? 'selected' : '' }}>Resolved</option>
                            <option value="Closed" {{ request('status')=='Closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm shadow">
                            Filter
                        </button>
                    </form>
                </div>

                <!-- Tickets Table -->
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600">Ticket #</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600">Topic</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600">Status</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600">Created At</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($tickets as $ticket)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-3 font-medium text-gray-800">{{ $ticket->ticket_number }}</td>
                                    <td class="px-6 py-3">{{ $ticket->topic }}</td>
                                    <td class="px-6 py-3">
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                                            @if($ticket->status === 'Open') bg-green-100 text-green-700
                                            @elseif($ticket->status === 'In Progress') bg-yellow-100 text-yellow-700
                                            @elseif($ticket->status === 'Resolved') bg-blue-100 text-blue-700
                                            @else bg-gray-200 text-gray-700 @endif">
                                            {{ $ticket->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-3 text-gray-600">{{ $ticket->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-3">
                                       <a href="{{ route('tickets.show', $ticket) }}" class="text-blue-600 hover:text-blue-900 p-1" title="View">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-6 text-center text-gray-500 text-sm">
                                        No tickets assigned to you.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
