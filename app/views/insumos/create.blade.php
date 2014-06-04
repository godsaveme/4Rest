@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')

        <a href="{{URL('insumos')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> CREAR INSUMO
</strong></div>

<div class="panel-body">
        {{ Form::open(array('id'=>'form_resto','url' => 'insumos/store', 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal')) }}
  <div class="form-group">
    <div class="col-md-3">
            {{Form::label('nombre', 'Nombre', array('class'=>'control-label'))}}
            </div>
    <div class="col-md-5">
            {{Form::text('nombre', '', array('class' => 'form-control','placeholder'=>'ej. Azúcar','autofocus', 'required', 'validationMessage'=>'Por favor entre un nombre.'))}}
            </div>
        </div>
<div class="form-group">
    <div class="col-md-3">
            {{Form::label('descripcion', 'Descripcion',array('class'=>'control-label'))}}
                </div>
    <div class="col-md-5">
            {{Form::text('descripcion', '', array('class' => 'form-control','placeholder'=>'ej. Azucar rubia de Pomalca.', 'required', 'validationMessage'=>'Por favor entre una descripción.'))}} 
            </div>
        </div>
<div class="form-group">
    <div class="col-md-3">
                {{Form::label('costo', 'Costo S/ #.##',array('class'=>'control-label'))}}            
                {{Form::text('costo', '', array('class' => 'form-control','placeholder'=>'#.##', 'required', 'validationMessage'=>'Por favor entre un precio.') )}}
            </div>
            <div class="col-md-4">
                {{Form::label('stock', 'Stock', array('class'=>'control-label'))}}
                {{Form::text('stock', '',array('class' => 'form-control'))}}
            </div>

          <div class="col-md-2">
            {{Form::label('stockMin', 'Stock Min', array('class'=>'control-label'))}}
            {{Form::text('stockMin', '', array('class' => 'form-control','placeholder'=>'#.##','min'=>'0'))}}
          </div>
          <div class="col-md-2">
            {{Form::label('stockMax', 'Stock Max', array('class'=>'control-label'))}}
            {{Form::text('stockMax', '', array('class' => 'form-control','placeholder'=>'#.##','min'=>'0'))}}
          </div>
          <div class="col-md-1">
            &nbsp;
          </div>


        </div>
        <div class="form-group">
                        <div class="col-md-4">
            {{Form::label('Unidades', 'Unidades', array('class'=>'control-label'))}}
                {{Form::select('unidadMedida', array('Unidades' => 'Unidades', 'Kilogramos' => 'Kilogramos', 'Litros' => 'Litros'), '', array('class' => 'form-control'))}}  
            </div>
            <div class="col-md-4">
            {{Form::label('tipoins', 'Tipo de Insumo', array('class' => 'control-label'))}}
                {{Form::select('tipoins_id',$tipoins, '', array('class' => 'form-control'))}}
            </div>
            <div class="col-md-4">
                {{Form::label('estado','estado',array('class' => 'control-label'))}}
                {{Form::select('estado',array('1' => 'Activo', '0' => 'Inactivo'),1, array('class' => 'form-control'))}}
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