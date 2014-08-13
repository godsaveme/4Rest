@extends('layouts.master')
 

@section('content')
  @parent
@stop 
@section('sub-content')
  @parent
  <a href="{{URL('almacenes/ordenproduccion')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>
<div id="cntnr2" style="opacity: 0;" class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> Detalle Requerimiento
</strong></div>
              
<div id="cntnrGrid" style="opacity: 0;" >
<div class="panel-body">
<div class="row">
  <div class="col-md-3">
    <strong>Fecha</strong>
  </div>
  <div class="col-md-4">
    {{$requerimiento->fechainicio}}
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <strong>Descripción</strong>
  </div>
  <div class="col-md-4">
    {{$requerimiento->descripcion}}
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <strong>Observación</strong>
  </div>
  <div class="col-md-4">
    {{$requerimiento->observacion}}
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <strong>Responsable</strong>
  </div>
  <div class="col-md-4">
  -
  </div>
</div>
<br>
  <table id="gridFam" style="width:100%">
                <colgroup>
                    <col style="width:10%" />
                    <col style="width:50%" />
                    <col style="width:20%" />
                    <col style="width:20%" />
                </colgroup>
  <thead>
    <tr>
      <th data-field="id">Nº</th>
      <th data-field="nombre">Nombre</th>
      <th data-field="cantidad">Cantidad</th>
      <th data-field="estado">Estado</th>
    </tr>
  </thead>
  <tbody>
    @foreach($insumos as $insumo)
    <tr>
      <td>{{$contador++}}</td>
      <td>{{$insumo->nombre}}</td>
      <td>{{$insumo->pivot->cantidad}}</td>
      <td>
        @if ($insumo->pivot->estado == 1)
        Iniciado
        @elseif ($insumo->pivot->estado == 2)
        Proceso
        @elseif ($insumo->pivot->estado == 3)
        Despachado
        @elseif ($insumo->pivot->estado == 4)
        Recibido
        @elseif ($insumo->pivot->estado == 5)
        Cancelado
        @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div> <!-- del panel body -->
</div>
@stop