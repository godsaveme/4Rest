@extends('layouts.cajamaster')
 @section('css')
 {{HTML::style('css/foundation.css')}}
 @stop
@section('content')
	<div class="container">
	<div class="panel panel-primary" id="reportetiempos">
        <div class="panel-heading">
        	<div class="row">
        		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        			<h3 class="title" id="restauranteinfo" data-id="{{$restaurante->id}}">{{$restaurante->nombreComercial}}</h3>
        		</div>
        		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            			<h4 class="title">Seleciona Fecha</h4>
            			<div class="form-group">
	                		<input id="fecha_inicio"/>
	                        <input id="fecha_fin"/>
	                        <a href="javascript:void(0)" id="btn_enviarfechas" class="btn btn-default">Buscar</a>
                        </div>
            	</div>
        	</div>
        </div>
        <table class="table">
                <thead>
                    <tr>
                        <th><span id="textf_inicio">00/00/0000</span> - <span id="textf_fin">00/00/0000</span></th>
                    </tr>
                </thead>
        </table>
        <ul class="list-group">
			<li class="list-group-item text-center">
				<div class="row">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="border-right: 1px solid silver">
						Producto
					</div>
					<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" style="border-right: 1px solid silver;" >
						<p id="text_producto">Tiempo</p>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border-left: 1px solid silver">
								Tpro
							</div>
						</div>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="border-right: 1px solid silver" >
						<p id="text_producto">Tiempo Espera</p>
						<div class="row">
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border-right: 1px solid silver; color: blue ">
								Tmin
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border-right: 1px solid silver">
								Tpro
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="color:red">
								Tmax
							</div>
						</div>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="border-right: 1px solid silver" id="promedio">
						<p>Tiempo Preparación</p>
						<div class="row">
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border-right: 1px solid silver; color: blue">
								Tmin
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border-right: 1px solid silver">
								Tpro
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="color: red">
								Tmax
							</div>
						</div>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" id="maximo" >
						<p>Tiempo Mozo</p>
						<div class="row">
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border-right: 1px solid silver; color: blue">
								Tmin
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border-right: 1px solid silver">
								Tpro
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="color: red">
								Tmax
							</div>
						</div>
					</div>
				</div>
			</li>
		</ul>
		<ul class="list-group" data-template="reportetiempos_template" data-bind="source: datosreporte">
			<script id="reportetiempos_template" type="text/x-kendo-template">
			<li class="list-group-item text-right">
				<div class="row">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-left" style="border-right: 1px solid silver;">
						<a href="javascript:void(0)" class="tiempo_productos"  data-idproducto = "#:producto_id#" style="color: blue">
							#:kendo.toString(get("nombre"), "C")#
							<span class="pull-right">#:cantidad#</span>
						</a>
					</div>
					<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 sub_maximo">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border-right: 1px solid silver; border-left: 1px solid silver">
								#:tiempototalpromedio#
							</div>
						</div>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						<div class="row">
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border-right: 1px solid silver; color: blue; border-left: 1px solid silver">
								#:tiempoesperaminimo#
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border-right: 1px solid silver">
								#:tiempoesperapromedio#
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border-right: 1px solid silver; color: red">
								#:tiempoesperamaximo#
							</div>
						</div>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 sub_promedio">
						<div class="row">
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border-right: 1px solid silver; border-left: 1px solid silver; color:blue">
								#:tiempococinaminimo#
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border-right: 1px solid silver">
								#:tiempococinapromedio#
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border-right: 1px solid silver; color:red">
								#:tiempococinamaximo#
							</div>
						</div>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 sub_promedio">
						<div class="row">
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border-right: 1px solid silver; border-left: 1px solid silver; color:blue">
								#:tiempomozominimo#
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border-right: 1px solid silver">
								#:tiempomozopromedio#
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="color:red">
								#:tiempomozomaximo#
							</div>
						</div>
					</div>
				</div>
			</li>
			</script>
		</ul>
    </div>
</div>
@stop

@section('js')
	{{HTML::script('js/reportetiempos.js')}}
@stop