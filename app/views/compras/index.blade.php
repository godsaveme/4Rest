@extends('layouts.master')
 

@section('content')
  @parent
@stop 
@section('sub-content')
  @parent
<a id="cntnr1" style="opacity: 0;" href="{{URL('compras/create')}}" class='pull-right btn btn-primary'><i class="fa fa-edit"></i> Ingresar Compra</a>

<div id="cntnr2" style="opacity: 0;" class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> Compras
</strong></div>

<div id="cntnrGrid" style="opacity: 0;" >

<div class="panel-body">

<table id="gridCompra" style="width:100%">
  <thead>
    <tr>
      <th data-field="nombre">Nombre</th>
      <th data-field="fecha">Fecha</th>
      <th data-field="restaurante">Almacen</th>
      <th data-field="importe">Importe</th>
      <th data-field="detalle">&nbsp;</th>
    </tr>
  </thead>
  <tbody>
    @foreach($compras as $compra)
    <tr>
      <td>
      @if (isset($compra->provedor->nombres))
        {{$compra->provedor->nombres.' '.$compra->provedor->apPaterno.' '.$compra->provedor->apMaterno}}
      @elseif (isset($compra->provedor->razonSocial))
        {{$compra->provedor->razonSocial}}
      @endif
      </td>
      <td>
        {{$compra->created_at}}
      </td>
      <td>
        {{$compra->almacen->nombre}}
      </td>
      <td>
        {{$compra->importetotal}}
      </td>
      <td>
        <a href="/compras/detalle/{{$compra->id}}">Detalle</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div> <!-- del panel body -->
</div>
<script>
  $("#gridCompra").kendoGrid({
    dataSource: {
      pageSize: 10
    },
    height: 525,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      refresh: true,
      pageSizes: true
    },
  });
</script>
@stop