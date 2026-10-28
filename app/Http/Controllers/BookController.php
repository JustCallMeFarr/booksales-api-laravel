<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    /**
     * GET /api/books - daftar semua buku beserta genre dan penulisnya.
     */
    public function index(): JsonResponse
    {
        $books = Book::with(['genre', 'author'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar data buku',
            'data' => $books,
        ]);
    }

    /**
     * GET /api/books/{id} - detail satu buku.
     */
    public function show(int $id): JsonResponse
    {
        $book = Book::with(['genre', 'author'])->find($id);

        if ($book === null) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data buku',
            'data' => $book,
        ]);
    }
}
