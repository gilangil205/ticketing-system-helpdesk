<x-app-layout>
    <x-slot name="header">
        @section('title', 'Management Employees')
        <h2 class="text-lg font-semibold text-gray-800 leading-tight">
            {{ __('Management Employees') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-3 gap-2">
                <form method="GET" action="{{ route('employees.index') }}" class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-2 w-full sm:w-auto">
                    <div class="relative w-full sm:w-48">
                        <input type="text" name="search" placeholder="Search..." 
                               value="{{ request('search') }}"
                               class="border border-gray-300 rounded-lg pl-8 pr-3 py-1.5 text-sm w-full focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <select name="filter" class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 w-full sm:w-auto bg-white"
                            onchange="this.form.submit()">
                        <option value="">All Status</option>
                        <option value="Active" {{ request('filter') === 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ request('filter') === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="Project Manager" {{ request('filter') === 'Project Manager' ? 'selected' : '' }}>Project Manager</option>
                        <option value="Developer" {{ request('filter') === 'Developer' ? 'selected' : '' }}>Developer</option>
                        <option value="QA/Tester" {{ request('filter') === 'QA/Tester' ? 'selected' : '' }}>QA/Tester</option>
                    </select>
                    
                    @if(request('search') || request('filter'))
                    <a href="{{ route('employees.index') }}" class="text-sm text-gray-500 hover:text-gray-700 flex items-center">
                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Clear
                    </a>
                    @endif
                </form>
                
                <a href="{{ route('employees.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg flex items-center text-sm w-full sm:w-auto justify-center transition duration-150 ease-in-out">
                    <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Add Employee
                </a>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden border border-gray-200">
                <div class="overflow-x-auto w-full">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Username</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Details</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Contact</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($employees as $employee)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($employee->profile_photo)
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/'.$employee->profile_photo) }}" alt="{{ $employee->username }}">
                                        </div>
                                        @else
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        @endif
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $employee->name }}</div>
                                            <div class="text-xs text-gray-500 sm:hidden">{{ $employee->username }}</div>
                                            <div class="text-xs text-gray-500 sm:hidden">{{ $employee->role }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 hidden sm:table-cell">{{ $employee->username }}</td>
                                <td class="px-4 py-4 hidden md:table-cell">
                                    <div class="text-sm text-gray-900">{{ $employee->nik }}</div>
                                    <div class="text-xs text-gray-500">{{ $employee->role }}</div>
                                </td>
                                <td class="px-4 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $employee->status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $employee->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 hidden lg:table-cell text-sm text-gray-500">
                                    <div>{{ $employee->email }}</div>
                                    <div class="text-xs text-gray-500">{{ $employee->phone }}</div>
                                </td>
                                <td class="px-4 py-4 text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-3">
                                        <a href="{{ route('employees.edit', $employee->id) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="text-red-600 hover:text-red-900 delete-confirm" data-id="{{ $employee->id }}" title="Delete">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-sm text-gray-500">
                                    No employees found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $employees->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

 {{-- SweetAlert2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- SweetAlert2 Success Alert + Delete Confirmation --}}
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Konfirmasi delete
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


</x-app-layout>
