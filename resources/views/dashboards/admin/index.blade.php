<x-app-layout>
    <x-slot name="header">
        @section('title', 'Dashboard Admin')
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="mx-auto ">
            <!-- Welcome Header -->
            <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        Welcome, {{ Auth::user()->full_name ?? Auth::user()->name ?? 'Guest' }}
                    </h1>
                </div>
            </div>

            <!-- Stat Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                @php
                    $cards = [
                        ['title' => 'Total Tickets', 'value' => 42, 'icon' => 'ticket', 'trend' => 'up', 'change' => '12%'],
                        ['title' => 'Open Tickets', 'value' => 15, 'icon' => 'inbox', 'trend' => 'down', 'change' => '5%'],
                        ['title' => 'Total Clients', 'value' => $clientCount ?? 10, 'icon' => 'users', 'trend' => 'up', 'change' => '8%'],
                        ['title' => 'Total Employees', 'value' => $employeeCount ?? 5, 'icon' => 'user-group', 'trend' => 'steady'],
                    ];
                @endphp

                @foreach($cards as $card)
                <div class="bg-white overflow-hidden shadow rounded-lg transition-all duration-200 hover:shadow-md">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-100 p-3 rounded-full">
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    @if($card['icon'] == 'ticket')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                    @elseif($card['icon'] == 'inbox')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    @elseif($card['icon'] == 'users')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    @endif
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        {{ $card['title'] }}
                                    </dt>
                                    <dd>
                                        <div class="text-2xl font-bold text-gray-900">{{ $card['value'] }}</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        @isset($card['trend'])
                        <div class="mt-4 flex items-center text-sm {{ $card['trend'] == 'up' ? 'text-green-600' : ($card['trend'] == 'down' ? 'text-red-600' : 'text-gray-500') }}">
                            @if($card['trend'] == 'up')
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            @elseif($card['trend'] == 'down')
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            @else
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v8a1 1 0 11-2 0V6a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                            @endif
                            <span class="font-medium">
                                @isset($card['change']) {{ $card['change'] }} @else No change @endisset from last week
                            </span>
                        </div>
                        @endisset
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Recent Activity Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Recent Logins Table -->
                <div class="lg:col-span-2">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Recent Logins (Client & Staff)
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Last 10 active users in the system
                            </p>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Login</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($recentUsers as $index => $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-medium">
                                                        {{ substr($user->full_name ?? $user->name, 0, 1) }}
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $user->full_name ?? $user->name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ in_array($user->role, ['Developer', 'Project Manager', 'QA Master']) ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                                {{ $user->role }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $user->last_login ? \Carbon\Carbon::parse($user->last_login)->format('d M Y, H:i') : 'Never' }}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No recent logins found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div>
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                System Overview
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Key performance indicators
                            </p>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            <div class="space-y-6">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 mb-2">Ticket Status</h4>
                                    <div class="space-y-2">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-500">Open</span>
                                            <span class="text-sm font-medium text-gray-900">15</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-500">In Progress</span>
                                            <span class="text-sm font-medium text-gray-900">8</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-500">Resolved</span>
                                            <span class="text-sm font-medium text-gray-900">19</span>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>