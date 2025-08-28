<div class="border border-gray-200 rounded-lg overflow-hidden mt-6">
    <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
        <h4 class="text-sm font-medium text-gray-700">Percakapan</h4>
    </div>

    <!-- Daftar Komentar -->
    <div class="p-4 space-y-4 max-h-64 overflow-y-auto">
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
                            {{ $comment->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <p class="text-gray-700 text-sm">{{ $comment->body }}</p>
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-sm">Belum ada komentar dari Admin/PM.</p>
        @endforelse
    </div>

    <!-- Form Tambah Komentar -->
    <div class="border-t border-gray-200 px-4 py-3">
        <form wire:submit.prevent="submitComment" class="flex space-x-2">
            <input type="text" wire:model.defer="commentText" 
                placeholder="Tulis komentar Anda..."
                class="flex-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" 
                class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                Kirim
            </button>
        </form>
        @error('commentText') 
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p> 
        @enderror
    </div>
</div>
