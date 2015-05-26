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
@if(!empty($msg))
<div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>{{$msg['msg1']}}</strong> {{$msg['msg2']}}
</div>
@endif

<p class=""><em><span class="text-danger">Si el producto tiene receta, su costo será determino a partir del costo de sus insumos.</span></em></p>

<table id="gridProd" style="width:100%">
  </tbody>
</table>

<script id="ProdTemplate" type="text/x-kendo-template">
    <tr data-uid="#= uid #">
        <td colspan="">
            #: nombreProd #
        </td>
        <td>
            #: precio #
        </td>
        <td>
            #: costo #
        </td>
        <td>
            #: nombreFam #
        </td>
        <td>
            #: estado #
        </td>
        <td><a href="/productos/edit/#: id #" type="button" class="k-button">
                        <!-- <span class="glyphicon glyphicon-pencil"></span> -->
                        <span class="k-icon k-i-pencil"></span>
                        Editar
                        </a>
      </td>
      <td>
        
        <a onclick="onDestroy('productos/destroy/#: id #','productos');" href="\#" type="button" class="k-button">
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

