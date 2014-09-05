@extends('layouts.pedidosmaster')
@section('content')
<div class="salones">
    @foreach ($salones as $salon)
    <div class="salon">
        {{$salon->nombre}}
    </div>
    @endforeach
</div>
@foreach ($salones as $salon)
<div class="mesas" id="{{$salon->id}}">
    @foreach ($arraymesas[$salon->id] as $mesa)
        <div class="mesa" data-id="{{$mesa->id}}" salon-nombre="{{$salon->nombre}}">
            <span class="nombre_mesa">{{$mesa->nombre}}</span>
        </div>
    @endforeach
</div>
@endforeach
<div class="comanda">
    <nav id="nav-pedido">
        <ul>
            <li>
                <a href="#enviarorden" class="btn_accion">
                    <i class="fa fa-send"></i> Ordenar
                </a>
            </li>
            <li>
                <a href="#precuenta" class="btn_accion">
                    <i class="fa fa-calculator"></i> Precuenta
                </a>
            </li>
            <li>
                <a href="#mostarcarta" class="btn_accion">
                    <i class="fa fa-reorder"></i>
                    Carta
                </a>
            </li>
             <li>
                <a href="#mostarsalones" class="btn_accion">
                    <i class="fa fa-reply"></i>
                    Regresar
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" class="totalitems">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="totalitems">
                        1
                    </span>
                </a>
            </li>
        </ul>
    </nav>
    <nav id="nav-combinacion">
        <ul>
            <li>
                <a href="javascript:void(0)" id="agregar_cesta">
                    <i class="fa fa-plus-circle"></i>
                    Agregar
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" class="totalitems">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="totalitems">
                        1
                    </span>
                </a>
            </li>
        </ul>
    </nav>
    <div class="pedido">
        <div class="pedidoencabezado">
            <ul>
                <li>
                    Total Productos:
                </li>
                <li>
                    Importe Total: 
                </li>
            </ul>
        </div>
        <ul class="cestaitems">
             <li>
                
            </li>
        </ul>
    </div>
    <div class="carta">
        <div class="productotitulo">
            Familia
        </div>
        <div class="listaproductos">
        </div>
    </div>
</div>
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
                <span class="adicionalprecio"><%= y.preciot%></span>
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
            <li>
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
                        <span class="adicionalcombinacion"><%= y.preciot%></span>
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

@stop