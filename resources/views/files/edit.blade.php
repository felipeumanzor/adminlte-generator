@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Files
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($files, ['route' => ['files.update', $files->id], 'method' => 'patch']) !!}

                        @include('files.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection