@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')

        <a href="{{URL('almacenes')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> CREAR ALMACÉN
</strong></div>

<div class="panel-body">

{{ Form::open(array('id'=>'form_resto','url' => 'almacenes/store' , 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal')) }}
<fieldset>
  <legend></legend>

  <div class="form-group">
    <div class="col-md-3">
        {{Form::label('nombre', 'Nombre', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
        {{Form::text('nombre', '', array('class' => 'form-control','placeholder'=>'ej. Almacen general', 'required', 'validationMessage'=>'Por favor entre un nombre.'))}}
    </div>
</div>



<div class="form-group">
    <div class="col-md-3">
        {{Form::label('capacidad', 'Capacidad', array('class' => 'control-label'))  }}
    </div>
    <div class="col-md-5">
        {{Form::text('capacidad', '', array('class' => 'form-control' , 'placeholder'=>'100 m2.', 'required' , 'validationMessage'=>'Campo requerido') ) }}
    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
        {{Form::label('restaurante', 'Restaurante', array('class' => 'control-label'))  }}
    </div>
    <div class="col-md-5">
        {{Form::select('restaurante_id', $restaurantes,'',array('class' => 'form-control', 'id'=>'id_restaurante') ) }}
    </div>
</div>
<div class="form-group">
    <div class="col-md-3">
        {{Form::label('id_tipoareapro', 'Tipo Área de Prod.', array('class' => 'control-label'))  }}
    </div>
    <div class="col-md-5">
        {{Form::select('id_tipoareapro', array('0' => "Seleccione ... "),'', array('class'=>'form-control','disabled'))}}
    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
        {{Form::label('descripcion', 'Comentarios', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
        {{Form::textarea('descripcion', '', array('class' => 'form-control','placeholder'=>'...', 'required', 'validationMessage'=>'Campo requerido.'))}}
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