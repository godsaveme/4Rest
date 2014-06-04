@extends('layouts.pedidosmaster')
@section('mesas_left_panel')
<style>
    input.btn{padding:8px; width:30px;}
    .product {
            float: left;
            position: relative;
            width: 111px;
            height: 170px;
            margin: 0 5px;
            padding: 0;
            z-index: 2;
            top: 10px;
            left: 5px;
        }
        .product img {
            width: 110px;
            height: 110px;
        }
        .product h3 {
            margin: 0;
            padding: 3px 5px 0 0;
            max-width: 96px;
            overflow: hidden;
            line-height: 1.1em;
            font-size: .9em;
            font-weight: normal;
            text-transform: uppercase;
            color: #999;
        }
        .product p {
            visibility: hidden;
        }
        .product:hover p {
            visibility: visible;
            position: absolute;
            width: 110px;
            height: 110px;
            top: 0;
            margin: 0;
            padding: 0;
            line-height: 110px;
            vertical-align: middle;
            text-align: center;
            color: #fff;
            background-color: rgba(0,0,0,0.75);
            transition: background .2s linear, color .2s linear;
            -moz-transition: background .2s linear, color .2s linear;
            -webkit-transition: background .2s linear, color .2s linear;
            -o-transition: background .2s linear, color .2s linear;
        }
        .k-state-active:after{
            content: ".";
            display: block;
            height: 0;
            clear: both;
            visibility: hidden;
        }
        .k-panelbar .k-panel, .k-panelbar .k-content{
            border: none;
        }
        .k-link,.k-header{
            height:60px;
        }
        .km-footer .km-tabstrip{
            height: 80px;
        }
</style>
@foreach ($salones as $salon)
<li>
{{$salon->nombre}}
     <ul>
        @foreach ($arrMesas[$salon->id] as $dato)
            <li style="padding-left:1em; padding-right:3em;" data-click="abrirMesa" data-icon="details" data-role="button" data-idmesa="{{$dato->id}}"><a>{{$dato->nombre}}</a>
            </li>
        @endforeach
     </ul>
</li>
@endforeach


@stop

@section('cesta_view')
<ul data-role="actionsheet" id="cesta_acciones" data-open="onOpen" >
        <li><a href="#" data-action="ordenarpedidos">Enviar Ordenes</a></li>
        <li><a href="#" data-action="btnprecuenta">Precuenta</a></li>
        <li><a href="#" >Mover Mesa</a></li>
        <li><a href="#" data-action="salir_mesa">Regresar</a></li>
        <li><a href="#" data-action="cerrar_mesa">Cerrar Mesa</a></li>
</ul>
<div class="panel panel-warning">
<div class="panel-heading">
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
    <h3 data-role="button" href="#cesta_acciones" data-rel="actionsheet"><span  id="infomesa" data-id="0"></span> - <span id="infomozo" data-idmozo="{{Auth::user()->id}}" data-idpedido="0">
    {{Auth::user()->login}}
    </span>
    </h3>
    </div>
</div>
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <h4>Total de productos: <span class="NmrItms"></span></h4>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <h4>Importe Total: <span class="montoTotalcu"></span></h4>
        </div>
    </div>
</div>
<ul class="list-group text-center" id="enviarcombi">
</ul>
<ul class="list-group text-center" id="enviarpf">
</ul>
<ul class="list-group list-group-flush text-center" id="productosenviados">
</ul>
</div>
<script type="text/x-kendo-template" id="template_productosf">
    <li class="list-group-item #=pestado#" data-iddetped="#=iddetpedido#" data-estado="#=pestado#" data-enviado="1">
            <div class="row">
                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                    #=cantidad#
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 text-left">
                #if (adicionales == 2){#&nbsp;&nbsp;&nbsp;&nbsp; ~#}#
                    #=pronombre#
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    S/. <span class="montoTotal">#=precio#</span>
                </div>
            </div>
    </li>
</script>

