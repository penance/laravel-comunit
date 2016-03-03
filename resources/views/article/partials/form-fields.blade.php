<div class="article-form-partial">
    <div class="container">
        @include('common.form.form-errors')

        <div class="row">
            <div class="col-xs-12 col-md-8">
                <div class="form-group">
                    {!! Form::label('title', 'Title:') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-xs-12 col-md-4">
                <div class="form-group">
                    {!! Form::label('slug', 'Alias (slug)') !!}
                    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xs-12">
                <hr>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    {!! Form::label('intro', 'Intro Text:') !!}
                    {!! Form::textarea('intro', null, ['class' => 'form-control', 'rows' => '3']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('content', 'Content:') !!}
                    {!! Form::textarea('content', null, ['class' => 'form-control editorized', 'rows' => '6']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit($submitButtonText, ['class' => 'btn btn-success form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
