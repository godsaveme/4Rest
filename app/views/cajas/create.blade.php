@extends('layouts.master')
@section('sidebar')
     {{'Pedido : '.$salon.'-'.$mesa_nombre}}
@stop
@section('content')
  	<dl class="tabs" data-tab>
	@for ($i=0; $i < count($familias); $i++)
	  <dd class="@if($i==0)active@endif">
	  	<a href="#panel_{{$familias[$i]['id']}}">{{$familias[$i]['nombre']}}</a>
	  </dd>
	@endfor
	</dl>
	<div class="tabs-content">
	@for ($i=0; $i < count($familias); $i++)
	<div class="content @if($i==0)active@endif" id="panel_{{$familias[$i]['id']}}">
	  	<ul class="small-block-grid-2 medium-block-grid-4 large-block-grid-4"> 
	  		@foreach ($arrayproductos[$familias[$i]['id']] as $dato)
	  		<li class="prueba">
	  			<a href="javascript:void(0)" class="pro_pe" data-precio="{{$dato->precio}}" data-npro="{{$dato->nombre}}">
	  			<img class="imagen_mesa th mesa_libre" src="/images/mesa.png">
	  			</a>
	  			<a href="javascript:void(0)" id="m_{{$dato->id}}" data-precio="{{$dato->precio}}" data-npro="{{$dato->nombre}}" class="posionar pro_pe"> 
	  				{{$dato->nombre}}
	  			</a>
	  		</li>
	  		@endforeach
	  	</ul>
	</div>
	@endfor
	</div>
@stop