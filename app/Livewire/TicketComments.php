<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketComments extends Component
{
    use WithFileUploads;

    public Ticket $ticket;
    public $commentText = '';
    public $file;

    protected $rules = [
        'commentText' => 'required|string|max:1000',
        'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx,zip|max:2048',
    ];

    protected $listeners = ['updateCommentText'];

    public function updateCommentText($content)
    {
        $this->commentText = $content;
    }

    public function submitComment()
    {
        $this->validate();

        $filePath = $this->file ? $this->file->store('comments', 'public') : null;

        Comment::create([
            'ticket_id' => $this->ticket->id,
            'user_id'   => Auth::id(),
            'body'      => $this->commentText,
            'file_path' => $filePath,
        ]);

        // Kosongkan input setelah terkirim
        $this->reset(['commentText', 'file']);

        // Trigger JS event untuk auto scroll ke bawah
        $this->dispatch('commentAdded');
    }

    public function render()
    {
        // Ambil komentar terbaru duluan
        $comments = $this->ticket->comments()
            ->with('user')
            ->latest()
            ->get();

        return view('livewire.ticket-comments', compact('comments'));
    }
}
