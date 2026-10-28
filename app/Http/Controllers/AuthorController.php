<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{
    /**
     * GET /api/authors - daftar semua penulis.
     */
    public function index(): JsonResponse
    {
        $authors = Author::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar data penulis',
            'data' => $authors,
        ]);
    }

    /**
     * GET /api/authors/{id} - detail satu penulis beserta bukunya.
     */
    public function show(int $id): JsonResponse
    {
        $author = Author::with('books')->find($id);

        if ($author === null) {
            return response()->json([
                'success' => false,
                'message' => 'Penulis tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data penulis',
            'data' => $author,
        ]);
    }
}
