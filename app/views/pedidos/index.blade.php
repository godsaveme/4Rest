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
    <nav>
        <ul>
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
                        <span id="totalitems">
                            1
                        </span>
                    </a>
                </li>
            </ul>
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
                <div class="itemcantidad">
                    1
                </div>
                <div class="itemcontrol">
                    <a href="#" class="btn-controlprimary" data-item="1">
                        <i class="fa fa-minus"></i>
                    </a>
                    <a href="#" class="btn-controlprimary" data-item="1">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="itemproducto">
                    <span class="itemnombre">
                        Arroz con Chancho
                    </span>
                    <span class="itemprecio">
                        10.00
                    </span>
                    
                    <div class="itemsabores">
                        Fresa, Lucuma, Durazno
                    </div>
                    <div class="itemadicionales">
                        <ul>
                            <li>
                            <span class="adicionalnombre">(1) Huevos</span>
                            <span class="adicionalprecio">1.00</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="itemadicional">
                    <a href="#" class="btn-controlprimary" data-item="1">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
                <div class="itemremover">
                    <a href="#" class="btn-controlprimary" data-item="1">
                        <i class="fa fa-remove"></i>
                    </a>
                </div>
            </li>

            <li>
                <div class="itemcantidad">
                    1
                </div>
                <div class="itemcontrol">
                    <a href="#" class="btn-controlprimary" data-item="1">
                        <i class="fa fa-minus"></i>
                    </a>
                    <a href="#" class="btn-controlprimary" data-item="1">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="itemproducto">
                    <ul class="combinaciones">
                        <li>
                            <span class="itemnombre">
                                Arroz con Chancho
                            </span>
                            <div class="itemsabores">
                                Fresa, Lucuma, Durazno
                            </div>
                            <div class="itemadicionales">
                                <ul>
                                    <li>
                                    <span class="adicionalnombre">(1) Huevos</span>
                                    <span class="adicionalcombinacion">1.00</span>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <span class="itemprecio">
                        10.00
                    </span>
                </div>
                <div class="itemadicional">
                   <a href="#" class="btn-controlprimary" data-item="1">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
                <div class="itemremover">
                    <a href="#" class="btn-controlprimary" data-item="1">
                        <i class="fa fa-remove"></i>
                    </a>
                </div>
            </li>
        </ul>
    </div>
    <div class="carta">
        <div class="producto familia" data-togle="#lista_1">

        </div>
        <div class="producto familia" data-togle="#lista_2">

        </div>
        <div class="producto familia" data-togle="#lista_3">

        </div>
        <div class="producto familia" data-togle="#lista_4">

        </div>
        <div class="listaproductos" id="lista_1">
            <div class="producto">
                S/ 10.00
            </div>
            <div class="producto">
                S/ 10.00
            </div>
            <div class="producto">
                S/ 10.00
            </div>
            <div class="producto">
                S/ 10.00
            </div>
            <div class="producto">
                S/ 10.00
            </div>
        </div>
        <div class="listaproductos" id="lista_2">
            <div class="producto">
                S/ 10.00
            </div>
            <div class="producto">
                S/ 10.00
            </div>
            <div class="producto">
                S/ 10.00
            </div>
            <div class="producto">
                S/ 10.00
            </div>
            <div class="producto">
                S/ 10.00
            </div>
        </div>
        <div class="listaproductos" id="lista_3">
            <div class="producto">
                S/ 10.00
            </div>
            <div class="producto">
                S/ 10.00
            </div>
            <div class="producto">
                S/ 10.00
            </div>
            <div class="producto">
                S/ 10.00
            </div>
            <div class="producto">
                S/ 10.00
            </div>
        </div>
        <div class="listaproductos" id="lista_4">
            <div class="producto">
                S/ 10.00
            </div>
            <div class="producto">
                S/ 10.00
            </div>
            <div class="producto">
                S/ 10.00
            </div>
            <div class="producto">
                S/ 10.00
            </div>
            <div class="producto">
                S/ 10.00
            </div>
        </div>


    </div>
</div>

@stop