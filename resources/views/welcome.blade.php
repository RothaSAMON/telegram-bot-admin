<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Telegram Bot Admin</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#FDFDFC]  min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md p-6 text-center space-y-4">
            <div class="mb-8">
                <a href="/" class="flex justify-center mb-4">
                    <img class="max-w-[100px]" src="https://propuskator.com/wp-content/uploads/2021/06/upravlenie-ustrojstvami-2smart-cloud-s-pomoshhyu-telegram-bota.png" alt="Logo">
                </a>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Telegram Bot Admin</h1>
                <p class="text-gray-500">Manage your Telegram bot interactions</p>
            </div>

            <div class="space-y-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                            class="w-full inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                            class="w-full inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                                class="w-full inline-block px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-100 transition-colors">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </body>
</html>