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
                            <script id="rangotickets" type="text/x-kendo-template">
                                Tickets #:rango()#
                            </script> 
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
            <tbody data-template="reportecaja_template" 
            data-bind="source: this">
            <script id="reportecaja_template" type="text/x-kendo-template">
                    <tr>
                        <td colspan="3" style="font-weight: bold;">Turno</td>
                        <td class="text-center" style="font-weight: bold; width: 10%">1</td>
                        <td class="text-center" style="font-weight: bold;width: 10%">2</td>
                        <td class="text-center" style="font-weight: bold;width: 10%">3</td>
                        <td class="text-center" style="font-weight: bold;width: 10%">4</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight: bold">Hora</td>
                        <td>#:turno(0)#</td>
                        <td>#:turno(1)#</td>
                        <td>#:turno(2)#</td>
                        <td>#:turno(3)#</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight: bold">Responsable</td>
                        <td>#:responsable(0)#</td>
                        <td>#:responsable(1)#</td>
                        <td>#:responsable(2)#</td>
                        <td>#:responsable(3)#</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Venta Neta</td> 
                        <td class="text-right" style="width: 10%">
                            <a href="/cajas/reportestickets/#:identificador()#/1?fechainicio=#:fechainicio()#&fechafin=#:fechafin()#&tipoc=1">
                                #:kendo.toString((parseFloat(totalventas())),"n2")#
                            </a>
                        </td>
                        <td style="width: 10%"></td>
                        <td class="text-right">  
                            <a href="/cajas/reportestickets/#:cajaid(0)#?tipoc=1"> 
                                #:kendo.toString((parseFloat(venta(0))),"n2")#
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(1)#?tipoc=1">
                                #:kendo.toString((parseFloat(venta(1))),"n2")#
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(2)#?tipoc=1">
                                #:kendo.toString((parseFloat(venta(2))),"n2")#
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(3)#?tipoc=1">
                                #:kendo.toString((parseFloat(venta(3))),"n2")#
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Efectivo</td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:identificador()#/1?fechainicio=#:fechainicio()#&fechafin=#:fechafin()#&tipoc=2">
                                #:kendo.toString(parseFloat(totalefectivo()),"n2")#
                            </a>
                        </td>
                        <td class="text-right">
                            #: (parseFloat(totalefectivo())*100/(parseFloat(totalventas()) + parseFloat(totaldescuento()))).toFixed(2) # %
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(0)#?tipoc=2">
                                #:kendo.toString(parseFloat(efectivo(0)),"n")#
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(1)#?tipoc=2">
                                #:kendo.toString(parseFloat(efectivo(1)),"n")#
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(2)#?tipoc=2">
                                #:kendo.toString(parseFloat(efectivo(2)),"n")#
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(3)#?tipoc=2">
                                #:kendo.toString(parseFloat(efectivo(3)),"n")#
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Tarjeta</td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:identificador()#/1?fechainicio=#:fechainicio()#&fechafin=#:fechafin()#&tipoc=3">
                                #:kendo.toString(parseFloat(totaltarjeta()),"n")#
                            </a>
                        </td>
                        <td class="text-right">
                            #: (parseFloat(totaltarjeta())*100/(parseFloat(totalventas()) + parseFloat(totaldescuento()))).toFixed(2) # %
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(0)#?tipoc=3">
                            #:kendo.toString(parseFloat(tarjeta(0)),"n")#
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(1)#?tipoc=3">
                            #:kendo.toString(parseFloat(tarjeta(1)),"n")#
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(2)#?tipoc=3">
                            #:kendo.toString(parseFloat(tarjeta(2)),"n")#
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(3)#?tipoc=3">
                            #:kendo.toString(parseFloat(tarjeta(3)),"n")#
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Descuentos</td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:identificador()#/1?fechainicio=#:fechainicio()#&fechafin=#:fechafin()#&tipoc=4">
                                #:kendo.toString(parseFloat(totaldescuento()),"n2")#
                            </a>
                        </td>
                        <td class="text-right">
                            #: (parseFloat(totaldescuento())*100/(parseFloat(totalventas()) + parseFloat(totaldescuento()))).toFixed(2) # %
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(0)#?tipoc=4">
                            #:kendo.toString(parseFloat(descuentos(0)),"n")#
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(1)#?tipoc=4">
                            #:kendo.toString(parseFloat(descuentos(1)),"n")#
                            </a>

                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(2)#?tipoc=4">
                            #:kendo.toString(parseFloat(descuentos(2)),"n")#
                            </a>

                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(3)#?tipoc=4">
                            #:kendo.toString(parseFloat(descuentos(3)),"n")#
                            </a>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Promociones</td>
                        <td class="text-right"> #:kendo.toString(parseFloat(totalImProm()), "n")#</td>
                        <td ></td>
                        <td class="text-right"> #:kendo.toString(parseFloat(importePromocional(0)), "n")# </td>
                        <td class="text-right"> #:kendo.toString(parseFloat(importePromocional(1)), "n")# </td>
                        <td class="text-right"> #:kendo.toString(parseFloat(importePromocional(2)), "n")# </td>
                        <td class="text-right"> #:kendo.toString(parseFloat(importePromocional(3)), "n")# </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Vales Personal</td> valePersonal
                        <td class="text-right"> #:kendo.toString(parseFloat(totalvale()), "n")# </td>
                        <td> </td>
                        <td class="text-right"> #:kendo.toString(parseFloat(valePersonal(0)), "n")# </td>
                        <td class="text-right"> #:kendo.toString(parseFloat(valePersonal(1)), "n")# </td>
                        <td class="text-right"> #:kendo.toString(parseFloat(valePersonal(2)), "n")# </td>
                        <td class="text-right"> #:kendo.toString(parseFloat(valePersonal(3)), "n")# </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Descuento Autorizado</td>
                        <td class="text-right">#:kendo.toString(parseFloat(totaldsctoAut()), "n")#</td>
                        <td></td>
                        <td class="text-right">
                        #:kendo.toString(parseFloat(descuentoautorizado(0)), "n")#
                        </td>
                        <td class="text-right">
                        #:kendo.toString(parseFloat(descuentoautorizado(1)),"n")#
                        </td>
                        <td class="text-right">
                        #:kendo.toString(parseFloat(descuentoautorizado(2)),"n")#
                        </td>
                        <td class="text-right">
                        #:kendo.toString(parseFloat(descuentoautorizado(3)),"n")#
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Productos Vendidos</td>
                        <td class="text-right">
                            <a href="/cajas/reporteproductoscaja/#:identificador()#/1?fechainicio=#:fechainicio()#&fechafin=#:fechafin()#&descuento=#:totaldescuento()#">
                                #:totalproductos()#
                            </a>
                        </td>
                        <td></td>
                        <td class="text-right">
                            <a href="/cajas/reporteproductoscaja/#:cajaid(0)#?descuento=#:descuentos(0)#">
                                #:producto(0)#
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reporteproductoscaja/#:cajaid(1)#?descuento=#:descuentos(1)#">
                                #:producto(1)#
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reporteproductoscaja/#:cajaid(2)#?descuento=#:descuentos(2)#">
                                #:producto(2)#
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reporteproductoscaja/#:cajaid(3)#?descuento=#:descuentos(3)#">
                                #:producto(3)#
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Tickets Emitidos</td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:identificador()#/1?fechainicio=#:fechainicio()#&fechafin=#:fechafin()#&tipoc=1">
                                #:ticketemitidos()#
                            </a>
                        </td>
                        <td></td>
                        <td class="text-right"> <!--add cajaid(2) cajaid(3)-->
                            <a href="/cajas/reportestickets/#:cajaid(0)#?tipoc=1">
                                #:ticket(0)#
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(1)#?tipoc=1">
                                #:ticket(1)#
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(2)#?tipoc=1">
                                #:ticket(2)#
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(3)#?tipoc=1">
                                #:ticket(3)#
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Tickets Anulados</td>
                        <td class="text-right">
                        #:anulados()#
                        </td>
                        <td></td>
                        <td class="text-right">
                        #:anulado(0)#
                        </td>
                        <td class="text-right">
                        #:anulado(1)#
                        </td>
                        <td class="text-right">
                        #:anulado(2)#
                        </td>
                        <td class="text-right">
                        #:anulado(3)#
                        </td>
                    </tr>
                    <tr>
                    <td colspan="7"></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Fondo Caja</td>
                        <td class="text-right">
                            #:kendo.toString(parseFloat(totalfondocaja()),"n")#
                        </td>
                        <td></td>
                        <td class="text-right">
                        #:kendo.toString(parseFloat(fondocaja(0)),"n")#
                        </td>
                        <td class="text-right">
                        #:kendo.toString(parseFloat(fondocaja(1)),"n")#
                        </td>
                        <td class="text-right">
                        #:kendo.toString(parseFloat(fondocaja(2)),"n")#
                        </td>
                        <td class="text-right">
                        #:kendo.toString(parseFloat(fondocaja(3)),"n")#
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Diferencia</td>
                        <td class="text-right">
                        #:kendo.toString(parseFloat(diferencias()),"n")#
                        </td>
                        <td></td>
                        <td class="text-right">
                        #:kendo.toString(parseFloat(diferencia(0)),"n")#
                        </td>
                        <td class="text-right">
                        #:kendo.toString(parseFloat(diferencia(1)),"n")#
                        </td>
                        <td class="text-right">
                        #:kendo.toString(parseFloat(diferencia(2)),"n")#
                        </td>
                        <td class="text-right">
                        #:kendo.toString(parseFloat(diferencia(3)),"n")#
                        </td>
                    </tr>
                </script>
            </tbody>
            </table>

            <div class="center-block" style="width:400px">
                <h3>Total</h3>
                <a href="javascript:void(o)" class="btn btn-primary pull-right" id ="btn_imprimircajadiario"> Imprimir</a>
                <table>
                    <thead data-template="totalreportediariocaja" data-bind="source: this">
                    <script id="totalreportediariocaja" type="text/x-kendo-template">
                        <tr>
                            <th style="width:200px">Total Efectivo</th>
                            <th style="width:100px" class="text-right" id="totalefectivo">
                            #:kendo.toString(parseFloat(totalefectivo()),"n")#
                            </th>
                        </tr>
                        <tr>
                            <th style="width:200px">Total Tarjeta</th>
                            <th style="width:100px" class="text-right" id="totaltarjeta">
                            #:kendo.toString(parseFloat(totaltarjeta()),"n")#
                            </th>
                        </tr>
                        <tr>
                            <th style="width:200px">Total Importe Prom.</th>
                            <th style="width:100px" class="text-right" id="totalImProm">
                            #:kendo.toString(parseFloat(totalImProm()),"n")#
                            </th>
                        </tr>
                        <tr>
                            <th style="width:200px">Total Vale</th>
                            <th style="width:100px" class="text-right" id="totalvale">
                            #:kendo.toString(parseFloat(totalvale()),"n")#
                            </th>
                        </tr>
                        <tr>
                            <th style="width:200px">Total Dscto. Aut.</th>
                            <th style="width:100px" class="text-right" id="totaldsctoAut">
                            #:kendo.toString(parseFloat(totaldsctoAut()),"n")#
                            </th>
                        </tr>
                        <tr>
                            <th style="width:200px">
                                <a href="/cajas/reportedescuentos/#:identificador()#/1?fechainicio=#:fechainicio()#&fechafin=#:fechafin()#">
                                Total Descuentos
                                </a>
                            </th>
                            <th style="width:100px" class="text-right" id="totaldescuentos">
                                #:kendo.toString(parseFloat(totaldescuento()),"n")#
                            </th>
                        </tr>
                        <tr>
                            <th style="width:200px">Total Venta Neta</th>
                            <th style="width:100px" class="text-right" id="totalventas">
                            #:kendo.toString(parseFloat(totalventas()),"n")#
                            </th>
                        </tr>
                        <tr>
                            <th style="width:200px">Total Abonos Caja</th>
                            <th style="width:100px" class="text-right" id="totalabonosacaja">
                            #:kendo.toString(parseFloat(totalabonosacaja()),"n")#
                            </th>
                        </tr>
                        <tr>
                            <th style="width:200px">
                                <a href="/cajas/reportegastos/#:identificador()#/1?fechainicio=#:fechainicio()#&fechafin=#:fechafin()#">
                                Total Gastos
                                </a>
                            </th>
                            <th style="width:100px" class="text-right" id="totalgastos">
                            #:kendo.toString(parseFloat(totalgastos()),"n")#
                            </th>
                        </tr>
                        <tr>
                            <th style="width:200px">Total Fondo de Caja</th>
                            <th style="width:100px" class="text-right" id="totalfondocaja"> #:kendo.toString(parseFloat(totalfondocaja()),"n")# </th>
                        </tr>
                        <tr>
                            <th style="width:200px">Total Caja</th>
                            <th style="width:100px" class="text-right" id="totalcaja">
                            #: kendo.toString((parseFloat(montoinicial()) + parseFloat(totalventas()) + parseFloat(totalabonosacaja()) -  parseFloat(totalgastos())),"n")#</th>
                        </tr>
                        <tr>
                            <th style="width:200px" >Arqueo</th>
                            <th style="width:100px" id="arqueo" class="text-right">
                            #:kendo.toString((parseFloat(montoinicial()) + parseFloat(totalventas()) + parseFloat(totalabonosacaja()) -  parseFloat(totalgastos()) - parseFloat(diferencias())),"n")#</th>
                        </tr>
                        <tr>
                            <th style="width:200px" >Diferencia</th>
                            <th style="width:100px" id="diferencia" class="text-right">
                            #:kendo.toString(parseFloat(diferencias()),"n")#
                            </th>
                        </tr>
                        <tr>
                            <th style="width:200px">
                                <a href="/cajas/reportestickets/#:identificador()#/1?fechainicio=#:fechainicio()#&fechafin=#:fechafin()#&tipoc=1">
                                    Tickets Emitidos
                                </a>
                            </th>
                            <th style="width:100px" id="temitidos" class="text-right">
                            #:ticketemitidos()#
                            </th>
                        </tr>
                        <tr>
                            <th style="width:200px" >Tickets Anulados</th>
                            <th style="width:100px" id="tanulados" class="text-right">
                            #:anulados()#
                            </th>
                        </tr>
                        <tr>
                            <th style="width:200px" >
                                <a href="/cajas/reporteproductoscaja/#:identificador()#/1?fechainicio=#:fechainicio()#&fechafin=#:fechafin()#&descuento=#:totaldescuento()#">
                                    Productos Vendidos
                                </a>
                            </th>
                            <th style="width:100px" id="pvendidos" class="text-right">#:totalproductos()#</th>
                        </tr>
                    </script>
                    </thead>
                </table>
            </div>
        </div>
</div>
@stop