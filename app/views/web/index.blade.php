@extends('layouts.master')



@section('sidebar')

@if (Session::has('error_message'))
<span>{{ Session::get('error_message') }}</span>
@endif

@stop


@section('content')
  @parent
  
@stop

@section('sub-content')
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-info" style="margin: 20px 20px;">
              <div class="panel-heading">
                <h3 class="panel-title">Cajas en Curso</h3>
              </div>
              <div class="panel-body">

                              @foreach($arraydatos1 as $datos)
                              <table class="table table-striped table-hover ">
                                                            <tbody>
                                                             <tr>

                                                              <td><strong>Caja: </strong></td>
                                                               <td><p class="text-danger">{{$datos['caja']}}</p></td>

                                                                     </tr>
                                                  <tr>

                                                    <td><strong>Abierto por:</strong></td>
                                                    <td>{{$datos['usuario']}}</td>

                                                  </tr>
                                                    <tr>

                                                    <td><strong>Fecha/Hora (a-m-d): </strong></td>
                                                    <td>{{$datos['fechaInicio']}}</td>

                                                  </tr>
                                                     <tr>
                                                                            <td><strong>Fecha/Hora Cierre:</strong></td>
                                                                            <td>-</td>
                                                                            </tr>
                                                        <tr>

                                                     <td><strong>Venta Neta: </strong></td>
                                                     <td> S/.{{$datos['ventaNeta']}}</td>

                                                   </tr>
                                                        <tr>

                                                      <td><strong>Tickets Emitidos: </strong></td>
                                                      <td>{{$datos['totalTickets']}}</td>

                                                    </tr>
                                                        <tr>

                                                      <td><strong>Productos Vendidos: </strong></td>
                                                      <td>{{$datos['totalProductos']}}</td>

                                                    </tr>

                                                </tbody>
                                                </table>
                                @endforeach


              </div>
            </div>
        </div>
        <div class="col-md-4">
                    <div class="panel panel-info" style="margin-top: 20px; ">
                      <div class="panel-heading">
                        <h3 class="panel-title">Últimas cajas abiertas</h3>
                      </div>
                      <div class="panel-body">
                        @foreach($arraydatos2 as $datos)
                        <table class="table table-striped table-hover ">
                                                                                    <tbody>
                                                                              <tr>

                                                                           <td><strong>Caja: </strong></td>
                                                                                 <td><p class="text-danger">{{$datos['caja']}}</p></td>

                                                                           </tr>
                                                                          <tr>

                                                                            <td><strong>Abierto por:</strong></td>
                                                                            <td>{{$datos['usuario']}}</td>

                                                                          </tr>
                                                                            <tr>

                                                                            <td><strong>Fecha/Hora (a-m-d): </strong></td>
                                                                            <td>{{$datos['fechaInicio']}}</td>

                                                                          </tr>
                                                                          <tr>
                                                                          <td><strong>Fecha/Hora Cierre:</strong></td>
                                                                          <td>{{$datos['fechaCierre']}}</td>
                                                                          </tr>
                                                                                <tr>

                                                                             <td><strong>Venta Neta: </strong></td>
                                                                             <td> S/.{{$datos['ventaNeta']}}</td>

                                                                           </tr>
                                                                                <tr>

                                                                              <td><strong>Tickets Emitidos: </strong></td>
                                                                              <td>{{$datos['totalTickets']}}</td>

                                                                            </tr>
                                                                                <tr>

                                                                              <td><strong>Productos Vendidos: </strong></td>
                                                                              <td>{{$datos['totalProductos']}}</td>

                                                                            </tr>

                                                                        </tbody>
                                                                        </table>
                        @endforeach

                      </div>
                    </div>
                </div>



    </div>
@stop
