<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            {{ __('Developer Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10 px-4">
        <div class="bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-4">Halo, {{ Auth::user()->full_name }}!</h1>

            <p class="text-gray-700">
                Selamat datang di dashboard Developer. Di sini Anda bisa melihat proyek yang ditugaskan,
                progress, dan melakukan update terkait tugas Anda.
            </p>

            <div class="mt-6">
                <a href="{{ route('projects') }}"
                   class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Lihat Proyek Anda
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
