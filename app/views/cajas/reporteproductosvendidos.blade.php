@extends('layouts.cajamaster')
@section('content')
<div class="container">
	<div class="panel panel-primary" id="reportediariocaja">
        <div class="panel-heading">
        	<div class="row">
        		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        			<h3 class="title" id="restauranteinfo" data-id="{{$restaurante->id}}">{{$restaurante->nombreComercial}}</h3>
        		</div>
        		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    @if (!isset($diario))
                        <h4 class="title">Fecha: {{substr($detacaja->fechaInicio,0,10)}}</h4>
                       <h4 class="title">Horario: {{substr($detacaja->fechaInicio,-8)}} / {{substr($detacaja->fechaCierre,-8)}}</h4>
                    @else 
                        <h4 class="title">Fecha: {{$fechaInicio}} / {{$fechaFin}}</h4>
                    @endif
        		</div>
        	</div>
        </div>
         <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-right"></th>
                    <th class="text-center"></th>
                    <th class="text-center">T. Cantidad: {{$totalcantidad}}</th>
                    <th class="text-center">V.Total: {{number_format($montototal,2,'.','')}}</th>
                    <th class="text-center">Desc.: {{Input::get('descuento')}} </th>
                    <th class="text-center">V. Neta: {{number_format($importeneto,2,'.','')}}</th>
                </tr>
                <tr>
                    <th class="text-right">Nº</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Promedio</th>
                    <th class="text-center">Precio To</th>
                    <th class="text-center">% Ventas</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td class="text-right">{{$contador++}}</td>
                    <td><a href="/cajas/detalleprovendidos/{{$detacaja->id}}/{{$producto->famiid}}/{{$flag}}">{{$producto->fnombre}}</a></td>
                    <td class="text-right">{{$producto->cantidadpro}}</td>
                    <td class="text-right">{{number_format($producto->preciot/$producto->cantidadpro,2,'.', '')}}</td>
                    <td class="text-right">{{$producto->preciot}}</td>
                    <td class="text-right">{{number_format(($producto->preciot*100)/$ventastotales,2,'.', '').' '.'%'}}</td>
                </tr>
            @endforeach
                <tr>
                    <td>
                        Combinaciones
                    </td>
                </tr>
            @foreach ($combinaciones as $combinacion)
                <tr>
                    <td class="text-right">{{$contador++}}</td>
                    <td><a href="/cajas/detallecombinaciones/{{$detacaja->id}}/{{$producto->famiid}}/{{$flag}}">{{$combinacion->cnombre}}</a></td>
                    <td class="text-right">{{$combinacion->cantidadpro}}</td>
                    <td class="text-right">{{$combinacion->preciou}}</td>
                    <td class="text-right">{{$combinacion->preciot}}</td>
                    <td class="text-right">{{number_format(($combinacion->preciot*100)/$ventastotales,2,'.', '').' '.'%'}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop