@extends('layouts.cajamaster')
@section('content')
<audio id="sonido_recibirpedido" src="/sound/mozo.mp3"> </audio>
<audio id="sonido_demora" src="/sound/demora.mp3" loop> </audio>
<div id="tabstrip">
  <ul id="tabscaja">
    @for($i=0; $i < count($salones); $i++)
      <li class="@if($i==0) k-state-active @endif">
        {{$salones[$i]['nombre']}}
      </li>
    @endfor
  </ul>
  @for ($i=0; $i < count($salones); $i++)
  <div class="mostrarmesas"  style="background-color: #f5f5f5">
        <ul class="list-inline"> 
          @foreach ($arraymesas[$salones[$i]['id']] as $dato)
          <li >
            <div id="{{$dato->mesa}}" class="btn_mesascajas {{$dato->estado}} text-center" data-id="{{$dato->id}}" data-estado = "{{$dato->estado}}"
            @if (isset($arrayocupadas[$dato->id]))
              @if($arrayocupadas['pagado_'.$dato->id]['pagado']<= 0)
                style="background:#98FB98"
              @endif
            @endif
            >
              {{$dato->nombre}}
              @if (isset($arrayocupadas[$dato->id]))
               &nbsp;<span class="tiempoenmesa" id="mesa_{{$arrayocupadas[$dato->id]['pedidoid']}}" style="color:gold; background: #000; padding: 5px;" data-idpedido="{{$arrayocupadas[$dato->id]['pedidoid']}}"></span>
              @endif
              <br>
              @if (isset($arrayocupadas[$dato->id]))
                  <span style="color:navy; line-height: 30px">{{$arrayocupadas[$dato->id]['login']}}</span>
                  <br>
                  <span style="background:yellow">S/. {{$arrayocupadas[$dato->id]['consumo']}}</span> 
              @else
                 <br style="color:navy; line-height: 30px">
                 <br>
              @endif   
            </div>
          </li>
          @endforeach
        </ul>
  </div>
  @endfor
  <div class="modalwindow" style="display:none;">
  <ul class="list-group listamozos">
  </ul>
      <button type="button" class="btn btn-danger pull-right" id="btn_cancelar_mozo">Cancelar</button>
      <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;" id="btn_aceptar_mozo">Aceptar</button>
  </div>
  </div>
@stop
@section('js')
{{HTML::script('js/caja.js')}}
@stop