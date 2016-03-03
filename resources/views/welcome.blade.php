@extends('layouts.app')

@section('content')

    <div class="panel panel-default home-content">
        <div class="panel-heading">Welcome</div>

        <div class="panel-body">
            <div>
                <h1>
                    Welcome to COMun.

                    @if (!Auth::check())
                        <br>
                        <a href="#">Please log in.</a>
                    @endif
                </h1>

            </div>


           </div>
    </div>

@endsection

@section('headtags')

   <link type="text/css" rel="stylesheet" href="css/test.css"/>

@endsection
