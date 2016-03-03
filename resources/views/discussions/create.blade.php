@extends('layouts.app')

@section('headtags')
    <link type="text/css" rel="stylesheet" href="{{asset('css/discussions.css')}}"/>
    <script type="text/javascript" src="{{asset('js/repeateble.form.field.js')}}"></script>
@endsection


@section('content')

<div class="page-header clearfix">
<h1 class="">Start a discussion |
    <small>Make sure it is important!</small>
    <a class="btn btn-warning pull-right" href="{{route('discussions.index')}}">Nah (cancel)</a>
</h1>
</div>

    <div class="conversation-create-wrap">
        {!!  Form::open(['route' => 'discussions.store', 'method' => 'post', 'class'=> 'form'])!!}

        @include('common.form.form-errors')
        @include('discussions.partials.form_fields')



            <div class="col-xs-12">
               <button class="start-discussion btn btn-primary" type="submit">Start the discussion!</button>
            </div>

        {!!  Form::close() !!}

    </div>


@endsection








