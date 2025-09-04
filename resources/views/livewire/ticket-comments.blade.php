<div class="border border-gray-200 rounded-lg overflow-hidden mt-6 flex flex-col h-[70vh]">
    <!-- Header -->
    <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
        <h4 class="text-sm font-medium text-gray-700">Percakapan</h4>
    </div>

    <!-- Daftar Komentar -->
    <div class="p-4 space-y-4 flex-1 overflow-y-auto" id="comments-container">
        @forelse ($comments as $comment)
            <div class="flex items-start space-x-3 p-3 border border-gray-200 rounded-lg">
                <!-- Avatar -->
                <div class="flex-shrink-0">
                    @if(!empty($comment->user->profile_photo))
                        <img src="{{ asset('storage/' . $comment->user->profile_photo) }}" 
                             alt="Avatar" 
                             class="h-10 w-10 rounded-full object-cover">
                    @else
                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-medium">
                            {{ strtoupper(substr($comment->user->name ?? 'U', 0, 2)) }}
                        </div>
                    @endif
                </div>

                <!-- Isi Komentar -->
                <div class="flex-1">
                    <div class="flex justify-between items-center mb-1">
                        <span class="font-medium text-gray-800">
                            {{ $comment->user->full_name ?? $comment->user->name ?? 'User' }}
                            <span class="text-xs text-gray-500">
                                ({{ $comment->user->role ?? 'User' }})
                            </span>
                        </span>
                        <span class="text-gray-500 text-xs">
                            {{ $comment->created_at->timezone('Asia/Jakarta')->format('d-m-Y h:i a') }}
                        </span>
                    </div>
                    <div class="text-gray-700 text-sm">{!! $comment->body !!}</div>

                    @if($comment->file_path)
                        <div class="mt-2">
                            <a href="{{ asset('storage/' . $comment->file_path) }}" 
                               target="_blank"
                               class="text-blue-600 text-xs hover:underline">
                                📎 Lihat Lampiran
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-sm">Belum ada komentar.</p>
        @endforelse
    </div>

    <!-- Form Tambah Komentar -->
    <div class="border-t border-gray-200 px-4 py-3">
        <form wire:submit.prevent="submitComment" class="flex flex-col space-y-3" enctype="multipart/form-data">
            <textarea wire:model.defer="commentText"
                class="border rounded-lg px-3 py-2 text-sm w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                rows="4"
                placeholder="Tulis komentar..."></textarea>

            <input type="file" wire:model="file" 
                class="text-sm border rounded-lg px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500"
                accept=".jpg,.jpeg,.png,.pdf,.docx,.zip">

            @error('commentText') 
                <p class="text-red-500 text-xs">{{ $message }}</p> 
            @enderror
            @error('file') 
                <p class="text-red-500 text-xs">{{ $message }}</p> 
            @enderror

            <button type="submit" 
                class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                Kirim
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    Livewire.on('commentAdded', () => {
        const container = document.getElementById('comments-container');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    });
</script>
@endpush
