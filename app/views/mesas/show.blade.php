@extends('layouts.master')
 
@section('sidebar')
     @parent
     Información de familia
@stop
 
@section('content')
        {{ HTML::link('familias', 'Volver'); }}
        <h1>
  familia {{$familia->id}}
      
</h1>
        Familia:
        {{ $familia->nombre }}
        <br />
        Descripcion:
        {{$familia->descripcion}}
        
<br />
@stop