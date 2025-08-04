<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (in_array($user->role, ['Admin', 'Project Manager'])) {
            $clientCount = Client::count();
            $employeeCount = User::whereIn('role', ['Developer', 'Project Manager', 'QA Master'])->count();

            $recentUsers = User::whereIn('role', ['Client', 'Developer', 'Project Manager', 'QA Master'])
                ->orderByDesc('last_login')
                ->limit(10)
                ->get();

            // Bedakan view untuk Admin dan Project Manager
            $viewPath = $user->role === 'Admin'
                ? 'dashboards.admin.index'
                : 'dashboards.manager.index';

            return view($viewPath, compact('clientCount', 'employeeCount', 'recentUsers'));
        }

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
