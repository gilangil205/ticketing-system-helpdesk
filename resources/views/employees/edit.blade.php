<x-app-layout>
    <x-slot name="header">
        @section('title', 'Edit Employee')
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Edit Employee
        </h2>
    </x-slot>

    <div class="py-4 ">
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('employees.update', $employee->id) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Profile Section -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <!-- Profile Photo Column -->
                            <div class="lg:col-span-1">
                                <div class="space-y-4">
                                    <!-- Current Photo -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Profile Photo</label>
                                        <div class="flex flex-col items-center space-y-4">
                                            @if($employee->profile_photo)
                                                <div class="relative group">
                                                    <img src="{{ asset('storage/'.$employee->profile_photo) }}" 
                                                         alt="Current Profile" 
                                                         class="h-32 w-32 rounded-full object-cover shadow-md border-2 border-gray-200">
                                                    <div class="absolute inset-0 bg-black bg-opacity-30 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                        <span class="text-white text-xs font-medium">Current Photo</span>
                                                    </div>
                                                </div>
                                                <label class="flex items-center space-x-2">
                                                    <input type="checkbox" name="remove_photo" class="h-4 w-4 text-blue-600 rounded border-gray-300">
                                                    <span class="text-sm text-gray-600">Remove current photo</span>
                                                </label>
                                            @else
                                                <div class="h-32 w-32 rounded-full bg-gray-200 flex items-center justify-center">
                                                    <svg class="h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- New Photo Upload -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ $employee->profile_photo ? 'Upload New Photo' : 'Upload Profile Photo' }}
                                        </label>
                                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                                            <div class="space-y-1 text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                <div class="flex text-sm text-gray-600">
                                                    <label for="profile_photo" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                                        <span>Upload a file</span>
                                                        <input id="profile_photo" name="profile_photo" type="file" class="sr-only">
                                                    </label>
                                                    <p class="pl-1">or drag and drop</p>
                                                </div>
                                                <p class="text-xs text-gray-500">
                                                    PNG, JPG, GIF up to 2MB
                                                </p>
                                            </div>
                                        </div>
                                        @error('profile_photo') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Employee Details Column -->
                            <div class="lg:col-span-2">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Username -->
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Username <span class="text-red-500">*</span></label>
                                        <input type="text" name="username" value="{{ old('username', $employee->username) }}" 
                                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm" 
                                               required />
                                        @error('username') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Name -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                                        <input type="text" name="name" value="{{ old('name', $employee->name) }}" 
                                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm" 
                                               required />
                                        @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- NIK -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Employee ID <span class="text-red-500">*</span></label>
                                        <input type="text" name="nik" value="{{ old('nik', $employee->nik) }}" 
                                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm" 
                                               required />
                                        @error('nik') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                        <input type="email" name="email" value="{{ old('email', $employee->email) }}" 
                                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm" 
                                               required />
                                        @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone <span class="text-red-500">*</span></label>
                                        <input type="text" name="phone" value="{{ old('phone', $employee->phone) }}" 
                                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm" 
                                               required />
                                        @error('phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Role -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Role <span class="text-red-500">*</span></label>
                                        <select name="role" 
                                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm" 
                                                required>
                                            <option value="">Select a role</option>
                                            <option value="Project Manager" {{ old('role', $employee->role) == 'Project Manager' ? 'selected' : '' }}>Project Manager</option>
                                            <option value="Developer" {{ old('role', $employee->role) == 'Developer' ? 'selected' : '' }}>Developer</option>
                                            <option value="QA/Tester" {{ old('role', $employee->role) == 'QA/Tester' ? 'selected' : '' }}>QA/Tester</option>
                                            <option value="Admin" {{ old('role', $employee->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                        @error('role') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Status -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                                        <select name="status" 
                                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm" 
                                                required>
                                            <option value="">Select status</option>
                                            <option value="Active" {{ old('status', $employee->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                            <option value="Inactive" {{ old('status', $employee->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Password Section -->
                                <div class="mt-6 border-t border-gray-200 pt-6">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Change Password</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- New Password -->
                                        <div class="md:col-span-1">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                            <input type="password" name="password" 
                                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm" />
                                            @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="md:col-span-1">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                                            <input type="password" name="password_confirmation" 
                                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm" />
                                        </div>
                                    </div>
                                    <p class="mt-2 text-xs text-gray-500">Leave blank to keep current password. Minimum 8 characters.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 pt-6">
                            <a href="{{ route('employees.index') }}" 
                               class="inline-flex justify-center items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200 text-sm">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 text-sm">
                                Update Employee
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>