@extends('layouts.cajamaster')
@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-primary "id="listadeventas">
            <div class="panel-heading">
                <h2>Lista de Eventos 
                </h2>
                <a href="/eventos/create" class="btn btn-default pull-right" style="margin-top: -40px;">Crear Evento</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Nombre</th>
                        <th>Documento</th>
                        <th>Telefono</th>
                        <th>Importe</th>
                        <th>Fecha</th>
                        <th>Horario</th>
                        <th>Cobrar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventos as $dato)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$dato->nombre}}</td>
                            <td>{{$dato->dni}}</td>
                            <td>{{$dato->telefono}}</td>
                            <td>{{$dato->costo}}</td>
                            <td>{{substr($dato->fecha, 0,10)}}</td>
                            <td>{{$dato->hora}}/{{$dato->horafin}}</td>
                            <td><a href="/eventos/cobrar/{{$dato->id}}" class="btn btn-primary">Cobrar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop