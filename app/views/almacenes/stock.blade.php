@extends('layouts.master')
 

@section('content')
  @parent
@stop 
@section('sub-content')
  @parent
<a id="cntnr1" style="opacity: 0;" href="{{URL('almacenes/createstock/'.$almacen->id)}}" class='pull-right btn btn-primary'><i class="fa fa-edit"></i> Ingresar Stock Inicial</a>

<div id="cntnr2" style="opacity: 0;" class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> {{$almacen->nombre}}
</strong></div>

<div id="cntnrGrid" style="opacity: 0;" >

<div class="panel-body">

<table id="gridFam" style="width:100%">
                <colgroup>
                    <col />
                    <col />
                    <col />
                    <col style="width:120px" />
                    <col style="width:130px" />
                </colgroup>
  <thead>
    <tr>
      <th data-field="nombre">Nombre</th>
      <th data-field="descripcion">Descripción</th>
      <th data-field="restaurante">Stock Actual</th>
      <th data-field="editar"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($insumos as $insumo)
    <tr>
      <td>
      {{$insumo->nombre}}
      </td>
      <td>{{$insumo->descripcion}}</td>
      <td>{{$insumo->pivot->stockActual}}</td>
      <td>
      <a href="/almacenes/editarstock/{{$almacen->id}}/{{$insumo->id}}" type="button" class="k-button">
                        <!-- <span class="glyphicon glyphicon-pencil"></span> -->
                        <span class="k-icon k-i-pencil"></span>
                        Editar
                        </a>
      </td>
    </tr>
    @endforeach
    @foreach($productos as $producto)
    <tr>
      <td>
      {{$producto->nombre}}
      </td>
      <td>{{$producto->descripcion}}</td>
      <td>{{$producto->pivot->stockActual}}</td>
      <td>
      <a href="almacenes/edit/{{$almacen->id}}" type="button" class="k-button">
                        <!-- <span class="glyphicon glyphicon-pencil"></span> -->
                        <span class="k-icon k-i-pencil"></span>
                        Modificar
                        </a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

</div> <!-- del panel body -->


</div>

@stop