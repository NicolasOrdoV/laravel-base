<?php

use App\Http\Controllers\PrimerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', [PrimerController::class, 'index']);
Route::get('otro/{post}/{otro}', [PrimerController::class, 'otro']);

// Route::resource('post', PrimerController::class);
// Route::resource('category', PrimerController::class)->only('index','show','store');
