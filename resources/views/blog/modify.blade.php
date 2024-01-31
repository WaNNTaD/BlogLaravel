@extends('base')

@section('title', 'Modifier article ' . $article->id)


@section('content')

    @include('blog.formArticle')

@endsection