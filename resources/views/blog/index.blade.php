@extends('base')

@section('title', 'Accueil du blog')

@section('content')
    @foreach ($articles as $article)
        <div class="container mt-4">
            <h2>{{ $article->title }}</h2>
            <p>{{ $article->content }}</p>
        </div>
    @endforeach
@endsection