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
	            			<h4 class="title">Seleciona Fecha</h4>
	            			<div class="form-group">
		                		<input id="fecha_inicio" value="{{$fechaInicio}}" placeholder="Fecha Inicio"/>
		                        <input id="fecha_fin" value="{{$fechaFin}}" placeholder="Fecha Fin"/>
		                        <a href="javascript:void(0)" id="btn_enviarfechas"  class="btn btn-default">Buscar</a>
	                        </div>
	            	</div>
	        	</div>
	        </div>
	        <table class="table">
	                <thead>
	                    <tr>
	                        <th><span id="textf_inicio">00/00/0000</span> / <span id="textf_fin">00/00/0000</span></th>
	                    </tr>
	                </thead>
	        </table>

	        <div class="row">
	        	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	        		<table class="table table-bordered">
		        	<thead data-template="reportemozos_totales" data-bind="source: this">
		        	<script id="reportemozos_totales" type="text/x-kendo-template">
		        		<tr>
		        			<th rowspan="3" class="text-center" valign="middle"> Nombre del Mozo</th>
		        			<th rowspan="2" class="text-center" valign="middle"> Venta Neta</th>
		        			<th rowspan="2" class="text-center" valign="middle"> %</th>
		        			<th rowspan="2" class="text-center"  valign="middle">T. P.</th>
		        			<th colspan="3" class="text-center"  valign="middle">Total</th>
		        			<th colspan="3" class="text-center"  valign="middle">Anulaciones</th>
		        			<th colspan="3" class="text-center"  valign="middle">Tiempos de Atención</th>
		        		</tr>
		        		<tr>
		        			<th class="text-center">Atenciones</th>
	    					<th class="text-center">Productos</th>
	    					<th class="text-center">Tickets</th>
	    					<th class="text-center">Pedidos</th>
	    					<th class="text-center">Productos</th>
	    					<th class="text-center">Tickets</th>
	    					<th class="text-center">Promedio</th>		
		        			<th class="text-center">Maximo</th>
		        			<th class="text-center">Minimo</th>
		        		</tr>
		        		<tr>
		        				<th class="text-right">#:kendo.toString(parseFloat(ventatotal()), "n")#</th>
		        				<th class="text-right"></th>
		        				<th class="text-right"></th>
		        				<th class="text-right">#:totalatenciones()#</th>
		        				<th class="text-right">
		        				<a href="/reportes/reporteproductos/{{$restaurante->id}}?tipoc=1&fechainicio=#:fechainicio()#&fechafin=#:fechafin()#">
		        				#:totalproductos()#
		        				</a>
		        				</th>
		        				<th class="text-right">#:totaltickets()#</th>
		        				<th class="text-right">#:pedidosanulados()#</th>
		        				<th class="text-right">#:productosanulados()#</th>
		        				<th class="text-right">#:ticketsanulados()#</th>
		        				<th class="text-right"></th>
		        				<th class="text-right"></th>
		        				<th class="text-right"></th>
		        			</th>
		        		</tr>
		        	</script>
		        	</thead>
		        	
		        	<tbody data-template="reporte_mozostemplate" data-bind="source: datosreporte">
		        	<script id="reporte_mozostemplate" type="text/x-kendo-template">
		        		<tr>
		        			<td>#=mozo#</td>
		        			<td class="text-right">
		        				#if (selector == 1) {#
		        					<a href="/usuarios/ticketsmozo/#=mozoid#?idrest=#=idrest#&fechainicio=#=fechai#&fechafin=#=fechafin#">
	                        		#= kendo.toString(parseFloat(mfactu), "n")#
	                        		</a>
		        				#}else{#
		        					#= kendo.toString(parseFloat(mfactu), "n")#
		        				#}#
		        			</td>
		        			<td class="text-right small">#:kendo.toString(mfactu/ventatotalpor(), "p2")#</td>
		        			<td class="text-right">#=promt#</td>
		        			<td class="text-right">#=peds#</td>
		        			<td class="text-right">
		        				<a href="/usuarios/productosmozo/#=mozoid#?idrest=#=idrest#&fechainicio=#=fechai#&fechafin=#=fechafin#">
                        		#=cprods#
                        		</a>
		        			</td>
		        			<td class="text-right">#=ctickets#</td>
		        			<td class="text-right">
		        				<a href="/usuarios/pedidosanulados/#=mozoid#?idrest=#=idrest#&fechainicio=#=fechai#&fechafin=#=fechafin#">
	                        	#=pedsa#
	                        	</a>
	                        </td>
		        			<td class="text-right">#=panul#</td>
		        			<td class="text-right">#=tanul#</td>
		        			<td class="text-right">#=tprom#</td>
		        			<td class="text-right">#=tmax#</td>
		        			<td class="text-right">#=tmin#</td>
		        		</tr>
		        	</script>
		        	</tbody>
		        </table>
	        	</div>
	        </div>
	    </div>
	</div>
@stop

@section('js')
		{{HTML::script('js/reportemozos.js')}}
@stop