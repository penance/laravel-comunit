@extends('layouts.app')

@section('headtags')
    <link type="text/css" rel="stylesheet" href="{{asset('css/discussions.css')}}"/>
@endsection


@section('content')

    <div class="page-header clearfix">
        <h1 class="">Our Discussions |
            <small>Let's decide important stuff.</small>
            <a class="btn btn-primary pull-right" href="{{route('discussions.create')}}">Start a Discussion</a>
        </h1>

    </div>

    <div class="discussions-container">
        @forelse ($discussions as $discussion)
            <div class="discussion-excerpt">

                <div class="discussion-excerpt__meta clearfix"
                    data-toggle="collapse"
                    data-target="#discussion-content-{{$discussion->id}}">
                    <h3 class="clearfix">{{ $discussion->title }}
                        <small class="pull-right">
                            <span class="discussion-excerpt__meta-item">Proposed by - {{ $discussion->user->name }}</span>
                            <br>
                            <span class="discussion-excerpt__meta-item">On - {{ $discussion->created_at->format('d/m/Y H:i') }}</span>
                        </small>
                    </h3>

                </div>
                <div class="discussion-excerpt__proposal collapse"
                     id="discussion-content-{{$discussion->id}}">
                    {{ $discussion->proposal }}

                    <div class="discussion-excerpt__options">
                        @if ( count($discussion->options))
                            <h4 class="discussion-excerpt__options-title">These are the options for the discussion:</h4>
                        @endif

                        @forelse ($discussion->options as $option)
                            <div class="discussion-excerpt__options">- {{ $option->title }}</div>
                        @empty
                            <h4 class="discussion-excerpt__options-title">This discussion has no options :[</h4>
                        @endforelse
                    </div>
                </div>


            </div>
        @empty
            <br>
            <h3>No discussions yet. Why you no talk?</h3>
        @endforelse

        {{$discussions->links()}}
    </div>


@endsection








