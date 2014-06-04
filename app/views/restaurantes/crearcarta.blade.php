@extends('layouts.master')
@section('js')
	{{HTML::script('js/crearcarta.js')}}
@stop
@section('content')
  @parent
@stop 
@section('sub-content')

        <a href="{{URL('restaurantes')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>

<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> CREAR CARTA
</strong></div>

<div class="panel-body">

{{ Form::open(array('id'=>'form_resto','url' => '' , 'enctype' => 'multipart/form-data', 'class'=>'form-horizontal')) }}
	<fieldset>
	    <legend>Crear Carta - <span id="nombre_local"></span></legend>
		  <div class="form-group">
		      <div class="col-md-5">
		      	{{Form::select('restaurante_id', array('0'=>'Seleciona un Restaurante') + $restaurantes, 0, array('class' => 'form-control', 'id'=>'restaurante_id'))}}
		      	<br>
		      	<div class="form-group">
		      		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		      			{{Form::select('familia_id', array('0'=>'Seleciona una Familia') + $familias, 0, array('class' => 'form-control', 'id'=>'familia_id'))}}
		      		</div>
		      	</div>
		      	<div class="form-group">
		      		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		      			{{Form::select('producto_id', array('0'=>'Seleciona un Producto'), 0, array('class' => 'form-control', 'id'=>'producto_id'))}}
		      		</div>
		      	</div>
		      	<div class="form-group">
		      		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		      			<a href="{{URL('restaurantes')}}" class='pull-right btn btn-info'><i class="fa fa-share"></i> Agregar</a>
		      		</div>
		      	</div>
		      	<div class="form-group">
		      		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		      			{{Form::select('tipocomb_id', array('0'=>'Seleciona una tipo de Combinacion') + $tipodecombinaciones, 0, array('class' => 'form-control', 'id'=>'tipocomb_id'))}}
		      		</div>
		      	</div>
		      	<div class="form-group">
		      		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		      			{{Form::select('combinacion_id', array('0'=>'Seleciona una combinación'), 0, array('class' => 'form-control','id'=> 'combinacion_id'))}}
		      		</div>
		      	</div>
		      	<div class="form-group">
		      		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		      			<a href="{{URL('restaurantes')}}" class='pull-right btn btn-info'><i class="fa fa-share"></i> Agregar</a>
		      		</div>
		      	</div>
		      </div>
		      <div class="col-md-7">
		      	<legend>Carta</legend>
		      </div>
		  </div>
	</fieldset>
{{ Form::close() }}
</div> <!-- del panel body -->
@stop