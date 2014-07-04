@extends('layouts.cajamaster')
@section('js')
	{{HTML::script('js/reportesventassemana.js')}}
@stop
@section('content')
<div class="container">
	<div class="panel panel-primary" id="reportesemanal">
        <div class="panel-heading">
        	<div class="row">
        		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        			<h3 class="title" id="restauranteinfo" data-id="{{$restaurante->id}}">{{$restaurante->nombreComercial}}</h3>
        		</div>
        		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <h4 class="title">Seleciona Fecha</h4>
                        <div class="form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <select name="year" id="year" class="form-control">
                                    <option value="0">Selecciona Año</option>
                                    <option value="2014"> 2014</option>
                                    @for ($i=0; $i < (date('Y') - 2014); $i++)
                                        <option value="{{(2014 + $i + 1)}}"> {{(2014 + $i + 1)}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <select name="semana" id="semana" class="form-control">
                                    <option value="0">Selecciona Semana</option>
                                    @for ($i=1; $i < 55 ; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <a href="javascript:void(0)" id="btn_summitinfo" class="btn btn-default">Buscar</a>
                        </div>
        		</div>
        	</div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Producto</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Lunes</th>
                    <th class="text-center">Martes</th>
                    <th class="text-center">Miercoles</th>
                    <th class="text-center">Jueves</th>
                    <th class="text-center">Viernes</th>
                    <th class="text-center">Sabado</th>
                    <th class="text-center">Domingo</th>
                </tr>
            </thead>
            <tbody data-template="reporteventasemanal_template" data-bind="source: datosreporte">
                <script id="reporteventasemanal_template" type="text/x-kendo-template">
                    <tr>
                        <td>
                            #if(fnombre){#
                                #:fnombre#
                            #}else{#
                                Evento
                            #}#
                        </td>
                        <td>#:total#</td>
                        <td>#:Lunes#</td>
                        <td>#:Martes#</td>
                        <td>#:Miercoles#</td>
                        <td>#:Jueves#</td>
                        <td>#:Viernes#</td>
                        <td>#:Sabado#</td>
                        <td>#:Domingo#</td>
                    </tr>
                </script>
            </tbody>
        </table>
    </div>
</div>
@stop