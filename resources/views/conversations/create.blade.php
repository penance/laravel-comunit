@extends('layouts.app')

@section('headtags')
    <link type="text/css" rel="stylesheet" href="css/conversations.css"/>
@endsection


@section('content')

<div class="page-header clearfix">
<h1 class="">Start a conversation |
    <small>Select douches, and add water!</small>
    <a class="btn btn-warning pull-right" href="{{route('conversations.index')}}">Nah (cancel)</a>
</h1>
</div>

    <div class="conversation-create-wrap">
        {!!  Form::open(['route' => 'conversations.store', 'method' => 'post', 'class'=> 'form'])!!}

        @include('common.form.form-errors')
        @include('common.form.selectUsersField')

        <div class="form-group">
            <button class="btn btn-primary" type="submit">Start the conversation!</button>
        </div>
        {!!  Form::close() !!}
    </div>


@endsection








