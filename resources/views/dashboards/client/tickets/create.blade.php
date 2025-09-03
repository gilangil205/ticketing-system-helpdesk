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

    <div class="py-4">
        <div class="bg-white p-6 rounded-lg shadow">

            {{-- Show validation errors --}}
            @if ($errors->any())
                <div class="mb-4">
                    <ul class="text-sm text-red-600 list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('client.tickets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Name Field -->
                    <div>
                        <label for="name_display" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" id="name_display"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100"
                            value="{{ Auth::user()->full_name }}" readonly>
                        <input type="hidden" name="name" value="{{ Auth::user()->full_name }}">
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="email_display" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email_display"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100"
                            value="{{ Auth::user()->email }}" readonly>
                        <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                    </div>

                    <!-- Topic Field -->
                    <div>
                        <label for="topic" class="block text-sm font-medium text-gray-700 mb-1">Topic</label>
                        <select id="topic" name="topic"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter ticket title">
                    </div>

                    <!-- Project Field -->
                    <div>
                        <label for="project_id" class="block text-sm font-medium text-gray-700 mb-1">Project</label>
                        <select id="project_id" name="project_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                <div class="card card-primary card-outline mb-6">
                    <div class="card-header flex justify-between">
                        <h3 class="card-title text-lg font-medium">Description</h3>
                    </div>
                    <div class="card-body">
                        <div id="quill-editor" style="min-height: 200px;" class="bg-white">
                            {!! old('description') !!}
                        </div>
                        <input type="hidden" name="description" id="description">
                    </div>
                </div>

                <!-- Attachment Field -->
                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-1 py-4">Attachment</label>
                    <div class="mt-1 flex items-center">
                        <label for="attachment"
                            class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Choose File
                        </label>
                        <span class="ml-2 text-sm text-gray-500" id="file-name">No file chosen</span>
                        <input id="attachment" name="attachment" type="file"
                            accept=".pdf,.png,.jpg,.jpeg"
                            class="sr-only"
                            onchange="document.getElementById('file-name').textContent = this.files[0] ? this.files[0].name : 'No file chosen'">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3">
                    <button type="reset"
                        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
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
                    modules: { toolbar: toolbarOptions },
                    theme: 'snow',
                    placeholder: 'Write something...'
                });

                // Set initial value from old input
                quill.root.innerHTML = document.getElementById('description').value;

                quill.on('text-change', function () {
                    document.getElementById('description').value = quill.root.innerHTML;
                });

                document.getElementById('attachment').addEventListener('change', function (e) {
                    const fileName = e.target.files[0] ? e.target.files[0].name : 'No file chosen';
                    document.getElementById('file-name').textContent = fileName;
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
    @endpush
</x-app-layout>
