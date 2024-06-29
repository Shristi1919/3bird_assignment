<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome to 3Bird Assignment</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 dark:bg-gray-900">
    <div class="relative flex items-top justify-center min-h-screen">
        <div class="absolute top-0 right-0 px-6 py-4">
            @auth
                <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
            @else
                <a href="{{ route('login') }}"
                    class="ml-4 inline-flex items-center px-4 py-2 bg-blue-500 border
                    border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest
                    hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300
                    disabled:opacity-25 transition ease-in-out duration-150">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="ml-4 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Register
                    </a>
                @endif
                @endif
            </div>

            <div class="flex items-center justify-center h-full">
                <div class="text-center mt-5">
                    <h1 class="text-4xl font-bold mb-4">Welcome to 3Bird Assignment</h1>
                    <p class="text-lg text-gray-700">Please login if you have an account or register to get started.</p>
                </div>
            </div>
        </div>
    </body>

    </html>
