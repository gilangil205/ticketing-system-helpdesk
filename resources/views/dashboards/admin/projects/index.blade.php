<x-app-layout>
    <x-slot name="header">
        @section('title', 'Project Management')
    </x-slot>

    <script src="//unpkg.com/alpinejs" defer></script>

    <div class="py-4">
        <div class="mx-auto">

            <!-- Header -->
            <div class="flex justify-end mb-8" x-data="{ open: false }">
                <!-- Tombol Tambah Project -->
                <button 
                    class="inline-flex items-center px-4 py-2 rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    @click="open = true">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add Project
                </button>

                <!-- Modal -->
                <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
                    <div @click.away="open = false" class="bg-white rounded-lg shadow-lg w-full max-w-md">
                        <div class="flex justify-between items-center border-b px-6 py-4">
                            <h3 class="text-lg font-semibold text-gray-800">Tambah Project</h3>
                            <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form action="{{ route('projects.store') }}" method="POST" class="px-6 py-4">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Project</label>
                                <input type="text" name="name" id="name"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Masukkan nama project" required>
                            </div>

                            <div class="mb-4">
                                <label for="client_id" class="block text-sm font-medium text-gray-700 mb-1">Client (opsional)</label>
                                <select name="client_id" id="client_id"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">-- Pilih Client --</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex justify-end gap-3 border-t pt-4">
                                <button type="button" @click="open = false"
                                    class="px-4 py-2 text-sm border rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 text-sm rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabel Project per Client -->
            <div class="bg-white shadow rounded-lg border border-gray-200">
                <div class="px-4 py-3 border-b">
                    <h3 class="text-lg font-semibold text-gray-800">Daftar Project</h3>
                    <p class="text-sm text-gray-500">Semua project berdasarkan client</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Project</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @php $no = 1; @endphp
                            @forelse($clients as $client)
                                @php $clientProjects = $projects->where('client_id', $client->id); @endphp
                                @if($clientProjects->isEmpty())
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $no++ }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $client->full_name }}</td>
                                        <td colspan="2" class="px-6 py-4 text-sm text-gray-500 italic">Belum ada project</td>
                                    </tr>
                                @else
                                    @foreach($clientProjects as $project)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 text-sm text-gray-700">{{ $no++ }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-700">{{ $client->full_name }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-700">{{ $project->name }}</td>
                                            <td class="px-6 py-4 text-right text-sm">
                                                <div class="flex justify-end space-x-3">
                                                    <!-- Edit -->
                                                    <a href="#" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                        </svg>
                                                    </a>
                                                    <!-- Delete -->
                                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="text-red-600 hover:text-red-900 delete-project-confirm" title="Delete">
                                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-6 text-center text-sm text-gray-500">
                                        Belum ada client terdaftar
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- SweetAlert untuk Delete -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Hapus semua event lama sebelum bind ulang
        document.querySelectorAll('.delete-project-confirm').forEach(button => {
            button.replaceWith(button.cloneNode(true));
        });

        document.querySelectorAll('.delete-project-confirm').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const form = this.closest('form');
                Swal.fire({
                    title: 'Hapus Project?',
                    text: "Semua tiket di project ini juga akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
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
            title: 'Berhasil',
            text: "{{ session('success') }}",
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    });
    </script>
    @endif

</x-app-layout>
