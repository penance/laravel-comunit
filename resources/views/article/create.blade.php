@extends('layouts.app')

@section('content')

    <div class="page-header">
        <h1>Create an Article | <small>Enrich us!</small></h1>
    </div>
    {!!  Form::open(['route' => 'articles.store']) !!}
        @include('article.partials.form-fields', ['submitButtonText' => 'Create article!'])
    {!! Form::close() !!}

@endsection


@section('headtags')
    <link type="text/css" rel="stylesheet" href="css/article.css"/>
@endsection





