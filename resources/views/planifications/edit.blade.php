@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Planification
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($planification, ['route' => ['planifications.update', $planification->id], 'method' => 'patch']) !!}

                        @include('planifications.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection