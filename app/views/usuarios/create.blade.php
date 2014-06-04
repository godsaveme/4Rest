@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')

        <a href="{{URL('usuarios')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> CREAR USUARIO
</strong></div>

<div class="panel-body">
        {{ Form::open(array('id'=>'form_resto','url' => 'usuarios/create', 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal')) }}
<fieldset>
  <legend></legend>
  <div class="form-group">
    <div class="col-md-3">
      {{Form::label('login', 'Usuario')}}
          </div>
    <div class="col-md-5">
      {{Form::input('text', 'login','', array('class' => 'form-control','placeholder'=>'ej gperez', 'autofocus','required', 'validationMessage'=>'Por favor entre un nombre.'))}}
    </div>
  </div>

<div class="form-group">
    <div class="col-md-3">
      {{Form::label('password', 'Contraseña', array('class'=>'control-label'))}}
          </div>
    <div class="col-md-5">
      {{Form::input('password', 'password','', array('class' => 'form-control','placeholder'=>'', 'autofocus','required', 'validationMessage'=>'Por favor entre una contraseña' ))}}
          </div>

</div>
<div class="form-group">
    <div class="col-md-3">
      {{Form::label('estado', 'Estado', array('class'=>'control-label'))}}
          </div>

    <div class="col-md-5">
      {{Form::select('estado', array(0=>'Inactivo', 1=>'Activo'), '',array('class' => 'form-control'))}}
       </div>
</div>
<div class="form-group">
  <div class="col-md-3">
      {{Form::hidden('persona_id', '', array('id'=>'persona_id'))}}
      {{Form::label('usuario', 'Buscar persona por', array('class' => 'control-label'))}}
      </div>
      <div class="col-md-5">
      {{Form::select('selector_', array('1'=>'Nombre', '2'=>'DNI'), '1', array('id'=>'selector_', 'class' => 'form-control'))}}
      {{Form::input('text', 'nombre_', '', array('id'=>'nombre_', 'placeholder' => 'Buscar por nombre', 'class' => 'form-control'))}}
      {{Form::input('text', 'dni_', '', array('id'=>'dni_', 'placeholder' => 'Buscar por DNI', 'style'=>'display: none','class' => 'form-control'))}}
    </div>
  </div>

<div class="form-group">
    <div class="col-md-3">
      {{Form::label('id_restaurante', 'Local', array('class'=>'control-label'))}}
      {{Form::select('id_restaurante',  array('' => "Seleccione ... ") +$restaurantes, '',array('class' => 'form-control'))}}
    </div>

    <div class="col-md-5">
      {{Form::label('id_tipoareapro', 'Área', array('class'=>'control-label'))}}
      {{Form::select('id_tipoareapro', array('' => "Seleccione ... "),'', array('class'=>'form-control'))}}
    </div>
</div>

<div class="form-group">
    <div class="col-md-4">
      {{Form::submit('Guardar', array('class' => 'btn btn-warning') )}}
    </div>
</div>
</fieldset>
{{ Form::close() }}
@stop