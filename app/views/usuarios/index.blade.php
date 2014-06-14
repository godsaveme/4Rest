@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')
  @parent
<a id="cntnr1" style="opacity: 0;" href="{{URL('usuarios/create')}}" class='pull-right btn btn-primary'><i class="fa fa-edit"></i> Crear Usuario</a>

<div id="cntnr2" style="opacity: 0;" class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> USUARIOS
</strong></div>       

<div id="cntnrGrid" style="opacity: 0;">

<div class="panel-body">


    <table id="gridUsuarios">
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
          <th data-field="descripcion">Usuario</th>
          <th data-field="sucursal">Perfil</th>
          <th data-field="habilitado">Activo</th>
          <th data-field="editar">Editar</th>
          <th data-field="eliminar">Eliminar</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($usuarios as $dato)
        <?php $usuario = $dato->usuario;
              $perfil = Perfil::find($dato->perfil_id);
        ?>
        @if (isset($usuario))
        <tr>
          <td>{{$dato->nombres.' '.$dato->apPaterno.' '.$dato->apMaterno}}</td>
          <td>{{$usuario->login}}</td>
          <td> @if(!empty($perfil->nombre)) {{$perfil->nombre}} @else - @endif </td>
          <td>@if($usuario->estado==1){{  "Sí" }}@elseif($usuario->estado==0){{"No"}}@else {{'No tiene estado asignado'}} @endif</td>
          <td><a href="usuarios/edit/{{$usuario->id}}" type="button" class="k-button">
        <!-- <span class="glyphicon glyphicon-pencil"></span> -->
                <span class="k-icon k-i-pencil"></span>
        Editar
      </a></td>
          <td><a onclick="onDestroy('usuarios/destroy/{{$usuario->id}}','usuarios');" href="#" type="button" class="k-button">
        <!-- <span class="glyphicon glyphicon-remove"></span> -->
        <span class="k-icon k-i-close"></span>
      Eliminar
        </a></td>
        </tr>
        @endif
        @endforeach
      </tbody>
    </table>


</div> <!-- del panel body -->

  </div>

@stop
