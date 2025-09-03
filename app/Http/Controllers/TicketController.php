<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Project;
use App\Models\TicketHistory;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Mail\TicketCreated;
use App\Services\FonnteService;

class TicketController extends Controller
{
    /**
     * ======================================================
     *                BAGIAN UNTUK ADMIN & PROJECT MANAGER
     * ======================================================
     */
    public function index(Request $request)
    {
        $query = Ticket::with(['project', 'developer']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        $tickets  = $query->orderBy('created_at', 'desc')->paginate(10);
        $projects = Project::all();

        // Ambil daftar developer dari tabel users (role = Developer)
        $employees = User::where('role', 'Developer')
            ->orderBy('full_name')
            ->get();

        $employees->each(function ($e) {
            if (!isset($e->name) || empty($e->name)) {
                $e->name = $e->full_name ?? $e->username ?? null;
            }
        });

        return view('tickets.index', compact('tickets', 'projects', 'employees'));
    }

    public function show(Ticket $ticket)
    {
        if (Auth::user()->role === 'Developer' && $ticket->developer_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke tiket ini.');
        }

        return view('tickets.show', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status'   => 'sometimes|required|in:Open,In Progress,Wait in Progress,Pass Test,Closed',
            'priority' => 'sometimes|required|in:Low,Medium,High,Critical',
        ]);

        $ticket = Ticket::findOrFail($id);

        if (Auth::user()->role === 'Developer') {
            if ($ticket->developer_id !== Auth::id()) {
                abort(403, 'Anda tidak memiliki akses untuk memperbarui tiket ini.');
            }
            if ($request->has('status')) {
                $ticket->status = $request->status;
            }
        } else {
            if ($request->has('status')) {
                $ticket->status = $request->status;
            }
            if ($request->has('priority')) {
                $ticket->priority = $request->priority;
            }
        }

        $ticket->save();

        TicketHistory::create([
            'ticket_id'   => $ticket->id,
            'user_id'     => Auth::id(),
            'action'      => 'Updated',
            'description' => 'Ticket updated: Status = ' . $ticket->status . ', Priority = ' . ($ticket->priority ?? '-'),
        ]);

        return back()->with('success', 'Tiket berhasil diperbarui.');
    }

    public function destroy(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        if ($ticket->attachment && Storage::disk('public')->exists($ticket->attachment)) {
            Storage::disk('public')->delete($ticket->attachment);
        }

        TicketHistory::create([
            'ticket_id'   => $ticket->id,
            'user_id'     => Auth::id(),
            'action'      => 'Deleted',
            'description' => 'Ticket "' . $ticket->title . '" has been deleted.',
        ]);

        $ticket->delete();

        return redirect()->route('tickets.index')
                         ->with('success', 'Tiket berhasil dihapus.');
    }

    /**
     * ======================================================
     *                BAGIAN PROJECT CRUD
     * ======================================================
     */

    public function projectTickets()
    {
        $projects = Project::with(['tickets' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->get();

        $clients = Client::all();

        return view('dashboards.admin.projects.index', compact('projects', 'clients'));
    }

    public function storeProject(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'client_id' => 'nullable|exists:clients,id',
        ]);

        Project::create([
            'name' => $request->name,
            'client_id' => $request->client_id ?? null,
        ]);

        return redirect()->back()->with('success', 'Project berhasil ditambahkan!');
    }

    public function destroyProject($id)
    {
        $project = Project::with('tickets')->findOrFail($id);

        foreach ($project->tickets as $ticket) {
            if ($ticket->attachment && Storage::disk('public')->exists($ticket->attachment)) {
                Storage::disk('public')->delete($ticket->attachment);
            }

            TicketHistory::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
                'action' => 'Deleted',
                'description' => 'Ticket "' . $ticket->title . '" deleted because its project was deleted.',
            ]);

