<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to My Application</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <h1 class="text-4xl font-bold mb-6">Welcome to My Application</h1>
        
        <div class="space-y-2 text-center">
            <p>BN5</p>
            <p>23B PM</p>
            <p>7/21/2025</p>
        </div>

        <div class="mt-8">
            @if (Route::has('login'))
                <div class="flex space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</body>
</html>