<div class="border border-gray-200 rounded-lg overflow-hidden mt-6">
    <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
        <h4 class="text-sm font-medium text-gray-700">Percakapan Client</h4>
    </div>

    <!-- Daftar Komentar -->
    <div class="p-4 space-y-4 max-h-64 overflow-y-auto">
        @forelse ($comments as $comment)
            <div class="flex items-start space-x-3 p-3 border border-gray-200 rounded-lg">
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

                <div class="flex-1">
                    <div class="flex justify-between items-center mb-1">
                        <span class="font-medium text-gray-800">
                            {{ $comment->user->full_name ?? $comment->user->name ?? 'User' }}
                        </span>
                        <span class="text-gray-500 text-xs">
                            {{ $comment->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <p class="text-gray-700 text-sm">{{ $comment->body }}</p>

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
            <p class="text-gray-500 text-sm">Belum ada komentar dari client.</p>
        @endforelse
    </div>

    <!-- Form Tambah Komentar -->
    <div class="border-t border-gray-200 px-4 py-3">
        <form wire:submit.prevent="submitComment" class="flex flex-col space-y-2" enctype="multipart/form-data">
            <input type="text" wire:model.defer="commentText" 
                placeholder="Tulis komentar Anda..."
                class="flex-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

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
