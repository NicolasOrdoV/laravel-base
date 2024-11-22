<?php

use App\Http\Controllers\blog\BlogController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserAccessDashboardMiddleware;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', UserAccessDashboardMiddleware::class]], function (){
    Route::resources([
        'post' => PostController::class,
        'category' => CategoryController::class
    ]);
    Route::get('', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');
});

Route::group(['prefix' => 'blog'], function (){
    Route::get('', [BlogController::class, 'index']);
    Route::get('detail/{post}', [BlogController::class, 'show'])->name('blog.show');
});
require __DIR__.'/auth.php';
