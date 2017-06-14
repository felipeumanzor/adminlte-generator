<!-- Id Mineduc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_mineduc', 'Id Mineduc:') !!}
    {!! Form::text('id_mineduc', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Subjectsid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subjectsid', 'Subjectsid:') !!}


   <select name="subjectsid" class="form-control">
    	@foreach ($levels as $level)
  <optgroup label="{{ $level->name }}">
  @foreach ($level->subjects as $subject)
     <option value="{{ $subject->id }}">{{ $subject->name }}</option>
  @endforeach
  </optgroup>
@endforeach

    </select>
</div>



<div class="form-group col-sm-12">
    {!! Form::label('description', 'Descripción:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('contents.index') !!}" class="btn btn-default">Cancel</a>
</div>
