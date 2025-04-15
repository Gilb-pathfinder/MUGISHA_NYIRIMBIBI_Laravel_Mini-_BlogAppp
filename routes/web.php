<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController as PublicPostController;

// Welcome Route
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Auth Routes
require __DIR__.'/auth.php';

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', AdminPostController::class);
});

// Public Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [PublicPostController::class, 'index'])->name('home');
    Route::get('/posts/{post}', [PublicPostController::class, 'show'])->name('posts.show');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    
    Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('likes.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User routes
    Route::get('/user/check-admin', function () {
        /** @var User $user */
        $user = Auth::user();
        return response()->json([
            'is_admin' => $user->isAdmin()
        ]);
    })->name('user.check-admin');
});
