@extends('layouts.cajamaster')
@section('js')
{{HTML::script('js/caja2.js')}}
@stop
@section('content')
<audio id="sonido_recibirpedido" src="/sound/mozo.mp3"> </audio>
<audio id="sonido_demora" src="/sound/demora.mp3" loop> </audio>

@if(count($salones)>0)

<div id="tabstrip">
  <ul id="tabscaja">
    @for ($i=0; $i < count($salones); $i++)
      <li class="@if($i==0) k-state-active @endif">
        {{$salones[$i]['nombre']}}
      </li>
    @endfor
  </ul>
  @for ($i=0; $i < count($salones); $i++)
  <div class="mostrarmesas"  style="background-color: #ffffff">
        <ul class="list-inline"> 
          @foreach ($arraymesas[$salones[$i]['id']] as $dato)
          <li >
            <div id="{{$dato->mesa}}" class="btn_mesascajas {{$dato->estado}} text-center" data-id="{{$dato->id}}" data-estado = "{{$dato->estado}}"
            @if (isset($arrayocupadas[$dato->id]))
              @if($arrayocupadas['pagado_'.$dato->id]['pagado']<= 0)
                style="border-color: #48c;
background-color: #83cfff;
background-image: linear-gradient(#ccefff 0%, #76caff 100%);"
              @endif
            @endif
            >
              <span style="background-color:#fff; padding:3px; border-radius:4px; box-shadow: 0 0 2px rgba(0,0,0,0.2);"> {{$dato->nombre}} </span>
              @if (isset($arrayocupadas[$dato->id]))
               &nbsp;<span class="tiempoenmesa" id="mesa_{{$arrayocupadas[$dato->id]['pedidoid']}}" style="color:gold; background: #000; padding: 3px; border-radius:3px;" data-idpedido="{{$arrayocupadas[$dato->id]['pedidoid']}}"></span>
              @endif
              <br>
              @if (isset($arrayocupadas[$dato->id]))
                  <span style="color:navy; line-height: 30px">{{$arrayocupadas[$dato->id]['login']}}</span>
                  <br>
                  <span style="background:yellow;padding: 2px; border-radius:3px; box-shadow: 0 0 2px rgba(0,0,0,0.2);">S/. {{$arrayocupadas[$dato->id]['consumo']}}</span> 
              @else
                 <br style="color:navy; line-height: 30px">
                 <br>
              @endif
              @if (isset($arrayocupadas[$dato->id]))
                @if (array_search($arrayocupadas[$dato->id]['pedidoid'], $arrPedJuntar) != null)
                    
                      

                           <span style="background:seashell;padding: 2px; border-radius:3px; box-shadow: 0 0 2px rgba(0,0,0,0.2);">
                              U{{array_search($arrayocupadas[$dato->id]['pedidoid'], $arrPedJuntar)}}
                           </span>
                     
                @endif
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

  @else
    <div class="alert alert-info" role="alert" style="margin-top: 50px;">
        <p class="">No hay salones creados o habilitados</p>
    </div>
  @endif
@stop
