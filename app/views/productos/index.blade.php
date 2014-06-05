@extends('layouts.master')
 

@section('content')
  @parent
@stop 
@section('sub-content')
  @parent

<a id="cntnr1" style="opacity: 0;" href="{{URL('productos/create')}}" class='pull-right btn btn-primary'><i class="fa fa-edit"></i> Crear Producto</a>

<div id="cntnr2" style="opacity: 0;" class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> PRODUCTOS
</strong></div>


<div id="cntnrGrid" style="opacity: 0;">

<div class="panel-body">

<table id="gridProd" style="width:100%">
                <colgroup>
                    <col style="width:130px"/>
                    <col style="width:130px"/>
                    <col style="width:130px" />
                    <col style="width:130px" />
                    <col style="width:130px" />
                    <col style="width:120px" />
                    <col style="width:130px" />
                </colgroup>
  <thead>
    <tr>
      <th data-field="nombre">Nombre</th>
      <th data-field="descripcion">Descripción</th>
      <th data-field="estado">Habilitado</th>
      <th data-field="familia">Familia</th>
      <th data-field="unMed">Und. Med.</th>
      <th data-field="editar">Editar</th>
      <th data-field="eliminar">Eliminar</th>
    </tr>
  </thead>
  <tbody>
@foreach ($productos as $dato)
 <tr>
    <td>{{$dato->nombre}}</td>
    <td>{{$dato->descripcion}}</td>
    <td>@if($dato->estado==1)Sí @else No @endif</td>
    <td>{{$dato->familia->nombre}}</td>
    <td>{{$dato->unidadMedida}}</td>
      <td><a href="/productos/edit/{{$dato->id}}" type="button" class="k-button">
                        <!-- <span class="glyphicon glyphicon-pencil"></span> -->
                        <span class="k-icon k-i-pencil"></span>
                        Editar
                        </a>
      </td>
      <td>
        
        <a onclick="onDestroy('productos/destroy/{{$dato->id}}','productos');" href="#" type="button" class="k-button">
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

