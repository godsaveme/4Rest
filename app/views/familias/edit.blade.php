@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')

        <a href="{{URL('familias')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> CREAR FAMILIA
</strong></div>

<div class="panel-body">

{{ Form::open(array('id'=>'form_resto','url' => 'familias/update/'.$familia->id , 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal')) }}
<fieldset>
  <legend></legend>

  <div class="form-group">
    <div class="col-md-3">
        {{Form::label('nombre', 'Nombre', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
        {{Form::text('nombre', $familia->nombre, array('class' => 'form-control','placeholder'=>'ej. Salón 1', 'required', 'validationMessage'=>'Por favor entre un nombre.'))}}
    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
        {{Form::label('descripcion', 'Descripcion', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
        {{Form::text('descripcion', $familia->descripcion, array('class' => 'form-control','placeholder'=>'ej. Salón en buenas condiciones.', 'required', 'validationMessage'=>'Por favor entre una descripción.'))}}
    </div>

</div>

<div class="form-group">
    <div class="col-md-12">
        {{ Form::file('imagen') }}
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
</div> <!-- del panel body -->
@stop