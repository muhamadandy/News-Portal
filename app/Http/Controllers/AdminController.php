<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalNews = News::where('status', 'published')->count();


        return view('admin.dashboard', compact('totalNews'));
    }


    public function news(Request $request)
    {
        // Ambil kata kunci dari input pencarian
        $search = $request->input('search');

        // Query berita dengan pencarian berdasarkan judul atau deskripsi
        $news = News::with(['categories', 'user'])
                    ->where('title', 'like', "%{$search}%")
                    ->latest()
                    ->paginate(10);

        // Memastikan query search ikut dalam pagination links
        $news->appends(['search' => $search]);

        return view('admin.news', compact('news', 'search'));
    }

    public function publishNews(News $news)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
        }

        $news->status = 'published';
        $news->save();

        return redirect()->route('news.index')->with('success', 'Berita berhasil dipublish.');
    }

    public function rejectNews(News $news)
    {
        // Pastikan hanya admin yang bisa mengakses
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
        }

        // Ubah status berita menjadi "rejected"
        $news->status = 'rejected';
        $news->save();

        return redirect()->route('news.index')->with('success', 'Berita berhasil ditolak.');
    }
}