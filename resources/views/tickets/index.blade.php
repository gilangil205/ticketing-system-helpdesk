<x-app-layout>
    <x-slot name="header">
        @section('title', 'Ticket Management')
    </x-slot>

    <div class="py-4">
        <div class="mx-auto">
            <!-- Filters -->
            <div class="bg-white rounded-lg shadow-sm mb-4 p-4 border border-gray-200">
                <div class="flex flex-col md:flex-row gap-4 items-start md:items-center">
                    <div class="relative w-full md:w-64">
                        <form method="GET" action="{{ route('tickets.index') }}" class="w-full">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}"
                                       class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="Search tickets...">
                            </div>
                        </form>
                    </div>

                    <div class="flex flex-wrap gap-2 w-full md:w-auto">
                        <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            <option>All Topics</option>
                            <option>Technical Support</option>
                            <option>Billing</option>
                            <option>Account</option>
                        </select>

                        <form method="GET" action="{{ route('tickets.index') }}" class="w-full sm:w-auto">
                            <select name="status" onchange="this.form.submit()"
                                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">All Status</option>
                                <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Wait in Progress" {{ request('status') == 'Wait in Progress' ? 'selected' : '' }}>Wait in Progress</option>
                                <option value="Pass Test" {{ request('status') == 'Pass Test' ? 'selected' : '' }}>Pass Test</option>
                                <option value="Closed" {{ request('status') == 'Closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </form>

                        <form method="GET" action="{{ route('tickets.index') }}" class="w-full sm:w-auto">
                            <select name="priority" onchange="this.form.submit()"
                                    class="border border-gray-300 pr-8 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">All Priorities</option>
                                <option value="Low" {{ request('priority') == 'Low' ? 'selected' : '' }}>Low</option>
                                <option value="Medium" {{ request('priority') == 'Medium' ? 'selected' : '' }}>Medium</option>
                                <option value="High" {{ request('priority') == 'High' ? 'selected' : '' }}>High</option>
                                <option value="Critical" {{ request('priority') == 'Critical' ? 'selected' : '' }}>Critical</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tickets Table -->
            <div class="bg-white shadow rounded-lg overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <div class="inline-block min-w-full align-middle">
                        <table class="min-w-full divide-y divide-gray-200">
                            <colgroup>
                                <col style="width: 22%">
                                <col style="width: 12%">
                                <col style="width: 14%">
                                <col style="width: 10%">
                                <col style="width: 12%">
                                <col style="width: 18%">
                                <col style="width: 12%">
                            </colgroup>
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requester</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Topic</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Ticket #</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <!-- Kolom baru: Assigned To -->
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned To</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($tickets as $ticket)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 bg-indigo-100 rounded-full flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2m5-5a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm text-gray-900 truncate">{{ $ticket->name }}</div>
                                                <div class="text-xs text-gray-500 truncate">{{ $ticket->email }}</div>
                                                <div class="text-xs text-gray-500 sm:hidden">#{{ $ticket->id }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-4 py-4 hidden sm:table-cell">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $ticket->topic === 'Technical' ? 'bg-blue-100 text-blue-800' : '' }}
                                            {{ $ticket->topic === 'Billing' ? 'bg-purple-100 text-purple-800' : '' }}
                                            {{ $ticket->topic === 'Account' ? 'bg-green-100 text-green-800' : '' }}">
                                            {{ $ticket->topic }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4 hidden md:table-cell">
                                        <div class="text-sm font-semibold text-gray-900 truncate">{{ $ticket->ticket_number ?? '-' }}</div>
                                    </td>

                                    <td class="px-4 py-4">
                                        <form action="{{ route('tickets.update', $ticket->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <select name="priority" onchange="this.form.submit()"
                                                    class="text-xs border border-gray-300 rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500
                                                        {{ $ticket->priority === 'Low' ? 'bg-gray-100 text-gray-800' : '' }}
                                                        {{ $ticket->priority === 'Medium' ? 'bg-blue-100 text-blue-800' : '' }}
                                                        {{ $ticket->priority === 'High' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                        {{ $ticket->priority === 'Critical' ? 'bg-red-100 text-red-800' : '' }}">
                                                <option value="Low" {{ $ticket->priority === 'Low' ? 'selected' : '' }}>Low</option>
                                                <option value="Medium" {{ $ticket->priority === 'Medium' ? 'selected' : '' }}>Medium</option>
                                                <option value="High" {{ $ticket->priority === 'High' ? 'selected' : '' }}>High</option>
                                                <option value="Critical" {{ $ticket->priority === 'Critical' ? 'selected' : '' }}>Critical</option>
                                            </select>
                                        </form>
                                    </td>

                                    <td class="px-4 py-4">
                                        <form action="{{ route('tickets.update', $ticket->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" onchange="this.form.submit()"
                                                    class="text-xs border border-gray-300 rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                                <option value="Open" {{ $ticket->status === 'Open' ? 'selected' : '' }}>Open</option>
                                                <option value="In Progress" {{ $ticket->status === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="Wait in Progress" {{ $ticket->status === 'Wait in Progress' ? 'selected' : '' }}>Wait</option>
                                                <option value="Pass Test" {{ $ticket->status === 'Pass Test' ? 'selected' : '' }}>Pass Test</option>
                                                <option value="Closed" {{ $ticket->status === 'Closed' ? 'selected' : '' }}>Closed</option>
                                            </select>
                                        </form>
                                    </td>

                                    <!-- Assigned To -->
                                    <td class="px-4 py-4">
                                        @if($ticket->developer)
                                            <div class="text-sm text-gray-900">{{ $ticket->developer->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $ticket->developer->email }}</div>
                                        @else
                                            <span class="text-xs text-gray-400 italic">Unassigned</span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-4 text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('tickets.show', $ticket) }}" class="text-blue-600 hover:text-blue-900 p-1" title="View">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>

                                            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="text-red-600 hover:text-red-900 p-1 delete-confirm" title="Delete">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>

                        <!-- Dropdown Action (khusus Move To, tidak mengubah status) -->
                        <button 
            onclick="openMoveModal('{{ $ticket->ticket_number }}')" 
            class="px-2 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700">
            Send to
        </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $tickets->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Move To Modal -->
    <div id="moveModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <h2 class="text-lg font-semibold mb-4">Move Ticket</h2>
            <form id="moveForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Developer</label>
                    <select name="developer_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">-- Select Developer --</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }} ({{ $employee->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeMoveModal()" class="px-4 py-2 bg-gray-300 rounded-lg">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Send</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function handleAction(select, ticketNumber) {
        if (select.value === "move") {
            const form = document.getElementById('moveForm');
            // gunakan route key ticket_number (karena getRouteKeyName() = 'ticket_number')
            form.action = `/tickets/${ticketNumber}/move`;
            document.getElementById('moveModal').classList.remove('hidden');
            select.value = "";
        }
    }

    function openMoveModal(ticketNumber) {
    const form = document.getElementById('moveForm');
    // route pakai ticket_number
    form.action = `/tickets/${ticketNumber}/move`;
    document.getElementById('moveModal').classList.remove('hidden');
}


    function closeMoveModal() {
        document.getElementById('moveModal').classList.add('hidden');
    }

    // Konfirmasi hapus
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-confirm');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
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

<style>
@media screen and (max-width: 768px) {
    table { font-size: 0.875rem; }
    td, th { padding: 0.5rem; }
}
</style>
