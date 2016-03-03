<div class="row">
    <div class="well-small col-xs-12 col-md-8 col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                @include ('comment.delete_form')
               <span>{{$comment->user->name . ' says:'}}</span>
            </div>
            <div class="panel-body">
                <span>{{$comment->content}}</span>
                <hr>
                <span class="date">On: {{$comment->created_at->format('d/m/Y - H:s')}}</span>
            </div>
        </div>
    </div>
</div>
