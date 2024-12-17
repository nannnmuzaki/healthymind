<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\TherapyScheduleController;
use App\Http\Controllers\TherapySessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MediaController;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/therapy-schedule/', [TherapyScheduleController::class, 'manageSchedule'])->name('schedule.manage');
    Route::get('/dashboard/therapy-schedule/create', [TherapyScheduleController::class, 'createSchedule'])->name('schedule.create');
    Route::post('/dashboard/therapy-schedule', [TherapyScheduleController::class, 'storeSchedule'])->name('schedule.store');
    Route::get('/dashboard/therapy-schedule/{schedule}/edit', [TherapyScheduleController::class, 'editSchedule'])->name('schedule.edit');
    Route::put('/dashboard/therapy-schedule/{schedule}', [TherapyScheduleController::class, 'updateSchedule'])->name('schedule.update');
    Route::delete('/dashboard/therapy-schedule/{schedule}', [TherapyScheduleController::class, 'destroySchedule'])->name('schedule.destroy');
    Route::patch('/dashboard/therapy-schedule/{schedule}/toggle', [TherapyScheduleController::class, 'toggleScheduleStatus'])->name('schedule.toggleStatus');
});

Route::get('/therapy', [TherapyScheduleController::class, 'index'])->name('schedule.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/therapy-session', [TherapySessionController::class, 'index'])->name('session.index');
    Route::delete('/dashboard/therapy-session/{session}', [TherapySessionController::class, 'destroy'])->name('session.destroy');
    Route::patch('/dashboard/therapy-session/{session}/toggle-is-paid', [TherapySessionController::class, 'toggleIsPaid'])->name('session.toggleIsPaid');
});

Route::get('/therapy', [TherapyScheduleController::class, 'index'])->name('therapy.index');
Route::post('/therapy/{id}', [TherapySessionController::class, 'book'])->name('therapy.book');

Route::get('/dashboard/media', [MediaController::class, 'index'])->name('media.index');
Route::post('/dashboard/media/upload', [MediaController::class, 'upload'])->name('media.upload');
Route::delete('/dashboard/media/{media}', [MediaController::class, 'destroy'])->name('media.destroy'); 

require __DIR__.'/auth.php';
