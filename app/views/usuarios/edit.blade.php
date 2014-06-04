@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')

        <a href="{{URL('usuarios')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> EDITAR USUARIO
</strong></div>

<div class="panel-body">
        {{ Form::open(array('id'=>'form_resto','url' => 'usuarios/edit', 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal')) }}
<fieldset>
  <legend></legend>
  <div class="form-group">
    <div class="col-md-3">
      {{Form::hidden('id', $usuario->id , array('class'=>'control-label'))}}
      {{Form::label('login', 'Usuario',array('class'=>'control-label'))}}
          </div>
    <div class="col-md-5">
      {{Form::input('text', 'login', $usuario->login, array('class' => 'form-control','placeholder'=>'ej gperez', 'autofocus','required', 'validationMessage'=>'Por favor entre un nombre.'))}}
    </div>
  </div>

<div class="form-group">
    <div class="col-md-3">
      {{Form::label('password', 'Contraseña', array('class'=>'control-label'))}}
          </div>
    <div class="col-md-5">
      {{Form::input('password', 'password', $usuario->password, array('class' => 'form-control','placeholder'=>'', 'autofocus','required', 'validationMessage'=>'Por favor entre una contraseña' ,'disabled' => 'disabled'))}}
          </div>

</div>
<div class="form-group">
    <div class="col-md-3">
      {{Form::label('estado', 'Estado', array('class'=>'control-label'))}}
          </div>

    <div class="col-md-5">
      {{Form::select('estado', array(0=>'Inactivo', 1=>'Activo'), $usuario->estado, array('class' => 'form-control'))}}
       </div>
</div>
<div class="form-group">
    <div class="col-md-3">
      <?php $persona = Persona::find($usuario->persona_id);?>
      {{Form::hidden('persona_id', $usuario->persona_id, array('id'=>'persona_id'))}}
      {{Form::label('usuario', 'Buscar persona por', array('class'=>'control-label'))}}
          </div>

    <div class="col-md-5">
      {{Form::select('selector_', array('1'=>'Nombre', '2'=>'DNI'), '1', array('id'=>'selector_', 'disabled'=>'disabled','class' => 'form-control'))}}
      {{Form::input('text', 'nombre_', $persona->nombres.' '.$persona->apPaterno.' '.$persona->apMaterno, array('id'=>'nombre_', 'placeholder' => 'Buscar por nombre', 'disabled'=>'disabled', 'class' => 'form-control'))}}
      {{Form::input('text', 'dni_', '', array('id'=>'dni_', 'placeholder' => 'Buscar por DNI', 'style'=>'display: none'))}}
    </div>
  </div>

<div class="form-group">
    <div class="col-md-3">
      {{Form::label('id_restaurante', 'Local', array('class'=>'control-label'))}}
      {{Form::select('id_restaurante',  array('' => "Seleccione ... ") +$restaurantes, $usuario->id_restaurante, array('class' => 'form-control'))}}
    </div>

    <div class="col-md-5">
      {{Form::label('id_tipoareapro', 'Área', array('class'=>'control-label'))}}
      {{Form::select('id_tipoareapro', array('' => "Seleccione ... "), $usuario->id_tipoareapro, array('select-areap'=>$usuario->id_tipoareapro , 'class'=>'form-control'))}}
    </div>
</div>

<div class="form-group">
    <div class="col-md-4">
      {{Form::submit('Modificar', array('class' => 'btn btn-warning') )}}
    </div>
</div>
</fieldset>
{{ Form::close() }}
@stop