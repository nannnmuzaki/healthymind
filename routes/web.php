<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogPostController;

Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/dashboard/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/dashboard/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/post', [BlogPostController::class, 'index'])->name('post.index');
    Route::get('/dashboard/post/create', [BlogPostController::class, 'create'])->name('post.create');
    Route::post('/dashboard/post', [BlogPostController::class, 'store'])->name('post.store');
    Route::get('/dashboard/post/{post}/edit', [BlogPostController::class, 'edit'])->name('post.edit');
    Route::put('/dashboard/post/{post}', [BlogPostController::class, 'update'])->name('post.update');
    Route::delete('/dashboard/post/{post}', [BlogPostController::class, 'destroy'])->name('post.destroy');
});

Route::get('/blog', [BlogPostController::class, 'viewAll'])->name('blog.index');
Route::get('/blog/post/{post}', [BlogPostController::class, 'show'])->name('post.show');

require __DIR__.'/auth.php';
