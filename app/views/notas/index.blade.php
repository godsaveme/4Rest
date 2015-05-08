@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')
  @parent
<a id="cntnr1" style="opacity: 0;" href="{{URL('notas/create')}}" class='pull-right btn btn-primary'><i class="fa fa-edit"></i> Crear Nota</a>

<div id="cntnr2" style="opacity: 0;" class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> NOTAS
</strong></div>

                    

<div id="cntnrGrid" style="opacity: 0;">

<div class="panel-body" style="position:relative; overflow:hidden;">


    <table id="gridNotas">

    </table>

    <script id="NotasTemplate" type="text/x-kendo-template">
    <tr data-uid="#= uid #">
        <td colspan="">
            #: descripcion #
        </td>
          <td><a href="notas/edit/#: id #" type="button" class="k-button">
        <!-- <span class="glyphicon glyphicon-pencil"></span> -->
                <span class="k-icon k-i-pencil"></span>
        Editar
      </a></td>
          <td><a onclick="onDestroy('notas/destroy/#: id #','notas');" href="\#" type="button" class="k-button">
        <!-- <span class="glyphicon glyphicon-remove"></span> -->
        <span class="k-icon k-i-close"></span>
      Eliminar
        </a></td>
    </tr>
</script>





</div> <!-- del panel body -->

  </div>

@stop