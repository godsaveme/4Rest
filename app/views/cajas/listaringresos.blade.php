@extends('layouts.cajamaster')
@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-primary" >
            <div class="panel-heading">
                <h3 class="panel-title">Lista de Ingresos</h3>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Cantidad</th>
                        <th>Importe Total</th>
                    </tr>
                </thead>
                <tbody>
				    <tr>
				        <td>
				           {{$totalingresos}}
				        </td>
				        <td>
				           {{$totalsoles}}
				        </td>
				    </tr>
                </tbody>
            </table>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Descripcion</th>
                        <th>Monto</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($listaingresos as $ingreso)
                	<tr>
				    	<td>
				    		{{$contador++}}
				        </td>
				        <td>
				        	{{$ingreso->descripcion}}
				        </td>
				        <td>
				        	{{$ingreso->importetotal}}
				        </td>
				        <td>
                           	{{$ingreso->tipoingreso->descripcion}}
                        </td>
                        <td>
                           	@if ($ingreso->estado == 0)
                           	EMITIDO
                           	@else
                           	CANCELADO
                           	@endif
                        </td>
				    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop