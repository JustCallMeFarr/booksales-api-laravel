<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\JsonResponse;

class GenreController extends Controller
{
    /**
     * GET /api/genres - daftar semua genre.
     */
    public function index(): JsonResponse
    {
        $genres = Genre::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar data genre',
            'data' => $genres,
        ]);
    }

    /**
     * GET /api/genres/{id} - detail satu genre beserta bukunya.
     */
    public function show(int $id): JsonResponse
    {
        $genre = Genre::with('books')->find($id);

        if ($genre === null) {
            return response()->json([
                'success' => false,
                'message' => 'Genre tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data genre',
            'data' => $genre,
        ]);
    }
}
