@extends('layouts.app')

@section('title', 'Detail Genre')

@section('content')
    <h1>{{ $genre->name }}</h1>
    <p><strong>ID:</strong> {{ $genre->id }}</p>
    <p><strong>Deskripsi:</strong> {{ $genre->description }}</p>

    <h3>Buku dalam genre ini</h3>
    <ul>
        @forelse ($genre->books as $book)
            <li><a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a></li>
        @empty
            <li>Belum ada buku.</li>
        @endforelse
    </ul>

    <a class="btn" href="{{ route('genres.index') }}">&larr; Kembali ke daftar genre</a>
@endsection
