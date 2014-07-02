@extends('layouts.cajamaster')
 @section('css')
 {{HTML::style('css/foundation.css')}}
 @stop
@section('content')
<div class="container">
		<div class="panel panel-primary" id="reporte_mozos">
	        <div class="panel-heading">
	        	<div class="row">
	        		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
	        			<h3 class="title" id="restauranteinfo" data-id="{{$restaurante->id}}">{{$restaurante->nombreComercial}}</h3>
	        		</div>
	        		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
	            			<h4 class="title">Usuario: {{$usuario->login}}</h4>
	            			<h4 class="title">Nombre: {{$usuario->nombres}} {{$usuario->apPaterno}} {{$usuario->apMaterno}}</h4>
	            			<a href="/usuarios/reportemozos/{{$restaurante->id}}?fechainicio={{$fechaInicio}}&fechafin={{$fechaFin}}" class="btn btn-default pull-right">Regresar</a>
	            	</div>
	        	</div>
	        </div>
	        <table class="table">
	                <thead>
	                    <tr>
	                        <th><span id="textf_inicio">{{$fechaInicio}}</span> / <span id="textf_fin">{{$fechaFin}}</span></th>
	                    </tr>
	                </thead>
	        </table>
	        <div class="row">
	        	<div class="col-xs-10 col-sm-10 col-md-8 col-lg-8">
	        		<table class="table">
			        	<thead>
			        		<tr>
			        			<th>Nº</th>
			        			<th class="text-center">Número</th>
			        			<th class="text-center">C. Productos</th>
			        			<th class="text-center">Fecha Inicio</th>
			        			<th class="text-center">Fecha Cancelación</th>
			        		</tr>
			        	</thead>
		                <tbody>
		                	<tr>
		                		<td></td>
		                		<td></td>
		                		<td class="text-right">{{$totaldeproductos}}</td>
		                		<td></td>
		                		<td></td>
		                	</tr>
		                	@foreach ($pedidosanulados as $pedidoa)
		                	<tr>
		                		<td>{{$contador++}}</td>
		                		<td>{{$pedidoa->id}}</td>
		                		<td class="text-right">{{$pedidoa->cantidad}}</td>
		                		<td class="text-center">{{$pedidoa->fechaInicio}}</td>
		                		<td class="text-center">{{$pedidoa->fechaCancelacion}}</td>
		                	</tr>
		                	@endforeach
		                </tbody>
			        </table>
	        	</div>
	        </div>
	    </div>
	</div>
@stop