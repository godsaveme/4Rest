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

</table>

<script id="InsumoTemplate" type="text/x-kendo-template">
    <tr data-uid="#= uid #">
        <td colspan="">
            #: nombre #
        </td>
        <td>
            #: descripcion #
        </td>
        <td>
            #: ultimocosto #
        </td>
        <td>
            #: unidadMedida #
        </td>
       <td><a href="insumos/edit/#: id #" type="button" class="k-button">
                        <!-- <span class="glyphicon glyphicon-pencil"></span> -->
                        <span class="k-icon k-i-pencil"></span>
                        Editar
                        </a>
      </td>
      <td>
        
        <a onclick="onDestroy('insumos/destroy/#: id #','insumos');" href="\#" type="button" class="k-button">
                        <!-- <span class="glyphicon glyphicon-remove"></span> -->
                        <span class="k-icon k-i-close"></span>
                        Eliminar
                        </a>
      </td>
    </tr>
</script>

</div> <!-- del panel body -->

</div>
@stop