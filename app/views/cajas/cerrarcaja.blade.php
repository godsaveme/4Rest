@extends('layouts.cajamaster')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			@if (isset($errors))
			<ul>
				@foreach ($errors->all() as $message)
						<li>{{$message}}</li>
				@endforeach
			</ul>
			@endif
			{{Form::open(array('url' => '/cajas/cerrarcaja', 'method' => 'post', 'role'=>'form'))}}
				<legend>Cerrar Caja</legend>
				{{Form::hidden('detcajaid', $detcaja->id)}}
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					<div class="form-group">
						<label for="">Monto Inicial</label>
						{{Form::input('text', 'montoInicial', $detcaja->montoInicial, array('class'=>'form-control text-right', 'placeholder'=> 'S/. 0.00', 'disabled'))}}
					</div>
				</div>
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					<div class="form-group">
						<label for="">Ingresos a Caja</label>
						{{Form::input('text', 'ingresosacaja', $totalingresoscaja, array('class'=>'form-control text-right', 'placeholder'=> 'S/. 0.00', 'disabled'))}}
					</div>
				</div>
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					<div class="form-group">
						<label for="">Ventas Totales</label>
						{{Form::input('text', 'ventastotales', $totalventas, array('class'=>'form-control text-right', 'placeholder'=> 'S/. 0.00', 'disabled'))}}
					</div>
				</div>
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					<div class="form-group">
						<label for="">Gastos</label>
						{{Form::input('text', 'gastos', $totalgastos, array('class'=>'form-control text-right','disabled', 'placeholder'=> 'S/. 0.00'))}}
					</div>
				</div>
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					<div class="form-group">
						<label for="">Importe Total</label>
						{{Form::input('text', 'importetotal', $importetotal, array('class'=>'form-control text-right', 'placeholder'=> 'S/. 0.00', 'disabled'))}}
					</div>
				</div>
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					<div class="form-group">
						<label for="">Arqueo</label>
						{{Form::input('text', 'arqueo', '', array('class'=>'form-control text-right', 'placeholder'=> 'S/. 0.00', 'id'=>'arqueo'))}}
					</div>
				</div>
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					<div class="form-group">
						<label for="">Diferencia</label>
						{{Form::input('text', 'diferencia', '', array('class'=>'form-control text-right', 'placeholder'=> 'S/. 0.00', 'disabled'))}}
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