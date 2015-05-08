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
	        		@if (isset($productos))
	        		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		        		@if ($tipoc== 1)
		        			<a href="/usuarios/reportemozos/{{$restaurante->id}}?fechainicio={{$fechaInicio}}&fechafin={{$fechaFin}}" class="btn btn-default pull-right">Regresar</a>
		        		@elseif($tipoc == 2)
		        			<a href="/reportes/reporteproductos/{{$restaurante->id}}?tipoc=1&fechainicio={{$fechaInicio}}&fechafin={{$fechaFin}}" class="btn btn-default pull-right">Regresar</a>
		        		@elseif ($tipoc== 3)
		        			<a href="/reportes/reporteproductos/{{$restaurante->id}}?tipoc=2&fechainicio={{$fechaInicio}}&fechafin={{$fechaFin}}&tipocombi={{$idtipocomb}}" class="btn btn-default pull-right">Regresar</a>
		        		@elseif ($tipoc== 4)
		        			<a href="/reportes/reporteproductos/{{$restaurante->id}}" class="btn btn-default pull-right">Regresar</a>
		        		@endif
	            	</div>
	            	@else
	            	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            			<h4 class="title">Seleciona Fecha</h4>
            			<div class="form-group">
	                		<input id="fecha_inicio" value="{{$fechaInicio}}" placeholder="Fecha Inicio"/>
	                        <input id="fecha_fin" value="{{$fechaFin}}" placeholder="Fecha Fin"/>
	                        <a href="javascript:void(0)" id="btn_rotacionpro"  class="btn btn-default">Buscar</a>
                        </div>
	            	</div>
	            	@endif
	        	</div>
	        </div>
	        @if (isset($productos))
	        <table class="table">
	                <thead>
	                    <tr>
	                        <th><span id="textf_inicio">{{$fechaInicio}}</span> / <span id="textf_fin">{{$fechaFin}}</span></th>
	                    </tr>
	                </thead>
	        </table>
	        <table class="table table-bordered">
	        	<thead>
	        		<tr>
	        			<th class="text-center">Producto</th>
	        			<th class="text-center">Cantidad</th>
	        			<th class="text-center">Venta Neta S/.</th>
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
                		<td>
                		@if ($producto->fnombre)
	                		@if($tipoc == 1)
	                			<a href="/reportes/reporteproductos/{{$restaurante->id}}?tipoc=2&fechainicio={{$fechaInicio}}&fechafin={{$fechaFin}}&tipocombi={{$producto->tipocombid}}">
		                			{{$producto->fnombre}}
		                		</a>
		                	@elseif($tipoc == 2)
		                		@if ($producto->combinacion_id > 1)
		                			{{$producto->fnombre}}
		                		@else
		                			<a href="/reportes/reporteproductos/{{$restaurante->id}}?tipoc=3&fechainicio={{$fechaInicio}}&fechafin={{$fechaFin}}&tipocombi={{$producto->tipocombid}}&famiid={{$producto->famiid}}">
			                			{{$producto->fnombre}}
			                		</a>
		                		@endif
		                	@elseif($tipoc == 3)
		                		{{$producto->fnombre}}
		                	@elseif($tipoc == 4)
	                			<a href="/reportes/reporteproductos/{{$restaurante->id}}?tipoc=2&fechainicio={{$fechaInicio}}&fechafin={{$fechaFin}}&tipocombi={{$producto->tipocombid}}">
		                			{{$producto->fnombre}}
		                		</a>
	                		@endif
                		@else
                		Eventos
                		@endif
                		</td>
                		<td class="text-right">{{$producto->cantidad}}</td>
                		<td class="text-right">{{$producto->precio}}</td>
                	</tr>
                	@endforeach
                </tbody>
	        </table>
	        @endif
	    </div>
	</div>
@stop

@section('js')
		{{HTML::script('js/reportemozos.js')}}
@stop