<x-app-layout>
    <x-slot name="header">
        @section('title', 'Edit Client')
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Edit Client') }}: <span class="text-blue-600">{{ $client->full_name }}</span>
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto">
            <!-- Client Information Header -->
            <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl shadow-sm border border-blue-200 mb-6 p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 mr-4">
                        @if($client->picture)
                            <img class="h-12 w-12 rounded-full object-cover border-2 border-white shadow" src="{{ asset('storage/'.$client->picture) }}" alt="Client photo">
                        @else
                            <div class="h-12 w-12 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-lg">
                                {{ substr($client->full_name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">{{ $client->full_name }}</h3>
                        <div class="flex items-center mt-1 text-sm text-gray-600">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $client->status === 'Active' ? 'green' : 'red' }}-100 text-{{ $client->status === 'Active' ? 'green' : 'red' }}-800">
                                {{ $client->status }}
                            </span>
                            <span class="mx-2">•</span>
                            <span>{{ $client->email }}</span>
                            <span class="mx-2">•</span>
                            <span>Member since {{ $client->created_at->format('M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('clients.update', $client->id) }}" class="space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Account Information Section -->
                        <div class="border-b border-gray-200 pb-4">
                            <h3 class="text-lg font-medium text-gray-900">Account Information</h3>
                            <p class="mt-1 text-sm text-gray-500">Update client's login credentials</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Username -->
                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username <span class="text-red-500">*</span></label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="username" name="username" required 
                                           value="{{ old('username', $client->username) }}"
                                           class="block w-full pl-10 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('username') border-red-300 text-red-900 @enderror">
                                </div>
                                @error('username')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <input type="email" id="email" name="email" required 
                                           value="{{ old('email', $client->email) }}"
                                           class="block w-full pl-10 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('email') border-red-300 text-red-900 @enderror">
                                </div>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Client Details Section -->
                        <div class="border-b border-gray-200 pb-4">
                            <h3 class="text-lg font-medium text-gray-900">Client Details</h3>
                            <p class="mt-1 text-sm text-gray-500">Update personal information</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Full Name -->
                            <div>
                                <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                                <input type="text" id="full_name" name="full_name" required 
                                       value="{{ old('full_name', $client->full_name) }}"
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
                                               {{ old('status', $client->status) === 'Active' ? 'checked' : '' }} required>
                                        <span class="ml-2 text-gray-700">Active</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="status" value="Inactive" 
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500"
                                               {{ old('status', $client->status) === 'Inactive' ? 'checked' : '' }}>
                                        <span class="ml-2 text-gray-700">Inactive</span>
                                    </label>
                                </div>
                                @error('status')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Password Section -->
                        <div class="border-b border-gray-200 pb-4">
                            <h3 class="text-lg font-medium text-gray-900">Password Update</h3>
                            <p class="mt-1 text-sm text-gray-500">Leave blank to keep current password</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <input type="password" id="password" name="password"
                                           class="block w-full pl-10 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('password') border-red-300 text-red-900 @enderror">
                                </div>
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-2 text-xs text-gray-500">Minimum 8 characters</p>
                            </div>

                            <!-- Password Confirmation -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                           class="block w-full pl-10 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <!-- Media Section -->
                        <div class="border-b border-gray-200 pb-4">
                            <h3 class="text-lg font-medium text-gray-900">Media</h3>
                            <p class="mt-1 text-sm text-gray-500">Update profile picture and logo</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Picture Upload -->
                            <div>
                                <label for="picture" class="block text-sm font-medium text-gray-700 mb-1">Profile Picture</label>
                                <div class="flex items-center space-x-4">
                                    @if($client->picture)
                                        <div class="relative group">
                                            <img src="{{ asset('storage/'.$client->picture) }}" alt="Current Picture" class="h-20 w-20 rounded-full object-cover shadow border-2 border-white">
                                            <div class="absolute inset-0 bg-black bg-opacity-30 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                <button type="button" onclick="event.preventDefault(); document.getElementById('remove_picture').value = '1'; this.parentElement.parentElement.classList.add('hidden'); document.getElementById('picture_preview_placeholder').classList.remove('hidden');" class="text-white text-xs font-medium">Remove</button>
                                            </div>
                                        </div>
                                        <input type="hidden" id="remove_picture" name="remove_picture" value="0">
                                    @endif
                                    <div id="picture_preview_placeholder" class="{{ $client->picture ? 'hidden' : 'block' }} h-20 w-20 rounded-full bg-gray-200 flex items-center justify-center">
                                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <input type="file" id="picture" name="picture" onchange="previewImage(event, 'picture_preview')"
                                               class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                        <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                    </div>
                                </div>
                                @error('picture')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Logo Upload -->
                            <div>
                                <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">Company Logo</label>
                                <div class="flex items-center space-x-4">
                                    @if($client->logo)
                                        <div class="relative group">
                                            <img src="{{ asset('storage/'.$client->logo) }}" alt="Current Logo" class="h-20 w-20 rounded-md object-cover shadow border-2 border-white">
                                            <div class="absolute inset-0 bg-black bg-opacity-30 rounded-md flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                <button type="button" onclick="event.preventDefault(); document.getElementById('remove_logo').value = '1'; this.parentElement.parentElement.classList.add('hidden'); document.getElementById('logo_preview_placeholder').classList.remove('hidden');" class="text-white text-xs font-medium">Remove</button>
                                            </div>
                                        </div>
                                        <input type="hidden" id="remove_logo" name="remove_logo" value="0">
                                    @endif
                                    <div id="logo_preview_placeholder" class="{{ $client->logo ? 'hidden' : 'block' }} h-20 w-20 rounded-md bg-gray-200 flex items-center justify-center">
                                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <input type="file" id="logo" name="logo" onchange="previewImage(event, 'logo_preview')"
                                               class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                        <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                    </div>
                                </div>
                                @error('logo')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Contact Information Section -->
                        <div class="border-b border-gray-200 pb-4">
                            <h3 class="text-lg font-medium text-gray-900">Contact Information</h3>
                            <p class="mt-1 text-sm text-gray-500">Update address and phone details</p>
                        </div>

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Address -->
                            <div>
                                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                <textarea id="alamat" name="alamat" rows="3"
                                          class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('alamat') border-red-300 text-red-900 @enderror">{{ old('alamat', $client->alamat) }}</textarea>
                                @error('alamat')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone Number -->
                            <div>
                                <label for="nohp" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="nohp" name="nohp" 
                                           value="{{ old('nohp', $client->nohp) }}"
                                           class="block w-full pl-10 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('nohp') border-red-300 text-red-900 @enderror">
                                </div>
                                @error('nohp')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Read-only Information Section -->
                        <div class="border-b border-gray-200 pb-4">
                            <h3 class="text-lg font-medium text-gray-900">System Information</h3>
                            <p class="mt-1 text-sm text-gray-500">Client account details</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Last Login -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Last Login</label>
                                <div class="p-3 bg-gray-50 rounded-md text-sm border border-gray-200">
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $client->last_login ? $client->last_login->format('M d, Y H:i') : 'Never logged in' }}
                                    </div>
                                </div>
                            </div>

                            <!-- Created At -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Created At</label>
                                <div class="p-3 bg-gray-50 rounded-md text-sm border border-gray-200">
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $client->created_at->format('M d, Y H:i') }}
                                    </div>
                                </div>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Update Client
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function previewImage(event, previewType) {
            const input = event.target;
            const previewId = previewType + '_placeholder';
            const previewElement = document.getElementById(previewId);
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    // Create new image element if it doesn't exist
                    let img = previewElement.querySelector('img');
                    if (!img) {
                        img = document.createElement('img');
                        img.className = previewType.includes('picture') ? 
                            'h-20 w-20 rounded-full object-cover shadow border-2 border-white' : 
                            'h-20 w-20 rounded-md object-cover shadow border-2 border-white';
                        previewElement.innerHTML = '';
                        previewElement.appendChild(img);
                    }
                    
                    img.src = e.target.result;
                    previewElement.classList.remove('bg-gray-200');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    @endpush
</x-app-layout>