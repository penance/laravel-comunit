<div class="discussions-form-partial container">
    <div class="row">
        <div class="col-xs-12">

            <div class="form-group">
                {!! Form::label('title', 'Title:') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('proposal', 'Proposal:') !!}
                {!! Form::textarea('proposal', null, ['class' => 'form-control editorized', 'rows' => '6']) !!}
            </div>
        </div>


            <h4 class="options-title col-xs-12 clearfix">Options to vote for:</h4>


            <div class="form-group repeatable-container clearfix clear">
                <div class="repeatable__unit clearfix">
                    <div class="col-xs-8 repeatable__field clearfix">{!! Form::text('options[]', null, ['class' => 'form-control']) !!}</div>

                    <div class="col-xs-4 repeatable__controls clearfix">
                        <button class="repeatable__control-remove btn btn-danger">-</button>
                        <button class="repeatable__control-add btn btn-success">+</button>
                    </div>

                </div>

            </div>

    </div>
</div>
