@extends('layouts.master')
@section('sidebar')
     Pedidos de Compra
@stop
@section('content')
<div class="row">
    <div class="small-6 medium-6 large-6 columns">
      {{HTML::link('pedidoscompras/create', 'Crear', array('class'=>'button radius left'))}}
    </div>
    <div class="small-6 medium-6 large-6 columns">
      {{HTML::link('web', 'Volver', array('class'=>'button radius right'))}}
    </div>
</div>
<ul class="pricing-table">
  <li class="title"><strong>Lista de Pedidos de Compra</strong></li>
  <li class="title">
    <div class="row">
    <div class="small-1 medium-1 large-1 columns">No</div>
    <div class="small-1 medium-1 large-1 columns">Fecha</div>
    <div class="small-2 medium-2 large-2 columns">Provedor</div>
    <div class="small-2 medium-2 large-2 columns">Importe</div>
    <div class="small-2 medium-2 large-2 columns">Usuario</div>
    <div class="small-1 medium-1 large-1 columns">Tipo</div>
    <div class="small-1 medium-1 large-1 columns">Editar</div>
    <div class="small-2 medium-2 large-2 columns">Eliminar</div>
    </div>
</li>
@foreach ($pedidos as $dato)
<li class="bullet-item">
    <div class="row">
    <div class="small-1 medium-1 large-1 columns">{{$dato->id}}</div>
    <div class="small-1 medium-1 large-1 columns">{{$dato->fechaInicio}}</div>
    <div class="small-2 medium-2 large-2 columns">{{$dato->proveedor_id}}</div>
    <div class="small-1 medium-2 large-2 columns">{{$dato->importeFinal}}</div>
    <div class="small-2 medium-2 large-2 columns">{{$dato->usuario_id}}</div>
    <div class="small-1 medium-1 large-1 columns">{{$dato->tipo_orden}}</div>
    <div class="small-1 medium-1 large-1 columns"><a href="pedidosdecompras/edit/{{$dato->id}}"><i class="fi-page-edit"></i></a></div>
    <div class="small-2 medium-2 large-2 columns"><a href="pedidosdecompras/destroy/{{$dato->id}}"><i class="fi-x"></i></a></div>
    </div>
  </li>
@endforeach
</ul>
@stop