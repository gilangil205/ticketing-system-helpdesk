<x-guest-layout>
    <div class="max-w-md mx-auto mt-8 bg-white dark:bg-gray-800 shadow-md rounded-2xl p-6">
        <!-- Judul -->
         @section('title', 'Forgot Password')

        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 text-center mb-2">
            Forgot Password?
        </h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-6">
            Enter your registered email address and we'll send you a link to reset your password.
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Form -->
        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email Address')" />
                <x-text-input 
                    id="email" 
                    class="block w-full mt-1" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    placeholder="you@example.com"
                    required 
                    autofocus 
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center mt-6">
                <x-primary-button class="w-full justify-center">
                    {{ __('Send Reset Link') }}
                </x-primary-button>
            </div>

            <!-- Back to login -->
            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 underline">
                    Back to Login
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
