<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">
                    {{ __('Developer Dashboard') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Ringkasan aktivitas & proyek Anda.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Stat Cards -->
            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-sm text-gray-500">Proyek Aktif</p>
                <h3 class="text-3xl font-bold text-blue-600 mt-2">{{ $activeProjects ?? 0 }}</h3>
            </div>

            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-sm text-gray-500">Tiket Dikerjakan</p>
                <h3 class="text-3xl font-bold text-green-600 mt-2">{{ $inProgressTickets ?? 0 }}</h3>
            </div>

            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-sm text-gray-500">Tiket Selesai</p>
                <h3 class="text-3xl font-bold text-purple-600 mt-2">{{ $completedTickets ?? 0 }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <!-- Greeting -->
            <div class="flex items-center gap-4 mb-6">
                <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-2xl font-bold">
                    {{ strtoupper(substr(Auth::user()->full_name, 0, 1)) }}
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-800">
                        Halo, {{ Auth::user()->full_name }}!
                    </h1>
                    <p class="text-gray-500 text-sm">
                        Selamat datang kembali. Berikut aktivitas terbaru Anda.
                    </p>
                </div>
            </div>

            <!-- Recent Tickets -->
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Tiket Terbaru Anda</h2>
            <table class="w-full text-sm text-left border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-4 py-2">Ticket #</th>
                        <th class="px-4 py-2">Topik</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentTickets ?? [] as $ticket)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $ticket->ticket_number }}</td>
                            <td class="px-4 py-2">{{ $ticket->topic }}</td>
                            <td class="px-4 py-2">
                                <span class="text-xs px-2 py-1 rounded bg-gray-100">
                                    {{ $ticket->status }}
                                </span>
                            </td>
                            <td class="px-4 py-2">{{ $ticket->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">
                                Tidak ada tiket terbaru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Actions -->
            <div class="mt-8 flex gap-4">
                <a href="{{ route('developer.tickets.index') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition">
                    Kelola Tiket
                </a>
                <a href="{{ route('projects') }}"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-5 py-2 rounded-lg shadow transition">
                    Lihat Proyek
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
