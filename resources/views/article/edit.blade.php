@extends('layouts.app')

@section('content')

    <div class="page-header">
        <h1>Edit | <small>{{$article->title}}.</small></h1>
        <a class="btn btn-danger" href="{{route('articles.index')}}">Nah (cancel)...</a>
    </div>

    {!!  Form::model($article, ['method' => 'PATCH', 'action' => ['ArticlesController@update', $article->slug]]) !!}
        @include('article.partials.form-fields', ['submitButtonText' => 'Update article'])
    {!! Form::close() !!}
@endsection


@section('headtags')
    <link type="text/css" rel="stylesheet" href="css/article.css"/>
@endsection





