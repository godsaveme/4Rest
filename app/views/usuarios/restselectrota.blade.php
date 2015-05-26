@extends('layouts.cajamaster')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			{{Form::open(array('url' => '/usuarios/selectrota', 'method' => 'post', 'role'=>'form'))}}
				<legend>Reporte de Productos</legend>
				<div class="row">
					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
						<div class="form-group">
							<label for="">Selecciona Sucursal</label>
							{{Form::select('restaurante_id', array('0'=> '-') + $restaurantes,'', array('class'=>'form-control'))}}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<button type="submit" class="btn btn-primary pull-right">Aceptar</button>
					</div>
				</div>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop