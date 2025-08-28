<x-app-layout>
    <x-slot name="header">
        @section('title', 'Project & Tickets')
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Daftar Project & Tiket
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto ">
            @forelse ($projects as $project)
                <div class="mb-8 bg-white p-6 rounded-lg shadow border border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">
                        {{ $project->name }}
                    </h3>

                    @if ($project->tickets->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 border">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Priority</th>
                                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($project->tickets as $ticket)
                                        <tr>
                                            <td class="px-4 py-2 text-sm text-gray-900">{{ $loop->iteration }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-900">{{ $ticket->title }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-900">{{ $ticket->name }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-900">{{ $ticket->status }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-900">{{ $ticket->priority }}</td>
                                            <td class="px-4 py-2 text-sm text-right">
                                                <a href="{{ route('tickets.show', $ticket) }}"
                                                    class="text-blue-600 hover:text-blue-900 p-1">
                                                    Detail
                                                </a> 
                                                <form action="{{ route('tickets.destroy', ['ticket' => $ticket->id, 'from' => 'project']) }}" 
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 p-1 delete-confirm">Hapus</button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-sm text-gray-500">Belum ada tiket untuk project ini.</p>
                    @endif
                </div>
            @empty
                <p class="text-center text-gray-500">Belum ada project yang tersedia.</p>
            @endforelse
        </div>
    </div>
    <script>
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