@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')

        <a href="{{URL('personas')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> MODIFICAR PERSONA
</strong></div>

<div class="panel-body">
        {{ Form::open(array('id'=>'form_resto','url' => 'personas/edit', 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal')) }}
<fieldset>
  <legend></legend>
<div class="form-group">
    <div class="col-md-3">
    {{Form::hidden('id', $persona->id)}}
      {{Form::label('nombres', 'Nombres', array('class'=>'control-label'))}}
          </div>
    <div class="col-md-5">
      {{Form::input('text', 'nombres',$persona->nombres, array('class' => 'form-control','placeholder'=>'Ej. Juan Miguel','autofocus', 'required', 'validationMessage'=>'Por favor entre un nombre.'))}}
    </div>
  </div>

<div class="form-group">
    <div class="col-md-3">
      {{Form::label('apPaterno', 'Apellido Paterno', array('class'=>'control-label'))}}
          </div>
    <div class="col-md-5">
      {{Form::input('text', 'apPaterno', $persona->apPaterno, array('class' => 'form-control','placeholder'=>'Ej. Pérez', 'required', 'validationMessage'=>'Por favor entre un apellido paterno.'))}}
    </div>
  </div>

<div class="form-group">
    <div class="col-md-3">
      {{Form::label('apMaterno', 'Apellido Materno', array('class'=>'control-label'))}}
          </div>
    <div class="col-md-5">
      {{Form::input('text', 'apMaterno',$persona->apMaterno, array('class' => 'form-control','placeholder'=>'Ej. Aranibar', 'required', 'validationMessage'=>'Por favor entre un apellido materno.'))}}
    </div>
  </div>

<div class="form-group">
    <div class="col-md-4">
      {{Form::label('dni', 'DNI', array('class'=>'control-label'))}}
      {{Form::input('text', 'dni',$persona->dni, array('class' => 'form-control','placeholder'=>'8 dígitos', 'required', 'validationMessage'=>'Por favor entre un dni válido. (8 dígitos)', 'pattern'=>'[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]'))}}
    </div>
    <div class="col-md-8">
      {{Form::label('direccion', 'Dirección', array('class'=>'control-label'))}}
      {{Form::input('text', 'direccion', $persona->direccion, array('class' => 'form-control','placeholder'=>'Ej. Av. del Ejército 330', 'required', 'validationMessage'=>'Por favor entre un nombre.'))}}
    </div>
  </div>

<div class="form-group">
    <div class="col-md-3">
    {{Form::label('pais', 'País', array('class'=>'control-label'))}}
      {{Form::select('pais', array('0'=>'Seleccione País','Perú'=>'Perú','Otro' => 'Otro'),$persona->pais,array('class' => 'form-control'))}}
    </div>
    <div class="col-md-3">
    {{Form::label('departamento', 'Departamento', array('class'=>'control-label'))}}
      {{Form::select('departamento', $departamentos,$persona->departamento,array('class' => 'form-control'))}}
    </div>
    <div class="col-md-3">
    {{Form::label('provincia', 'Provincia', array('class'=>'control-label'))}}
      {{Form::select('provincia', $provincias,$persona->provincia,array('class' => 'form-control'))}}
    </div>
    <div class="col-md-3">
    {{Form::label('distrito', 'Distrito', array('class'=>'control-label'))}}
      {{Form::select('distrito', $distritos,$persona->distrito,array('class' => 'form-control'))}}
    </div>
  </div>

<div class="form-group">
    <div class="col-md-3">
      {{Form::label('tel', 'Telefono', array('class'=>'control-label'))}}
      {{Form::input('text', 'tel', $persona->tel, array('class' => 'form-control','placeholder'=>'6 díg. mín.', 'validationMessage'=>'Por favor entre un número de teléfono válido','pattern'=>'[0-9][0-9][0-9][0-9][0-9][0-9]+'))}}
    </div>
    <div class="col-md-3">
      {{Form::label('cel', 'Celular', array('class'=>'control-label'))}}
      {{Form::input('text', 'cel',$persona->cel, array('class' => 'form-control','placeholder'=>'9 dígitos','pattern'=>'[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]', 'validationMessage'=>'Por favor entre un número de celular válido.'))}}
    </div>
    <div class="col-md-6">
      {{Form::label('email', 'Email', array('class'=>'control-label'))}}
      {{Form::input('email', 'email', $persona->email, array('class' => 'form-control','placeholder'=>'persona@dominio.com', 'validationMessage'=>'Por favor entre un email válido.'))}}
    </div>
  </div>

<div class="form-group">
    <div class="col-md-2">
      {{Form::label('habilitado', 'Habilitado', array('class'=>'control-label'))}}
      {{Form::select('habilitado', array(1=>'Si', 0=> 'No'), $persona->habilitado ,array('class' => 'form-control'))}}
    </div>
    <div class="col-md-3">
      {{Form::label('perfil_id', 'Perfil', array('class'=>'control-label'))}}
      <select name="perfil_id" id="perfil_id" class="form-control">
        @foreach ($perfiles as $dato)
        <option value="{{$dato->id}}"
        @if ($dato->id == $persona->perfil_id)
          selected
        @endif
          >{{$dato->nombre}}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-7">
      &nbsp;
    </div>
  </div>
<div class="form-group">
    <div class="col-md-4">
      {{Form::submit('Modificar',  array('class' => 'btn btn-warning') )}}
    </div>
  </div>
</fieldset>
        {{ Form::close() }}
        </div> <!-- del panel body -->
@stop