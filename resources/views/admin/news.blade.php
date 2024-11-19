<x-admin-layout>
    <h1 class="text-3xl font-bold mb-4">Semua Berita</h1>

    <div class="flex justify-between items-center">
        <form method="GET" action="{{ route('admin.news.index') }}" class="mb-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita..." class="border p-2 rounded">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
        </form>
        <div class="flex justify-end items-center my-4">
            <a href="{{ route('news.create') }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 rounded-md text-white">
                Buat Berita
            </a>
        </div>
    </div>

    @if($news->isEmpty())
        <p class="text-gray-600">Tidak ada berita yang tersedia saat ini.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg mb-4">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Title</th>
                        <th class="py-3 px-6 text-left">Body</th>
                        <th class="py-3 px-6 text-left">Image</th>
                        <th class="py-3 px-6 text-center">Status</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light mb-4">
                    @foreach($news as $article)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <!-- Title -->
                            <td class="py-3 px-6 text-left">
                                <span class="font-medium">{{ $article->title }}</span>
                            </td>

                            <!-- Body (limited to 100 characters) -->
                            <td class="py-3 px-6 text-left">
                                <span>{{ Str::limit($article->body, 100) }}</span>
                            </td>

                            <!-- Image -->
                            <td class="py-3 px-6 text-left">
                                @if($article->image)
                                    <img src="{{ $article->image }}" alt="News Image" class="h-12 w-12 rounded-lg object-cover">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>

                            <!-- Status -->
                            <td class="py-3 px-6 text-center">
                                <span class="py-1 px-3 rounded-full text-xs {{ $article->status === 'published' ? 'bg-green-200 text-green-800' : ($article->status === 'review' ? 'bg-yellow-200 text-yellow-800' : 'bg-gray-200 text-gray-800') }}">
                                    {{ ucfirst($article->status) }}
                                </span>
                            </td>

                            <!-- Actions (Review and Delete) -->
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center space-x-4">
                                    <!-- Review Button (only if status is 'review') -->
                                    @if($article->status === 'review')
                                        <a href="{{ route('news.show', $article->id) }}" class="text-blue-600 hover:text-blue-800">
                                            Review
                                        </a>
                                    @endif

                                    <!-- Delete Button -->
                                    <form action="{{ route('news.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this news?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$news->links()}}
        </div>
    @endif
</x-admin-layout>
