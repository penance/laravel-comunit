@if($errors->any())
    <div class="row">
        <div class="col-xs-12">
            <h3 class="alert alert-danger">Error!</h3>
            <ul class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>
        </div>
    </div>
@endif