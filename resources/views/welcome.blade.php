<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="flex items-center justify-center min-h-screen bg-blue-600">
        <div class="text-center text-white rounded p-7">
            @if (session('message'))
                <p class="text-2xl font-semibold">{{ session('message') }}</p>
            @else
                <p class="text-2xl font-semibold">Welcome to the system!</p>
            @endif
            
            @auth
                <form method="POST" action="{{ route('logout') }}" class="mt-6">
                    @csrf
                    <button type="submit" class="px-6 py-2 font-semibold text-white bg-red-600 rounded hover:bg-red-700">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>

</body>

</html>