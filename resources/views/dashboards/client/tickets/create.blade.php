<x-app-layout>
    <x-slot name="header">
        @section('title', 'Open New Ticket')
        <h2 class="text-xl font-semibold text-gray-800">
            {{ __('Open New Ticket') }}
        </h2>
    </x-slot>

    @push('styles')
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @endpush

    <div class="py-4 px-2 sm:px-4">
        <div class="bg-white p-4 sm:p-6 rounded-lg shadow">

            {{-- Show validation errors --}}
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-md">
                    <ul class="text-sm text-red-600 list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('client.tickets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-4 sm:gap-6 mb-6">
                    <!-- Name Field -->
                    <div>
                        <label for="name_display" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" id="name_display"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 text-sm sm:text-base"
                            value="{{ Auth::user()->full_name }}" readonly>
                        <input type="hidden" name="name" value="{{ Auth::user()->full_name }}">
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="email_display" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email_display"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 text-sm sm:text-base"
                            value="{{ Auth::user()->email }}" readonly>
                        <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                    </div>

                    <!-- Topic Field -->
                    <div>
                        <label for="topic" class="block text-sm font-medium text-gray-700 mb-1">Topic</label>
                        <select id="topic" name="topic"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                            <option value="">Select a topic</option>
                            <option value="Bug Report" {{ old('topic') == 'Bug Report' ? 'selected' : '' }}>Bug Report</option>
                            <option value="Feature Request" {{ old('topic') == 'Feature Request' ? 'selected' : '' }}>Feature Request</option>
                            <option value="Technical Support" {{ old('topic') == 'Technical Support' ? 'selected' : '' }}>Technical Support</option>
                            <option value="Account Issue" {{ old('topic') == 'Account Issue' ? 'selected' : '' }}>Account Issue</option>
                        </select>
                    </div>

                    <!-- Title Field -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" id="title" name="title"
                            value="{{ old('title') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base"
                            placeholder="Enter ticket title">
                    </div>

                    <!-- Project Field -->
                    <div>
                        <label for="project_id" class="block text-sm font-medium text-gray-700 mb-1">Project</label>
                        <select id="project_id" name="project_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                            <option value="">-- Select Project --</option>
                           @foreach ($projects as $project)
                                <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Description Field (Quill Editor) -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-sm sm:text-base font-medium text-gray-700">Description</h3>
                    </div>
                    <div class="bg-white border border-gray-300 rounded-md overflow-hidden">
                        <div id="quill-editor" style="min-height: 180px;" class="bg-white">
                            {!! old('description') !!}
                        </div>
                        <input type="hidden" name="description" id="description">
                    </div>
                </div>

                <!-- Attachment Field -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Attachment</label>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                        <label for="attachment"
                            class="cursor-pointer bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 text-center">
                            Choose File
                        </label>
                        <span class="text-sm text-gray-500 text-center sm:text-left" id="file-name">No file chosen</span>
                        <input id="attachment" name="attachment" type="file"
                            accept=".pdf,.png,.jpg,.jpeg"
                            class="sr-only"
                            onchange="document.getElementById('file-name').textContent = this.files[0] ? this.files[0].name : 'No file chosen'">
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Accepted formats: PDF, PNG, JPG, JPEG</p>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col-reverse sm:flex-row justify-end gap-3">
                    <button type="reset"
                        class="mt-3 sm:mt-0 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Reset
                    </button>
                    <button type="button" onclick="window.history.back()"
                        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        Create Ticket
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <!-- Quill Editor -->
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const toolbarOptions = [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    ['link', 'image'],
                    ['clean']
                ];

                const quill = new Quill('#quill-editor', {
                    modules: { 
                        toolbar: toolbarOptions,
                    },
                    theme: 'snow',
                    placeholder: 'Write something...'
                });

                // Set initial value from old input
                quill.root.innerHTML = document.getElementById('description').value || '';

                quill.on('text-change', function () {
                    document.getElementById('description').value = quill.root.innerHTML;
                });

                document.getElementById('attachment').addEventListener('change', function (e) {
                    const fileName = e.target.files[0] ? e.target.files[0].name : 'No file chosen';
                    document.getElementById('file-name').textContent = fileName;
                });

                // Responsive toolbar adjustment for mobile
                function adjustToolbar() {
                    const toolbar = document.querySelector('.ql-toolbar');
                    if (window.innerWidth < 640) {
                        toolbar.style.flexWrap = 'wrap';
                        toolbar.style.padding = '8px';
                    } else {
                        toolbar.style.flexWrap = 'nowrap';
                        toolbar.style.padding = '';
                    }
                }

                adjustToolbar();
                window.addEventListener('resize', adjustToolbar);
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
    @endpush
</x-app-layout>