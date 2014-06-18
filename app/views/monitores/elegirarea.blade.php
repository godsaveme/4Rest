@extends('layouts.cajamaster')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			{{Form::open(array('id'=>'form_area'))}}
				<legend><span id="info_rest" data-id="{{$restaurante->id}}">{{$restaurante->nombreComercial}}</span> - Elegir Area</legend>
				<div class="row">
					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
						<div class="form-group">
							<label for="">Selecciona Area</label>
							{{Form::select('restaurante_id', array('0'=> 'Seleciona Área') + $areas,'', array('class'=>'form-control', 'id'=>'select_areaid'))}}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<a href="javascript:void(0)" class="btn btn-primary pull-right" id="btn_aceparea">Aceptar</a>
					</div>
				</div>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop

@section('js')
	{{HTML::script('js/monitoresgeneral.js')}}
@stop