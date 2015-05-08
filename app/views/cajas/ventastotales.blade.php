@extends('layouts.cajamaster')
@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Lista de Ventas</h3>
            </div>
            @if($total >= 0)
                <h3 class="text-center">Total: S/. {{$total}}</h3>  
            @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Total Efectivo</th>
                        <th class="text-center">&nbsp;</th>
                        <th class="text-center">Total Tarjeta</th>
                        <th class="text-center">Total Ventas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-right">
                           &nbsp;
                        </td>
                        <td class="text-right">
                         {{number_format($efectivo, 2, '.','')}}
                        </td>
                        <td class="text-right">
                         &nbsp;
                        </td>
                         <td class="text-right">
                         {{number_format($tarjeta,2, '.','')}}
                        </td>
                        <td class="text-right">
                        {{number_format($efectivo + $tarjeta, 2, '.','')}}
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Nº</th>
                        <th class="text-center">Subtotal</th>
                        <th class="text-center">IGV</th>
                        <th class="text-center">Importe Total</th>
                        <th class="text-center">Descuento</th>
                        <th class="text-center">Copia</th>
                        <th class="text-center">Anular</th>
                        <th class="text-center">Generar</th>
                    </tr>
                </thead>
                <tbody>

                    <?php /* print_r($tickets);
                        die();*/
                     ?>

                @foreach ($tickets as $ticket)
                    <tr>
                        <td>
                            <a href="/tickets/show/{{$ticket->id}}">
                                {{$ticket->numero}}
                            </a>
                        </td>
                        <td class="text-right">
                            {{$ticket->subtotal}}
                        </td>
                        <td class="text-right">
                            {{$ticket->IGV}}
                        </td>
                        <td class="text-right">
                            {{$ticket->importe}}
                        </td>
                        <td class="text-right">
                            {{$ticket->idescuento}}
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-primary btn-sm btn_imprimicopiatick" 
                            data-idtick="{{$ticket->id}}">Imprimir</button>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-primary btn-sm btn_anular" data-idtick="{{$ticket->id}}">Anular</button>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-primary btn-sm btn_generarticket" data-idtick="{{$ticket->id}}#">Generar</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="windowsdatos" style="display:none;">
     <form class="form-inline" role="form">
      <div class="form-group">
        <input type="text" id="buscar_clientegenerar" class="form-control" placeholder="Ingrese DNI/RUC/TEXTO">
      </div>
      <a href="javascript:void(0)" class="btn btn-primary" id="btn_nuevocliente">Nuevo Cliente</a>
    </form>
</div>

<div class="windowsregistrarcliente" style="width:100%;display:none;">
    <div class="btn-group btn-group-lg">
      <button type="button" class="btn btn-primary" id="btn_rpersona">Persona</button>
      <button type="button" class="btn btn-primary" id="btn_rempresa">Empresa</button>
    </div>
    <br>
    <br>
    <div id="cont_cliperona" style="display: none">
        <div style="width: 500px;" class="pull-left">
            <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                            <h3 class="panel-title">Registrar Nueva Persona</h3>
                            </div>
                            <div class="panel-body">
                            <form role="form" id="frm_clipersona">
                                <div class="row">
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                        <input type="text" name="first_name" id="input_nombres" class="form-control input-sm" placeholder="Nombres">
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                            <input type="text" name="last_name" id="input_apPaterno" class="form-control input-sm" placeholder="Apellido Materno">
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                            <input type="text" name="last_name" id="input_apMaterno" class="form-control input-sm" placeholder="Apellido Paterno">
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                            <input type="text" name="password" id="input_dni" class="form-control input-sm" placeholder="DNI">
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                            <input type="text" name="password_confirmation" id="input_direccion" class="form-control input-sm" placeholder="Dirección">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 pull-right">
                                        <div class="form-group">
                                        <a href="javascript:void(0)" class="btn btn-info btn-block registrarcliente"> Registrar</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pull-left" style="margin-left: 10px; width: 300px" id="datos_persona">
            <script type="text/x-kendo-template" id="template">
                <div class="container-fluid well span6">
                    <div class="row-fluid">
                        <div class="span8">
                            <h4>Datos Persona</h4>
                            <h6>Nombres: #=nombres#</h6>
                            <h6>Apellidos: #=apPaterno# #=apMaterno#</h6>
                            <h6>DNI: #=dni#</h6>
                            <h6>Dirección: #=Direccion#</h6>
                        </div>
                    </div>
                </div>
            </script>
        </div>
    </div>

    <div id="cont_cliempresa" style="display: none">
        <div style="width: 500px;" class="pull-left">
            <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                            <h3 class="panel-title">Registrar Nueva Empresa</h3>
                            </div>
                            <div class="panel-body">
                            <form role="form" id="frm_cliempresa">
                                <div class="row">
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                        <input type="text" name="first_name" id="input_rs" class="form-control input-sm" placeholder="Razon Social">
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                            <input type="text" name="password" id="input_ruc" class="form-control input-sm" placeholder="RUC">
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                            <input type="text" name="password_confirmation" id="input_direccionem" class="form-control input-sm" placeholder="Dirección">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 pull-right">
                                        <div class="form-group">
                                        <a href="javascript:void(0)" class="btn btn-info btn-block registrarcliente"> Registrar</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pull-left" style="margin-left: 10px; width: 300px" id="datos_empresa">
            <script type="text/x-kendo-template" id="template_cliem">
                <div class="container-fluid well span6">
                    <div class="row-fluid">
                        <div class="span8">
                            <h4>Datos Empresa</h4>
                            <h6>Razon Soc.: #=nombres#</h6>
                            <h6>RUC: #=ruc#</h6>
                            <h6>Dirección: #=Direccion#</h6>
                        </div>
                    </div>
                </div>
            </script>
        </div>
    </div>

</div>

@stop