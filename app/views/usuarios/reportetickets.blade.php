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
	        	<div class="col-xs-8 col-sm-8 col-md-6 col-lg-6">
	        		<table class="table">
			        	<thead>
			        		<tr>
			        			<th>Nº</th>
			        			<th class="text-center">Número</th>
			        			<th class="text-center">Descuento</th>
			        			<th class="text-center">Importe</th>
			        			<th class="text-center">Estado</th>
			        		</tr>
			        	</thead>
		                <tbody>
		                <tr>
		                	<td>&nbsp;</td>
		                	<td>&nbsp;</td>
		                	<td class="text-right">{{number_format($descuento, 2, '.', '')}}</td>
		                	<td class="text-right">{{number_format($importetotal, 2, '.', '')}}</td>
		                	<td>&nbsp;</td>
		                </tr>
		                @foreach ($tickestfacturados as $ticket)
	        				<tr>
	        					<td>{{$contador++}}</td>
			        			<td>
				        			<a href="/tickets/show/{{$ticket->id}}">
				        				{{$ticket->numero}}
				        			</a>
			        			</td>
			        			<td class="text-right">{{$ticket->idescuento}}</td>
			        			<td class="text-right">{{$ticket->importe}}</td>
			        			<td class="text-center">
			        				@if($ticket->estado == 1)
										Anulado
			        				@else
			        					Correcto
			        				@endif
			        			</td>
		        			</tr>
			        		@endforeach
		                </tbody>
			        </table>
	        	</div>
	        </div>
	    </div>
	</div>
@stop