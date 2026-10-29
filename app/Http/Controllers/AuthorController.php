<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    /**
     * GET /api/authors - daftar semua penulis (Read all).
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

    /**
     * POST /api/authors - tambah penulis baru (Create).
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'photo' => 'nullable|string|max:255',
            'bio' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $author = Author::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Penulis berhasil ditambahkan',
            'data' => $author,
        ], 201);
    }
}
