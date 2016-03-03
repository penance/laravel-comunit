@extends('layouts.app')

@section('headtags')
    <link type="text/css" rel="stylesheet" href="css/article.css"/>
@endsection

{{-- Populate admin bar --}}
@can('global.create')
    @push('admin-bar')
        <a href="{{route('articles.create')}}" class="btn navbar-btn btn-primary">Create an Article</a>
        <a href="{{route('comments.index')}}" class="btn navbar-btn btn-primary">Manage Comments</a>
    @endpush
@endcan

@section('content')

<div class="page-header">
<h1>COMun's Content |
    <small>Read what is up!</small>
</h1>
</div>

<div class="articles-container">
    @foreach ($articles as $article)
    <a href="{{route('articles.show', ['articles' => $article->slug])}}" class="panel panel-primary" >
        <div class="panel-heading clearfix">
            @can('edit', $article)
                <button  onclick="window.location.href = '{{route('articles.edit', ['articles'=> $article->slug])}}'" class="btn btn-success pull-right">Edit</button>
            @endcan
            @can('delete', $article)
            {!! Form::open(['route' => array('articles.destroy', $article->slug), 'method' => 'delete', 'class' => 'pull-right']) !!}
            <button  type="submit" class="btn btn-danger" style="margin-right: 6px;">Delete</button>
            {!! Form::close() !!}
            @endcan
            <h4>{{$article->title}}</h4>
        </div>
        <div class="panel-body">
            {{$article->intro}}

        </div>
    </a>
    @endforeach
</div>
@endsection








