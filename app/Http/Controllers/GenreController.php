<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    /**
     * GET /api/genres - daftar semua genre (Read all).
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

    /**
     * POST /api/genres - tambah genre baru (Create).
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $genre = Genre::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Genre berhasil ditambahkan',
            'data' => $genre,
        ], 201);
    }
}
