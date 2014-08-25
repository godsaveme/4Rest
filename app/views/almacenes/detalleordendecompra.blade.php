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
        <th style="width:55%; border: 1px solid gray" class="text-center">Nombre</th>
        <th style="width:10%; border: 1px solid gray" class="text-center">Cantidad</th>
        <th style="width:10%; border: 1px solid gray" class="text-center">Cant. Com.</th>
        <th style="width:15%; border: 1px solid gray" class="text-center">Estado</th>
      </tr>
    </thead>
    <tbody class="listarequerimientos">
    @foreach ($detallesordendecompra as $ordendecompra)
      <tr>
        <td style="border: 1px solid gray">{{$ordendecompra->id}}</td>
        <td style="border: 1px solid gray">{{$ordendecompra->nombre}}</td>
        <td style="border: 1px solid gray">
          {{$ordendecompra->pivot->cantidad}}
        </td>
        <td style="border: 1px solid gray">
          
        </td>
        <td style="border: 1px solid gray">
          @if ($ordendecompra->pivot->estado == 0)
            Pendiente
          @elseif ($ordendecompra->pivot->estado == 1)
            Finalizado
          @endif
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div> <!-- del panel body -->
</div>
@stop