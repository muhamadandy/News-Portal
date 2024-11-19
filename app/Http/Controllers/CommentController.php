<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, News $news)
{
    $request->validate([
        'comment' => 'required|string|max:1000',
    ]);

    // Cek apakah pengguna sudah pernah mengomentari berita ini
    if ($news->comments()->where('user_id', Auth::id())->exists()) {
        return redirect()->route('news.show', $news->id)->with('error', 'Anda hanya dapat memberikan satu komentar untuk setiap berita.');
    }

    Comment::create([
        'user_id' => Auth::id(),
        'news_id' => $news->id,
        'body' => $request->comment,
    ]);

    return redirect()->route('news.show', $news->id)->with('success', 'Komentar berhasil ditambahkan.');
}


    public function destroy(Comment $comment)
    {
        // Pastikan pengguna hanya bisa menghapus komentarnya sendiri
        if ($comment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return redirect()->route('news.show', $comment->news_id)->with('success', 'Komentar berhasil dihapus.');
    }
}