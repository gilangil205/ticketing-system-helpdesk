<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketComments extends Component
{
    public Ticket $ticket;
    public $commentText = '';

    protected $rules = [
        'commentText' => 'required|string|max:1000',
    ];

    public function submitComment()
    {
        $this->validate();

        Comment::create([
            'ticket_id' => $this->ticket->id,
            'user_id'   => Auth::id(),
            'body'      => $this->commentText,
        ]);

        $this->commentText = '';
        $this->dispatch('commentAdded'); // event untuk scroll ke bawah (v3)
    }

    public function render()
    {
        $comments = $this->ticket->comments()->with('user')->latest()->get();

        return view('livewire.ticket-comments', compact('comments'));
    }
}
