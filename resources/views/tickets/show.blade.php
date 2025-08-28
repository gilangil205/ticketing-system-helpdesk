<x-app-layout>
    <x-slot name="header">
        @section('title', 'Detail Tiket')
        <h2 class="text-lg font-semibold text-gray-800 leading-tight">
            {{ __('Detail Tiket') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto">
            <div class="bg-white shadow overflow-hidden rounded-lg">
                <!-- Header Section -->
                <div class="px-6 py-4 border-b border-gray-200 bg-white">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                        <div class="flex items-center space-x-4">
                            <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                <span class="text-blue-600 text-xl font-medium">
                                    {{ strtoupper(substr($ticket->name, 0, 1)) }}
                                </span>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">
                                    {{ $ticket->name }}
                                </h3>
                                <div class="mt-1 flex flex-wrap items-center gap-2">
                                    <span class="inline-flex px-2.5 py-0.5 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                        #{{ $ticket->ticket_number ?? '-' }}
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $ticket->status === 'Open' ? 'bg-red-100 text-red-800' : '' }}
                                        {{ $ticket->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $ticket->status === 'Closed' ? 'bg-green-100 text-green-800' : '' }}">
                                        {{ $ticket->status ?? 'Open' }}
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        Dibuat {{ $ticket->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <x-secondary-button onclick="window.history.back();" class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v1a1 1 0 11-2 0v-1a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Kembali
                        </x-secondary-button>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="px-6 py-6">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Left Column (Ticket Info) -->
                        <div class="lg:col-span-2 space-y-6">
                            <!-- Ticket Title -->
                            <div>
                                <h1 class="text-xl font-bold text-gray-900">{{ $ticket->title }}</h1>
                                <div class="mt-2 flex items-center space-x-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $ticket->topic === 'Technical' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $ticket->topic === 'Billing' ? 'bg-purple-100 text-purple-800' : '' }}
                                        {{ $ticket->topic === 'Account' ? 'bg-green-100 text-green-800' : '' }}">
                                        {{ $ticket->topic }}
                                    </span>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="border border-gray-200 rounded-lg overflow-hidden">
                                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                    <h4 class="text-sm font-medium text-gray-700">Deskripsi</h4>
                                </div>
                                <div class="p-4 bg-white">
                                    <p class="text-sm text-gray-700 whitespace-pre-line">{!! strip_tags($ticket->description, '<b><strong><i><em><u><br>') !!}</p>
                                </div>
                            </div>

                            <!-- Comments Section (Livewire) -->
                            <div class="mt-4">
                               <livewire:ticket-comments :ticket="$ticket" />
                            </div>
                        </div>

                        <!-- Right Column (Metadata) -->
                        <div class="space-y-6">
                            <!-- Ticket Details -->
                            <div class="border border-gray-200 rounded-lg overflow-hidden">
                                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                    <h4 class="text-sm font-medium text-gray-700">Detail Tiket</h4>
                                </div>
                                <div class="p-4 bg-white space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-500">Status</span>
                                        <span class="text-sm font-medium text-gray-900">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                {{ $ticket->status === 'Open' ? 'bg-red-100 text-red-800' : '' }}
                                                {{ $ticket->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $ticket->status === 'Closed' ? 'bg-green-100 text-green-800' : '' }}">
                                                {{ $ticket->status ?? 'Open' }}
                                            </span>
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

                            <!-- Attachment -->
                            @if($ticket->attachment)
                                @php
                                    $fileUrl = Storage::url($ticket->attachment);
                                    $fileExists = Storage::disk('public')->exists($ticket->attachment);
                                @endphp
                                <div class="border border-gray-200 rounded-lg overflow-hidden">
                                    <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                        <h4 class="text-sm font-medium text-gray-700">Lampiran</h4>
                                    </div>
                                    <div class="p-4 bg-white">
                                        @if($fileExists)
                                            <div class="flex items-center p-3 bg-gray-50 rounded border border-gray-200">
                                                <svg class="w-5 h-5 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                </svg>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 truncate">{{ basename($ticket->attachment) }}</p>
                                                    @php
                                                        try {
                                                            $fileSize = round(Storage::size($ticket->attachment) / 1024);
                                                        } catch (\Exception $e) {
                                                            $fileSize = 'N/A';
                                                        }
                                                    @endphp
                                                    <p class="text-xs text-gray-500">Ukuran: {{ $fileSize }} KB</p>
                                                </div>
                                                <a href="{{ $fileUrl }}" target="_blank"
                                                class="ml-3 inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                                                    Unduh
                                                </a>
                                            </div>
                                        @else
                                            <div class="text-red-500 text-sm bg-red-50 p-3 rounded-lg">
                                                File lampiran tidak ditemukan di server.
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
