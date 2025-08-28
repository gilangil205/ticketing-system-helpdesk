<x-app-layout>
    <x-slot name="header">
        @section('title', 'Detail Tiket')
        <h2 class="text-2xl font-bold text-gray-800">Detail Tiket</h2>
        <p class="text-gray-500 text-sm mt-1">Informasi lengkap tiket dan riwayat perubahan</p>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-5xl space-y-6">

            <!-- Card Tiket -->
            <div class="bg-white shadow-lg rounded-lg border border-gray-200 overflow-hidden">
                <!-- Header Ticket -->
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                            <span class="text-blue-600 text-xl font-medium">
                                {{ strtoupper(substr($ticket->name, 0, 1)) }}
                            </span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $ticket->title }}</h3>
                            <div class="mt-1 flex items-center space-x-2">
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $ticket->status === 'Open' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $ticket->status === 'In Progress' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $ticket->status === 'Resolved' ? 'bg-green-100 text-green-800' : '' }}">
                                    {{ $ticket->status }}
                                </span>
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $ticket->priority === 'High' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ $ticket->priority === 'Medium' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $ticket->priority === 'Low' ? 'bg-green-100 text-green-800' : '' }}">
                                    {{ $ticket->priority }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <x-secondary-button onclick="window.history.back();">
                        Kembali
                    </x-secondary-button>
                </div>

                <!-- Main Content Grid -->
                <div class="px-6 py-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Left Column -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Ticket Info -->
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                <h4 class="text-sm font-medium text-gray-700">Informasi Tiket</h4>
                            </div>
                            <div class="p-4 bg-white grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <p><strong>Nama:</strong> {{ $ticket->name }}</p>
                                    <p><strong>Email:</strong> {{ $ticket->email }}</p>
                                    <p><strong>Topik:</strong> {{ $ticket->topic }}</p>
                                    <p><strong>Proyek:</strong> {{ $ticket->project->name ?? '-' }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p><strong>Tanggal Dibuat:</strong> {{ $ticket->created_at->format('d M Y H:i') }}</p>
                                    <p>
                                        <strong>Lampiran:</strong>
                                        @if($ticket->attachment)
                                            <a href="{{ asset('storage/'.$ticket->attachment) }}" class="text-blue-600 hover:underline" target="_blank">Download</a>
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                       <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                            <h4 class="text-sm font-medium text-gray-700">Deskripsi</h4>
                        </div>
                        <div class="p-4 bg-white">
                            <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                                {{ strip_tags($ticket->description) }}
                            </p>
                        </div>
                    </div>

                        <!-- Komentar Livewire -->
                           @livewire('client-ticket-comments', ['ticket' => $ticket])
                        </div>

                    <!-- Right Column Metadata -->
                    <div class="space-y-6">
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                <h4 class="text-sm font-medium text-gray-700">Detail Tiket</h4>
                            </div>
                            <div class="p-4 bg-white space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">Status</span>
                                    <span class="px-2 py-1 rounded-full text-xs font-medium 
                                        {{ $ticket->status === 'Open' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $ticket->status === 'In Progress' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $ticket->status === 'Resolved' ? 'bg-green-100 text-green-800' : '' }}">
                                        {{ $ticket->status }}
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">Prioritas</span>
                                    <span class="px-2 py-1 rounded-full text-xs font-medium 
                                        {{ $ticket->priority === 'High' ? 'bg-red-100 text-red-800' : '' }}
                                        {{ $ticket->priority === 'Medium' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $ticket->priority === 'Low' ? 'bg-green-100 text-green-800' : '' }}">
                                        {{ $ticket->priority }}
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">Dibuat</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $ticket->created_at->format('d M Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">Diperbarui</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $ticket->updated_at->format('d M Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
