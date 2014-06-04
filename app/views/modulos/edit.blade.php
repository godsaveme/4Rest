@extends('layouts.master')
 
@section('sidebar')
     Modulos
@stop
@section('content')
<div class="row">
  <div class="small-8 medium-8 large-8 columns">
     &nbsp;
  </div>
  <div class="small-4 medium-4 large-4 columns">
    {{ HTML::link('modulos', 'volver', array('class'=>'button tiny radius')); }}
  </div>
</div>
{{Form::open(array('url'=>'modulos/update','data-abide' => 'data-abide'))}}
<fieldset>
  <legend>Crear Modulo</legend>
  <div class="row">
    <div class="large-12 columns">
      {{Form::hidden('id', $modulo->id)}}
      {{Form::label('nmodulo', 'Modulo')}}
      {{Form::input('text', 'nmodulo',$modulo->nmodulo)}}
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
      {{Form::label('nombre', 'Nombre Proceso')}}
      {{Form::input('text', 'nombre', $modulo->nombre)}}
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
      {{Form::label('controlador', 'Controlador')}}
      {{Form::input('text', 'controlador', $modulo->controlador)}}
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
      {{Form::label('proceso', 'Proceso')}}
      {{Form::input('text', 'proceso', $modulo->proceso)}}
    </div>
  </div>
  <div class="row">
    <div class="small-3 medium-2 large-2 columns">
      {{Form::label('activo', 'Activo')}}
      {{Form::select('activo', array(0=>'No', 1=>'Si'), $modulo->activo)}}
    </div>
    <div class="small-9 medium-10 large-10 columns">
      &nbsp;
    </div>
  </div>
  <div class="row">
    <div class="small-8 medium-8 large-8 columns">
      &nbsp;
    </div>
    <div class="small-4 medium-4 large-4 columns">
      {{Form::submit('Guardar', array('class'=>'button tiny radius right'))}}
    </div>
  </div>
</fieldset>
{{Form::close()}}
@stop