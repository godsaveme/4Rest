@extends('layouts.cajamaster')
 @section('css')
 {{HTML::style('css/foundation.css')}}
 {{HTML::style('css/jquery.countup.css')}}
 @stop
@section('content')
	<div class="row">
		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
			<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4" id="contaitnerplatos">
				@foreach ($pedidos as $datos)
					<li>
			            <div class="panel panel-info">
			                <div class="panel-heading">
			                {{$datos->nombre}} <time class="timeago pull-right" datetime="{{str_replace(' ','T', $datos->fechaInicio)}}-05:00" style="color:red"></time>
			                </div>
			                <ul class="list-group list-group-flush">
			                @foreach ($platos[$datos->pedido_id.'_'.$datos->ordenCocina] as $dato)
								@if ($dato->estado != 'E' && $dato->estado != 'A')
				                    <li class="list-group-item {{$dato->estado}}" data-idpro="{{$dato->producto_id}}" 
										data-iddetped="{{$dato->id}}" data-estado="{{$dato->estado}}">
											{{$dato->nombre}} x <span>{{$dato->cantidad}}</span>
									</li>
								@endif
							@endforeach
			                </ul>
			            </div>
		        	</li>
		        @endforeach
		    </ul>
        <script type="text/x-kendo-template" id="template_platoscocina">
        	<li>
		            <div class="panel panel-info">
		                <div class="panel-heading">
		                #:mesa# <time class="timeago pull-right" datetime="#=cronometro#-05:00" style="color:red"></time>
		                </div>
		                <ul class="list-group list-group-flush">
		                #for( var i in platos){#
		                    <li class="list-group-item #=platos[i]['estado']#" 
		                    	data-idpro="#=platos[i]['productoid']#" 
								data-iddetped="#=platos[i]['id']#" 
								data-estado="#=platos[i]['estado']#">
									#=platos[i]['nombre']# x <span>#=platos[i]['cantidad']#</span>
								#if (platos[i]['notas'].length > 0) {#
									<br>
									#for(var j in platos[i]['notas']){#
										#=platos[i]['notas'][j]#/ 
									#}#
								#}#
								#if (platos[i]['sabores'].length > 0) {#
									<br>
									#for(var l in platos[i]['sabores']){#
										#=platos[i]['sabores'][l]# /
									#}#
								#}#
								#if (platos[i]['adicionales'].length > 0) {#
									<br>
									#for(var k in platos[i]['adicionales']){#
										#=platos[i]['adicionales'][k]['nombre']# x #=platos[i]['adicionales'][k]['cantidad']#/ 
									#}#
								#}#
							</li>
						#}#
		                </ul>
		            </div>
	        </li>
        </script>
		</div>
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
			<div class="panel panel-default">
                <div class="panel-heading">
                	<h5>TOTALES</h5>
                </div>
                <ul class="list-group list-group-flush">
                	@foreach ($platospanel as $plato)
					<li data-idpro="{{$plato->producto_id}}" class="list-group-item {{$plato->estado}}">
					{{$plato->nombre}} x <span>{{$plato->sumcantidad}}</span>
					</li>
					@endforeach
                </ul>
            </div>
		</div>

	</div>
@stop
@section('js')
{{HTML::script('js/jquery.countup.js')}}
{{HTML::script('js/cocina.js')}}
@stop