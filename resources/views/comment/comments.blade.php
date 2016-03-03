<h3>Article Comments:</h3>
@forelse ($article->comments as $comment)
    @include ('comment.comment', ['comment' => $comment])
@empty
    <h4>No comments yet! <small>Be the first to comment!</small></h4>
@endforelse
<div class="panel panel-primary">
    <div class="panel-heading">What do you have to say?</div>
    <div id="comment-form" class="panel-body">
        {!! Form::open(['route' => ['comments.store', $article->id],'method' => 'post']) !!}
            @include ('comment.partials.form_fields', ['submitButtonText' => 'Add Comment!'])
        {!! Form::close() !!}
    </div>
</div>