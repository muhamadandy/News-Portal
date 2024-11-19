<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = News::with('categories')->where('status', 'published')->latest();

        // Filter by category if selected
        if ($request->has('category')) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        // Search by title or body if search term is provided
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhere('body', 'like', "%$search%");
            });
        }

        $news = $query->get();

        return view('news.index', compact('news', 'categories'));
    }

    public function show(News $news)
    {
        // Mengambil berita terkait berdasarkan kategori yang sama, membatasi 5 berita
        $relatedNews = News::where('status', 'published')
                            ->whereHas('categories', function($q) use ($news) {
                                $q->whereIn('categories.id', $news->categories->pluck('id'));
                            })
                            ->where('id', '!=', $news->id)
                            ->take(5)
                            ->get();

        // Mengambil komentar terkait dengan relasi user
        $comments = $news->comments()->with('user')->get();

        return view('news.show', compact('news', 'relatedNews', 'comments'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|exists:categories,id',
        ]);

        $news = News::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::id(),
            'status' => 'review', // Atur status awal ke 'review'
        ]);

        // Handle image upload jika ada
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('news_images', 'public');
            $news->image = Storage::url($path);
            $news->save();
        }

        // Attach categories
        $news->categories()->attach($request->category);

        return redirect()->route('dashboard.news')->with('success', 'News created successfully and is under review.');
    }

    public function edit(News $news)
    {
        // Pastikan pengguna hanya bisa mengedit berita mereka sendiri
        if ($news->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $categories = Category::all();
        // Karena hanya satu kategori yang dipilih, kita ambil kategori pertama yang terkait
        $selectedCategory = $news->categories->first()->id ?? null;

        return view('news.edit', compact('news', 'categories', 'selectedCategory'));
    }

    public function update(Request $request, News $news)
    {
        // Pastikan pengguna hanya bisa memperbarui berita mereka sendiri
        if ($news->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|exists:categories,id',
        ]);

        $news->title = $request->title;
        $news->body = $request->body;

        // Handle image upload jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($news->image) {
                // Menghapus path '/storage/' dari URL
                $oldImagePath = str_replace('/storage/', '', $news->image);
                Storage::disk('public')->delete($oldImagePath);
            }

            $path = $request->file('image')->store('news_images', 'public');
            $news->image = Storage::url($path);
        }

        // Reset status ke 'review' jika ada perubahan
        $news->status = 'review';
        $news->save();

        // Sync category (hanya satu)
        $news->categories()->sync([$request->category]);

        return redirect()->route('dashboard.news')->with('success', 'News updated successfully and is under review.');
    }

    public function destroy(News $news)
    {
        // Pastikan pengguna hanya bisa menghapus berita mereka sendiri
        if ($news->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Hapus gambar jika ada
        if ($news->image) {
            // Menghapus path '/storage/' dari URL
            $imagePath = str_replace('/storage/', '', $news->image);
            Storage::disk('public')->delete($imagePath);
        }

        // Menghapus relasi pivot
        $news->categories()->detach();

        // Menghapus berita
        $news->delete();

        return redirect()->route('dashboard.news')->with('success', 'News deleted successfully.');
    }
}