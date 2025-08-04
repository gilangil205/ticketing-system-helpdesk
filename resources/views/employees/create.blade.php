<x-app-layout>
    <x-slot name="header">
        @section('title', 'Add Employee')
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Add New Employee
        </h2>
    </x-slot>

      <div class="py-4">
        <div class="mx-auto">
            <!-- Elegant Header Section -->
            <div class="mb-6 bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-md overflow-hidden">
                <div class="p-6 flex items-center">
                    <div class="flex-shrink-0 mr-4">
                        <svg class="h-12 w-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-white">Add New Team Member</h3>
                        <p class="mt-1 text-blue-100">Fill in the details below to register a new employee in the system</p>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 bg-white border-b border-gray-200">
                    <!-- Progress Steps (Optional) -->
                    <div class="mb-6">
                        <div class="flex items-center">
                            <div class="flex items-center text-blue-600 relative">
                                <div class="rounded-full transition duration-500 ease-in-out h-8 w-8 py-1 border-2 border-blue-600 bg-blue-600">
                                    <div class="text-white text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="absolute top-0 -ml-8 text-center mt-10 w-32 text-xs font-medium text-blue-600">Basic Information</div>
                            </div>
                            <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-blue-600"></div>
                            <div class="flex items-center text-gray-500 relative">
                                <div class="rounded-full transition duration-500 ease-in-out h-8 w-8 py-1 border-2 border-gray-300">
                                    <div class="text-gray-600 text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="absolute top-0 -ml-8 text-center mt-10 w-32 text-xs font-medium text-gray-500">Profile Details</div>
                            </div>
                            <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-gray-300"></div>
                            <div class="flex items-center text-gray-500 relative">
                                <div class="rounded-full transition duration-500 ease-in-out h-8 w-8 py-1 border-2 border-gray-300">
                                    <div class="text-gray-600 text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="absolute top-0 -ml-8 text-center mt-10 w-32 text-xs font-medium text-gray-500">Employment</div>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Profile Section -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <!-- Profile Photo Column -->
                            <div class="lg:col-span-1">
                                <div class="space-y-4">
                                    <!-- Photo Preview Area -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Profile Photo</label>
                                        <div class="flex flex-col items-center space-y-4">
                                            <div id="photoPreview" class="h-32 w-32 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden shadow-md border-2 border-blue-100">
                                                <svg id="defaultAvatar" class="h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                                <img id="previewImage" class="hidden h-full w-full object-cover" src="" alt="Preview">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- New Photo Upload -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Upload Profile Photo
                                        </label>
                                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 transition duration-150">
                                            <div class="space-y-1 text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                <div class="flex text-sm text-gray-600 justify-center">
                                                    <label for="profile_photo" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none transition duration-150">
                                                        <span>Upload a file</span>
                                                        <input id="profile_photo" name="profile_photo" type="file" class="sr-only" onchange="previewPhoto(event)">
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
                                        <input type="text" name="username" value="{{ old('username') }}" 
                                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm" 
                                               required />
                                        @error('username') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Name -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                                        <input type="text" name="name" value="{{ old('name') }}" 
                                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm" 
                                               required />
                                        @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- NIK -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Employee ID <span class="text-red-500">*</span></label>
                                        <input type="text" name="nik" value="{{ old('nik') }}" 
                                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm" 
                                               required />
                                        @error('nik') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                        <input type="email" name="email" value="{{ old('email') }}" 
                                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm" 
                                               required />
                                        @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone <span class="text-red-500">*</span></label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" 
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
                                            <option value="Project Manager" {{ old('role') == 'Project Manager' ? 'selected' : '' }}>Project Manager</option>
                                            <option value="Developer" {{ old('role') == 'Developer' ? 'selected' : '' }}>Developer</option>
                                            <option value="QA/Tester" {{ old('role') == 'QA/Tester' ? 'selected' : '' }}>QA/Tester</option>
                                            <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
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
                                            <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                            <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Password Section -->
                                <div class="mt-6 border-t border-gray-200 pt-6">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Set Password</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Password -->
                                        <div class="md:col-span-1">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Password <span class="text-red-500">*</span></label>
                                            <input type="password" name="password" 
                                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm"
                                                   required />
                                            @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="md:col-span-1">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password <span class="text-red-500">*</span></label>
                                            <input type="password" name="password_confirmation" 
                                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm"
                                                   required />
                                        </div>
                                    </div>
                                    <p class="mt-2 text-xs text-gray-500">Minimum 8 characters.</p>
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
                                Add Employee
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

     <script>
        function previewPhoto(event) {
            const input = event.target;
            const preview = document.getElementById('previewImage');
            const defaultAvatar = document.getElementById('defaultAvatar');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    defaultAvatar.classList.add('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
                preview.classList.add('hidden');
                defaultAvatar.classList.remove('hidden');
            }
        }
    </script>
</x-app-layout>