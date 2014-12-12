@extends('layouts.master')
 

@section('content')
  @parent
@stop 
@section('sub-content')
  @parent
<div id="cntnr2" style="opacity: 0;" class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> Orden de Compra
</strong></div>
              
<div id="cntnrGrid" style="opacity: 0;" >
<div class="panel-body">
  <table class="table table-hover">
    <thead>
      <tr>
        <th style="width:10%; border: 1px solid gray" class="text-center">Código</th>
        <th style="width:40%; border: 1px solid gray" class="text-center">Fecha</th>
        <th style="width:20%; border: 1px solid gray" class="text-center">Detalles</th>
      </tr>
    </thead>
    <tbody class="listarequerimientos">
    @foreach ($ordenesdecompra as $ordendecompra)
      <tr>
        <td style="border: 1px solid gray">{{$ordendecompra->id}}</td>
        <td style="border: 1px solid gray">{{$ordendecompra->fechainicio}}</td>
        <td style="border: 1px solid gray">
          <a href="/almacenes/detalleordendecompra/{{$ordendecompra->id}}">Ver Detalle</a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div> <!-- del panel body -->
</div>
@stop