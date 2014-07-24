@extends('layouts.cajamaster')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
			@if (isset($errors))
			<ul>
				@foreach ($errors->all() as $message)
						<li>{{$message}}</li>
				@endforeach
			</ul>
			@endif
			{{Form::open(array('url' => '/cajas/registraringreso', 'method' => 'post', 'role'=>'form'))}}
				{{Form::hidden('detallecaja_id', $iddetalle)}}
				<legend>Registrar Ingreso</legend>
				<div class="col-xs-4">
					<label>Importe</label>
					{{Form::input('text', 'importetotal', '', array('class'=>'form-control text-right', 'placeholder'=> 'S/. 0.00'))}}
				</div>
				<div class="col-xs-8 ">
					&nbsp;
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
						<label>Motivo</label>
						{{Form::input('text', 'descripcion', '',array('class'=>'form-control', 'placeholder'=> 'Ingrese motivo'))}}
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<button type="submit" class="btn btn-primary pull-right">Aceptar</button>
				</div>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop