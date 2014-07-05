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
		                        <input id="fecha_fin" value="{{$fechaFin}}"/>
		                        <a href="javascript:void(0)" id="btn_enviarfechas" placeholder="Fecha Fin" class="btn btn-default">Buscar</a>
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
	        <table class="table">
	        	<thead>
	        		<tr>
	        			<th>Mozo</th>
	        			<th>M. Factu</th>
	        			<th>Prom T.</th>
	        			<th>Peds</th>
	        			<th>Peds A.</th>
	        			<th>C. Prods</th>
	        			<th>P. Anul</th>
	        			<th>C. Tickets</th>
	        			<th>T. Anul</th>
	        			<th>T. Prom</th>
	        			<th>T. Min</th>
	        			<th>T. Max</th>
	        		</tr>
	        	</thead>
                <tbody data-template="reporte_mozostemplate" data-bind="source: datosreporte">
                <script id="reporte_mozostemplate" type="text/x-kendo-template">
                    <tr>    
                        <td>#=mozo#</td>
                        <td class="text-right">
                        	<a href="/usuarios/ticketsmozo/#=mozoid#?idrest=#=idrest#&fechainicio=#=fechai#&fechafin=#=fechafin#">
                        		#=mfactu#
                        	</a>
                        </td>
                        <td class="text-right">#=promt#</td>
                        <td class="text-right">#=peds#</td>
                        <td class="text-right">
	                        <a href="/usuarios/pedidosanulados/#=mozoid#?idrest=#=idrest#&fechainicio=#=fechai#&fechafin=#=fechafin#">
	                        	#=pedsa#
	                        </a>
                        </td>
                        <td class="text-right">
                        	<a href="/usuarios/productosmozo/#=mozoid#?idrest=#=idrest#&fechainicio=#=fechai#&fechafin=#=fechafin#">
                        		#=cprods#
                        	</a>
                        </td>
                        <td class="text-right">#=panul#</td>
                        <td class="text-right">#=ctickets#</td>
                        <td class="text-right">#=tanul#</td>
                        <td class="text-right">#=tprom#</td>
                        <td class="text-right">#=tmin#</td>
                        <td class="text-right">#=tmax#</td>
                    </tr>
                </script>
                </tbody>
	        </table>
	    </div>
	</div>
@stop

@section('js')
	{{HTML::script('js/reportemozos.js')}}
@stop