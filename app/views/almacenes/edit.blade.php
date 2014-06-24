@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')

        <a href="{{URL('almacenes')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> EDITAR ALMACÉN
</strong></div>

<div class="panel-body">

{{ Form::open(array('id'=>'form_resto','url' => 'almacenes/update' , 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal')) }}
<fieldset>
  <legend></legend>

  <div class="form-group">
    <div class="col-md-3">
        {{Form::label('nombre', 'Nombre', array('class'=>'control-label'))}}
        {{Form::hidden('almacen_id', $almacen->id) }}
    </div>
    <div class="col-md-5">
        {{Form::text('nombre', $almacen->nombre, array('class' => 'form-control','placeholder'=>'ej. Almacen general', 'required', 'validationMessage'=>'Por favor entre un nombre.'))}}
    </div>
</div>



<div class="form-group">
    <div class="col-md-3">
        {{Form::label('capacidad', 'Capacidad', array('class' => 'control-label'))  }}
    </div>
    <div class="col-md-5">
        {{Form::text('capacidad', $almacen->capacidad, array('class' => 'form-control' , 'placeholder'=>'100 m2.', 'required' , 'validationMessage'=>'Campo requerido') ) }}
    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
        {{Form::label('restaurante', 'restaurante', array('class' => 'control-label'))  }}
    </div>
    <div class="col-md-5">
        {{Form::select('restaurante_id', $restaurantes, $almacen->restaurante_id ,array('class' => 'form-control') ) }}
    </div>
</div>


<div class="form-group">
    <div class="col-md-3">
        {{Form::label('descripcion', 'Comentarios', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
        {{Form::textarea('descripcion', $almacen->descripcion, array('class' => 'form-control','placeholder'=>'...', 'required', 'validationMessage'=>'Campo requerido.'))}}
    </div>

</div>

<!--{{ Form::file('imagen') }}-->
<div class="form-group">
    <div class="col-md-4">

        {{Form::submit('Modificar', array('class' => 'btn btn-warning') )}}

    </div>
</div>
</fieldset>
{{ Form::close() }}
</div> <!-- del panel body -->
@stop