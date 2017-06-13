@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Content
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($content, ['route' => ['contents.update', $content->id], 'method' => 'patch']) !!}

                        @include('contents.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection