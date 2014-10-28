@extends('layouts.master')
@section('content')
  @parent
@stop
@section('sub-content')
  @parent
  <a href="{{URL('almacenes/ordenproduccion')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>
<div id="cntnr2" style="opacity: 0;" class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> Requerimientos Orden de Producción
</strong></div>
<div id="cntnrGrid" style="opacity: 0;" >
<div class="panel-body">
<div class="row">
  <div class="col-md-3">
    <strong>Fecha</strong>
  </div>
  <div class="col-md-4">
    {{$ordendeproduccion->fechainicio}}
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <strong>Descripción</strong>
  </div>
  <div class="col-md-4">
    {{$ordendeproduccion->descripcion}}
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <strong>Observación</strong>
  </div>
  <div class="col-md-4">
    {{$ordendeproduccion->observacion}}
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
                    <col style="width:60%" />
                    <col style="width:20%" />
                    <col style="width:10%" />
                </colgroup>
  <thead>
    <tr>
      <th data-field="id">Codigo</th>
      <th data-field="descripcion">Descripción</th>
      <th data-field="observacion">Observación</th>
      <th>Detalles</th>
    </tr>
  </thead>
  <tbody>
    @foreach($requerimientos as $requerimiento)
    <tr>
      <td>{{$requerimiento->id}}</td>
      <td>{{$requerimiento->descripcion}}</td>
      <td>{{$requerimiento->observacion}}</td>
      <td><a href="/almacenes/detallerequerimiento/{{$requerimiento->id}}">Detalle</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
</div> <!-- del panel body -->
</div>
@stop