

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    @yield('headtags')

    @stack('head-css')


    <style>
        @stack('free-css')
        /* optional style for the admin bar */
        @if (array_key_exists('admin-bar', $__env->getSections()))
            html {
                padding-bottom: 80px;
            }
        @endif
    </style>
    @stack('head-scripts')
</head>

<body id="app-layout">

    @include('common.menus.topMenu')

    <div class="container">
        @include('layouts.flash')

        <div class="row">
            <div class="col-xs12 col-md-12 col-lg-12">
                @yield('content')
             </div>
        </div>

    </div>
        @if (array_key_exists('admin-bar', $__env->getSections()))
            @include('common.menus.adminMenu')
        @endif

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    @yield('footer-tags')
</body>
</html>
