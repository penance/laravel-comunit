<div class="form-group">
    {!!  Form::label('users', 'Start a conversation with:') !!}
    {!!  Form::select('users[]', $userList, null, ['class'=>'form-control', 'multiple'])!!}
</div>