<script type="text/x-kendo-template" id="template_productosc">
    <li class="list-group-item" data-enviado="1">
        <div class="row">
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                #=cantidad#
            </div>
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                <ul class="list-group list-group-flush">
                    #for(var i in produccomb){#
                        <li class="list-group-item #=produccomb[i]['pestado']#" data-iddetped="#=produccomb[i]['iddetpedido']#" data-estado="#=produccomb[i]['pestado']#" data-tipo="c">
                            #=produccomb[i]['pronombre']#
                        </li>
                    #}#
                </ul>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                S/. <span class="montoTotal">#=precio#</span>
            </div>
        </div>
    </li>
</script>
@stop


@section('carta_view')
    @foreach ($tiposcomb as $tipocomb)
            <li>
            {{$tipocomb->nombre}}
            <ul>
            @foreach ($combinaciones[$tipocomb->nombre] as $pcom)
                <li><a href="javascript:void(0)" class="btn_createcombi" data-idcombi="{{$pcom->id}}" data-combiprecio ="{{$pcom->preciotcomb}}">{{$pcom->nombre}}</a>
                </li>
            @endforeach
            </ul>
            </li>
    @endforeach
    @foreach ($familias as $familia)
            <li class="familia" data-idf="{{$familia->id}}">
            {{$familia->nombre}}
            @foreach ($platosfamilia[$familia->nombre] as $datos)
            <div class="product" data-pronombre = "{{$datos->nombre}}" 
                data-proid="{{$datos->id}}" data-proprecio = "{{$datos->precio}}"
                data-cantsabores = "
                @if ($datos->cantidadsabores)
                {{$datos->cantidadsabores}}
                @endif">
            {{HTML::image('/images/productos/shake.jpg')}}
            <h3>{{$datos->nombre}}</h3>
            <p>{{$datos->precio}}</p>
            </div>
            @endforeach
          </li>
    @endforeach
@stop

@section('platos_right_panel')
        <div id="example">
            <div id="pages">
                <div id="pages-title"><span>Site Menu</span></div>
                <div id="sortable-handlers">
                    <div class="item">
                        <a class="handler">&nbsp;</a>
                        <span>About us</span>
                    </div>
                    <div class="item">
                        <span class="handler">&nbsp;</span>
                        <span>Contact us</span>
                    </div>
                    <div class="item">
                        <span class="handler">&nbsp;</span>
                        <span>Community</span>
                    </div>
                    <div class="item">
                        <span class="handler">&nbsp;</span>
                        <span>Products</span>
                    </div>
                    <div class="item">
                        <span class="handler">&nbsp;</span>
                        <span>Services</span>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/x-kendo-template" id="template_cestacombinaciones">
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-1">
                <div class="input-group">
                    <div class="input-group-btn">
                    <a href="javascript:void(0)" class="btn btn-primary btn_mincanti" data-iddatasour = "#:id#">
                                <span class="glyphicon glyphicon-minus"></span>
                    </a>
                    </div>
                    <div class="input-group-btn">
                    <button class="btn btn-default" data-iddatasour = "#:id#" disabled>#:cantidad#</button>
                    </div>
                     <div class="input-group-btn">
                        <a href="javascript:void(0)" class="btn btn-primary btn_pluscanti" data-iddatasour = "#:id#">
                            <span class="glyphicon glyphicon-plus"></span>
                            </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <ul class="list-group">
                #for (var i = 0; i < fcantidad; i++) {#
                    #if( eval(producombi[i]).nombre != '-'){#
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <i class="fi-clipboard-pencil notas" data-filaid ="#=id#" data-id="#=eval(producombi[i]).idprocombi#" data-procombi ="#=producombi[i]#"></i>
                                </div>
                                <div class="col-xs-7 col-sm-7 col-md-8 col-lg-8">
                                    #=eval(producombi[i]).nombre#
                                    <ul class="list-inline" id="notas_#=id#">
                                    #for (var y = eval(producombi[i]).cantidadnotas - 1; y >= 0; y--) {#
                                        <li><span class="glyphicon glyphicon-pencil"></span> #=eval(producombi[i])['notas'][y]['nombre']#</li>
                                    #}#
                                    </ul>
                                    <ul class="list-inline" id="sabores_#=id#">
                                    #for (var y = eval(producombi[i]).cantidadsabores - 1; y >= 0; y--) {#
                                        <li> #=eval(producombi[i])['sabores'][i]['nombre']#</li>
                                    #}#
                                    </ul>
                                    <ul class="list-unstyled adicionales" id="adiconales_#=id#">
                                    #for (var y = eval(producombi[i]).cantidadadicionales - 1; y >= 0; y--) {#
                                        <li> <a href="javascript:void(0)" class="btn btn-primary btn_mincanti" data-iddatasour = "#:id#">
                                            <span class="glyphicon glyphicon-minus"></span>
                                            </a>
                                            #=eval(producombi[i])['adicionales'][y]['nombre']# x #=eval(producombi[i])['adicionales'][y]['cantidad']# - S/. <span class="montoTotal">eval(producombi[i])['adicionales'][y]['precio']</span>
                                        </li>
                                    #}#
                                    </ul>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
                                    <a href="javascript:void(0)" class="btn btn-info">
                                    <span class="glyphicon glyphicon-th-list"></span>
                                    </a>
                                </div>
                            </div>
                        </li>
                    #}#
                #}#
                </ul>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <span class="montoTotal">#:preciot#</span>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <a href="javascript:void(0)" class="btn btn-default reitemcesta" data-iddatasour = "#:id#">
                        <span class="glyphicon glyphicon-floppy-remove"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </li>
