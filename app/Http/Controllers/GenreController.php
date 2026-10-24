<?php

namespace App\Http\Controllers;

use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Tampilkan daftar semua genre.
     */
    public function index()
    {
        $genres = Genre::all();

        return view('genres.index', compact('genres'));
    }

    /**
     * Tampilkan detail satu genre.
     */
    public function show(int $id)
    {
        $genre = Genre::find($id);

        if ($genre === null) {
            abort(404, 'Genre tidak ditemukan');
        }

        return view('genres.show', compact('genre'));
    }
}
