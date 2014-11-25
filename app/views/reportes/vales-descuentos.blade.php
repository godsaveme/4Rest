@extends('layouts.cajamaster')
@section('js')
	{{HTML::script('js/reportescaja.js')}}
@stop
@section('content')
<div class="container">
	<div class="panel panel-primary" id="reportediariocaja">
            <div class="panel-heading">
            	<div class="row">
            		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            			<h3 class="title" id="restauranteinfo" data-id="{{$restaurante->id}}">{{$restaurante->nombreComercial}}</h3>
            		</div>
            		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <h4 class="title">Seleciona Fecha</h4>
                            <div class="form-group">
                                <input id="fecha_inicio" placeholder ="Fecha Inicio"/>
                                 <input id="fecha_fin" placeholder ="Fecha Fin"/>
                                <a href="javascript:void(0)" id="btn_enviarfechasvd" class="btn btn-default">Buscar</a>
                            </div>
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
                <div class="col-sm-9">
                    <h4>DESCUENTOS AUTORIZADOS</h4>
                    <table class="table table-bordered">
                        <thread>
                            <tr>
                            <th class="text-center col-sm-6">Nombre</th>
                            <th class="text-center col-sm-3">DNI</th>
                            <th class="text-center col-sm-3">Monto</th>
                            </tr>
                        </thread>
                        <tbody>
                        @foreach($personas as $persona)
                        <?php $importe = 0; ?>
                            @if(count($persona->tickets) > 0)
                                @foreach($persona->tickets as $ticket)
                                    @foreach($ticket->tipopago as $tipopago)
                                        @if($tipopago->id == 3)
                                        <?php $importe= $importe + $tipopago->pivot->importe;?>
                                        <tr>
                                            <td>{{$persona->nombres.' '.$persona->apPaterno.' '.$persona->apMaterno}}</td>
                                            <td>{{$persona->dni}} - {{$ticket->id}}</td>
                                            <td class="text-right">{{number_format($importe,2,'.',',')}}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@stop