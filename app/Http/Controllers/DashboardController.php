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

        // Hanya Admin & Project Manager
        if (in_array($user->role, ['Admin', 'Project Manager'])) {
            // Hitung jumlah clients & employees
            $clientCount = Client::count();
            $employeeCount = User::whereIn('role', ['Developer', 'Project Manager', 'QA Master'])->count();

            // 5 tiket terakhir
            $recentTickets = Ticket::select('ticket_number', 'topic', 'created_at', 'status')
                ->orderByDesc('created_at')
                ->limit(5)
                ->get();

            // Hitung tiket berdasarkan status
            $totalTickets = Ticket::count();
            $openTickets = Ticket::where('status', 'Open')->count();
            $inProgressTickets = Ticket::where('status', 'In Progress')->count();
            $waitInProgressTickets = Ticket::where('status', 'Wait in Progress')->count();
            $passTestTickets = Ticket::where('status', 'Pass Test')->count();
            $resolvedTickets = Ticket::where('status', 'Resolved')->count();
            $closedTickets = Ticket::where('status', 'Closed')->count();

            // --- Hitung Closed Tickets bulan ini & bulan lalu ---
            $closedThisMonth = Ticket::where('status', 'Closed')
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count();

            $closedLastMonth = Ticket::where('status', 'Closed')
                ->whereMonth('created_at', Carbon::now()->subMonth()->month)
                ->whereYear('created_at', Carbon::now()->subMonth()->year)
                ->count();

            // --- Hitung persentase perubahan ---
            if ($closedLastMonth === 0) {
                $changePercent = null; // Bisa tampilkan N/A
                $trend = 'steady';
            } else {
                $changePercent = round((($closedThisMonth - $closedLastMonth) / $closedLastMonth) * 100, 1);
                $trend = $changePercent >= 0 ? 'up' : 'down';
                $changePercent .= '%';
            }

            // --- Data statistik ---
            $stats = [
                [
                    'title' => 'Total Tickets',
                    'value' => $totalTickets, // tetap total semua tiket
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

            // Tentukan view sesuai role
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

        // Views untuk role lainnya
        $roleViews = [
            'Client' => 'dashboards.client.index',
            'Developer' => 'dashboards.developer.index',
            'QA Master' => 'dashboards.qa.index',
        ];

        if (!isset($roleViews[$user->role])) {
            abort(403, 'Unauthorized role.');
        }

        return view($roleViews[$user->role]);
    }
}
