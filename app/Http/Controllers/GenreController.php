<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
     * POST /api/genres - tambah genre baru.
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

    /**
     * GET /api/genres/{genre} - detail satu genre beserta bukunya.
     */
    public function show($id): JsonResponse
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
     * PUT/PATCH /api/genres/{genre} - ubah data genre.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $genre = Genre::find($id);

        if ($genre === null) {
            return response()->json([
                'success' => false,
                'message' => 'Genre tidak ditemukan',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $genre->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Genre berhasil diubah',
            'data' => $genre,
        ]);
    }

    /**
     * DELETE /api/genres/{genre} - hapus genre.
     */
    public function destroy($id): JsonResponse
    {
        $genre = Genre::find($id);

        if ($genre === null) {
            return response()->json([
                'success' => false,
                'message' => 'Genre tidak ditemukan',
            ], 404);
        }

        $genre->delete();

        return response()->json([
            'success' => true,
            'message' => 'Genre berhasil dihapus',
        ]);
    }
}
