@extends('layouts.cajamaster')
@section('js')
	{{HTML::script('js/reportesventassemana.js')}}
@stop
@section('content')
<div class="container">
	<div class="panel panel-primary" id="reportesemanal">
        <div class="panel-heading">
        	<div class="row">
        		<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
        			<h3 class="title" id="restauranteinfo" data-id="{{$restaurante->id}}">{{$restaurante->nombreComercial}}</h3>
        		</div>
        		<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
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
                            <a href="javascript:void(0)" id="btn_summitinfo" class="btn btn-default">
                            En Soles
                            </a>
                            <a href="javascript:void(0)" id="btn_summitinfo2" class="btn btn-default">
                            En Unidades
                            </a>
                        </div>
        		</div>
        	</div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <table class="table table-bordered">
                    <thead data-template="reportecajasemanas_totales" data-bind="source: this">
                    <script id="reportecajasemanas_totales" type="text/x-kendo-template">
                        <tr>
                            <th rowspan="3" valign="middle" class="text-center">Familia</th>
                            <th rowspan="2" colspan="2" valign="middle" class="text-center">Venta Total</th>
                            <th colspan="7" valign="middle" class="text-center">Venta Diaria (Detalle en Soles)</th>
                        </tr>
                        <tr>
                            <th valign="middle" class="text-center">Lunes</th>
                            <th valign="middle" class="text-center">Martes</th>
                            <th valign="middle" class="text-center">Miercoles</th>
                            <th valign="middle" class="text-center">Jueves</th>
                            <th valign="middle" class="text-center">Viernes</th>
                            <th valign="middle" class="text-center">Sabado</th>
                            <th valign="middle" class="text-center">Domingo</th>
                        </tr>
                        <tr>
                            <th valign="middle" class="text-right" id="valor_x">#:ventatotal()#</th>
                            <th valign="middle" class="text-right">100 %</th>
                            <th valign="middle" class="text-right">#:ventalunes()#</th>
                            <th valign="middle" class="text-right">#:ventamartes()#</th>
                            <th valign="middle" class="text-right">#:ventamiercoles()#</th>
                            <th valign="middle" class="text-right">#:ventajueves()#</th>
                            <th valign="middle" class="text-right">#:ventaviernes()#</th>
                            <th valign="middle" class="text-right">#:ventasabado()#</th>
                            <th valign="middle" class="text-right">#:ventadomingo()#</th>
                        </tr>
                    </script>
                    </thead>
                    <tbody data-template="reporteventasemanal_template" data-bind="source: datosreporte">
                    <script id="reporteventasemanal_template" type="text/x-kendo-template">
                        <tr>
                        <td>
                            #if(fnombre){#
                                #:fnombre#
                            #}else{#
                                Eventos
                            #}#
                        </td>
                        <td class="text-right">#:total#</td>
                        <td class="text-right">
                        #:(parseFloat(total)* 100 / parseFloat(totalventasporcentaje())).toFixed(2)# %
                        </td>
                        <td class="text-right">#:Lunes#</td>
                        <td class="text-right">#:Martes#</td>
                        <td class="text-right">#:Miercoles#</td>
                        <td class="text-right">#:Jueves#</td>
                        <td class="text-right">#:Viernes#</td>
                        <td class="text-right">#:Sabado#</td>
                        <td class="text-right">#:Domingo#</td>
                        </tr>
                    </script>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop