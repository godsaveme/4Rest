@extends('layouts.pedidosmaster')
@section('content')
<div class="platosusuario">
    <script type="text/template" id="productosusuario-template">
        <% _.each(productos, function(i) { %>
            <li class="<%=i.pivot.estado%>" data-id ="<%= i.pivot.id%>">
                &nbsp;
                <%if (i.pivot.estado == 'I') {%>
                    <i class="fa fa-clock-o"></i>
                <%}else if(i.pivot.estado == 'P'){ %>
                    <i class="flaticon-chef15"></i>
                <%}else if(i.pivot.estado=='E'){%>
                    <i class="flaticon-restaurant36"></i>
                <%}else if(i.pivot.estado == 'D'){%>
                    <i class="flaticon-restaurant2"></i>
                <%}%>
                &nbsp;
                <%=i.nombre %> 
                &nbsp; / <%=mesas[0].nombre%>
            </li>
        <%}); %>
    </script>
</div>
<div class="userui">
    <div class="salones" data-userid="{{Auth::user()->id}}">
        @foreach ($salones as $salon)
        <div class="salon">
            {{$salon->nombre}}
        </div>
        @endforeach
    </div>

    <div class="mesas">
            <script type="text/template" id="mesa-template">
                <span class="nombre_mesa"><%=nombre%></span><br>
                <span class="nombre_mesa"><%=login%> </span><br><br>
                <span class="nombre_mesa"><i class="fa fa-clock-o"></i> <%=tiempomesa%></span><br>
                <span class="nombre_mesa">S/. <%=importetotal%></span>
            </script>
    </div>

    <div class="comanda">
        <nav id="nav-pedido">
            <ul>
                <li>
                    <a href="javascript:void(0)">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="totalitems">
                            1
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#enviarorden" class="btn_accion">
                        <i class="fa fa-send"></i> Ordenar
                    </a>
                </li>
                <li>
                    <a href="#getPrecuenta" class="btn_accion btn_precuenta">
                        <i class="fa fa-calculator"></i> Precuenta
                    </a>
                </li>
                <li>
                    <a href="#mostarcarta" class="btn_accion flagcarta">
                        <i class="fa fa-reorder"></i>
                        <span>Carta</span>
                    </a>
                </li>
                 <li>
                    <a href="#mostarsalones" class="btn_accion">
                        <i class="fa fa-reply"></i>
                        Salon
                    </a>
                </li>
            </ul>
        </nav>
        <nav id="nav-combinacion" style="display:none">
            <ul>
                <li>
                    <a href="javascript:void(0)">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="totalitems">
                            0
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#" class="btn_mesa">
                        <i class="fa fa-reply"></i>
                        Mesa
                    </a>
                </li>
            </ul>
            <a href="javascript:void(0)" id="agregar_cesta">
                <i class="fa fa-plus-circle"></i>
                Agregar
            </a>
        </nav>
        <nav id="nav-notas-adicionales" style="display:none">
            <ul>
                <li>
                    <a href="javascript:void(0)">
                        <i class="fa fa-check"></i>
                        <span class="select_product">

                        </span>
                    </a>
                </li>
                <li>
                    <a href="#" id="notas">
                        <i class="fa fa-book"></i>
                        Notas (<span class="count_notas">0</span> )
                    </a>
                </li>
                <li>
                    <a href="#" id="adicionales">
                        <i class="fa fa-bars"></i>
                        Adicionales (<span class="count_adicionales">0</span> )
                    </a>
                </li>
                <li>
                    <a href="#" class="btn_mesa">
                        <i class="fa fa-reply"></i>
                        Mesa
                    </a>
                </li>
            </ul>
        </nav>
        <div class="precuenta" style="display:none">
        </div>
        <div class="pedido pedido_mesa">
            <div class="pedidoencabezado">
                <ul>
                    <li>
                        Total Productos: <span class="totalitems"></span>
                    </li>
                    <li>
                        Importe Total: S/. <span class="totalprecio"></span>
                    </li>
                </ul>
            </div>
            <ul class="cestaitems">
            </ul>
        </div>
        <div class="carta">
            <div class="productotitulo">
                Familia
            </div>
            <div class="listaproductos">
            </div>
            <div class="notas">
                <ul>
                </ul>
            </div>
            <div class="sabores">
            <h3> <span class="productonombre"></span> / <span class="count_sabores"></span></h3>
            </div>
            <div class="adicionales">

            </div>
        </div>
    </div>
</div>

<script type="text/template" id="sabor-template">
    <div class="stock">
       0
    </div>
    <span class="nproducto">
        <%=nombre %>
    </span>
</script>
<script type="text/template" id="adicional-template">
    <div class="stock">
        0
    </div>
    <span class="nproducto">
        <%=nombre %><br>
        <%=precio %>
    </span>
</script>
<script type="text/template" id="nota-template">
    <%=descripcion%>
</script>
<script type="text/template" id="tipocombinacion-template">
    <span class="nfamilia">
        <%=TipoCombinacionNombre %>
    </span>
</script>
<script type="text/template" id="familia-template">
    <span class="nfamilia">
        <%=nombre %>
    </span>
</script>
<script type="text/template" id="combinacion-template">
    <span class="nproducto">
        <%=CombinacionNombre %><br>
        <%=CombinacionPrecio %>
    </span>
</script>

<script type="text/template" id="producto-template">
    <div class="stock">
        <%=stock%>
    </div>
    <span class="nproducto">
        <%=nombre %><br>
        <%=precio %>
    </span>
</script>

<script type="text/template" id="pcombinaciones-template">
        <div class="combinaciontitle">
            <%=fnombre %>  <span class="cantidad">(<%=combcantidad%>)</span>
        </div>
        <% _.each(productos, function(i) { %>
            <div class="producto" data-id="<%=i.productoid %>">
                <div class="stock">
                    <%= i.stock%>
                </div>
                <span class="nproducto">
                    <%= i.nombre %>
                </span>
            </div>
        <% }); %>
</script>


<script type="text/template" id="productocesta-template">
    <div class="itemcantidad">
        <%= cantidad %>
    </div>
    <div class="itemcontrol">
        <a href="#" class="btn-controlprimary minus">
            <i class="fa fa-minus"></i>
        </a>
        <a href="#" class="btn-controlprimary plus">
            <i class="fa fa-plus"></i>
        </a>
    </div>
    <div class="itemproducto">
        <span class="itemnombre">
            <%=nombre%>
        </span>
        <span class="itemprecio">
            <%=preciot%>
        </span>

        <div class="itemsabores">
            <%if(sabores.length > 0){%>
                <% _.each(sabores, function(y) {%>
                    <%=y.nombre%>,
                <% });%>
            <%}%>
            <%if(notas.length > 0){%>
                <% _.each(notas, function(y) {%>
                    <%=y.nombre%>,
                <% });%>
            <%}%>
        </div>
        <%if(adicionales.length > 0){%>
        <div class="itemadicionales">
            <ul>
            <% _.each(adicionales, function(y) {%>
                <li>
                <span class="adicionalnombre">(<%= y.cantidad%>) <%= y.nombre%></span>
                <span class="adicionalprecio"><%= y.precio%></span>
                </li>
            <% });%>
            </ul>
        </div>
        <%}%>
    </div>
    <div class="itemadicional">
        <a href="#" class="btn-controlprimary">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <div class="itemremover">
        <a href="#" class="btn-controlprimary">
            <i class="fa fa-remove"></i>
        </a>
    </div>
</script>


