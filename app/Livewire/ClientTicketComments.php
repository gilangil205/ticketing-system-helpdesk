<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class ClientTicketComments extends Component
{
    use WithFileUploads;

    public Ticket $ticket;
    public $commentText = '';
    public $file;

    protected $rules = [
        'commentText' => 'required|string|max:1000',
        'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx,zip|max:2048',
    ];

    protected $listeners = ['refreshComments' => '$refresh'];

    public function submitComment()
    {
        $this->validate();

        // Simpan file jika ada
        $filePath = null;
        if ($this->file) {
            $filePath = $this->file->store('comments', 'public');
        }

        // Simpan komentar client
        Comment::create([
            'ticket_id' => $this->ticket->id,
            'user_id'   => Auth::id(),
            'body'      => $this->commentText,
            'role'      => 'Client',
            'file_path' => $filePath,
        ]);

        // Reset form setelah kirim
        $this->reset(['commentText', 'file']);

        // Supaya komentar langsung ter-refresh
        $this->dispatch('refreshComments');
    }

    public function render()
    {
        $comments = $this->ticket->comments()
            ->where('role', 'Client')
            ->with('user')
            ->latest()
            ->get();

        return view('livewire.client-ticket-comments', compact('comments'));
    }
}
