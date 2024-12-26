<x-layout>
    <div class="md:flex justify-between items-center">
        {{-- Tampilkan kategori untuk filter --}}
        <div>
            <ul class="flex flex-wrap gap-4 mb-6 md:mb-0">
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('news.index', ['category' => $category->id]) }}"
                           class="px-4 py-2 rounded-lg text-sm font-medium transition
                                  {{ request('category') == $category->id
                                     ? 'bg-blue-500 text-white shadow-lg'
                                     : 'bg-gray-200 text-gray-700 hover:bg-blue-100 hover:text-blue-500' }}">
                            {{ ucfirst(strtolower($category->name)) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>


        {{-- Form pencarian --}}
        <div>
            <form action="{{ route('news.index') }}" method="GET">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari Berita..."
                    class="px-4 py-2 border-2 rounded-md"
                >
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Cari</button>
            </form>
        </div>
    </div>

    {{-- Section Berita Terbaru --}}
    <div class="mb-12">
        <h2 class="text-2xl font-bold my-8">Berita Terbaru</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($news as $newsItem)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <a href="{{route('news.show',$newsItem)}}">
                        <img src="{{ $newsItem->image }}" alt="{{ $newsItem->title }}" class="w-full h-48 object-cover">
                        <div class="p-2">
                            <p class="text-lg font-bold">{{ $newsItem->title }}</p>
                            <p>{!! Str::limit($newsItem->body, 100, '...') !!}</p>
                        </div>
                        <div class="p-2">
                            @foreach($newsItem->categories as $category)
                                <span class="bg-yellow-700 font-medium text-white rounded-full px-2 py-1">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="my-4">
            {{ $news->links() }}
        </div>
    </div>
</x-layout>
