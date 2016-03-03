@if (Session::has('flashMessageSuccess'))

    <div class="alert alert-success">
        <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{session('flashMessageSuccess')}}
    </div>
@endif
@if (Session::has('flashMessageError'))

    <div class="alert alert-danger">
        <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{session('flashMessageError')}}
    </div>
@endif