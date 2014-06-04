@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')
  @parent

<a id="cntnr1" style="opacity: 0;" href="{{URL('restaurantes/create')}}" class='pull-right btn btn-primary'><i class="fa fa-edit"></i> Crear Sucursal</a>

<div id="cntnr2" style="opacity: 0;" class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> LISTA DE RESTAURANTES (Sucursales):
</strong></div>

                    

<div id="cntnrGrid" style="opacity: 0;">

<div class="panel-body">

<table id="gridRest">
                <colgroup>
                    <col style="width:130px"/>
                    <col style="width:150px"/>
                    <col style="width:130px"/>
                    <col style="width:130px"/>
                    <col style="width:100px"/>
                    <col style="width:170px"/>
                    <col style="width:120px" />
                    <col style="width:130px" />
                </colgroup>
  <thead>
    <tr>
      <th data-field="nombre">Nombre</th>
      <th data-field="rs">Razón Social</th>
      <th data-field="ruc">RUC</th>
      <th data-field="direccion">Dirección</th>
      <th data-field="tel">Tel</th>
      <th data-field="proc">Procedencia</th>
      <th data-field="editar">Editar</th>
      <th data-field="eliminar">Eliminar</th>
    </tr>
  </thead>
  <tbody>
    @foreach($restaurantes as $restaurante)
    <tr>
      <td>{{$restaurante->nombreComercial}}</td>
      <td>{{$restaurante->razonSocial}}</td>
      <td>{{$restaurante->ruc}}</td>
      <td>{{$restaurante->direccion}}</td>
      <td>{{$restaurante->tel}}</td>
      <td>  @if($restaurante->provincia !== '') 
      {{$restaurante->provincia.', '}}
      @endif
      @if($restaurante->departamento !== '') 
      {{$restaurante->departamento.', '}}
      @endif
      @if($restaurante->pais !== '')
      {{$restaurante->pais}}
      @endif
      </td>
      <td><a href="restaurantes/edit/{{$restaurante->id}}" type="button" class="k-button">
        <!-- <span class="glyphicon glyphicon-pencil"></span> -->
        <span class="k-icon k-i-pencil"></span>
        Editar
      </a></td>
      <td><a onclick="onDestroy('restaurantes/destroy/{{$restaurante->id}}','restaurantes');" href="#" type="button" class="k-button">
      <!-- <span class="glyphicon glyphicon-remove"></span> -->
      <span class="k-icon k-i-close"></span>
      Eliminar
      </a></td>
    </tr>
    @endforeach
  </tbody>
</table>


</div> <!-- del panel body -->


</div> 


@stop

