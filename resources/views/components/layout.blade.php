<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News Portal</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class=" min-h-screen flex flex-col">
    <header class="container flex flex-col">
        <nav class="flex justify-between items-center py-4">
            <!-- Logo -->
            <div>
                <a href="/" class="flex items-center space-x-2">
                    <img src="{{ Vite::asset('resources/images/logo.svg') }}" class="h-8 w-8" alt="News Portal Logo">
                    <span class="text-xl font-bold">BeritaKita</span>
                </a>
            </div>

            <!-- Authentication Links -->
            <div class="space-x-4">
                <x-nav-link href="/news" :active="request()->is('news')">Berita</x-nav-link>
                @guest
                <x-nav-link href="/login" :active="request()->is('login')">Masuk</x-nav-link>
                <x-nav-link href="/register" :active="request()->is('register')">Daftar</x-nav-link>
                @endguest
                @auth
                <a href="{{route('dashboard')}}">{{Auth::user()->name}}</a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container mt-6 ">
        {{$slot}}
    </main>

    <footer class="py-6 mt-auto">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2024 BeritaKita.</p>
        </div>
    </footer>
</body>
</html>
