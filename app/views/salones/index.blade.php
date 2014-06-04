@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')
  @parent
<a id="cntnr1" style="opacity: 0;" href="{{URL('salones/create')}}" class='pull-right btn btn-primary'><i class="fa fa-edit"></i> Crear Salón</a>

<div id="cntnr2" style="opacity: 0;" class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> SALONES
</strong></div>

                    

<div id="cntnrGrid" style="opacity: 0;">

<div class="panel-body">


    <table id="gridSalones">
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
          <th data-field="sucursal">Sucursal</th>
          <th data-field="habilitado">Habilitado</th>
          <th data-field="editar">Editar</th>
          <th data-field="eliminar">Eliminar</th>
        </tr>
      </thead>
      <tbody>
        @foreach($salones as $salon)
        <tr>
          <td>{{$salon->nombre}}</td>
          <td>{{$salon->descripcion}}</td>
          <td>{{$salon->restaurante->nombreComercial}}</td>
          <td>@if($salon->habilitado==1){{  "Sí" }}@else{{"No"}}@endif</td>
          <td><a href="salones/edit/{{$salon->id}}" type="button" class="k-button">
        <!-- <span class="glyphicon glyphicon-pencil"></span> -->
                <span class="k-icon k-i-pencil"></span>
        Editar
      </a></td>
          <td><a onclick="onDestroy('salones/destroy/{{$salon->id}}','salones');" href="#" type="button" class="k-button">
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
