<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Cycle Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cycle', 'Cycle:') !!}
    {!! Form::select('cycle', ['Parvularia' => 'Parvularia', 'Enseñanza Básica' => 'Enseñanza Básica', 'Enseñanza Media' => 'Enseñanza Media'] ,null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('levels.index') !!}" class="btn btn-default">Cancel</a>
</div>
