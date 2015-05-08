@extends('layouts.master')


@section('content')
@parent
@stop
@section('sub-content')
        <a href="{{URL('almacenes/show/'.$almacen->id)}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>

<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> CREAR INSUMO
</strong></div>

<div class="panel-body">
    {{ Form::open(array('id'=>'form_resto','url' => 'almacenes/editarstock', 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal')) }}
    {{Form::hidden('almacen_id', $almacen->id)}}
    {{Form::hidden('insumo_id', $insumo->id, ['id'=>'insumo_id'])}}
    {{Form::hidden('tipo', $tipo,['id'=>'tipo'])}}
  <div class="form-group">
    <div class="col-md-3">
            {{Form::label('nombre', 'Nombre', array('class'=>'control-label'))}}
            </div>
    <div class="col-md-5">
            {{Form::text('nombre', $insumo->nombre, array('style'=>'width:250px','placeholder'=>'ej. Azúcar','autofocus', 'required', 'validationMessage'=>'Por favor entre un nombre.', 'id'=>'insumo','class' => 'form-control','readonly'))}}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                    {{Form::label('stock', 'Stock Actual',array('class'=>'control-label'))}}
                        </div>
            <div class="col-md-5">
                    {{Form::text('stock', $insumo->pivot->stockActual, array('placeholder'=>'0.00', 'required', 'validationMessage'=>'Por favor entre el stock actual.'))}}
            </div>
        </div>
        <div class="form-group">
    <div class="col-md-4">
            {{Form::submit('Guardar', array('class' => 'btn btn-warning'))}}
                </div>
</div>
{{ Form::close() }}
</div> <!-- del panel body -->
@stop