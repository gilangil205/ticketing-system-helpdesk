<x-app-layout>
    <x-slot name="header">
        @section('title', 'Add Client')
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Create New Client') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto">
            <!-- Elegant Header Card -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl shadow-lg overflow-hidden mb-6">
                <div class="p-6 flex items-center">
                    <div class="flex-shrink-0 mr-4 bg-white/20 p-3 rounded-full">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-white">Add New Client</h3>
                        <p class="mt-1 text-blue-100">Fill in the client details below to create a new account</p>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8 bg-white border-b border-gray-200">
                    @if($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">There were {{ $errors->count() }} errors with your submission</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('clients.store') }}" class="space-y-6" enctype="multipart/form-data">
                        @csrf

                        <!-- Account Information -->
                        <div class="border-b border-gray-200 pb-4">
                            <h3 class="text-lg font-medium text-gray-900">Account Information</h3>
                            <p class="mt-1 text-sm text-gray-500">Basic login credentials for the client</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Username -->
                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username <span class="text-red-500">*</span></label>
                                <input type="text" id="username" name="username" required value="{{ old('username') }}" 
                                       class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password <span class="text-red-500">*</span></label>
                                <input type="password" id="password" name="password" required
                                       class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <p class="mt-2 text-xs text-gray-500">Minimum 8 characters</p>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                <input type="email" id="email" name="email" required value="{{ old('email') }}"
                                       class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>

                            <!-- Password Confirmation -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password <span class="text-red-500">*</span></label>
                                <input type="password" id="password_confirmation" name="password_confirmation" required
                                       class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                        </div>

                        <!-- Client Details -->
                        <div class="border-b border-gray-200 pb-4">
                            <h3 class="text-lg font-medium text-gray-900">Client Details</h3>
                            <p class="mt-1 text-sm text-gray-500">Personal and contact information</p>
                        </div>

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Full Name -->
                            <div>
                                <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                                <input type="text" id="full_name" name="full_name" required value="{{ old('full_name') }}"
                                       class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>

                            <!-- Status -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">Status <span class="text-red-500">*</span></label>
                                <div class="flex space-x-6">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="status" value="Active" class="h-4 w-4 text-blue-600 focus:ring-blue-500"
                                               {{ old('status', 'Active') === 'Active' ? 'checked' : '' }} required>
                                        <span class="ml-2 text-gray-700">Active</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="status" value="Inactive" class="h-4 w-4 text-blue-600 focus:ring-blue-500"
                                               {{ old('status') === 'Inactive' ? 'checked' : '' }}>
                                        <span class="ml-2 text-gray-700">Inactive</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Media Uploads -->
                        <div class="border-b border-gray-200 pb-4">
                            <h3 class="text-lg font-medium text-gray-900">Media Uploads</h3>
                            <p class="mt-1 text-sm text-gray-500">Client profile picture and logo</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Profile Picture with Preview -->
                            <div>
                                <label for="picture" class="block text-sm font-medium text-gray-700 mb-1">Profile Picture</label>
                                <div class="mt-1 flex flex-col items-center justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <img id="picture-preview" class="hidden mb-3 w-24 h-24 rounded-full object-cover border" />
                                    <label class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                        <span>Upload a file</span>
                                        <input id="picture" name="picture" type="file" class="sr-only" accept="image/*" onchange="previewImage(event, 'picture-preview')">
                                    </label>
                                    <p class="text-xs text-gray-500 mt-2">PNG, JPG, GIF up to 2MB</p>
                                </div>
                            </div>

                            <!-- Company Logo with Preview -->
                            <div>
                                <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">Company Logo</label>
                                <div class="mt-1 flex flex-col items-center justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <img id="logo-preview" class="hidden mb-3 w-24 h-24 object-contain border" />
                                    <label class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                        <span>Upload a file</span>
                                        <input id="logo" name="logo" type="file" class="sr-only" accept="image/*" onchange="previewImage(event, 'logo-preview')">
                                    </label>
                                    <p class="text-xs text-gray-500 mt-2">PNG, JPG, GIF up to 2MB</p>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="border-b border-gray-200 pb-4">
                            <h3 class="text-lg font-medium text-gray-900">Contact Information</h3>
                            <p class="mt-1 text-sm text-gray-500">Address and phone details</p>
                        </div>

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Address -->
                            <div>
                                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                <textarea id="alamat" name="alamat" rows="3"
                                          class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('alamat') }}</textarea>
                            </div>

                            <!-- Phone Number -->
                            <div>
                                <label for="nohp" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                <input type="text" id="nohp" name="nohp" value="{{ old('nohp') }}"
                                       class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                            <a href="{{ route('clients.index') }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Create Client
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script for Preview Image -->
    <script>
    function previewImage(event, previewId) {
        const input = event.target;
        const preview = document.getElementById(previewId);

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '';
            preview.classList.add('hidden');
        }
    }
    </script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    @if(session('error'))
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: "{{ session('error') }}",
            confirmButtonColor: '#d33'
        });
    });
    </script>
    @endif
</x-app-layout>
