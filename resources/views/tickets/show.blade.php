<x-app-layout>
    <x-slot name="header">
        @section('title', 'Detail Tiket')

        <div class="py-4 mx-auto">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Detail Tiket</h2>
                <div class="flex items-center mt-1 space-x-2 text-sm text-gray-500">
                    <span>#{{ $ticket->id }}</span>
                    <span>•</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                        {{ $ticket->status === 'Open' ? 'bg-red-100 text-red-800' : '' }}
                        {{ $ticket->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $ticket->status === 'Closed' ? 'bg-green-100 text-green-800' : '' }}">
                        {{ $ticket->status ?? 'Open' }}
                    </span>
                </div>
            </div>
            <div class="flex space-x-2">
                <x-secondary-button onclick="window.history.back();">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v1a1 1 0 11-2 0v-1a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Kembali
                </x-secondary-button>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Ticket Details Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">{{ $ticket->title }}</h3>
                            <div class="mt-1 flex items-center text-sm text-gray-500">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $ticket->topic === 'Technical' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $ticket->topic === 'Billing' ? 'bg-purple-100 text-purple-800' : '' }}
                                    {{ $ticket->topic === 'Account' ? 'bg-green-100 text-green-800' : '' }}">
                                    {{ $ticket->topic }}
                                </span>
                                <span class="mx-2">•</span>
                                <span>Dibuat {{ $ticket->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-sm font-medium text-gray-900">{{ $ticket->name }}</div>
                            <div class="text-sm text-gray-500">{{ $ticket->email }}</div>
                        </div>
                    </div>
                </div>

                <!-- Ticket Content -->
                <div class="px-6 py-4 bg-gray-50">
                    <div class="prose max-w-none">
                        <h4 class="text-lg font-medium text-gray-900 mb-3">Deskripsi Tiket</h4>
                        <div class="text-gray-700 whitespace-pre-line">{{ $ticket->description }}</div>
                    </div>
                </div>

                <!-- Attachments -->
                @if($ticket->attachment)
                    @php
                        $fileUrl = Storage::url($ticket->attachment);
                        $fileExists = Storage::disk('public')->exists($ticket->attachment);
                    @endphp

                    @if($fileExists)
                        <div class="mt-4 px-6 py-4">
                            <h4 class="font-medium text-gray-900 mb-2">Lampiran:</h4>
                            <a href="{{ $fileUrl }}" 
                               target="_blank"
                               class="inline-flex items-center text-blue-600 hover:underline">
                               <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                               </svg>
                               Download Lampiran
                            </a>
                        </div>
                    @else
                        <div class="text-red-500 text-sm mt-2 px-6">
                            File lampiran tidak ditemukan di server.
                        </div>
                    @endif
                @endif

                <!-- Comments Section -->
                <div class="px-6 py-4 border-t border-gray-200">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Diskusi</h4>

                    <!-- Comment Form -->
                    <div class="mb-6">
                        <form>
                            <div class="mt-1">
                                <textarea rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Tambahkan komentar..."></textarea>
                            </div>
                            <div class="mt-2 flex justify-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Kirim Komentar
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Sample Comment -->
                    <div class="space-y-4">
                        <div class="flex">
                            <div class="flex-shrink-0 mr-3">
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-medium">
                                    {{ strtoupper(substr($ticket->name, 0, 2)) }}
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="bg-white border border-gray-200 p-3 rounded-lg">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-medium text-gray-900">{{ $ticket->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $ticket->created_at->diffForHumans() }}</p>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-700">Terima kasih atas bantuannya. Saya akan menunggu update.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
