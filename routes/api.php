<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// Semua route di file ini otomatis diawali /api (contoh: /api/books)

/*
|--------------------------------------------------------------------------
| Autentikasi
|--------------------------------------------------------------------------
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/me', [AuthController::class, 'me']);
Route::post('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| Route publik: Read All dan Show (bisa diakses siapa saja, tanpa login)
|--------------------------------------------------------------------------
*/
Route::apiResource('books', BookController::class)->only(['index', 'show']);
Route::apiResource('genres', GenreController::class)->only(['index', 'show']);
Route::apiResource('authors', AuthorController::class)->only(['index', 'show']);

/*
|--------------------------------------------------------------------------
| Route khusus admin: Create, Update, Destroy
|--------------------------------------------------------------------------
| Dilindungi AdminMiddleware: harus login (token) dan role-nya admin.
*/
Route::middleware(AdminMiddleware::class)->group(function () {
    Route::apiResource('genres', GenreController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('authors', AuthorController::class)->only(['store', 'update', 'destroy']);
});
