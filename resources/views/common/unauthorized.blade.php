@extends('layouts.app')

@section('content')

    <div class="panel panel-default home-content">
        <div class="panel-heading">Welcome</div>

        <div class="panel-body">
            <div>
                <h1>
                    Unauthorized!
                    <br><br>
                    <small>You do not have sufficient permissions to access this feature.</small>
                    <br><br>
                    <button class="btn btn-primary" onclick="history.back()">
                       <i class="fa fa-btn fa-arrow-left"></i> Back
                    </button>
                </h1>

            </div>


           </div>
    </div>

@endsection

@section('headtags')

   <link type="text/css" rel="stylesheet" href="css/test.css"/>

@endsection