            $ticket->delete();
        }

        $project->delete();

        return redirect()->route('projects')->with('success', 'Project beserta semua tiket terkait berhasil dihapus.');
    }

    /**
     * ======================================================
     *                BAGIAN UNTUK CLIENT
     * ======================================================
     */
    public function clientDashboard()
    {
        $userEmail = Auth::user()->email;

        $openCount       = Ticket::where('status', 'Open')->where('email', $userEmail)->count();
        $inProgressCount = Ticket::where('status', 'In Progress')->where('email', $userEmail)->count();
        $closedCount     = Ticket::where('status', 'Closed')->where('email', $userEmail)->count();

        return view('dashboards.client.index', compact('openCount', 'inProgressCount', 'closedCount'));
    }

    public function create()
    {
        $user = Auth::user();
        $client = Client::where('email', $user->email)->first();
        $projects = $client ? $client->projects : collect();

        $employees = User::where('role', 'Developer')
            ->orderBy('full_name')
            ->get();

        $employees->each(function ($e) {
            if (!isset($e->name) || empty($e->name)) {
                $e->name = $e->full_name ?? $e->username ?? null;
            }
        });

        return view('dashboards.client.tickets.create', compact('projects', 'employees'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required',
            'email'       => 'required|email',
            'topic'       => 'required',
            'title'       => 'required',
            'description' => 'required',
            'attachment'  => 'nullable|mimes:pdf,png,jpg,jpeg|max:2048',
            'project_id'  => 'nullable|exists:projects,id',
            'developer_id'=> 'nullable|exists:users,id',
        ]);

        $data['priority']      = 'Low';
        $data['status']        = $data['status'] ?? 'Open';
        $data['ticket_number'] = 'TK-' . strtoupper(uniqid());

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        $ticket = Ticket::create($data);

        TicketHistory::create([
            'ticket_id'   => $ticket->id,
            'user_id'     => Auth::id(),
            'action'      => 'Created',
            'description' => 'Ticket created with title: ' . $ticket->title,
        ]);

        $fonnte = app(FonnteService::class);

        // Kirim notifikasi WA ke Client (Auth user)
        $user = Auth::user();
        if ($user && !empty($user->phone)) {
            $message = "Halo {$user->full_name}, tiket Anda berhasil dibuat!\n\n".
                       "ID Ticket: {$ticket->ticket_number}\n".
                       "Judul: {$ticket->title}\n".
                       "Status: {$ticket->status}\n\n".
                       "Kami akan segera memproses tiket Anda. Terima kasih.";

            $fonnte->sendMessage($user->phone, $message);
        }

        // Kirim notifikasi WA ke Client (dari model Client)
        $client = Client::where('email', $data['email'])->first();
        if ($client && !empty($client->nohp)) {
            $message = "Halo {$client->full_name}, tiket Anda berhasil dibuat!\n\n".
                       "ID Ticket: {$ticket->ticket_number}\n".
                       "Judul: {$ticket->title}\n".
                       "Status: {$ticket->status}\n\n".
                       "Kami akan segera memproses tiket Anda. Terima kasih.";

            $fonnte->sendMessage($client->nohp, $message);
        }

        // Kirim notifikasi WA ke semua Project Manager
        $projectManagers = User::where('role', 'Project Manager')->get();
        foreach ($projectManagers as $pm) {
            if (!empty($pm->phone)) {
                $pmMessage = "📢 Ticket Baru dari Client\n\n".
                             "Nama: {$ticket->name}\n".
                             "Email: {$ticket->email}\n".
                             "Judul: {$ticket->title}\n".
                             "ID Ticket: {$ticket->ticket_number}\n".
                             "Status: {$ticket->status}\n\n".
                             "Mohon segera ditindaklanjuti.";

                $fonnte->sendMessage($pm->phone, $pmMessage);
            }
        }

        // Email notifikasi
        $recipients = [$data['email']];
        $pmEmails   = User::where('role', 'Project Manager')->pluck('email')->toArray();
        $recipients = array_merge($recipients, $pmEmails);

        if (!empty($data['developer_id'])) {
            $developer = User::find($data['developer_id']);
            if ($developer) {
                $recipients[] = $developer->email;
            }
        }

        foreach ($recipients as $recipient) {
            Mail::to($recipient)->send(new TicketCreated($data));
        }

        return redirect()->route('client.tickets.create')
                         ->with('success', 'Tiket berhasil dibuat. Notifikasi telah dikirim.');
    }

    public function showClientTicket($ticket_number)
    {
        $ticket = Ticket::where('ticket_number', $ticket_number)
                        ->where('email', Auth::user()->email)
                        ->firstOrFail();

        $history = TicketHistory::where('ticket_id', $ticket->id)
                    ->with('user')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('dashboards.client.tickets.show', compact('ticket', 'history'));
    }

    public function history()
    {
        $userEmail = Auth::user()->email;

        $tickets = Ticket::with(['project'])
            ->where('email', $userEmail)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboards.client.history', compact('tickets'));
    }

    /**
     * ======================================================
     *                BAGIAN UNTUK DEVELOPER
     * ======================================================
     */
    public function developerTickets(Request $request)
    {
        $developerId = Auth::id();

        $query = Ticket::with(['project', 'developer'])
            ->where('developer_id', $developerId);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        $tickets = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboards.developer.tickets.index', compact('tickets'));
    }

    /**
     * ======================================================
     *          MOVE TICKET KE DEVELOPER (TIDAK UBAH STATUS)
     * ======================================================
     */
    public function moveToDeveloper(Request $request, Ticket $ticket)
    {
        $request->validate([
            'developer_id' => 'required|exists:users,id',
        ]);

        $developer = User::where('role', 'Developer')->findOrFail($request->developer_id);

        $ticket->developer_id = $developer->id;
        $ticket->save();

        TicketHistory::create([
            'ticket_id'   => $ticket->id,
            'user_id'     => Auth::id(),
            'action'      => 'Moved',
            'description' => 'Ticket moved to developer: ' . ($developer->full_name ?? $developer->username ?? $developer->id),
        ]);

        if (!empty($developer->phone)) {
            $fonnte = app(FonnteService::class);
            $pmName = Auth::user()->full_name ?? Auth::user()->name ?? 'Project Manager';

            $message = "📢 *Tiket Baru Ditugaskan*\n\n".
                       "Nomor Ticket : {$ticket->ticket_number}\n".
                       "Judul        : {$ticket->title}\n".
                       "Dipindahkan oleh : {$pmName}\n\n".
                       "Silakan cek sistem untuk detail lebih lanjut.";

            $fonnte->sendMessage($developer->phone, $message);
        } else {
            Log::warning("Developer tidak punya nomor WA", [
                'developer_id' => $developer->id,
            ]);
        }

        return back()->with('success', 'Tiket berhasil dipindahkan ke ' . ($developer->full_name ?? $developer->username ?? $developer->id));
    }
}
