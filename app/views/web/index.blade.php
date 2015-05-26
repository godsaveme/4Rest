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
<div style="min-height: 450px;">
    <div class="row" style=" padding: 25px;">
        <div class="col-md-4">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
               <div class="panel panel-warning">
                 <div class="panel-heading" role="tab" id="headingOne">
                   <h4 class="panel-title">
                     <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                     <i class="fa fa-calculator"></i> Cajas en Curso
              </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
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
            </div> <!--panel-->
        </div>
        <div class="col-md-4">
                    <div class="panel-group" id="accordionTwo" role="tablist" aria-multiselectable="true">
                      <div class="panel panel-info">
                        <div class="panel-heading" role="tab" id="headingTwo">
                          <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordionTwo" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <i class="fa fa-calculator"></i> Últimas cajas abiertas
                      </a>
                            </h4>
                          </div>
                          <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
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
                </div>



    </div>
    <div class="row" style="padding: 20px;">
    <div class="col-md-4">
    <div class="panel-group" id="accordionThree" role="tablist" aria-multiselectable="true">
                   <div class="panel panel-success">
                     <div class="panel-heading" role="tab" id="headingThree">
                       <h4 class="panel-title">
                         <a data-toggle="collapse" data-parent="#accordionThree" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                         <i class="fa fa-tags"></i> Informe de Stock de Productos
                  </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">




                    </div>
                  </div>
                  </div>
                </div> <!--panel-->
    </div>
    <div class="col-md-4">
        <div class="panel-group" id="accordionFour" role="tablist" aria-multiselectable="true">
                       <div class="panel panel-success">
                         <div class="panel-heading" role="tab" id="headingFour">
                           <h4 class="panel-title">
                             <a data-toggle="collapse" data-parent="#accordionFour" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            <i class="fa fa-tags"></i> Informe de Stock de Insumos
                      </a>
                            </h4>
                          </div>
                          <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                            <div class="panel-body">




                        </div>
                      </div>
                      </div>
                    </div> <!--panel-->
        </div>
    </div>
</div>
@stop
