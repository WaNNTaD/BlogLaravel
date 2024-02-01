@extends('base')

@section('title', 'Accueil du blog')

@section('content')
    <h1>Accueil du blog</h1>
    @foreach ($articles as $article)
        <h2>{{ $article->title }}</h2>
        <p class="small">
            @if($article->categorie)
                Catégorie: {{ $article->categorie?->name }}
            @endif
        
            @if(!$article->tags->isEmpty())
                Tags:
                @foreach($article->tags as $tag)
                    <span class='badge bg-secondary'>{{ $tag->name }}</span>
                @endforeach
            @endif
        </p>
        <p>{{ $article->content }}</p>
        <p><a href="{{ route('blog.show', ['slug' => $article->slug, 'article' => $article->id]) }}" class='btn btn-primary'>Lire la suite</a></p>
    @endforeach

    {{ $articles->links() }}
@endsection