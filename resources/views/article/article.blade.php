@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>{{$article->title}} | <small>By {{$article->author->name}}.</small></h1>
        @can('edit', $article)
        <a class="btn btn-success" href="{{route('articles.edit', ['articles' => $article->slug])}}">Edit Content</a>
        @endcan
    </div>

    <div class="article-container">
        {{$article->content}}
    </div>
    <div class="comment-section">
        <br><hr><br>
        @include ('comment.comments')
    </div>
@endsection


@section('headtags')
    <link type="text/css" rel="stylesheet" href="css/article.css"/>
@endsection





