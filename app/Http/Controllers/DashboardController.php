<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 🔹 Hanya untuk Admin & Project Manager
        if (in_array($user->role, ['Admin', 'Project Manager'])) {
            $clientCount = Client::count();
            $employeeCount = User::whereIn('role', ['Developer', 'Project Manager', 'QA Master'])->count();

            $recentTickets = Ticket::select('ticket_number', 'topic', 'created_at', 'status')
                ->orderByDesc('created_at')
                ->limit(5)
                ->get();

            $totalTickets = Ticket::count();
            $openTickets = Ticket::where('status', 'Open')->count();
            $inProgressTickets = Ticket::where('status', 'In Progress')->count();
            $waitInProgressTickets = Ticket::where('status', 'Wait in Progress')->count();
            $passTestTickets = Ticket::where('status', 'Pass Test')->count();
            $resolvedTickets = Ticket::where('status', 'Resolved')->count();
            $closedTickets = Ticket::where('status', 'Closed')->count();

            $closedThisMonth = Ticket::where('status', 'Closed')
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count();

            $closedLastMonth = Ticket::where('status', 'Closed')
                ->whereMonth('created_at', Carbon::now()->subMonth()->month)
                ->whereYear('created_at', Carbon::now()->subMonth()->year)
                ->count();

            if ($closedLastMonth === 0) {
                $changePercent = null;
                $trend = 'steady';
            } else {
                $changePercent = round((($closedThisMonth - $closedLastMonth) / $closedLastMonth) * 100, 1);
                $trend = $changePercent >= 0 ? 'up' : 'down';
                $changePercent .= '%';
            }

            $stats = [
                [
                    'title' => 'Total Tickets',
                    'value' => $totalTickets,
                    'icon' => 'ticket',
                    'trend' => $trend,
                    'change' => $changePercent
                ],
                [
                    'title' => 'Open Tickets',
                    'value' => $openTickets,
                    'icon' => 'inbox',
                    'trend' => 'down'
                ],
                [
                    'title' => 'Total Clients',
                    'value' => $clientCount,
                    'icon' => 'users',
                    'trend' => 'up'
                ],
                [
                    'title' => 'Total Employees',
                    'value' => $employeeCount,
                    'icon' => 'user-group',
                    'trend' => 'steady'
                ],
            ];

            $viewPath = $user->role === 'Admin'
                ? 'dashboards.admin.index'
                : 'dashboards.manager.index';

            return view($viewPath, compact(
                'clientCount',
                'employeeCount',
                'recentTickets',
                'totalTickets',
                'openTickets',
                'inProgressTickets',
                'waitInProgressTickets',
                'passTestTickets',
                'resolvedTickets',
                'closedTickets',
                'stats'
            ));
        }

        // 🔹 Views untuk role lain
        $roleViews = [
            'Client' => 'dashboards.client.index',
            'Developer' => 'dashboards.developer.index',
            'QA Master' => 'dashboards.qa.index',
        ];

        if (!isset($roleViews[$user->role])) {
            abort(403, 'Unauthorized role.');
        }

        // 🔹 Dashboard Client
        if ($user->role === 'Client') {
            $tickets = Ticket::where('user_id', $user->id)
                ->orderByDesc('created_at')
                ->get();

            $openTickets = Ticket::where('user_id', $user->id)->where('status', 'Open')->count();
            $closedTickets = Ticket::where('user_id', $user->id)->where('status', 'Closed')->count();
            $totalTickets = Ticket::where('user_id', $user->id)->count();

            return view($roleViews[$user->role], compact(
                'tickets',
                'openTickets',
                'closedTickets',
                'totalTickets'
            ));
        }

        // 🔹 Untuk Developer & QA (sementara hanya view kosong)
        return view($roleViews[$user->role]);
    }
}
