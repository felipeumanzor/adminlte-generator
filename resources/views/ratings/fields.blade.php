<!-- Contentsid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contentsid', 'Contentsid:') !!}
    {!! Form::number('contentsid', null, ['class' => 'form-control']) !!}
</div>

<!-- Usersid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('usersid', 'Usersid:') !!}
    {!! Form::number('usersid', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('ratings.index') !!}" class="btn btn-default">Cancel</a>
</div>
