
<x-layout>
    <div class="flex flex-col lg:flex-row justify-between items-center min-h-screen p-8">
        <!-- Konten Utama -->
        <div class="lg:w-1/2 mb-8 lg:mb-0">
            <h1 class="text-5xl md:text-7xl font-extrabold text-gray-800">Selamat Datang di <span class="text-blue-600">BeritaKita</span></h1>
            <p class="mt-4 text-xl text-gray-600">
                Platform berita terpercaya yang memungkinkan Anda untuk membaca, dan menciptakan berita terbaru. Bergabunglah dengan komunitas kami dan jadilah bagian dari berita yang menginspirasi.
            </p>
            <div class="mt-6 flex space-x-4">
                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition">
                    Daftar Sekarang
                </a>
                <a href="{{url('/news')}}" class="bg-gray-200 text-gray-800 px-6 py-3 rounded-md hover:bg-gray-300 transition">
                    Mulai Membaca
                </a>
            </div>
        </div>

        <!-- Gambar Hero -->
        <div class="lg:w-1/2">
            <img src="{{ Vite::asset('resources/images/hero.jpg') }}" alt="Ilustrasi Berita" class="w-full">
        </div>
    </div>

</x-layout>
