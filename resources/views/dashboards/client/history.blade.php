<x-app-layout>
    <x-slot name="header">
        @section('title', 'History Tiket')
        <h2 class="text-xl font-semibold text-gray-800">
            {{ __('History Tiket') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($tickets->isEmpty())
                    <p class="text-gray-500 text-center py-6">Belum ada tiket yang dibuat.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">#</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Judul</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Proyek</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Status</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Prioritas</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Tanggal</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td class="px-4 py-2 text-sm text-gray-700">
                                            {{ ($tickets->currentPage() - 1) * $tickets->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-800 font-medium">
                                            <a href="{{ route('client.tickets.show', $ticket->ticket_number) }}" class="text-blue-600 hover:underline">
                                                {{ $ticket->title }}
                                            </a>
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-600">
                                            {{ $ticket->project->name ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            <span class="px-2 py-1 text-xs rounded-full 
                                                @if($ticket->status === 'Open') bg-blue-100 text-blue-700
                                                @elseif($ticket->status === 'In Progress') bg-yellow-100 text-yellow-700
                                                @elseif($ticket->status === 'Resolved') bg-green-100 text-green-700
                                                @else bg-gray-100 text-gray-700 @endif">
                                                {{ $ticket->status ?? 'Unknown' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2">
                                            <span class="px-2 py-1 text-xs rounded-full
                                                @if($ticket->priority === 'High') bg-red-100 text-red-700
                                                @elseif($ticket->priority === 'Medium') bg-yellow-100 text-yellow-700
                                                @elseif($ticket->priority === 'Low') bg-green-100 text-green-700
                                                @else bg-gray-100 text-gray-700 @endif">
                                                {{ $ticket->priority ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-500">
                                            {{ $ticket->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-4 py-2 text-sm">
                                            <a href="{{ route('client.tickets.show', $ticket->ticket_number) }}" class="text-blue-600 hover:underline">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $tickets->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
