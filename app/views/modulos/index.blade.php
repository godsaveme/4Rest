@extends('layouts.master')
@section('sidebar')
     Modulos
@stop
@section('content')
<div class="row">
	  <div class="small-6 medium-6 large-6 columns">
	  	{{HTML::link('modulos/create', 'Crear', array('class'=>'button radius left'))}}
	  </div>
	  <div class="small-6 medium-6 large-6 columns">
	  	{{HTML::link('web', 'Volver', array('class'=>'button radius right'))}}
	  </div>
</div>
<ul class="pricing-table">
  <li class="title"><strong>Lista de Modulos
{{ Request::segment(1);}}
  </strong></li>
  <li class="title">
  	<div class="row">
    <div class="small-3 medium-3 large-3 columns">Controlador</div>
    <div class="small-3 medium-3 large-3 columns">Pocedimiento</div>
    <div class="small-3 medium-3 large-2 columns">Activo</div>
    <div class="small-2 medium-2 large-2 columns">Editar</div>
    <div class="small-2 medium-2 large-2 columns">Eliminar</div>
  	</div>
</li>
@foreach ($modulos as $dato)
  <li class="bullet-item">
    <div class="row">
    <div class="small-3 medium-3 large-3 columns">{{$dato->controlador}}</div>
    <div class="small-3 medium-3 large-3 columns">{{$dato->proceso}}</div>
    <div class="small-3 medium-3 large-2 columns">
      @if ($dato->activo == 0)
      No
      @else
      Sí
      @endif
    </div>
    <div class="small-2 medium-2 large-2 columns"><a href="modulos/edit/{{$dato->id}}"><i class="fi-page-edit"></i></a></div>
    <div class="small-2 medium-2 large-2 columns"><a href="modulos/destroy/{{$dato->id}}"><i class="fi-x"></i></a></div>
    </div>
  </li>
@endforeach
</ul>
@stop