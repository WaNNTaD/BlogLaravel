@extends('base')

@section('title', $article->title)

@section('content')
    <h1>{{ $article->title }}</h1>
    <p>{{ $article->content }}</p>
    
    <a class='btn btn-primary' href="{{ route('blog.modify', ['slug'=>$article->slug, 'article' => $article->id]) }}">Modifier</a>
@endsection