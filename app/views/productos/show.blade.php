@extends('layouts.master')
 
@section('sidebar')
     @parent
     Información de producto
@stop
 
@section('content')
        {{ HTML::link('productos', 'Volver'); }}
        <h1>
  producto {{$producto->id}}
      
</h1>
        
        {{ $producto->nombre .' '.$producto->descripcion }}
        
<br />
        {{ $producto->created_at}}
@stop