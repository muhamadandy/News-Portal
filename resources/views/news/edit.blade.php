{{-- resources/views/news/edit.blade.php --}}
<x-dashboard-layout>
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-6">Edit Berita</h1>

        @if(session('success'))
            <div class="mb-4 text-green-500">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('news.update', $news->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-semibold mb-2">Title</label>
                <input id="title" type="text" name="title" value="{{ old('title', $news->title) }}" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('title') border-red-500 @enderror">

                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Body --}}
            <div class="mb-4">
                <label for="body" class="block text-gray-700 font-semibold mb-2">Body</label>
                <textarea id="body" name="body" rows="6" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('body') border-red-500 @enderror">{{ old('body', $news->body) }}</textarea>

                @error('body')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Current Image --}}
            @if($news->image)
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Current Image</label>
                    <img src="{{ $news->image }}" alt="{{ $news->title }}" class=" size-24 object-cover rounded">
                </div>
            @endif

            {{-- Image --}}
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-semibold mb-2">Change Image (optional)</label>
                <input id="image" type="file" name="image"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('image') border-red-500 @enderror">

                @error('image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Category --}}
            <div class="mb-4">
                <label for="category" class="block text-gray-700 font-semibold mb-2">Category</label>
                <select id="category" name="category" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('category') border-red-500 @enderror">
                    <option value="">-- Select a Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category', $selectedCategory) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                @error('category')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Tombol Update --}}
            <div class="mt-6">
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                    Update News
                </button>
            </div>
        </form>
    </div>
</x-dashboard-layout>
