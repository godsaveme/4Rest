@extends('layouts.pedidosmaster')

 
@section('mesas_bar')

	@parent

	@foreach($salones as $salon)

                    <li><label>{{$salon->nombre}}</label></li>

                <?php $mesas = Mesa::whereraw('salon_id='.$salon->id.' and habilitado=1')->get(); ?>

                   @foreach ($mesas as $mesa) 
                   <li>
                    <?php
                  $i=$mesa->estado;
                  $color="";
                    switch ($i) {
                       case "L":
                             $color="white";
                             break;
                       case "O":
                             $color="red";
                             break;
                       case "R":
                             $color="yellow";
                             break;
                       default: 
                          $color="white";
                          break;
                    }
                ?>
                      <!--<span style="display:block; position: left; height: 15px; width: 15px; background-color: {{$color}};"></span>-->
                   <a href="javascript:void(0)" class="btnClickMesa" style="color: {{$color}}" data-id="{{$mesa->id}}" data-nombre="{{$mesa->nombre}}">{{$mesa->nombre}}</a>
                  </li>
                   @endforeach 
      
   
              @endforeach

@stop


@section('main_section')
	     <div class="row">
        	<div class="large-12 columns">
              <div style="position: relative; height: 550px;"></div>
            </div>
         </div>
@stop





