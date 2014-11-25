@extends('layouts.cajamaster')
@section('js')
	{{HTML::script('js/reportescaja.js')}}
@stop
@section('content')
<div class="container">
	<div class="panel panel-primary" id="reportediariocaja">
            <div class="panel-heading">
            	<div class="row">
            		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            			<h3>{{$persona->nombres}} {{$persona->apPaterno}} {{$persona->apMaterno}}</h3>
            		</div>
            	</div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Fecha: <span id="text_fechainicio">{{$fechaInicio}}</span> / <span id="text_fechafin">{{$fechaFin}}</span></th>
                        <th data-template="rangotickets" data-bind="source: this" id="rangoti">
                        </th>
                    </tr>
                </thead>
            </table>
             <div class="row">
                <div class="col-sm-1">
                    &nbsp;
                </div>
                <div class="col-sm-5">
                    <h4>DESCUENTOS AUTORIZADOS</h4>
                    <table class="table table-bordered">
                        <thread>
                            <tr>
                            <th class="text-center col-sm-6">Nº</th>
                            <th class="text-center col-sm-6">Monto</th>
                            </tr>
                        </thread>
                        <tbody>
                        <?php $total = 0; ?>
                        @foreach($tickets as $ticket)
                        @foreach($ticket->tipopago as $tipo)
                        @if($tipo->id == 3)
                            <tr>
                                <td>
                                <a href="/tickets/show/{{$ticket->id}}">
                                    {{$ticket->numero}}
                                </a>
                                </td>
                                <td class="text-right">{{$tipo->pivot->importe}}</td>
                            </tr>
                            <?php $total = $total + $tipo->pivot->importe; ?>
                        @endif
                        @endforeach
                        @endforeach
                        <tr>
                            <th>Total</th>
                            <th class="text-right">
                            {{number_format($total,2,'.',',')}}
                            </th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@stop