@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')

        <a href="{{URL('notas')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>



<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> EDITAR NOTA
</strong></div>

<div class="panel-body">
        {{ Form::open(array('id'=>'form_resto','url' => 'notas/edit','enctype' => 'multipart/form-data' , 'class'=>'form-horizontal')) }}
<fieldset>
  <legend></legend>

  <div class="form-group">
    <div class="col-md-3">
    {{Form::hidden('id', $nota->id)}}
      {{Form::label('descripcion', 'Descripcion',array('class'=>'control-label'))}}
          </div>
    <div class="col-md-5">
      {{Form::input('text', 'descripcion', $nota->descripcion, array('class' => 'form-control','placeholder'=>'ej. Sin sal', 'autofocus','required', 'validationMessage'=>'Por favor entre un nombre.'))}}
    </div>
  </div>

<div class="form-group">
    <div class="col-md-4">
      {{Form::submit('Modificar', array('class' => 'btn btn-warning'))}}
    </div>
  </div>
</fieldset>
        {{ Form::close() }}
@stop