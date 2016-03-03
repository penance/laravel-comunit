@include ('common.form.form-errors')
<div class="form-group col-xs-12 col-md-4">
    {!! Form::label('user','Name') !!}
    {!! Form::text('user-dummy', Auth::user()->name, ['class' => 'form-control', 'disabled']) !!}
</div>

<div class="form-group col-xs-12">
    {!! Form::label('content', 'Content:') !!}
    <br>
    {!! Form::textarea('content', null, ['class'=>'form->control', 'rows' => '3', 'cols' => '50', 'placeholder' => 'Arlarlarlar...']) !!}
</div>

<div class="col-xs-12 col-md-4">
    {!! Form::button($submitButtonText, ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
</div>