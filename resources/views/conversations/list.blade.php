@extends('layouts.app')

@section('headtags')
    <link type="text/css" rel="stylesheet" href="css/conversations.css"/>
@endsection


@section('content')

<div class="page-header clearfix">
<h1 class="">Your conversations |
    <small>Time to dig!</small>
    <a class="btn btn-primary pull-right " href="{{route('conversations.create')}}">Start a Conversation</a>
</h1>

</div>

<div class="conversations-container">
    @forelse ($conversations as $conversation)
    <a href="{{route('conversations.show', ['conversations' => $conversation->id])}}" class="panel panel-primary clearfix" style="display: block; text-decoration: none;" >
        <div class="panel-heading clearfix">
            @if (Auth::user()->isAdmin() == true)
                {!! Form::open(['route' => array('conversations.destroy', $conversation->id), 'method'=>'delete', 'class' => 'pull-right']) !!}
                <button type="submit" class="btn btn-danger pull-right">Delete Conversation</button>
                {!! Form::close() !!}
            @endif
            <h4>
                {{ implode(', ', $conversation->users->lists('name')->toArray()) }}
            </h4>
        </div>
        <div class="panel-body">
            > last message
        </div>
    </a>
    @empty
        <h3>You has no conversations yet.</h3>
        <a class="btn btn-primary" href="{{route('conversations.create')}}">Start a Conversation</a>
    @endforelse
</div>

@if (Auth::user()->isAdmin() == true)
    <br>
    <hr>
    <br>
    <h1>Welcome admin. Herer are all the conversations on the site:</h1>
    <div class="conversations-container">
        @forelse ($allConversations as $conversation)
            <a href="{{route('conversations.show', ['conversations' => $conversation->id])}}" class="panel panel-primary clearfix" style="display: block; text-decoration: none;" >
                <div class="panel-heading clearfix">
                    @if (Auth::user()->isAdmin() == true)
                        {!! Form::open(['route' => array('conversations.destroy', $conversation->id), 'method'=>'delete', 'class' => 'pull-right']) !!}
                        <button type="submit" class="btn btn-danger pull-right">Delete Conversation</button>
                        {!! Form::close() !!}
                    @endif
                    <h4>
                        {{ implode(', ', $conversation->users->lists('name')->toArray()) }}
                    </h4>
                </div>
                <div class="panel-body">
                    > last message
                </div>
            </a>
        @empty

        @endforelse
        {!! $allConversations->links()  !!}
    </div>
    @endif
@endsection








