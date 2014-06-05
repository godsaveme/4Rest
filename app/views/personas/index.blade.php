@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')
  @parent
<a id="cntnr1" style="opacity: 0;" href="{{URL('personas/create')}}" class='pull-right btn btn-primary'><i class="fa fa-edit"></i> Crear Persona</a>

<div id="cntnr2" style="opacity: 0;" class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> PERSONAS
</strong></div>

                    

<div id="cntnrGrid" style="opacity: 0;">

<div class="panel-body">

<table id="gridPersonas">
                    <colgroup>
                    <col style="width:120px" />
                    <col style="width:150px"  />
                    <col style="width:120px" />
                    <col style="width:130px" />
                </colgroup>
      <thead>
        <tr>
          <th data-field="nombre">Nombre</th>
          <th data-field="perfil">Perfil</th>
          <th data-field="editar">Editar</th>
          <th data-field="eliminar">Eliminar</th>
        </tr>
      </thead>
<tbody>
@foreach ($personas as $dato)
<tr>
          <td>{{$dato->nombres}} {{$dato->apPaterno}} {{$dato->apMaterno}}</td>
          <td> @if (isset($dato->PerfilNombre)) {{$dato->PerfilNombre}} @else - @endif </td>
          <td><a href="personas/edit/{{$dato->id}}" type="button" class="k-button">
        <!-- <span class="glyphicon glyphicon-pencil"></span> -->
                <span class="k-icon k-i-pencil"></span>
        Editar
      </a></td>
          <td><a onclick="onDestroy('personas/destroy/{{$dato->id}}','personas');" href="#" type="button" class="k-button">
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
