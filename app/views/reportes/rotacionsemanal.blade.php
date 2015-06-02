@extends('layouts.cajamaster')

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
                            <a href="javascript:void(0)" id="btn_regresar" class="btn btn-default" 
                            style="display: none">
                            Regresar
                            </a>
                            <a href="javascript:void(0)" id="btn_regresar2" class="btn btn-default" 
                            style="display: none">
                            Regresar
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
                            <th valign="middle" class="text-right" id="valor_x">
                            #:kendo.toString(parseFloat(ventatotal()),"n")#
                            </th>
                            <th valign="middle" class="text-right">100 %</th>
                            <th valign="middle" class="text-right">
                            #:kendo.toString(parseFloat(ventalunes()),"n")#
                            </th>
                            <th valign="middle" class="text-right">
                            #:kendo.toString(parseFloat(ventamartes()),"n")#
                            </th>
                            <th valign="middle" class="text-right">
                            #:kendo.toString(parseFloat(ventamiercoles()),"n")#
                            </th>
                            <th valign="middle" class="text-right">
                            #:kendo.toString(parseFloat(ventajueves()),"n")#
                            </th>
                            <th valign="middle" class="text-right">
                            #:kendo.toString(parseFloat(ventaviernes()), "n")#
                            </th>
                            <th valign="middle" class="text-right">
                            #:kendo.toString(parseFloat(ventasabado()),"n")#
                            </th>
                            <th valign="middle" class="text-right">
                            #:kendo.toString(parseFloat(ventadomingo()),"n")#
                            </th>
                        </tr>
                    </script>
                    </thead>
                    <tbody data-template="reporteventasemanal_template" data-bind="source: datosreporte">
                    <script id="reporteventasemanal_template" type="text/x-kendo-template">
                        <tr>
                        <td>
                            #if(fnombre){#
                                #if (sesion()== 0) {#
                                    <a href="javascript:void(0)" class="familias" data-id="#:tipocombid#">
                                        #:fnombre#
                                    </a>
                                #}else if (sesion() == 1){#
                                    #if (combinacion_id > 1) {#
                                        #:fnombre#
                                    #}else{#
                                        <a href="javascript:void(0)" class="familias" data-id="#:famiid#">
                                        #:fnombre#
                                        </a>
                                    #}#
                                #}else if (sesion() == 2){#
                                    #:fnombre#
                                #}#
                            #}else{#
                                Eventos
                            #}#
                        </td>
                        <td class="text-right">
                        #:kendo.toString(parseFloat(total),"n")#
                        </td>
                        <td class="text-right">
                        #:(parseFloat(total)* 100 / parseFloat(totalventasporcentaje())).toFixed(2)# %
                        </td>
                        <td class="text-right">
                        #if (Lunes != '-') {#
                            #:kendo.toString(parseFloat(Lunes), "n")#
                        #}else{#
                            #:Lunes#
                        #}#
                        </td>
                        <td class="text-right">
                        #if (Martes != '-') {#
                             #:kendo.toString(parseFloat(Martes),"n")#
                        #}else{#
                            #:Martes#
                        #}#
                        </td>
                        <td class="text-right">
                        #if (Miercoles != '-') {#
                             #:kendo.toString(parseFloat(Miercoles),"n")#
                        #}else{#
                            #:Miercoles#
                        #}#
                        </td>
                        <td class="text-right">
                        #if (Jueves != '-') {#
                        #:kendo.toString(parseFloat(Jueves), "n")#
                        #}else{#
                            #:Jueves#
                        #}#
                        </td>
                        <td class="text-right">
                        #if (Viernes != '-') {#
                        #:kendo.toString(parseFloat(Viernes), "n")#
                        #}else{#
                            #:Viernes#
                        #}#
                        </td>
                        <td class="text-right">
                        #if (Sabado != '-') {#
                        #:kendo.toString(parseFloat(Sabado), "n")#
                        #}else{#
                            #:Sabado#
                        #}#
                        </td>
                        <td class="text-right">
                        #if (Domingo != '-') {#
                        #:kendo.toString(parseFloat(Domingo),"n")#
                        #}else{#
                            #:Domingo#
                        #}#
                        </td>
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
    {{HTML::script('js/reportesventassemana.js')}}
@stop