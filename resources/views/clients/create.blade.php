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

                        <!-- Section Header -->
                        <div class="border-b border-gray-200 pb-4">
                            <h3 class="text-lg font-medium text-gray-900">Account Information</h3>
                            <p class="mt-1 text-sm text-gray-500">Basic login credentials for the client</p>
                        </div>

                        <!-- Account Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Username Field -->
                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username <span class="text-red-500">*</span></label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="username" name="username" required value="{{ old('username') }}" 
                                           class="block w-full pl-10 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('username') border-red-300 text-red-900 @enderror">
                                </div>
                                @error('username')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password <span class="text-red-500">*</span></label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <input type="password" id="password" name="password" required
                                           class="block w-full pl-10 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('password') border-red-300 text-red-900 @enderror">
                                </div>
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-2 text-xs text-gray-500">Minimum 8 characters</p>
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <input type="email" id="email" name="email" required value="{{ old('email') }}"
                                           class="block w-full pl-10 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('email') border-red-300 text-red-900 @enderror">
                                </div>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password Confirmation Field -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password <span class="text-red-500">*</span></label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <input type="password" id="password_confirmation" name="password_confirmation" required
                                           class="block w-full pl-10 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <!-- Section Header -->
                        <div class="border-b border-gray-200 pb-4">
                            <h3 class="text-lg font-medium text-gray-900">Client Details</h3>
                            <p class="mt-1 text-sm text-gray-500">Personal and contact information</p>
                        </div>

                        <!-- Client Details -->
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Full Name Field -->
                            <div>
                                <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                                <input type="text" id="full_name" name="full_name" required value="{{ old('full_name') }}"
                                       class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('full_name') border-red-300 text-red-900 @enderror">
                                @error('full_name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status Field -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">Status <span class="text-red-500">*</span></label>
                                <div class="flex space-x-6">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="status" value="Active" 
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500" 
                                               {{ old('status', 'Active') === 'Active' ? 'checked' : '' }} required>
                                        <span class="ml-2 text-gray-700">Active</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="status" value="Inactive" 
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500"
                                               {{ old('status') === 'Inactive' ? 'checked' : '' }}>
                                        <span class="ml-2 text-gray-700">Inactive</span>
                                    </label>
                                </div>
                                @error('status')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Section Header -->
                        <div class="border-b border-gray-200 pb-4">
                            <h3 class="text-lg font-medium text-gray-900">Media Uploads</h3>
                            <p class="mt-1 text-sm text-gray-500">Client profile picture and logo</p>
                        </div>

                        <!-- Media Uploads -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Picture Upload -->
                            <div>
                                <label for="picture" class="block text-sm font-medium text-gray-700 mb-1">Profile Picture</label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        <div class="flex text-sm text-gray-600 justify-center">
                                            <label for="picture" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                                <span>Upload a file</span>
                                                <input id="picture" name="picture" type="file" class="sr-only">
                                            </label>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                    </div>
                                </div>
                                @error('picture')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Logo Upload -->
                            <div>
                                <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">Company Logo</label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <div class="flex text-sm text-gray-600 justify-center">
                                            <label for="logo" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                                <span>Upload a file</span>
                                                <input id="logo" name="logo" type="file" class="sr-only">
                                            </label>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                    </div>
                                </div>
                                @error('logo')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Section Header -->
                        <div class="border-b border-gray-200 pb-4">
                            <h3 class="text-lg font-medium text-gray-900">Contact Information</h3>
                            <p class="mt-1 text-sm text-gray-500">Address and phone details</p>
                        </div>

                        <!-- Contact Information -->
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Address Field -->
                            <div>
                                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                <textarea id="alamat" name="alamat" rows="3"
                                          class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('alamat') border-red-300 text-red-900 @enderror">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone Number Field -->
                            <div>
                                <label for="nohp" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="nohp" name="nohp" value="{{ old('nohp') }}"
                                           class="block w-full pl-10 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('nohp') border-red-300 text-red-900 @enderror">
                                </div>
                                @error('nohp')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                            <a href="{{ route('clients.index') }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
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
    
</x-app-layout>