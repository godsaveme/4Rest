@extends('layouts.master')
 
@section('sidebar')
     Perfiles
@stop

 
@section('content')
        {{ Form::open(array('url' => 'perfiles/update', 'data-abide' => 'data-abide')) }}
<fieldset>
  <legend>Editar Perfil</legend>
  <div class="row">
    <div class="large-12 columns">
      {{Form::hidden('id', $perfil->id)}}
      {{Form::label('nombre', 'Nombre')}}
      {{Form::input('text', 'nombre', $perfil->nombre)}}
    </div>
  </div>
  <div class="row">
    <div class="large-9 columns">
      {{Form::label('descripcion', 'Descripcion')}}
      {{Form::input('text', 'descripcion', $perfil->descripcion)}}
    </div>
    <div class="large-3 columns">
      {{Form::label('selector', 'Descripcion')}}
      {{Form::select('selector', array(1=>'Persona', 2 => 'Empresa'), $perfil->selector)}}
    </div>
  </div>
  <div class="row">
    <div class="small-6 medium-16 large-16 columns">
      &nbsp;
    </div>
    <div class="small-6 medium-16 large-16 columns">
      {{HTML::link('perfiles', 'Cancelar', array('class'=> 'button radius left'))}}
      {{Form::submit('Guardar', array('class'=> 'button radius right'))}}
    </div>
  </div>
</fieldset>
        {{ Form::close() }}
@stop