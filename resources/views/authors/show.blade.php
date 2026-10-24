@extends('layouts.app')

@section('title', 'Detail Author')

@section('content')
    <h1>{{ $author['name'] }}</h1>
    <p><strong>ID:</strong> {{ $author['id'] }}</p>
    <p><strong>Foto:</strong> {{ $author['photo'] }}</p>
    <p><strong>Bio:</strong> {{ $author['bio'] }}</p>

    <a class="btn" href="{{ route('authors.index') }}">&larr; Kembali ke daftar author</a>
@endsection
