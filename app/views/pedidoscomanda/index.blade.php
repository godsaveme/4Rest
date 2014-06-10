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
            <div class="btn_mesascajas img-circle {{$dato->estado}} text-center" data-id="{{$dato->id}}" data-estado = "{{$dato->estado}}">
              {{$dato->nombre}}
              @if (isset($arrayocupadas[$dato->id]))
                  <br><br>
                  <span style="color:navy">{{$arrayocupadas[$dato->id]['login']}} / S/. {{$arrayocupadas[$dato->id]['consumo']}}</span>
                  <br><br>
                 <time class="timeago" datetime="{{str_replace(' ','T', $arrayocupadas[$dato->id]['created_at'])}}-05:00" style="color:gold; background: #000; padding: 5px;"></time>
              @endif
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
