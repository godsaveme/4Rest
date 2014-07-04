@extends('layouts.cajamaster')
@section('escalahtml')
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<meta name="viewport" content="width=device-width" />
@stop
@section('modulo')
	Monitor General
@show
 @section('css')
 {{HTML::style('css/foundation.css')}}
 @stop
@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<ul class="small-block-grid-3 medium-block-grid-3 large-block-grid-4" id="contaitnerplatos">
				@foreach ($mesas as $mesa)
					<li>
			            <div class="panel panel-info">
			                <div class="panel-heading" style="line-height: 30px">
			                {{substr($mesa->nombre,-2)}} / {{$arrayconsumos['mesa_'.$mesa->id]['login']}}
			                 / {{$arrayconsumos['mesa_'.$mesa->id]['preciot']}}
			                 <span class="tiempoenmesa pull-right" id="mesa_{{$arrayconsumos['mesa_'.$mesa->id]['idpedido']}}" style="color:red; padding: 5px;" data-idpedido="{{$arrayconsumos['mesa_'.$mesa->id]['idpedido']}}"></span>
			                </div>
			                <table class="table table-bordered">
			                @foreach ($arrayproductos['mesa_'.$mesa->id] as $detalle)
			                	<tr  data-estado="{{$detalle->estado}}" data-iddetped="{{$detalle->id}}" class="{{$detalle->estado}}">
			                		<td style="line-height: 30px; background: silver;">
			                			{{HTML::image('images/'.$detalle->estado.'.png', 'alt', array('height'=>30, 'width'=>30))}}
			            			@if ($detalle->estado == 'I')
			            				<time class="timeago" datetime="{{str_replace(' ','T', $detalle->fechaInicio)}}-05:00" style="color:red"></time>
			            			@elseif($detalle->estado == 'P')
			            				<time class="timeago" datetime="{{str_replace(' ','T', $detalle->fechaProceso)}}-05:00" style="color:red"></time>
			            			@elseif($detalle->estado == 'E')
			            				<time class="timeago" datetime="{{str_replace(' ','T', $detalle->fechaDespacho)}}-05:00" style="color:red"></time>
			            			@elseif($detalle->estado == 'D')
			            				<time class="timeago" datetime="{{str_replace(' ','T', $detalle->fechaDespachado)}}-05:00" style="color:red"></time>
			            			@endif
			                		</td>
			                		<td style="line-height: 30px">
			                			{{$detalle->nombre}} x {{$detalle->cantidad}}
			                		</td>
			                	</tr>
			                @endforeach
			                </table>
			            </div>
		        	</li>
		        @endforeach
		    </ul>
		</div>
	</div>
@stop
@section('js')
{{HTML::script('js/monitoresgeneral.js')}}
@stop