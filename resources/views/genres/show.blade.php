@extends('layouts.app')

@section('title', 'Detail Genre')

@section('content')
    <h1>{{ $genre['name'] }}</h1>
    <p><strong>ID:</strong> {{ $genre['id'] }}</p>
    <p><strong>Deskripsi:</strong> {{ $genre['description'] }}</p>

    <a class="btn" href="{{ route('genres.index') }}">&larr; Kembali ke daftar genre</a>
@endsection
