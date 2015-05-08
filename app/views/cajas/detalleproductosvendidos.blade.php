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
        			<h4 class="title">Fecha: {{substr($detacaja->fechaInicio,0,10)}} </h4>
                    <h4 class="title">Horario: {{substr($detacaja->fechaInicio,-8)}} / {{substr($detacaja->fechaCierre,-8)}}</h4>
        		</div>
        	</div>
        </div>
         <table class="table">
            <thead>
                <tr>
                    <th>Nº</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Precio Un</th>
                    <th class="text-center">Precio To</th>
                    <th class="text-center">% Ventas</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{$contador++}}</td>
                    <td><a href="/cajas/detalleticketproductosvendidos/{{$detacaja->id}}/{{$producto->proid}}/{{$flag}}">{{$producto->fnombre}}</a></td>
                    <td  class="text-right">{{$producto->cantidadpro}}</td>
                    <td class="text-right">{{$producto->preciou}}</td>
                    <td class="text-right">{{$producto->preciot}}</td>
                    @if ($ventastotales == 0)  
                        <td class="text-right"> 0.00% </td>
                    @else 
                    <td class="text-right">{{number_format(($producto->preciot*100)/$ventastotales,2,'.', '')}} %</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop