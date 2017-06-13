<!-- Comment Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comment', 'Comment:') !!}
    {!! Form::text('comment', null, ['class' => 'form-control']) !!}
</div>

<!-- Usersid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('usersid', 'Usersid:') !!}
    {!! Form::number('usersid', null, ['class' => 'form-control']) !!}
</div>

<!-- Filesid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('filesid', 'Filesid:') !!}
    {!! Form::number('filesid', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('fileComments.index') !!}" class="btn btn-default">Cancel</a>
</div>
