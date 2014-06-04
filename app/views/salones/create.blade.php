@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')

        <a href="{{URL('salones')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


@if (!isset($salon)) 

<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> CREAR SALÓN
</strong></div>

<div class="panel-body">

{{ Form::open(array('id'=>'form_resto','url' => 'salones/store' , 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal')) }}
<fieldset>
  <legend></legend>

  <div class="form-group">
    <div class="col-md-3">
        {{Form::label('nombre', 'Nombre', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
        {{Form::text('nombre', '', array('class' => 'form-control','placeholder'=>'ej. Salón 1', 'autofocus','required', 'validationMessage'=>'Por favor entre un nombre.'))}}
    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
        {{Form::label('descripcion', 'Descripcion', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
        {{Form::text('descripcion', '', array('class' => 'form-control','placeholder'=>'ej. Salón en buenas condiciones.', 'required', 'validationMessage'=>'Por favor entre una descripción.'))}}
    </div>

</div>

<div class="form-group">
    <div class="col-md-3">
        {{Form::label('Restaurantes', 'Restaurantes', array('class'=>'control-label'))}}
    </div>

    <div class="col-md-5">
        {{Form::select('restaurante_id', $restaurantes,'', array('class' => 'form-control'))}}
    </div>
</div>
<div class="form-group">
    <div class="col-md-3">
        {{Form::label('Habilitado', 'Habilitado', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
        <div class="radio">
            <label>
                {{Form::radio('habilitado',1)}}Sí
            </label>
        </div>
        <div class="radio">
            <label>
                {{Form::radio('habilitado',0,true)}}No
            </label>
        </div>

    </div>

</div>


<!--{{ Form::file('imagen') }}-->
<div class="form-group">
    <div class="col-md-4">

        {{Form::submit('Guardar', array('class' => 'btn btn-warning') )}}

    </div>
</div>
</fieldset>
{{ Form::close() }}

@else
<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> MODIFICAR SALÓN
</strong></div>

<div class="panel-body">
{{ Form::open(array('id'=>'form_resto','url' => 'salones/update/'.$salon->id , 'enctype' => 'multipart/form-data', 'class'=>'form-horizontal')) }}
<fieldset>
  <legend></legend>
  <div class="form-group">
    <div class="col-md-3">
        {{Form::label('nombre', 'Nombre', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
        {{Form::text('nombre', $salon->nombre, array('class' => 'form-control','placeholder'=>'ej. Salón 1','autofocus', 'required', 'validationMessage'=>'Por favor entre un nombre.'))}}
    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
        {{Form::label('descripcion', 'Descripcion', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
        {{Form::text('descripcion', $salon->descripcion, array('class' => 'form-control','placeholder'=>'ej. Salón en buenas condiciones.', 'required', 'validationMessage'=>'Por favor entre una descripción.'))}}
    </div>

</div>

<!--{{ Form::file('image') }}-->
<div class="form-group">
    <div class="col-md-3">
        {{Form::label('Restaurantes', 'Restaurantes', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
        {{Form::select('restaurante_id', $restaurantes, $salon->restaurante_id, array('class' => 'form-control'))}}
    </div>
</div>
<div class="form-group">
    <div class="col-md-3">
        {{Form::label('Habilitado', 'Habilitado')}}
    </div>
    <div class="col-md-5">
        @if($salon->habilitado==1)
        <div class="radio">
            <label >
                {{Form::radio('habilitado',1,true)}}Sí
            </label>
        </div>

        <div class="radio">
            <label >
                {{Form::radio('habilitado',0)}}No
            </label>
        </div>

        @else
        <div class="radio">
            <label >
                {{Form::radio('habilitado',1)}}Sí
            </label>
        </div>

        <div class="radio">
            <label >
                {{Form::radio('habilitado',0,true)}}No
            </label>
        </div>

        @endif
    </div>
</div>
<div class="form-group">
    <div class="col-md-4">
        {{Form::submit('Modificar', array('class' => 'btn btn-warning') )}}
    </div>
</div>
</fieldset>
{{ Form::close() }}

</div> <!-- del panel body -->

@endif

@stop
