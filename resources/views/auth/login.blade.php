<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - IT Support Center</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .right-panel {
            background-image: url('/images/logo_login.png');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="font-sans antialiased h-full m-0 p-0">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Left Column - Login Form -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                <!-- Header - Exactly matches your image -->
                <div class="mb-8">
                    <p class="text-xl text-gray-700">Welcome to</p>
                    <h1 class="text-2xl font-bold text-gray-800">IT Support Center!</h1>
                    <p class="mt-2 text-gray-600">Please login to your account.</p>
                </div>

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <input name="login" type="text" required autofocus
                                value="{{ old('login') }}"
                                class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-300"
                                placeholder="Email atau Username">
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <!-- Lock Icon -->
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            
                            <!-- Password Input -->
                            <input id="password" name="password" type="password" required
                                class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-300"
                                placeholder="">
                            
                            <!-- Eye Toggle Icon -->
                            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg id="eye-icon" class="h-5 w-5 text-gray-400 hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember + Forgot -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center text-sm text-gray-600">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600">
                            <span class="ml-2">Remember Me</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="text-sm text-blue-600">Forget Password?</a>
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 mt-4">
                        Login
                    </button>
                </form>
            </div>
        </div>

        <!-- Right Column - Image -->
        <div class="hidden md:block md:w-1/2 relative right-panel">
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
                                    
            if (passwordInput.type === 'password') {
             passwordInput.type = 'text';
             eyeIcon.innerHTML = `
             <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
             <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                `;
            } else {
            passwordInput.type = 'password';
             eyeIcon.innerHTML = `
             <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
             `;
             }
         }
    </script>
</body>
</html>