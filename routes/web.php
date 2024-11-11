<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\PrimerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', [PrimerController::class, 'index']);
Route::get('otro/{post}/{otro}', [PrimerController::class, 'otro']);

// Route::resource('post', PrimerController::class);
// Route::resource('category', PrimerController::class)->only('index','show','store');



Route::group(['prefix' => 'dashboard'], function () {
    Route::resource('post', PostController::class);
    Route::resource('category', CategoryController::class);
});
