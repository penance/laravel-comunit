@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            {{ isset($title) ? $title : 'Register' }}
        </div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ isset($route)? url($route) : url('/register') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Name</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="name" value="{{isset($user) ? $user->name : old('name') }}">

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-6">
                        @if (!Auth::check() || (Auth::check() && Auth::user()->isAdmin())   )
                        <input type="email" class="form-control" name="email" value="{{ isset($user) ? $user->email : old('email') }}">
                        @else
                            <input type="email" class="form-control" disabled name="email_dummy" value="{{ isset($user) ? $user->email : '-' }}">
                        @endif
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Password</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Confirm Password</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password_confirmation">

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                @if (!Auth::check())
                <div class="form-group{{ $errors->has('invite') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Invitation Code</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="invite">

                        @if ($errors->has('invite'))
                            <span class="help-block">
                                <strong>{{ $errors->first('invite') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                @endif
                @if (Auth::check())
                <div class="form-group">
                    <label class="col-md-4 control-label">User ID</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="id" value="{{isset($id) ?  $id : '0'}}" disabled>
                    </div>
                </div>
                @endif

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        @if (Auth::check())
                                <button type="submit" class="btn btn-success">
                                <i class="fa fa-btn fa-download"></i> Save
                            </button>
                        @else
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-user"></i> Register
                            </button>
                        @endif

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

