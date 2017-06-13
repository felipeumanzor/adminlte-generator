@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Content Comment
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($contentComment, ['route' => ['contentComments.update', $contentComment->id], 'method' => 'patch']) !!}

                        @include('content_comments.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection