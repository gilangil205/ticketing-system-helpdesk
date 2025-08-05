<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\TicketCreated;

class TicketController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'topic' => 'required',
            'title' => 'required',
            'description' => 'required',
            'attachment' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('attachment')) {
            // Simpan file ke disk 'public'
           $data['attachment'] = $request->file('attachment')->store('attachments', 'public');

        }

        $ticket = Ticket::create($data);

        // Kirim email ke pengirim, Project Manager, dan Developer
        $recipients = [$data['email']];
        $pmEmails = User::where('role', 'Project Manager')->pluck('email')->toArray();
        $devEmails = User::where('role', 'Developer')->pluck('email')->toArray();
        $recipients = array_merge($recipients, $pmEmails, $devEmails);

        foreach ($recipients as $recipient) {
            Mail::to($recipient)->send(new TicketCreated($data));
        }

        return redirect()->back()->with('success', 'Tiket berhasil dibuat dan email telah dikirim.');
    }

    public function index()
    {
        $tickets = Ticket::latest()->get();
        return view('tickets.index', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dihapus.');
    }
}
