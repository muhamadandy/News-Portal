<x-dashboard-layout>
    <div class="px-6 py-8 min-h-screen">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Dasbor</h1>
        </div>

        <!-- Statistik Utama -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Total Berita -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Berita Anda</h2>
                <p class="text-3xl font-bold text-blue-600">{{$totalNews}}</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('news.create') }}"
                   class="px-4 py-2 bg-blue-500 text-white font-medium rounded-md shadow hover:bg-blue-600">
                    + Tambah Berita Baru
                </a>
                <a href="{{ route('news.index') }}"
                   class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-md shadow hover:bg-gray-300">
                    Lihat Semua Berita
                </a>
            </div>
        </div>

    </div>
</x-dashboard-layout>
