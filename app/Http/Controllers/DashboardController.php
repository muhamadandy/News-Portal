<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil ID pengguna yang sedang login
        $userId = Auth::id();

        // Menghitung jumlah berita yang dimiliki oleh pengguna tersebut
        $totalNews = News::where('user_id', $userId)->count();

        return view('user.dashboard', compact('totalNews'));
    }


    public function userNews(Request $request)
{
    // Mengambil user_id dari pengguna yang sedang login
    $userId = Auth::id();

    // Mengambil berita yang dibuat oleh user tersebut dengan pagination
    $news = News::where('user_id', $userId)
                ->latest()
                ->paginate(10);

    return view('user.news', compact('news'));
}
}