@extends('layouts.cajamaster')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                            <h3 class="title" id="restauranteinfo">Nº {{$ticket->numero}}</h3>
                        </div>
                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                            <h4 class="title">Fecha: {{substr($ticket->created_at,0,10)}} </h4>
                            <h4 class="title">Hora: {{substr($ticket->created_at,-8)}} </h4>
                        </div>
                    </div>
                </div>
                 <table class="table">
                    <thead>
                        <tr>
                            <th>Importe</th>
                            <th>Descuento</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td>{{$ticket->importe}}</td>
                        <td>{{$ticket->idescuento}}</td>
                        <td>
                            @if ($ticket->estado == 0)
                                Correcto
                            @else 
                                Anulado
                            @endif
                        </td>
                    </tbody>
                </table>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Cantidad</th>
                            <th>Descripcion</th>
                            <th>Precio Un</th>
                            <th>Precio To.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalles as $detalle)
                            <tr>
                                <td>{{$detalle->cantidad}}</td>
                                <td>{{$detalle->nombre}}</td>
                                <td>{{$detalle->preciou}}</td>
                                <td>{{$detalle->precio}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>{{$ticket->cliente}}</th>
                        </tr>
                        <tr>
                            <th>Documento</th>
                            <th>{{$ticket->documento}}</th>
                        </tr>
                        <tr>
                            <th>Dirección</th>
                            <th>{{$ticket->direccion}}</th>
                        </tr>
                        <tr>
                            <th>Cajero</th>
                            <th>{{$ticket->cajero}}</th>
                        </tr>
                        <tr>
                            <th>Mozo</th>
                            <th>{{$ticket->mozo}}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@stop