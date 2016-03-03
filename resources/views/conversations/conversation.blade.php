@extends('layouts.app')

@push('head-css')
    <link type="text/css" rel="stylesheet" href="{{asset('css/messages.css')}}"/>
@endpush


@section('content')
<?php
        // make the sub title here
    $with = str_replace(Auth::user()->name .', ', '', $users->implode('name', ', '));
    $pos = strrpos($with, ',');
    if ($pos !== false) {
        $with = substr_replace($with, ' &', $pos, 1);
    }
?>
<div class="page-header clearfix">
<h1 class="">Talk |
    <small>With <?php echo $with;?></small>
</h1>
</div>


<div class="conversation-messages clearfix">
    @forelse ($messages as $message)
        <?php if ($message->user_id == Auth::user()->id){
            $messageClass = 'own';
        } else {
            $messageClass = '';
        }

        ?>

        <div class="message {{$messageClass}} clearfix">
            <div class="message-content">
                <strong class="message-by">{{$message->author->name}}:</strong>
                <br>
                <span class="message-text">{{ $message->content }}</span>
            </div>
        </div>
    @empty
    <h3>Say hey :]</h3>
    @endforelse
</div>

    <div class="conversation-create-wrap">
        {!!  Form::open(['route' => ['messages.store', $conversation->id], 'method' => 'post', 'class'=> 'form form-inline'])!!}
        <div class="form-group form-group--wide">
            {!! Form::text('content', null, ['class' => 'form-control', 'required']) !!}
        </div>
        <div class="form-group form-group--button">
            <button class="btn btn-primary" type="submit">Send!</button>
        </div>
        {!! Form::hidden('conversation_id' , $conversation->id) !!}
        {!! Form::close() !!}
    </div>


@endsection








