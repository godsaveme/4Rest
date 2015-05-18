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
			       				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                					<label>Tipo de Ingreso</label>
                					{{Form::select('tipoingreso_id', $tiposdeingresos,'', array('class'=>'form-control'))}}
                				</div>
                				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                					<div class="form-group">
                						<label for="">Sub Total</label>
                						{{Form::input('text', 'subtotal', '', array('class'=>'form-control text-right', 'placeholder'=> 'S/. 0.00'))}}
                					</div>
                				</div>
                				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                					<div class="form-group">
                						<label for="">IGV</label>
                						{{Form::input('text', 'igv', '', array('class'=>'form-control text-right', 'placeholder'=> 'S/. 0.00'))}}
                					</div>
                				</div>
                				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                					<div class="form-group">
                						<label for="">Total</label>
                						{{Form::input('text', 'importetotal', '', array('class'=>'form-control text-right', 'placeholder'=> 'S/. 0.00'))}}
                					</div>
                				</div>
                				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                					<div class="form-group">
                						<label for="">Serie de Comprobante</label>
                						{{Form::input('text', 'seriecomprobante', '', array('class'=>'form-control text-right', 'placeholder'=> 'Texto o Números'))}}
                					</div>
                				</div>
                				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                					<div class="form-group">
                						<label for="">Numero de Comprobante</label>
                						{{Form::input('text', 'numerocomprobante', '', array('class'=>'form-control text-right', 'placeholder'=> 'Texto o Números'))}}
                					</div>
                				</div>
                				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                					<div class="form-group">
                						<label for="">Numero Cargo</label>
                						{{Form::input('text', 'numerocargo', '', array('class'=>'form-control text-right', 'placeholder'=> 'Texto o Números'))}}
                					</div>
                				</div>
                				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                					<div class="form-group">
                						<label>Descripción:</label>
                						<!--{{Form::input('text', 'descripcion', '',array('class'=>'form-control', 'placeholder'=> 'Ingrese motivo'))}}-->
                						<textarea name="descripcion" class="form-control" placeholder="Ingrese una descripción" rows="5"></textarea>
                					</div>
                				</div>
                				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                				<label>Estado:</label>
                                        {{Form::select('estado',array('0' => 'EMITIDO', '1' => 'CANCELADO'),0,array('class' => 'form-control'))}}
                				</div>
                				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-11">
                				    <div class="row">
                				    <br/><br/>
                					<button type="submit" class="btn btn-primary pull-right">Aceptar</button>
                					<span class="pull-right">   </span>

                					<a href="/cajas" class="btn btn-danger pull-right" style="margin-right: 10px;">Cancelar</a>
                					</div>
                				</div>



			{{Form::close()}}
		</div>
	</div>
</div>
@stop