<script type="text/template" id="combinacioncesta-template">
    <div class="itemcantidad">
        <%=cantidad %>
    </div>
    <div class="itemcontrol">
        <a href="#" class="btn-controlprimary minus">
            <i class="fa fa-minus"></i>
        </a>
        <a href="#" class="btn-controlprimary plus">
            <i class="fa fa-plus"></i>
        </a>
    </div>
    <div class="itemproducto">
        <ul class="combinaciones">
        <% _.each(productos, function(i) { %>
            <li data-indice="<%=i.indice%>">
                <span class="itemnombre">
                    <%=i.nombre%>
                </span>
                <div class="itemsabores">
                <%if(i.sabores.length > 0){%>
                    <% _.each(i.sabores, function(y) {%>
                        <%=y.nombre%>,
                    <% });%>
                <%}%>
                <%if(i.notas.length > 0){%>
                    <% _.each(i.notas, function(y) {%>
                        <%=y.nombre%>,
                    <% });%>
                <%}%>
                </div>
                <%if(i.adicionales.length > 0){%>
                <div class="itemadicionales">
                    <ul>
                    <% _.each(i.adicionales, function(y) {%>
                        <li>
                        <span class="adicionalnombre">(<%= y.cantidad%>) <%= y.nombre%></span>
                        <span class="adicionalcombinacion"><%= y.precio%></span>
                        </li>
                    <% });%>
                    </ul>
                </div>
                <%}%>
            </li>
        <% }); %>
        </ul>
        <span class="itemprecio">
            <%= preciot%>
        </span>
    </div>
    <div class="itemadicional">
       <a href="#" class="btn-controlprimary">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <div class="itemremover">
        <a href="#" class="btn-controlprimary">
            <i class="fa fa-remove"></i>
        </a>
</div>
</script>

<script type="text/template" id="productomesa-template">
    <div class="pcestacantidad">
        <%=cantidad%>
    </div>
    <div class="pcestanombre">
        &nbsp;
        <%if (estado == 'I') {%>
            <i class="fa fa-clock-o"></i>
        <%}else if(estado == 'P'){ %>
            <i class="flaticon-chef15"></i>
        <%}else if(estado=='E'){%>
            <i class="flaticon-restaurant36"></i>
        <%}else if(estado == 'D'){%>
            <i class="flaticon-restaurant2"></i>
        <%}%>
        &nbsp;
        <%=nombre%>
    </div>
    <div class="pcestaprecio">
        <%=precio%>
    </div>
</script>
<script type="text/template" id="combinacionmesa-template">
    <div class="pcestacantidad">
        <%= cantidad%>
    </div>
    <div class="pcestanombre">
        <ul class="productomesacombinaciones">
        <% _.each(productos, function(i) {%>
            <li class="<%=i.estado%>" data-id ="<%= i.idpedido%>">
                &nbsp;
                <%if (i.estado == 'I') {%>
                    <i class="fa fa-clock-o"></i>
                <%}else if(i.estado == 'P'){ %>
                    <i class="flaticon-chef15"></i>
                <%}else if(i.estado=='E'){%>
                    <i class="flaticon-restaurant36"></i>
                <%}else if(i.estado == 'D'){%>
                    <i class="flaticon-restaurant2"></i>
                <%}%>
                &nbsp;
                <%=i.nombre %>
            </li>
        <% });%>
        </ul>
    </div>
    <div class="pcestaprecio">
        <%= precio%>
    </div>
</script>


<script type="text/template" id="precuenta-template">
<a href="#" id="print_precuenta">Imprimir PreCuenta</a>
<table>
    <thead>
        <tr>
            <th style="width: 60%">Nombre</th>
            <th style="width: 15%">Precio Unitario</th>
            <th style="width: 10%">Cantidad</th>
            <th style="width: 15%">Importe</th>
        </tr>
    </thead>
    <tbody>
    <%_.each(items, function(i) { %>
         <tr>
            <td><%=i.nombre %> </td>
            <td style="text-align: right"><%=i.preciou %> </td>
            <td style="text-align: right"><%=i.cantidad %> </td>
            <td style="text-align: right"><%=i.precio %> </td>
        </tr>
    <%}); %>
        <tr>
            <td colspan="3">Total</td>
            <td style="text-align: right"><%=total%></td>
        </tr>
    </tbody>
</table>
</script>

@stop