@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            File Comment
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($fileComment, ['route' => ['fileComments.update', $fileComment->id], 'method' => 'patch']) !!}

                        @include('file_comments.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection