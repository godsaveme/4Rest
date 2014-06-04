@extends('layouts.master')
 
@section('sidebar')
     Notas
@stop

@section('content')
<div class="row">
    <div class="small-6 medium-6 large-6 columns">
      &nbsp;
    </div>
    <div class="small-6 medium-6 large-6 columns">
      {{HTML::link('notas', 'Volver', array('class'=>'button radius right'))}}
    </div>
</div>
        {{ Form::open(array('url' => 'notas/create', 'data-abide' => 'data-abide')) }}
<fieldset>
  <legend>Crear Nota</legend>
  <div class="row">
    <div class="large-12 columns">
      {{Form::label('descripcion', 'Descripcion')}}
      {{Form::input('text', 'descripcion', '', array('Placeholder' => 'Ejm. Sin Sal...'))}}
    </div>
  </div>
  <div class="row">
    <div class="small-12 medium-12 large-12 columns">
      {{Form::submit('Guardar', array('class'=> 'button radius right'))}}
    </div>
  </div>
</fieldset>
        {{ Form::close() }}
@stop