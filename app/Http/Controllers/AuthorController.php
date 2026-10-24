<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Tampilkan daftar semua penulis.
     */
    public function index()
    {
        $authors = Author::all();

        return view('authors.index', compact('authors'));
    }

    /**
     * Tampilkan detail satu penulis.
     */
    public function show(int $id)
    {
        $author = Author::find($id);

        if ($author === null) {
            abort(404, 'Penulis tidak ditemukan');
        }

        return view('authors.show', compact('author'));
    }
}
