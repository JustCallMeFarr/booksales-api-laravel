<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use Illuminate\Support\Facades\Route;

// Semua route di file ini otomatis diawali /api (contoh: /api/books)

// Book (baru Read: index dan show)
Route::apiResource('books', BookController::class)->only(['index', 'show']);

// Genre: index, store, show, update, destroy
Route::apiResource('genres', GenreController::class);

// Author: index, store, show, update, destroy
Route::apiResource('authors', AuthorController::class);
