<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class ClientTicketComments extends Component
{
    public Ticket $ticket;
    public $commentText = '';

    protected $rules = [
        'commentText' => 'required|string|max:1000',
    ];

    protected $listeners = ['refreshComments' => '$refresh'];

    public function submitComment()
    {
        $this->validate();

        Comment::create([
            'ticket_id' => $this->ticket->id,
            'user_id'   => Auth::id(),
            'body'      => $this->commentText,
            'role'      => 'Client', // tandai bahwa ini komentar dari client
        ]);

        $this->commentText = '';

        $this->dispatch('refreshComments'); // supaya realtime untuk client
    }

    public function render()
    {
        $comments = $this->ticket->comments()
            ->where('role', 'Client') // hanya komentar client
            ->with('user')
            ->latest()
            ->get();

        return view('livewire.client-ticket-comments', compact('comments'));
    }
}
