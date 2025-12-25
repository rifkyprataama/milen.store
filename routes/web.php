<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontController;

Route::get('/', [FrontController::class, 'index'])->name('home');

Route::resource('products', ProductController::class);