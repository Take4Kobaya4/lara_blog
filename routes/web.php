<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 投稿におけるCRUD処理のルートを設定するために設置
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // ユーザーであれば、投稿できるようにルートを設定
    Route::resource('/posts', PostController::class);
});

require __DIR__.'/auth.php';
