<aside class="w-64 bg-white shadow-md hidden md:block">
    <div class="p-6">
        <!-- Logo -->
        <a href="/news" class="flex items-center space-x-2 mb-6">
            <img src="{{ Vite::asset('resources/images/logo.svg') }}" class="h-8 w-8" alt="BeritaKita Logo">
            <span class="text-xl font-bold">BeritaKita</span>
        </a>

        <!-- Navigation Links -->
        <nav class="space-y-4">
            <x-sidebar-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" text="Dashboard" />
            <x-sidebar-link href="{{route('profile.edit')}}" :active="request()->routeIs('profile')" text="Profile" />
            <x-sidebar-link href="{{route('dashboard.news')}}" :active="request()->routeIs('news.*')" text="News" />
            <form method="POST" action="{{route('logout')}}">
                @csrf
                <button type="submit" class="w-full text-left text-gray-700 hover:bg-gray-100 px-4 py-2 rounded-md">
                    Logout
                </button>
            </form>
        </nav>
    </div>
</aside>
