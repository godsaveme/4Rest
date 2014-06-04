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
                    @if (!isset($diario))
                       <h4 class="title">Horario: {{substr($detacaja->fechaInicio,-8)}} / {{substr($detacaja->fechaCierre,-8)}}</h4>
                    @endif
        		</div>
        	</div>
        </div>
         <table class="table">
            <thead>
                <tr>
                    <th>Nº</th>
                    <th>Numero</th>
                    <th>Importe</th>
                    <th>Descuento</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($tickets as $tickete)
                <tr>
                    <td>{{$contador++}}</td>
                    <td> <a href="/tickets/show/{{$tickete->id}}">{{$tickete->numero}}</a></td>
                    <td class="text-right">{{$tickete->importe}}</td>
                    <td class="text-right">{{$tickete->idescuento}}</td>
                    <td>
                    @if ($tickete->estado == 0)
                   		Conforme
                   	@else
                   		Anulado
                    @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop