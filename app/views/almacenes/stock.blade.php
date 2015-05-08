@extends('layouts.master')
 

@section('content')
  @parent
@stop 
@section('sub-content')
  @parent
<a id="cntnr1" style="opacity: 0;" href="{{URL('almacenes/createstock/'.$almacen->id)}}" class='pull-right btn btn-primary'><i class="fa fa-edit"></i> Ingresar Stock Inicial</a>

<div id="cntnr2" style="opacity: 0;" class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> {{$almacen->nombre}} / Insumos-Productos
</strong></div>

<div id="cntnrGrid" style="opacity: 0;" >

<div class="panel-body">

<table id="gridFam" style="width:100%">
                <colgroup>
                    <col />
                    <col />
                    <col />
                    <col />
                    <col />
                </colgroup>
  <thead>
    <tr>
      <th data-field="tipo">Categoría</th>
      <th data-field="nombre">Nombre</th>
      <th data-field="descripcion">Descripción</th>
      <th data-field="stockActual">Stock Actual</th>
      <th data-field="editar"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($insumos as $insumo)
    <tr>
      <td>{{$insumo->Tipo}}</td>
      <td>
      {{$insumo->nombre}} <strong>({{substr($insumo->unidadMedida,0,2)}})</strong>
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
      <td>{{$producto->Tipo}}</td>
      <td>
      {{$producto->nombre}} <strong>({{substr($producto->unidadMedida,0,2)}})</strong>
      </td>
      <td>{{$producto->descripcion}}</td>
      <td>{{$producto->pivot->stockActual}}</td>
      <td>
      <a href="/almacenes/stockedit/{{$almacen->id}}/{{$producto->id}}" type="button" class="k-button">
                        <!-- <span class="glyphicon glyphicon-pencil"></span> -->
                        <span class="k-icon k-i-pencil"></span>
                        Editar
                        </a>
      </td>
    </tr>
    @endforeach
    @foreach($productosReceta as $producto)
    <tr>
      <td>{{$producto->Tipo}}</td>
      <td>
      {{$producto->nombre}} <strong>({{substr($producto->unidadMedida,0,2)}})</strong>
      </td>
      <td>{{$producto->descripcion}}</td>
      <td>{{$producto->disponible}}</td>
      <td>
      <a href="#" type="button" class="k-button" disabled>
                        <!-- <span class="glyphicon glyphicon-pencil"></span> -->
                        <span class="k-icon k-i-pencil"></span>
                        Editar
                        </a>
      </td>
    </tr>
    @endforeach
    @foreach($prodRecNoDispo as $producto)
    <tr>
      <td>{{$producto->Tipo}}</td>
      <td>
      {{$producto->nombre}} <strong>({{substr($producto->unidadMedida,0,2)}})</strong>
      </td>
      <td>{{$producto->descripcion}}</td>
      <td>{{$producto->disponible}}</td>
      <td>
      <a href="#" type="button" class="k-button" disabled>
                        <!-- <span class="glyphicon glyphicon-pencil"></span> -->
                        <span class="k-icon k-i-pencil"></span>
                        Editar
                        </a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

</div> <!-- del panel body -->


</div>

@stop