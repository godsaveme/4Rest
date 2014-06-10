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
    </div>
</div>
@stop

@section('js')
	{{HTML::script('js/reportetiempos.js')}}
@stop