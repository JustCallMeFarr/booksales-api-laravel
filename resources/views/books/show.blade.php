@extends('layouts.app')

@section('title', 'Detail Book')

@section('content')
    <h1>{{ $book->title }}</h1>
    <p><strong>ID:</strong> {{ $book->id }}</p>
    <p><strong>Penulis:</strong> <a href="{{ route('authors.show', $book->author->id) }}">{{ $book->author->name }}</a></p>
    <p><strong>Genre:</strong> <a href="{{ route('genres.show', $book->genre->id) }}">{{ $book->genre->name }}</a></p>
    <p><strong>Harga:</strong> Rp {{ number_format($book->price, 0, ',', '.') }}</p>
    <p><strong>Stok:</strong> {{ $book->stock }}</p>
    <p><strong>Cover:</strong> {{ $book->cover_photo }}</p>
    <p><strong>Deskripsi:</strong> {{ $book->description }}</p>

    <a class="btn" href="{{ route('books.index') }}">&larr; Kembali ke daftar book</a>
@endsection
