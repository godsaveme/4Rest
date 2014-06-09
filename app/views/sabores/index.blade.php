@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')
  @parent
<a id="cntnr1" style="opacity: 0;" href="{{URL('sabores/create')}}" class='pull-right btn btn-primary'><i class="fa fa-edit"></i> Crear Sabor</a>

<div id="cntnr2" style="opacity: 0;" class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> SABORES
</strong></div>

                    

<div id="cntnrGrid" style="opacity: 0;">

<div class="panel-body">


    <table id="gridSabores">
                    <colgroup>
                    <col style="width:120px" />
                    <col style="width:150px"  />
                    <col style="width:120px" />
                    <col style="width:80px" />
                    <col style="width:120px" />
                    <col style="width:130px" />
                </colgroup>
      <thead>
        <tr>
          <th data-field="nombre">Nombre</th>
          <th data-field="descripcion">Descripción</th>
          <th data-field="sucursal">Insumo Referencia</th>
          <th data-field="habilitado">Habilitado</th>
          <th data-field="editar">Editar</th>
          <th data-field="eliminar">Eliminar</th>
        </tr>
      </thead>
      <tbody>
        @foreach($sabores as $sabor)
        <tr>
          <td>{{$sabor->nombre}}</td>
          <td>{{$sabor->descripcion}}</td>
          <td> @if(isset($sabor->insumo->nombre)) {{$sabor->insumo->nombre}} @endif</td>
          <td>@if($sabor->habilitado==1){{  "Sí" }}@else{{"No"}}@endif</td>
          <td><a href="sabores/edit/{{$sabor->id}}" type="button" class="k-button">
        <!-- <span class="glyphicon glyphicon-pencil"></span> -->
                <span class="k-icon k-i-pencil"></span>
        Editar
      </a></td>
          <td><a onclick="onDestroy('sabores/destroy/{{$sabor->id}}','sabores');" href="#" type="button" class="k-button">
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