</script>

<script type="text/x-kendo-template" id="template_cestaproductos">
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                <i class="fi-clipboard-pencil notas" data-filaid ="#=id#" data-popover="1" data-id="#=idpro#"></i>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-1">
                <div class="input-group">
                    <div class="input-group-btn">
                    <a href="javascript:void(0)" class="btn btn-primary btn_mincanti" data-iddatasour = "#:id#">
                                <span class="glyphicon glyphicon-minus"></span>
                    </a>
                    </div>
                    <div class="input-group-btn">
                    <button class="btn btn-default" data-iddatasour = "#:id#" disabled>#:cantidad#</button>
                    </div>
                     <div class="input-group-btn">
                        <a href="javascript:void(0)" class="btn btn-primary btn_pluscanti" data-iddatasour = "#:id#">
                            <span class="glyphicon glyphicon-plus"></span>
                            </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <p class="text-primary produnombre"  style="word-wrap: break-word;"
                #if (numsabores) {#
                    data-numsabores = #=numsabores#
                #}#
                data-iddatasour = "#:id#" >#:nombre#</p>
                    <ul class="list-inline" id="notas_#=id#">
                    #for (var i = cantidadnotas - 1; i >= 0; i--) {#
                        <li style="font-size:12px; text-align: left; margin: 5px">
                        <span class="glyphicon glyphicon-pencil"></span> #=notas[i]['nombre']#</li>
                    #}#
                    </ul>
                    <ul class="list-inline sabores" id="sabores_#=id#">
                    #for (var i = cantidadsabores - 1; i >= 0; i--) {#
                        <li style="font-size:12px; text-align: left; margin: 5px">
                         <a href="javascript:void(0)" class="btn btn-primary btn-sm btn_minsabor" 
                                data-idsabor="#=sabores[i]['idsabor']#" data-idfila = "#:id#">
                            <span class="glyphicon glyphicon-minus"></span>
                         </a>
                         #=sabores[i]['nombre']#
                        </li>
                    #}#
                    </ul>
                    <ul class="list-unstyled adicionales" id="adiconales_#=id#">
                    #for (var i = cantidadadicionales - 1; i >= 0; i--) {#
                        <li style="font-size:12px; text-align: left; margin: 5px"> 
                            <a href="javascript:void(0)" class="btn btn-primary btn_minadi" 
                                data-idadi="#=adicionales[i]['idadicional']#" data-idfila = "#:id#">
                            <span class="glyphicon glyphicon-minus"></span>
                            </a>
                            #=adicionales[i]['nombre']# x #=adicionales[i]['cantidad']# - <span class="montoTotal">
                            #=adicionales[i]['preciot']#</span>
                        </li>
                    #}#
                    </ul>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <span class="montoTotal">#:preciot#</span>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <a href="javascript:void(0)" class="btn btn-info btn_adi" data-filaid ="#=id#" data-id="#=idpro#">
                        <span class="glyphicon glyphicon-th-list"></span>
                        </a>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <a href="javascript:void(0)" class="btn btn-default reitemcesta" data-iddatasour = "#:id#">
                        <span class="glyphicon glyphicon-floppy-remove"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </li>
