@extends('layouts.master')
@section('sidebar')
     Notas
@stop
@section('content')
<div class="row">
	  <div class="small-6 medium-6 large-6 columns">
	  	{{HTML::link('notas/create', 'Crear', array('class'=>'button radius left'))}}
	  </div>
	  <div class="small-6 medium-6 large-6 columns">
	  	{{HTML::link('web', 'Volver', array('class'=>'button radius right'))}}
	  </div>
</div>
<ul class="pricing-table">
  <li class="title"><strong>Lista de Notas</strong></li>
  <li class="title">
  	<div class="row">
    <div class="small-1 medium-1 large-1 columns">Nº</div>
    <div class="small-7 medium-7 large-7 columns">Nota</div>
    <div class="small-2 medium-2 large-2 columns">Editar</div>
    <div class="small-2 medium-2 large-2 columns">Eliminar</div>
  	</div>
</li>
<?php $i = 1;?>
@foreach ($notas as $dato)
  <li class="bullet-item">
  <div class="row">
    <div class="small-1 medium-1 large-1 columns">{{$i}}</div>
    <div class="small-5 medium-5 large-5 columns">{{$dato->descripcion}}</div>
    <div class="small-2 medium-2 large-2 columns"><a href="/notas/agregarnotas/{{$dato->id}}"><i class="fi-plus"></i></a></div>
    <div class="small-2 medium-2 large-2 columns"><a href="/notas/edit/{{$dato->id}}"><i class="fi-page-edit"></i></a></div>
    <div class="small-2 medium-2 large-2 columns"><a href="/notas/destroy/{{$dato->id}}"><i class="fi-x"></i></a></div>
  </div>
  </li>
  <?php $i++;?>
@endforeach
</ul>
@stop