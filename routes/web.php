<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

Route::view('/','home')->name('home');

Route::get('/news',[NewsController::class,'index'])->name('news.index');
Route::get('/news/{news}',[NewsController::class,'show'])->name('news.show');

Route::middleware('guest')->group(function(){
    Route::view('/register','auth.register');
    Route::post('/register',[AuthController::class,'register'])->name('register');

    Route::view('/login','auth.login');
    Route::post('/login',[AuthController::class,'login'])->name('login');
});

Route::middleware('auth')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('user')->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/news', [DashboardController::class, 'userNews'])->name('dashboard.news');
    });

    // News Management Routes
    Route::get('/dashboard/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/dashboard/news', [NewsController::class, 'store'])->name('news.store');
    Route::get('/dashboard/news/edit/{news}', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/dashboard/news/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/dashboard/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');

    //comments
    Route::post('/news/{news}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');


     // Profile Management Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Admin
    Route::middleware('admin')->group(function(){
        Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
        Route::get('/admin/news',[AdminController::class,'news'])->name('admin.news.index');
        Route::post('/admin/news/{news}/publish', [AdminController::class, 'publishNews'])->name('news.publish');
        Route::post('/admin/news/{news}/reject', [AdminController::class, 'rejectNews'])->name('news.reject');

         // Manajemen Kategori
        Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories.index'); // Tampilkan semua kategori
        Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('categories.create'); // Tampilkan form tambah kategori
        Route::post('/admin/categories', [CategoryController::class, 'store'])->name('categories.store'); // Simpan kategori baru
        Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy'); // Hapus kategori

        Route::resource('/admin/users', UserController::class);
    });
});