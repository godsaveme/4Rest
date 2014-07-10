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
                                <input id="fecha_fin" placeholder="Fecha Fin"/>
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
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Turno</th>
                        <th>F. Caja</th>
                        <th>In. Caja</th>
                        <th>Efec</th>
                        <th>Tarj</th>
                        <th>Vale</th>
                        <th>Desc</th>
                        <th>Ventas</th>
                        <th>Gastos</th>
                        <th>Caja</th>
                        <th>Arque.</th>
                        <th>Dif.</th>
                        <th>Pro. V</th>
                        <th>T. Emi</th>
                        <th>T. Anu.</th>
                    </tr>
                </thead>
                <tbody data-template="reportediario_template" data-bind="source: datosreporte">
                <script id="reportediario_template" type="text/x-kendo-template">
	                <tr>
	                    <td class="text-left">
                            <a href="/cajas/reportestickets/#:cajaid#">
                                #: kendo.toString(get("usuario"), "C")#
                            </a>
                        </td>
	                    <td class="text-left">#: kendo.toString(get("turno"), "C") #</td>	
	                    <td class="text-right">#: kendo.toString(get("fondodecaja"), "C") #</td>
	                    <td class="text-right">#: kendo.toString(get("ingresoscaja"), "C") #</td>
	                    <td class="text-right">#: kendo.toString(get("totalefectivo"), "C") #</td>
	                    <td class="text-right">#: kendo.toString(get("totaltarjeta"), "C") #</td>
	                    <td class="text-right">#: kendo.toString(get("totalvale"), "C") #</td>
	                    <td class="text-right">
                            <a href="/cajas/reportedescuentos/#:cajaid#">
                                #: kendo.toString(get("totaldescuentos"), "C") #
                            </a>
                        </td>
                        <td class="text-right">#: kendo.toString(get("totalventas"), "C") #</td>
                        <td class="text-right">
                            <a href="/cajas/reportegastos/#:cajaid#">
                            #: kendo.toString(get("gastos"), "C")#
                            </a>
                        </td>
                        <td class="text-right">#: kendo.toString(get("caja"), "C") #</td>
                        <td class="text-right">#: kendo.toString(get("arqueo"), "C") #</th>
                        <td class="text-right">#: kendo.toString(get("dif"), "C") #</th>
                        <td class="text-right">
                            <a href="/cajas/reporteproductoscaja/#:cajaid#?descuento=#:totaldescuentos#">
                                #: tproductos #
                            </a>
                        </td>
                        <td class="text-right">#: totaltickets #</td>
                        <td class="text-right">#: totalanulados#</td>
	                </tr>
                </script>
                </tbody>
            </table>
            <table class="table table-bordered">
            <tbody data-template="reportediario_template" data-bind="source: datosreporte">
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
                        <td style="font-weight: bold;">Venta</td>
                        <td class="text-right" style="width: 10%">
                            <a href="/cajas/reportestickets/#:identificador()#/1?fechainicio=#:fechainicio()#&fechafin=#:fechafin()#&tipoc=1">
                                #:(parseFloat(totalventas()) + parseFloat(totaldescuento())).toFixed(2)#
                            </a>
                        </td>
                        <td style="width: 10%"></td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(0)#">
                                #:(parseFloat(venta(0)) + parseFloat(descuentos(0))).toFixed(2)#
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(1)#">
                                #:(parseFloat(venta(1)) + parseFloat(descuentos(1))).toFixed(2)#
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(2)#">
                                #:(parseFloat(venta(2)) + parseFloat(descuentos(2))).toFixed(2)#
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(3)#">
                                #:(parseFloat(venta(3)) + parseFloat(descuentos(3))).toFixed(2)#
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Efectivo</td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:identificador()#/1?fechainicio=#:fechainicio()#&fechafin=#:fechafin()#&tipoc=2">
                                #:totalefectivo()#
                            </a>
                        </td>
                        <td class="text-right">
                            #: (parseFloat(totalefectivo())*100/(parseFloat(totalventas()) + parseFloat(totaldescuento()))).toFixed(2) # %
                        </td>
                        <td class="text-right">#:efectivo(0)#</td>
                        <td class="text-right">#:efectivo(1)#</td>
                        <td class="text-right">#:efectivo(2)#</td>
                        <td class="text-right">#:efectivo(3)#</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Tarjeta</td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:identificador()#/1?fechainicio=#:fechainicio()#&fechafin=#:fechafin()#&tipoc=3">
                                #:totaltarjeta()#
                            </a>
                        </td>
                        <td class="text-right">
                            #: (parseFloat(totaltarjeta())*100/(parseFloat(totalventas()) + parseFloat(totaldescuento()))).toFixed(2) # %
                        </td>
                        <td class="text-right">#:tarjeta(0)#</td>
                        <td class="text-right">#:tarjeta(1)#</td>
                        <td class="text-right">#:tarjeta(2)#</td>
                        <td class="text-right">#:tarjeta(3)#</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Descuentos</td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:identificador()#/1?fechainicio=#:fechainicio()#&fechafin=#:fechafin()#&tipoc=4">
                                #:totaldescuento()#
                            </a>
                        </td>
                        <td class="text-right">
                            #: (parseFloat(totaldescuento())*100/(parseFloat(totalventas()) + parseFloat(totaldescuento()))).toFixed(2) # %
                        </td>
                        <td class="text-right">#:descuentos(0)#</td>
                        <td class="text-right">#:descuentos(1)#</td>
                        <td class="text-right">#:descuentos(2)#</td>
                        <td class="text-right">#:descuentos(3)#</td>
                    </tr>
                    <tr>
                        <td colspan="7">
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Promociones</td>
                        <td class="text-right"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Vales Personal</td>
                        <td class="text-ight"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Descuento Autorizado</td>
                        <td class="text-right">#:totalvale()#</td>
                        <td></td>
                        <td class="text-right">#:descuentoautorizado(0)#</td>
                        <td class="text-right">#:descuentoautorizado(1)#</td>
                        <td class="text-right">#:descuentoautorizado(2)#</td>
                        <td class="text-right">#:descuentoautorizado(3)#</td>
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
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(0)#">
                                #:ticket(0)#
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(1)#">
                                #:ticket(1)#
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(0)#">
                                #:ticket(2)#
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="/cajas/reportestickets/#:cajaid(0)#">
                                #:ticket(3)#
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Tickets Anulados</td>
                        <td class="text-right">#:anulados()#</td>
                        <td></td>
                        <td class="text-right">#:anulado(0)#</td>
                        <td class="text-right">#:anulado(1)#</td>
                        <td class="text-right">#:anulado(2)#</td>
                        <td class="text-right">#:anulado(3)#</td>
                    </tr>
                    <tr>
                    <td colspan="7"></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Fondo Caja</td>
                        <td class="text-right"></td>
                        <td></td>
                        <td class="text-right">#:fondocaja(0)#</td>
                        <td class="text-right">#:fondocaja(1)#</td>
                        <td class="text-right">#:fondocaja(2)#</td>
                        <td class="text-right">#:fondocaja(3)#</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Diferencia</td>
                        <td class="text-right">#:diferencias()#</td>
                        <td></td>
                        <td class="text-right">#:diferencia(0)#</td>
                        <td class="text-right">#:diferencia(1)#</td>
                        <td class="text-right">#:diferencia(2)#</td>
                        <td class="text-right">#:diferencia(3)#</td>
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
                            <th style="width:100px" class="text-right" id="totalefectivo">#:totalefectivo()#</th>
                        </tr>
                        <tr>
                            <th style="width:200px">Total Tarjeta</th>
                            <th style="width:100px" class="text-right" id="totaltarjeta">#:totaltarjeta()#</th>
                        </tr>
                        <tr>
                            <th style="width:200px">Total Vale</th>
                            <th style="width:100px" class="text-right" id="totalvale">#:totalvale()#</th>
                        </tr>
                        <tr>
                            <th style="width:200px">
                                <a href="/cajas/reportedescuentos/#:identificador()#/1?fechainicio=#:fechainicio()#&fechafin=#:fechafin()#">
                                Total Descuentos
                                </a>
                            </th>
                            <th style="width:100px" class="text-right" id="totalvale">
                                #:totaldescuento()#
                            </th>
                        </tr>
                        <tr>
                            <th style="width:200px">Total Ventas</th>
                            <th style="width:100px" class="text-right" id="totalventas">#:totalventas()#</th>
                        </tr>
                        <tr>
                            <th style="width:200px">Total Abonos Caja</th>
                            <th style="width:100px" class="text-right" id="totalabonosacaja">#:totalabonosacaja()#</th>
                        </tr>
                        <tr>
                            <th style="width:200px">
                                <a href="/cajas/reportegastos/#:identificador()#/1?fechainicio=#:fechainicio()#&fechafin=#:fechafin()#">
                                Total Gastos
                                </a>
                            </th>
                            <th style="width:100px" class="text-right" id="totalgastos">#:totalgastos()#</th>
                        </tr>
                        <tr>
                            <th style="width:200px">Total Caja</th>
                            <th style="width:100px" class="text-right" id="totalcaja">#: (parseFloat(montoinicial()) + parseFloat(totalventas()) + parseFloat(totalabonosacaja()) -  parseFloat(totalgastos())).toFixed(2)#</th>
                        </tr>
                        <tr>
                            <th style="width:200px" >Arqueo</th>
                            <th style="width:100px" id="arqueo" class="text-right">#:(parseFloat(montoinicial()) + parseFloat(totalventas()) + parseFloat(totalabonosacaja()) -  parseFloat(totalgastos()) - parseFloat(diferencia())).toFixed(2)#</th>
                        </tr>
                        <tr>
                            <th style="width:200px" >Diferencia</th>
                            <th style="width:100px" id="diferencia" class="text-right">#:diferencia()#</th>
                        </tr>
                        <tr>
                            <th style="width:200px">
                                <a href="/cajas/reportestickets/#:identificador()#/1?fechainicio=#:fechainicio()#&fechafin=#:fechafin()#">
                                    Tickets Emitidos
                                </a>
                            </th>
                            <th style="width:100px" id="temitidos" class="text-right">#:ticketemitidos()#</th>
                        </tr>
                        <tr>
                            <th style="width:200px" >Tickets Anulados</th>
                            <th style="width:100px" id="tanulados" class="text-right">#:anulados()#</th>
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