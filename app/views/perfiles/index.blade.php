@extends('layouts.master')
@section('sidebar')
     Perfiles
@stop
@section('content')
<div class="row">
    <div class="small-6 medium-6 large-6 columns">
      {{HTML::link('perfiles/create', 'Crear', array('class'=>'button radius left'))}}
    </div>
    <div class="small-6 medium-6 large-6 columns">
      {{HTML::link('web', 'Volver', array('class'=>'button radius right'))}}
    </div>
</div>
<ul class="pricing-table">
  <li class="title"><strong>Lista de Perfiles</strong></li>
  <li class="title">
    <div class="row">
    <div class="small-5 medium-5 large-4 columns">Nombre</div>
    <div class="small-3 medium-3 large-4 columns">Tipo</div>
    <div class="small-2 medium-2 large-2 columns">Editar</div>
    <div class="small-2 medium-2 large-2 columns">Eliminar</div>
    </div>
</li>
@foreach ($perfiles as $dato)
  <li class="bullet-item">
    <div class="row">
    <div class="small-5 medium-5 large-4 columns">{{$dato->nombre}}</div>
    <div class="small-3 medium-3 large-4 columns">
      @if ($dato->selector == 1)
      Persona      
      @elseif ($dato->selector == 2)
      Empresa
      @endif
    </div>
    <div class="small-2 medium-2 large-2 columns"><a href="perfiles/edit/{{$dato->id}}"><i class="fi-page-edit"></i></a></div>
    <div class="small-2 medium-2 large-2 columns"><a href="perfiles/destroy/{{$dato->id}}"><i class="fi-x"></i></a></div>
    </div>
  </li>
@endforeach
</ul>
@stop
