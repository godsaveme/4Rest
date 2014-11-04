@extends('layouts.master')
 

@section('content')
  @parent
@stop 
@section('sub-content')
  @parent
<a id="cntnr1" style="opacity: 0;" href="{{URL('almacenes/create')}}" class='pull-right btn btn-primary'><i class="fa fa-edit"></i> Crear Almacén</a>

<div id="cntnr2" style="opacity: 0;" class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> ALMACENES
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
      <th data-field="restaurante">Sucursal</th>
      <th data-field="editar">Editar</th>
      <th data-field="eliminar">Eliminar</th>
    </tr>
  </thead>
  <tbody>
    @foreach($almacenes as $almacen)
    <tr>
      <td>
      <a href="/almacenes/show/{{$almacen->id}}">
        {{$almacen->nombre}}
      </a>
      </td>
      <td>{{$almacen->descripcion}}</td>
      <td> @if(!empty($almacen->restaurante->nombreComercial)) {{$almacen->restaurante->nombreComercial}} @else - @endif </td>
      <td><a href="almacenes/edit/{{$almacen->id}}" type="button" class="k-button">
                        <!-- <span class="glyphicon glyphicon-pencil"></span> -->
                        <span class="k-icon k-i-pencil"></span>
                        Editar
                        </a>
      </td>
      <td>
        
        <a onclick="onDestroy('almacenes/destroy/{{$almacen->id}}','almacenes');" href="#" type="button" class="k-button">
                        <!-- <span class="glyphicon glyphicon-remove"></span> -->
                        <span class="k-icon k-i-close"></span>
                        Eliminar
                        </a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

</div> <!-- del panel body -->


</div>

@stop