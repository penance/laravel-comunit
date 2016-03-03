@extends('layouts.app')

@section('headtags')
    <link type="text/css" rel="stylesheet" href="css/comments.css"/>
@endsection

{{-- Populate admin bar --}}
@can('global.create')
    @push('admin-bar')
        <a href="{{route('articles.create')}}" class="btn navbar-btn btn-primary">Create an Article</a>
    @endpush
@endcan
@if (Auth::user()->isAdmin())
    @push('admin-bar')
        <a href="{{route('comments.index')}}" class="btn navbar-btn btn-primary">Manage Comments</a>
    @endpush
@endif

@section('content')




<h3>Article Comments:</h3>
@forelse ($comments as $comment)
    @include ('comment.comment', ['comment' => $comment])
@empty
    <h4>No comments yet! <small>Be the first to comment!</small></h4>
@endforelse

@endsection
