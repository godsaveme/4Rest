@extends('layouts.master')
 

@section('content')
  @parent
@stop 
@section('sub-content')
  @parent
  
<a id="cntnr1" style="opacity: 0;" href="{{URL('insumos/create')}}" class='pull-right btn btn-primary'><i class="fa fa-edit"></i> Crear Insumo</a>

<div id="cntnr2" style="opacity: 0;" class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> INSUMOS
</strong></div>

                    

<div id="cntnrGrid" style="opacity: 0;">

<div class="panel-body">

<table id="gridInsum" >
                <colgroup>
                    <col style="width:130px"/>
                    <col style="width:80px"/>
                    <col style="width:50px" />
                    <col style="width:110px" />
                    <col style="width:70px" />
                    <col style="width:70px" />
                    <col style="width:70px" />
                    <col style="width:120px" />
                    <col style="width:130px" />
                </colgroup>
  <thead>
    <tr>
      <th data-field="nombre">Nombre</th>
      <th data-field="descripcion">Descripción</th>
      <th data-field="estado">Habilitado</th>
      <th data-field="familia">Tipo de Insumo</th>
      <th data-field="stock">Stock</th>
      <th data-field="costo">Costo</th>
      <th data-field="unMed">Und. Med.</th>
      <th data-field="editar">Editar</th>
      <th data-field="eliminar">Eliminar</th>
    </tr>
  </thead>
  <tbody>
  @foreach($insumos as $insumo)
<tr>
    <td>{{$insumo->nombre}}</td>
    <td>{{$insumo->descripcion}}</td>
    <td> @if($insumo->estado==1)Sí @else No @endif</td>
    <td>{{$insumo->tipoins->nombre}}</td>
    <td>{{$insumo->stock}}</td>
    <td>{{$insumo->costo}}</td>
    <td>{{$insumo->unidadMedida}}</td>
      <td><a href="insumos/edit/{{$insumo->id}}" type="button" class="k-button">
                        <!-- <span class="glyphicon glyphicon-pencil"></span> -->
                        <span class="k-icon k-i-pencil"></span>
                        Editar
                        </a>
      </td>
      <td>
        
        <a onclick="onDestroy('insumos/destroy/{{$insumo->id}}','insumos');" href="#" type="button" class="k-button">
                        <!-- <span class="glyphicon glyphicon-remove"></span> -->
                        <span class="k-icon k-i-close"></span>
                        Eliminar
                        </a>
      </td>
    </tr>
          @endforeach
  </tbody>
</table>
</div>
@stop