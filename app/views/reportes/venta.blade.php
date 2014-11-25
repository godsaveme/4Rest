@extends('layouts.cajamaster')
@section('js')
	{{HTML::script('js/reportescaja.js')}}
@stop
@section('content')
<div class="container">
	<div class="panel panel-primary" id="reportediariocaja">
            <div class="panel-heading">
            	<div class="row">
            		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            			<h3 class="title" id="restauranteinfo" data-id="{{$restaurante->id}}">{{$restaurante->nombreComercial}}</h3>
            		</div>
            		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <h4 class="title">Seleciona Fecha</h4>
                            <div class="form-group">
                                <input id="fecha_inicio" placeholder ="Fecha Inicio"/>
                                <a href="javascript:void(0)" id="btn_enviarfechas" class="btn btn-default">Buscar</a>
                            </div>
            		</div>
            	</div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Fecha: <span id="text_fechainicio">0000-00-00</span> / <span id="text_fechafin">0000-00-00</span></th>
                        <th data-template="rangotickets" data-bind="source: this" id="rangoti">
                        </th>
                    </tr>
                </thead>
            </table>
            <table class="table table-bordered">
                <tbody data-template="reportediario_template" data-bind="source: datosreporte">
                <script id="reportediario_template" type="text/x-kendo-template">
                </script>
                </tbody>
            </table>
            <table class="table table-bordered">
	            <tbody data-template="reportecaja_template" data-bind="source: this">
	            </tbody>
            </table>
        </div>
</div>
@stop