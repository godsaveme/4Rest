@extends('layouts.master')
 

@section('content')
  @parent
@stop 
@section('sub-content')
  @parent
  <a href="{{URL('compras')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>

<div id="cntnr2" style="opacity: 0;" class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> Compras
</strong></div>

<div id="cntnrGrid" style="opacity: 0;" >

<div class="panel-body">
<div class="row">
  <div class="col-md-3">
    <strong>Provedor:</strong>
    @if (isset($compra->provedor->nombres))
      {{$compra->provedor->nombres.' '.$compra->provedor->apPaterno.' '.$compra->provedor->apMaterno}}
    @elseif (isset($compra->provedor->razonSocial))
      {{$compra->provedor->razonSocial}}
    @endif
  </div>
  <div class="col-md-3 ">
    <strong>DNI/RUC:</strong>
    {{$compra->provedor->ruc}}
    @if (isset($compra->provedor->dni))
     / DNI: {{$compra->provedor->dni}}
    @endif
  </div>
  <div class="col-md-2 ">
      <strong>Almacén:</strong>
      {{$compra->almacen->nombre}}

   </div>
  <div class="col-md-3 ">
    <strong>Estado:</strong>
    @if ($compra->estado == 1)
      Cancelada
    @else
      Emitida
    @endif
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <strong>Serie:</strong> {{$compra->serie}}
  </div>
  <div class="col-md-3">
    <strong>Número:</strong> {{$compra->numero}}
  </div>
  <div class="col-md-2">
    <strong>Sub Total:</strong> {{$compra->subtotal}}
  </div>
  <div class="col-md-2">
    <strong>Igv:</strong> {{$compra->igv}}
  </div>
  <div class="col-md-2">
    <strong>Total:</strong> {{$compra->importetotal}}
  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <strong>Responsable:</strong> {{$compra->usuario->persona->nombres}} {{$compra->usuario->persona->apPaterno}} {{$compra->usuario->persona->apMaterno}}
  </div>
</div>
<br>
<table class="table table-bordered" style="width:100%">
  <thead>
    <tr>
      <th style="border: 1px solid silver; width: 40%" class="text-center">Nombre</th>
      <th style="border: 1px solid silver; width: 10%" class="text-center">Presentación</th>
      <th style="border: 1px solid silver; width: 10%" class="text-center">Cantidad</th>
      <th style="border: 1px solid silver; width: 10%" class="text-center">Porción</th>
      <th style="border: 1px solid silver; width: 10%" class="text-center">Total</th>
      <th style="border: 1px solid silver; width: 10%" class="text-center">Costo U.</th>
      <th style="border: 1px solid silver; width: 10%" class="text-center">Costo T.</th>
    </tr>
  </thead>
  <tbody>
    @foreach($detalles as $detalle)
    <tr>
      <td style="border: 1px solid silver;">{{$detalle->nombre}}  
      <strong class="pull-right">({{substr($detalle->unidadMedida,0,2)}})</strong></td>
      <td style="border: 1px solid silver;" class="text-right">
      {{$detalle->pivot->presentacion}}
      </td>
      <td style="border: 1px solid silver;" class="text-right">{{$detalle->pivot->cantidad}}</td>
      <td style="border: 1px solid silver;" class="text-right">{{$detalle->pivot->porcion}}</td>
      <td style="border: 1px solid silver;" class="text-right">{{$detalle->pivot->total}}</td>
      <td style="border: 1px solid silver;" class="text-right">{{$detalle->pivot->costou}}</td>
      <td style="border: 1px solid silver;" class="text-right">{{$detalle->pivot->costototal}}</td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <td colspan="6">
        Total
      </td>
      <td class="text-right">
        {{$compra->importetotal}}
      </td>
    </tr>
  </tfoot>
</table>
</div> <!-- del panel body -->
</div>
@stop