<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        return view('user.dashboard');
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