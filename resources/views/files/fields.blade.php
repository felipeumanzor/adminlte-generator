<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- File Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('file_url', 'File Url:') !!}
    {!! Form::text('file_url', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('content_url', 'Content Url:') !!}
    {!! Form::text('content_url', null, ['class' => 'form-control']) !!}
</div>

<!-- Usersid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('usersid', 'Usersid:') !!}
    {!! Form::number('usersid', null, ['class' => 'form-control']) !!}
</div>

<!-- Contentsid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contentsid', 'Contentsid:') !!}
    {!! Form::number('contentsid', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('files.index') !!}" class="btn btn-default">Cancel</a>
</div>
