@extends('layouts.cajamaster')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			@if( $errors->has('montoInicial') )
	              @foreach($errors->get('montoInicial') as $error )
	                  <br />* {{ $error }}
	              @endforeach
	          @endif
	          @if( $errors->has('caja_id') )
	              @foreach($errors->get('caja_id') as $error )
	                  <br />* {{ $error }}
	              @endforeach
	          @endif
			{{Form::open(array('url' => '/cajas/index', 'method' => 'post', 'role'=>'form'))}}
				<legend>Abrir Caja</legend>
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					<div class="form-group">
						<label for="">Selecciona Caja</label>
						{{Form::select('caja_id', $cajas,'', array('class'=>'form-control'))}}
					</div>
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					<div class="form-group">
						<label for="">Monto Inicial</label>
						{{Form::input('text', 'montoInicial', '', array('class'=>'form-control text-right', 'placeholder'=> 'S/. 0.00'))}}
					</div>
				</div>
				<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
					<button type="submit" class="btn btn-primary pull-right">Aceptar</button>
				</div>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop