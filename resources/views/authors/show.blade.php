@extends('layouts.app')

@section('title', 'Detail Author')

@section('content')
    <h1>{{ $author->name }}</h1>
    <p><strong>ID:</strong> {{ $author->id }}</p>
    <p><strong>Foto:</strong> {{ $author->photo }}</p>
    <p><strong>Bio:</strong> {{ $author->bio }}</p>

    <h3>Buku karya penulis ini</h3>
    <ul>
        @forelse ($author->books as $book)
            <li><a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a></li>
        @empty
            <li>Belum ada buku.</li>
        @endforelse
    </ul>

    <a class="btn" href="{{ route('authors.index') }}">&larr; Kembali ke daftar author</a>
@endsection
