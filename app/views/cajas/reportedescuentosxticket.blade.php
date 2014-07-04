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
                    <th class="text-right">Nº</th>
                    <th class="text-center">Número</th>
                    <th class="text-center">Importe</th>
                    <th class="text-center">Descuento</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Mozo</th>
                    <th class="text-center">Cajero</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="text-right">{{number_format($montototal, 2, '.', '')}}</td>
                    <td class="text-right">{{number_format($totaldescuentos, 2, '.','')}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @foreach ($descuentos as $descuento)
                <tr>
                    <td class="text-right">{{$contador++}}</td>
                    <td><a href="/tickets/show/{{$descuento->id}}">{{$descuento->numero}}</a></td>
                    <td class="text-right">{{$descuento->importe}}</td>
                    <td class="text-right">{{$descuento->idescuento}}</td>
                    <td>&nbsp;&nbsp;{{$descuento->cliente}}</td>
                    <td class="text-center">{{$descuento->mozo}}</td>
                    <td class="text-center">{{$descuento->cajero}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop