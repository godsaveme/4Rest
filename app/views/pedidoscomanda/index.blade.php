@extends('layouts.pedidoscomandamaster')
@section('content')
<div id="tabstrip">
  <ul id="tabscaja">
    @for ($i=0; $i < count($salones); $i++)
      <li class="@if($i==0)k-state-active@endif">
        {{$salones[$i]['nombre']}}
      </li>
    @endfor
  </ul>
  @for ($i=0; $i < count($salones); $i++)
  <div class="mostrarmesas"  style="background-color: #f5f5f5">
        <ul class="list-inline"> 
          @foreach ($arraymesas[$salones[$i]['id']] as $dato)
          <li>
            <div class="btn_mesascajas img-circle {{$dato->estado}}" data-id="{{$dato->id}}" data-estado = "{{$dato->estado}}">
              {{$dato->nombre}} 
            </div>
          </li>
          @endforeach
        </ul>
  </div>
  @endfor
  <div class="modalwindow">
  <ul class="list-group listamozos">
  </ul>
      <button type="button" class="btn btn-danger pull-right" id="btn_cancelar_mozo">Cancelar</button>
      <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;" id="btn_aceptar_mozo">Aceptar</button>
  </div>
  </div>
</div>
@stop
