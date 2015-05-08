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
	        <table class="table">
	        	<thead>
	        		<tr>
	        			<th class="text-center">Producto</th>
	        			<th class="text-center">Cantidad</th>
	        			<th class="text-center">Venta Total S/.</th>
	        		</tr>
	        	</thead>
                <tbody>
                	<tr>
                		<td>&nbsp;</td>
                		<td class="text-right">
                			<strong>{{$cantidad}}</strong>
                		</td>
                		<td class="text-right">
                			<strong>S/. {{ number_format($montototal, 2, '.', '')}}</strong>
                		</td>
                	</tr>
                	@foreach ($productos as $producto)
                	<tr>
                		<td>{{$producto->nombre}}</td>
                		<td class="text-right">{{$producto->cantidad}}</td>
                		<td class="text-right">{{$producto->precio}}</td>
                	</tr>
                	@endforeach
                </tbody>
	        </table>
	    </div>
	</div>
@stop