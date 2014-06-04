@extends('layouts.cajamaster')
@section('sidebar')
     Cocina
@stop
 @section('css')
 {{HTML::style('css/jquery.countup.css')}}
 @stop
@section('content')
<div class="row">
	<div class="smal-8 medium-8 large-9 columns">
	<ul class="small-block-grid-3 medium-block-grid-3 large-block-grid-3">
	@foreach ($pedidos as $datos)
	<li>
		<ul class="pricing-table">
			<li class="title">{{$datos->nombre}} ({{$datos->ordenCocina}})</li>
			<li class="price" data-fechai = "{{str_replace(' ', ',', str_replace(':', ',', str_replace('-', ',', $datos->fechaInicio)))}}"><div id="{{$datos->pedido_id}}_{{$datos->ordenCocina}}"></div></li>
			@foreach ($platos[$datos->pedido_id.'_'.$datos->ordenCocina] as $dato)
			@if ($dato->estado != 'E')
				<li class="bullet-item {{$dato->estado}}" data-idpro="{{$dato->producto_id}}" data-iddetped="{{$dato->id}}" data-estado="{{$dato->estado}}"> 
					@if ($dato->detnota)
					<i class="fi-clipboard-pencil nota"></i>
					@endif 
				{{$dato->nombre}} x <span>{{$dato->cantidad}}</span>
				</li>
			@endif
			@endforeach
		</ul>
	</li>
	@endforeach
	</ul>	
	</div>
	<div class="smal-4 medium-4 large-3 columns">
	<h6>En espera</h6>
	<ul class="no-bullet" id="platospanel">
	@foreach ($platospanel as $plato)
	<li data-idpro="{{$plato->producto_id}}" class="{{$plato->estado}}">{{$plato->nombre}} x <span>{{$plato->sumcantidad}}</span></li>
	@endforeach
	</ul>
	</div>
</div>
@stop
@section('js')
{{HTML::script('js/jquery.countup.js')}}
{{HTML::script('js/cocina.js')}}
@stop