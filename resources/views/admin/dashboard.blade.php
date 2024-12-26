<x-admin-layout>
    <div class="px-6 py-8 min-h-screen">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Dasbor</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Berita</h2>
                <p class="text-3xl font-bold text-blue-600">{{ $totalNews }}</p>
            </div>
        </div>
        </div>
    </div>
</x-admin-layout>
