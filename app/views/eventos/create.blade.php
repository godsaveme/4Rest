@extends('layouts.cajamaster')
@section('js')
{{HTML::script('js/eventos.js')}}
@stop
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
			{{Form::open(array('url' => '/eventos/create', 'method' => 'post', 'role'=>'form'))}}
				<legend>Datos Evento</legend>
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					<label>Fecha</label>
					{{Form::input('text', 'fecha', '', array('class'=>'form-control', 'id'=>'fecha'))}}
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					<div class="form-group">
						<label for="">Hora Inicio</label>
						{{Form::input('text', 'hora', '', array('class'=>'form-control', 'id'=>'hora'))}}
					</div>
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					<div class="form-group">
						<label for="">Hora Fin</label>
						{{Form::input('text', 'horafin', '', array('class'=>'form-control', 'id'=>'horafin'))}}
					</div>
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					<div class="form-group">
						<label for="">Precio</label>
						{{Form::input('text', 'costo', '', array('class'=>'form-control text-right', 'placeholder'=> 'S/. 0.00'))}}
					</div>
				</div>
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<div class="form-group">
						<label>Restaurante</label>
						{{Form::select('restaurante_id', $restaurantes, '', array('class'=>'form-control'))}}
					</div>
				</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
					<div class="form-group">
						<label>Descripción:</label>
						{{Form::input('text', 'descripcion', '',array('class'=>'form-control', 'placeholder'=> 'Ingrese Descripcion'))}}
					</div>
				</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
					<div class="form-group">
						<label>Nombre:</label>
						{{Form::input('text', 'nombre', '',array('class'=>'form-control', 'placeholder'=> 'Ingrese Nombre'))}}
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="form-group">
						<label>DNI:</label>
						{{Form::input('text', 'dni', '',array('class'=>'form-control', 'placeholder'=> 'Ingrese DNI'))}}
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="form-group">
						<label>Telefono:</label>
						{{Form::input('text', 'telefono', '',array('class'=>'form-control', 'placeholder'=> 'Telf. contacto'))}}
					</div>
				</div>
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<div class="form-group">
						<label>Correo:</label>
						{{Form::input('text', 'email', '',array('class'=>'form-control', 'placeholder'=> 'Ingrese Email'))}}
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