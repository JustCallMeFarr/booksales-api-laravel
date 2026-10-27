<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['genre', 'author'])->get();

        return view('books.index', compact('books'));
    }

    public function show(int $id)
    {
        $book = Book::with(['genre', 'author'])->findOrFail($id);

        return view('books.show', compact('book'));
    }
}
