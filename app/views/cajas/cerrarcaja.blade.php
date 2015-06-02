@extends('layouts.cajamaster')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			@if (isset($errors))
			<ul>
				@foreach ($errors->all() as $message)
						<li>{{$message}}</li>
				@endforeach
			</ul>
			@endif
			{{Form::open(array('url' => '/cajas/cerrarcaja', 'method' => 'post', 'role'=>'form', 'class'=>'form-horizontal'))}}
			<legend>Cierre de Caja</legend>
			<div class="col-sm-6">
				<fieldset class="fielsetborder">
					<legend class="legendborder">Ventas</legend>
					{{Form::hidden('detcajaid', $detcaja->id)}}
					<div class="form-group">
					    <label for="inputEmail3" class="col-sm-5 text-left">Efectivo</label>
					    <div class="col-sm-5">
					      <input type="text" value="{{$efectivo}}" class="form-control text-right" id="inputEmail3" disabled="disabled">
					    </div>
					    <div class="col-sm-2">
					    	<a href="/cajas/listarventas?tipoc=2">Verdetalle</a>
					    </div>
					</div>
					<div class="form-group">
					    <label for="inputEmail3" class="col-sm-5 text-left">Tarjetas</label>
					     <div class="col-sm-5">
					      <input type="text" value="{{$tarjetas}}"  class="form-control text-right" id="inputEmail3" disabled="disabled">
					    </div>
					    <div class="col-sm-2">
					    	<a href="/cajas/listarventas?tipoc=3">Verdetalle</a>
					    </div>
					</div>
					<div class="form-group">
					    <label for="inputEmail3" class="col-sm-5 text-left">Total</label>
					     <div class="col-sm-5">
					      {{Form::input('text', 'ventastotales', $totalventas, array('class'=>'form-control text-right', 'placeholder'=> 'S/. 0.00', 'disabled'))}}
					    </div>
					    <div class="col-sm-2">
					    	<a href="/cajas/listarventas?tipoc=1">Verdetalle</a>
					    </div>
					</div>
				</fieldset>
				<fieldset class="fielsetborder">
					<legend class="legendborder">No asociados a la Venta</legend>
					<div class="form-group">
					    <label for="inputEmail3" class="col-sm-5 text-left">Promociones</label>
					    <div class="col-sm-5">
					      <input type="text" value="{{$promociones}}"  class="form-control text-right" id="inputEmail3" disabled="disabled">
					    </div>
					    <div class="col-sm-2">
					    	<a href="/cajas/listarventas?tipoc=6">Verdetalle</a>
					    </div>
					</div>
					<div class="form-group">
					    <label for="inputEmail3" class="col-sm-5 text-left">Vales de Personal</label>
					     <div class="col-sm-5">
					      <input type="text" value="{{$valespersonal}}" class="form-control text-right" id="inputEmail3" disabled="disabled">
					    </div>
					    <div class="col-sm-2">
					    	<a href="/cajas/listarventas?tipoc=5">Verdetalle</a>
					    </div>
					</div>
					<div class="form-group">
					    <label for="inputEmail3" class="col-sm-5 text-left">Descuentos Autorizados</label>
					     <div class="col-sm-5">
					      <input type="text" value="{{$descuentosautorizados}}" class="form-control text-right" id="inputEmail3" disabled="disabled">
					    </div>
					    <div class="col-sm-2">
					    	<a href="/cajas/listarventas?tipoc=4">Verdetalle</a>
					    </div>
					</div>
				</fieldset>
			</div>
			<div class="col-sm-6">
				<fieldset class="fielsetborder">
					<legend class="legendborder">Movientos Caja</legend>
					<div class="form-group">
					    <label for="inputEmail3" class="col-sm-5 text-left">Saldo Inicial</label>
					    <div class="col-sm-5">
					      {{Form::input('text', 'montoInicial', $detcaja->montoInicial, array('class'=>'form-control text-right', 'placeholder'=> 'S/. 0.00', 'disabled'))}}
					    </div>
					    <div class="col-sm-2">
					    	&nbsp;
					    </div>
					</div>
					<div class="form-group">
					    <label for="inputEmail3" class="col-sm-5 text-left">Ingresos</label>
					     <div class="col-sm-5">
					      {{Form::input('text', 'ingresosacaja', $totalingresoscaja, array('class'=>'form-control text-right', 'placeholder'=> 'S/. 0.00', 'disabled'))}}
					    </div>
					    <div class="col-sm-2">
					    	<a href="/cajas/listaringresos">Verdetalle</a>
					    </div>
					</div>
					<div class="form-group">
					    <label for="inputEmail3" class="col-sm-5 text-left">Gastos</label>
					     <div class="col-sm-5">
					      {{Form::input('text', 'gastos', $totalgastos, array('class'=>'form-control text-right','disabled', 'placeholder'=> 'S/. 0.00'))}}
					    </div>
					    <div class="col-sm-2">
					    	<a href="/cajas/listargastos">Verdetalle</a>
					    </div>
					</div>
				</fieldset>
				<fieldset class="fielsetborder">
					<legend class="legendborder">Arqueo</legend>
					<div class="form-group">
					    <label for="inputEmail3" class="col-sm-5 text-left">Cantidad Teórica</label>
					    <div class="col-sm-5">
					      {{Form::input('text', 'importetotal', $importetotal, array('class'=>'form-control text-right', 'placeholder'=> 'S/. 0.00', 'disabled'))}}
					    </div>
					    <div class="col-sm-2">
					    	&nbsp;
					    </div>
					</div>
					<div class="form-group">
					    <label for="inputEmail3" class="col-sm-5 text-left">Cantidad Real</label>
					     <div class="col-sm-5">
					      {{Form::input('text', 'arqueo', '', array('class'=>'form-control text-right', 'placeholder'=> 'S/. 0.00', 'id'=>'arqueo'))}}
					    </div>
					    <div class="col-sm-2">
					    	&nbsp;
					    </div>
					</div>
					<div class="form-group">
					    <label for="inputEmail3" class="col-sm-5 text-left">Descuadre</label>
					     <div class="col-sm-5">
					      {{Form::input('text', 'diferencia', '', array('class'=>'form-control text-right', 'placeholder'=> 'S/. 0.00', 'disabled'))}}
					    </div>
					    <div class="col-sm-2">
					    	&nbsp;
					    </div>
					</div>
				</fieldset>
			</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<button type="submit" class="btn btn-primary pull-right">Aceptar</button>
				</div>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop
@section('js')
    {{HTML::script('js/caja2.js')}}
@stop