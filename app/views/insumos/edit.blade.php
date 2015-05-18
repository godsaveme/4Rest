@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')

        <a href="{{URL('insumos')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> MODIFICAR INSUMO
</strong></div>

<div class="panel-body">
        {{ Form::open(array('id'=>'form_resto','url' => 'insumos/update/'.$insumo->id, 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal')) }}
  <div class="form-group">
    <div class="col-md-3">
            {{Form::label('nombre', 'Nombre', array('class'=>'control-label'))}}
            </div>
    <div class="col-md-5">
            {{Form::text('nombre', $insumo->nombre, array('class' => 'form-control','autofocus','placeholder'=>'ej. Azúcar', 'required', 'validationMessage'=>'Por favor entre un nombre.'))}}
            </div>
        </div>
<div class="form-group">
    <div class="col-md-3">
            {{Form::label('descripcion', 'Descripcion',array('class'=>'control-label'))}}
                </div>
    <div class="col-md-5">
            {{Form::text('descripcion', $insumo->descripcion, array('class' => 'form-control','placeholder'=>'ej. Azucar rubia de Pomalca.', 'required', 'validationMessage'=>'Por favor entre una descripción.'))}} 
            </div>
        </div>

        <div class="form-group">
                        <div class="col-md-4">
            {{Form::label('Unidades', 'Unidades', array('class'=>'control-label'))}}
                {{Form::select('unidadMedida', array('Unidades' => 'Unidades', 'Kilogramos' => 'Kilogramos', 'Litros' => 'Litros'),  $insumo->unidadMedida, array('class' => 'form-control'))}}  
            </div>
            <div class="col-md-4">
                {{Form::label('estado','Estado',array('class' => 'control-label'))}}
                {{Form::select('estado',array('1' => 'Activo', '0' => 'Inactivo'), $insumo->estado, array('class' => 'form-control'))}}
            </div>
            <div class="col-md-4">
                {{Form::label('ultimocosto','Ultimo Costo',array('class' => 'control-label'))}}<br>
                {{Form::text('ultimocosto', $insumo->ultimocosto, array('class' => '','placeholder'=>'0.00', 'required', 'validationMessage'=>'Por favor ingrese ultimo costo.'))}}
            </div>

        </div>
        <div class="form-group">
    <div class="col-md-4">
            {{Form::submit('Modificar', array('class' => 'btn btn-warning'))}}
                </div>
</div>
{{ Form::close() }}
</div> <!-- del panel body -->
@stop