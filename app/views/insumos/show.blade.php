@extends('layouts.master')
 
@section('sidebar')
     @parent
     Información de Insumo
@stop
 
@section('content')
        {{ HTML::link('insumos', 'Volver'); }}
        <h1>
  Insumo {{$insumo->id}}
      
</h1>
        
        {{ $insumo->nombre .' '.$insumo->descripcion }}
        
<br />
        {{ $insumo->created_at}}
@stop