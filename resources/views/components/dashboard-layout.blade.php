{{-- dashboard layout --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/ac4a83189a.js" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-white shadow-md  md:block">
            <div class="p-6">
                <!-- Logo -->
                <a href="/news" class="flex items-center space-x-2 mb-6">
                    <img src="{{ Vite::asset('resources/images/logo.svg') }}" class="h-8 w-8" alt="BeritaKita Logo">
                    <span class="text-xl font-bold">BeritaKita</span>
                </a>

                <!-- Navigation Links -->
                <nav class="space-y-4">
                    <x-sidebar-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" text="Dasbor" />
                    <x-sidebar-link href="{{route('profile.edit')}}" :active="request()->routeIs('profile')" text="Profil" />
                        @if (Auth::check() && Auth::user()->role === 'admin')
                            <x-sidebar-link href="{{ route('users.index') }}" :active="request()->routeIs('users')" text="Pengguna" />
                            <x-sidebar-link href="{{route('admin.news.index')}}" :active="request()->routeIs('news.*')" text="Berita" />
                            <x-sidebar-link href="{{ route('categories.index') }}" :active="request()->routeIs('categories')" text="Kategori" />
                        @else
                            <x-sidebar-link href="{{route('dashboard.news')}}" :active="request()->routeIs('news.*')" text="Berita" />
                        @endif
                    <form method="POST" action="{{route('logout')}}">
                        @csrf
                        <button type="submit" class="w-full text-left text-gray-700 hover:bg-gray-100 px-4 py-2 rounded-md">
                            Keluar
                        </button>
                    </form>
                </nav>
            </div>
        </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-6 overflow-auto">
        {{ $slot }}
    </main>
    </div>

    <script src="https://cdn.ckeditor.com/4.25.0-lts/standard/ckeditor.js"></script>


</body>
</html>
