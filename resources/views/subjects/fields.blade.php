<!-- Levelsid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('levelsid', 'Levelsid:') !!}
    {!! Form::number('levelsid', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::number('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('subjects.index') !!}" class="btn btn-default">Cancel</a>
</div>
