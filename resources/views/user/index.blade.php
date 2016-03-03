@extends('layouts.app')

@section('content')



        <div class="page-header">
            <h1 class="">Community members |
                @if (Auth::user()->accessLevel->id == 1)
                <small>See your friends</small>
                @else
                <small>Manage the douches</small>
                @endif
            </h1>
        </div>
        <div class="panel panel-default home-content">
            <div class="panel-heading text-center">
                <h1>
                    @if (Auth::user()->accessLevel->id == 1)
                        Your friends
                    @else
                       The douches
                    @endif
                </h1>

            </div>
        <div class="panel-body">

            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    @if (Auth::user()->accessLevel->id > 1)
                        <th class="">Access</th>
                    @endif
                        <th class="">Actions</th>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="active">{{$user->id}}</td>
                        <td>
                            @can('update', $user)
                                <a href="{{route('user.edit', ['id' => $user->id] )}}">{{$user->name}}</a>
                            @else
                                {{$user->name}}
                            @endcan

                        </td>
                        <td>{{$user->email}}</td>
                        @if (Auth::user()->accessLevel->id > 1)
                            <td class="">{{$user->accessLevel->title . ' (' . $user->accessLevel->id . ')'}}</td>
                        @endif
                            <td class="">
                                <div class="btn-group">
                                    <button type="button"
                                            class="btn btn-sm btn-info dropdown-toggle"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false" >Contact <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="mailto:{{$user->email}}" class="contact-option">Email</a></li>
                                        <li><a href="{{route('conversations.create')}}" class="contact-option">Private Message</a></li>

                                    </ul>
                                </div>
                                @if (Auth::user()->accessLevel->id > 1)
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-warning dropdown-toggle"
                                            type="button"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false">Manage <span class="caret"></span></button>
                                    <ul class="dropdown-menu">

                                        @if ($user->accessLevel->id > 1)
                                            <li><a href="{{Route('user.updateAccessLevel', ['userId' => $user->id, 'accessLevelId' => 1])}}">De-adminize</a></li>
                                        @else
                                            <li><a href="{{Route('user.updateAccessLevel', ['userId' => $user->id, 'accessLevelId' => 2])}}">Adminize</a></li>
                                        @endif
                                            <li><a href="{{Route('user.delete', ['id'=> $user->id])}}"><span class="text-danger">Delete Douche</span></a></li>
                                    </ul>
                                </div>
                                @endif
                            </td>

                    </tr>
                @endforeach
                </tbody>

            </table>
            {{$users->links()}}
        </div>
    </div>

@endsection

@section('headtags')
    <link type="text/css" rel="stylesheet" href="css/test.css"/>
@endsection
