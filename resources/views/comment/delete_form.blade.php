{!! Form::open(['route' => array('comments.destroy', $comment->id), 'method' => 'delete', 'class' => 'pull-right']) !!}
<button  type="submit" class="btn btn-danger" style="margin-right: 6px;">Delete</button>
{!! Form::close() !!}