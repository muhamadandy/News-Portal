
<x-layout>
    @if(session('error'))
    <div class="bg-red-500 text-white p-4 rounded">
        {{ session('error') }}
    </div>
    @endif


    <div class="flex bg-gray-100 items-center">
        @if (Auth::check() && Auth::user()->role === 'admin')
            @if ($news->status !== 'published')
                <div class=" p-4">
                    <form action="{{ route('news.publish', $news->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 rounded-md text-white font-bold px-4 p-2">
                            Publish
                        </button>
                    </form>
                </div>
            @endif

            @if ($news->status !== 'rejected' && $news->status !== 'published')
                <div class=" p-4 mt-2">
                    <form action="{{ route('news.reject', $news->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 rounded-md text-white font-bold px-4 p-2">
                            Reject
                        </button>
                    </form>
                </div>
            @endif
        @endif
    </div>



    <div class="grid md:grid-cols-3 gap-8 mt-8">
        <div class=" col-span-2">
            {{-- Penerbit dan Image --}}
            <div class="mb-6">
                <h1 class="text-3xl font-bold mb-4">{{ $news->title }}</h1>
                <div class="flex items-center space-x-4">
                    <div>
                        <p class="font-semibold">{{ $news->user->name}}</p>
                        <p class="text-gray-600 text-sm">{{ $news->created_at->format('d M Y') }}</p>
                    </div>
                </div>
                <img src="{{ $news->image }}" alt="{{ $news->title }}" class="w-full mt-6 rounded-lg">
            </div>

            {{-- Konten --}}
            <div class="prose max-w-none">
                {!! nl2br(e($news->body)) !!}
            </div>
        </div>

        <aside class="p-6 rounded-lg">
            {{-- Berita Terkait --}}
            <h2 class="text-xl font-semibold mb-4">Berita Terkait</h2>
            <ul>
                @foreach ($relatedNews as $related)
                <li class="mb-4">
                    <a href="{{ route('news.show', $related->id) }}" class="block hover:bg-gray-200 p-2 rounded">
                        <div class="flex items-center space-x-4">
                            <img src="{{ $related->image }}" alt="{{ $related->title }}" class="w-16 h-16 object-cover rounded">
                            <div>
                                <span class="text-gray-800 font-semibold">{{ Str::limit($related->title, 50, '...') }}</span>
                                <p class="text-gray-600 text-sm">{{ $related->user->name }}</p>
                                <p class="text-gray-500 text-xs">{{ $related->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
                @if($relatedNews->isEmpty())
                    <li class="text-gray-600">Tidak ada berita terkait.</li>
                @endif
            </ul>
        </aside>
    </div>

    {{-- Komentar --}}
    <div class="my-12">
        <h2 class="text-2xl font-bold mb-6">Komentar</h2>

        {{-- Tampilkan nama user dan komentar --}}
<div class="space-y-4 mb-6">
    @forelse ($comments as $comment)
        <div class="flex justify-between items-center">
            <div>
                <p class="font-semibold">{{ $comment->user->name }}</p>
                <p class="text-gray-700">{{ $comment->body }}</p>
                <p class="text-gray-500 text-sm">{{ $comment->created_at->locale('id')->diffForHumans() }}</p>
            </div>
            @if(Auth::check() && Auth::id() == $comment->user_id)
                <div>
                    {{-- Form Delete Komentar --}}
                    <form action="{{ route('comments.destroy', ['news' => $news->id, 'comment' => $comment->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus komentar ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Delete</button>
                    </form>
                </div>
            @endif
        </div>
    @empty
        <p class="text-gray-600">Belum ada komentar.</p>
    @endforelse
</div>


        {{-- Form Komentar --}}
        @auth
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4">Tambahkan Komentar</h3>
                <form action="{{ route('comments.store', $news->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <textarea name="comment" rows="4" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tulis komentar Anda...">{{ old('comment') }}</textarea>
                        @error('comment')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Kirim Komentar</button>
                </form>
            </div>
        @else
            <p class="text-gray-600">Silakan <a href="{{route('login')}}" class="text-blue-500 underline">login</a> untuk menambahkan komentar.</p>
        @endauth
    </div>
</x-layout>
