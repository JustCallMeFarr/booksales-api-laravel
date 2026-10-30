<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
     * POST /api/authors - tambah penulis baru.
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

    /**
     * GET /api/authors/{author} - detail satu penulis beserta bukunya.
     */
    public function show($id): JsonResponse
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
     * PUT/PATCH /api/authors/{author} - ubah data penulis.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $author = Author::find($id);

        if ($author === null) {
            return response()->json([
                'success' => false,
                'message' => 'Penulis tidak ditemukan',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'photo' => 'nullable|string|max:255',
            'bio' => 'sometimes|required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $author->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Penulis berhasil diubah',
            'data' => $author,
        ]);
    }

    /**
     * DELETE /api/authors/{author} - hapus penulis.
     */
    public function destroy($id): JsonResponse
    {
        $author = Author::find($id);

        if ($author === null) {
            return response()->json([
                'success' => false,
                'message' => 'Penulis tidak ditemukan',
            ], 404);
        }

        $author->delete();

        return response()->json([
            'success' => true,
            'message' => 'Penulis berhasil dihapus',
        ]);
    }
}
