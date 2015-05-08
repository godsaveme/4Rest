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

    </table>


<script id="UserTemplate" type="text/x-kendo-template">
    <tr data-uid="#= uid #">
        <td colspan="">
            #: nombres #
        </td>
        <td>
            #: login #
        </td>
        <td>
            #: nombre #
        </td>
        <td>
            #: estado #
        </td>
        <td><a href="usuarios/edit/#: id #" type="button" class="k-button">
        <!-- <span class="glyphicon glyphicon-pencil"></span> -->
                <span class="k-icon k-i-pencil"></span>
        Editar
      </a></td>
          <td><a onclick="onDestroy('usuarios/destroy/#: id #','usuarios');" href="\#" type="button" class="k-button">
        <!-- <span class="glyphicon glyphicon-remove"></span> -->
        <span class="k-icon k-i-close"></span>
      Eliminar
        </a></td>
    </tr>
</script>










</div> <!-- del panel body -->

  </div>

@stop
