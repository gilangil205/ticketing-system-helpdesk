<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            {{ __('QA Master Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10 px-4">
        <div class="bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-4">Selamat datang, {{ Auth::user()->full_name }}!</h1>
            <p class="text-gray-700">
                Ini adalah dashboard QA Master. Anda dapat mengawasi hasil pengujian proyek, validasi bug, dan memberikan persetujuan QA.
            </p>

            <div class="mt-6">
                <a href="{{ route('projects') }}"
                   class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                    Cek Proyek yang Diuji
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
