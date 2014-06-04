@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')

        <a href="{{URL('tipocombinacions')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> MODIFICAR TIPO DE COMBINACIÓN
</strong></div>

<div class="panel-body">

{{Form::open(array('id'=>'form_resto','url'=>'tipocombinacions/update/'.$tipocomb->id, 'class'=>'form-horizontal'))}}
<fieldset>
	<legend></legend>
  <div class="form-group">
    <div class="col-md-3">
			{{Form::label('nombre', 'Nombre',array('class'=>'control-label'))}}
			    </div>
    <div class="col-md-5">
			{{Form::input('text', 'nombre',$tipocomb->nombre ,array('class'=>'form-control','placeholder'=>'Ej. Desayunos', 'required','autofocus', 'validationMessage'=>'Por favor entre un nombre.'))}}
		</div>
	</div>
<div class="form-group">
    <div class="col-md-3">
			{{Form::label('descripcion', 'Descripcion',array('class'=>'control-label'))}}
			    </div>
    <div class="col-md-5">
			{{Form::input('text', 'descripcion', $tipocomb->descripcion,array('class'=>'form-control','placeholder'=>'Ej. Todos los desayunos..', 'required', 'validationMessage'=>'Por favor entre una descripción.'))}}
		</div>
	</div>
	<div class="row">
	  <div class="col-md-4">
	  	{{Form::submit('Modificar', array('class' => 'btn btn-warning'))}}
	  </div>
	</div>
</fieldset>
{{Form::close()}}
</div> <!-- del panel body -->
@stop