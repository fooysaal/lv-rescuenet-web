<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite('resources/css/app.css')
        @livewireStyles
    </head>
    <body class="bg-gray-50 text-gray-800">
        <!-- Navbar -->
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
                <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600">{{ config('app.name', 'RescueNet') }}</a>
                <div class="space-x-6">
                    <a href="#" class="text-gray-700 hover:text-blue-600 font-medium">Home</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 font-medium">About</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 font-medium">Contact</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 font-medium">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium">Login</a>
                    @endauth
                </div>
            </div>
        </nav>
        <!-- Hero Section -->
        <header class="bg-gradient-to-r from-blue-500 to-indigo-600 py-20">
            <div class="max-w-4xl mx-auto text-center text-white">
                <h1 class="text-4xl md:text-6xl font-extrabold mb-4">Welcome to RescueNet</h1>
                <p class="text-lg md:text-2xl mb-8">Connecting communities for faster emergency response.</p>
                <a href="#" class="bg-white text-blue-600 font-semibold px-6 py-3 rounded shadow hover:bg-gray-100 transition">Get Started</a>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 py-12">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t mt-12">
            <div class="max-w-7xl mx-auto px-4 py-6 flex justify-between items-center">
                <span class="text-gray-500">&copy; {{ date('Y') }} RescueNet. All rights reserved.</span>
                <div class="space-x-4">
                    <a href="#" class="text-gray-400 hover:text-blue-600">Privacy</a>
                    <a href="#" class="text-gray-400 hover:text-blue-600">Terms</a>
                </div>
            </div>
        </footer>

        @livewireScripts
    </body>
</html>