</script>


<script type="text/x-kendo-template" id="template_combi_iz">
    #var f = 0#
    # for (var i in familias) { #
                <li class="list-group-item">
                    <span class="negrita #=familias[i]['familiaid']#" data-idfila ="#=f#" data-idselec ="0" data-cantidad="#=familias[i]['cantidad']#">#=familias[i]['familianombre']#</span> <br>
                    <div class="btn-group">
                    #for (var j in familias[i]['productos']) {#
                        <button type="button" class="btn btn-default procombi" data-faid ="#=familias[i]['familiaid']#" data-cantidad="#=familias[i]['cantidad']#" data-procompre = "#=familias[i]['productos'][j]['precio']#"
                        data-procombiid ="#=familias[i]['productos'][j]['id']#">#=familias[i]['productos'][j]['nombre']#</button>
                    #}#
                    </div>
                </li>
                #for (var j = 0; j < familias[i]['cantidad']; j++) {#
                    #f++#
                #}#
            # } #
    </script>
    <script type="text/x-kendo-template" id="template_combi_de">
    #var faconta = 0#
    #for (var i in familias) {#
        #for (var j = 0; j < familias[i]['cantidad']; j++) {#
            <th>#=familias[i]['familianombre']#</th>
            #faconta++#
        #}#
    #}#
    <input type="hidden" value="#=faconta#" id="fcombicantidad">
    </script>

    <script type="text/x-kendo-template" id="template_listacombi">
    <table>
    <tr>
    #for (var i = 0; i< cantidad; i++){#
        <td data-listaid="#=id#" data-pro= "#=producombi[i]#">#=eval(producombi[i]).nombre#</td>
    #}#
    </tr>
    </table>
    </script>
    
    <div class="modalwindowprecuenta">
        <table class="table table-striped">
        <thead style="font-size: 13px">
            <tr class="info">
                <td>Descripcion</td>
                <td>PreUni</td>
                <td>Cant</td>
                <td>PrecioT</td>
            </tr>
        </thead>
        <tbody id="listaprecuenta" style="font-size: 12px">
        <script type="text/x-kendo-template" id="template_precuenta">
        #var importefinal = 0;#
        #for (var i = 0 ; i < precuenta.length ; i++) {#
            <tr>
                <td>#=precuenta[i]['nombre']#</td>
                <td>#=precuenta[i]['preciou']#</td>
                <td>#=precuenta[i]['cantidad']#</td>
                <td>#=parseFloat(precuenta[i]['precio']).toFixed(2)#</td>
            </tr>
        #importefinal +=parseFloat(precuenta[i]['precio']); }#
        <tr>
            <td>Total</td>
            <td></td>
            <td></td>
            <td>#=parseFloat(importefinal).toFixed(2)#</td>
        </tr>
        </script>
        </tbody>
        </table>
          <button type="button" class="btn btn-danger pull-right" id="btn_cancelarpre">Cancelar</button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;" id="btn_aceptarpre">
          Aceptar</button>
</div>
@stop