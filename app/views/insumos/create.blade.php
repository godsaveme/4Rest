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
            {{Form::text('nombre', '', array('style'=>'width:250px','placeholder'=>'ej. Azúcar','autofocus', 'required', 'validationMessage'=>'Por favor entre un nombre.', 'id'=>'insumo'))}}
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
            <div class="col-md-4">
            {{Form::label('Unidades', 'Unidades', array('class'=>'control-label'))}}
                {{Form::select('unidadMedida', array('Unidades' => 'Unidades', 'Kilogramos' => 'Kilogramos', 'Litros' => 'Litros'), '', array('class' => 'form-control'))}}  
            </div>
            <div class="col-md-4">
                {{Form::label('estado','Estado',array('class' => 'control-label'))}}
                {{Form::select('estado',array('1' => 'Activo', '0' => 'Inactivo'),1, array('class' => 'form-control'))}}
            </div>
            <div class="col-md-4">
                {{Form::label('ultimocosto','Ultimo Costo',array('class' => 'control-label'))}}<br>
                {{Form::text('ultimocosto', '', array('class' => '','placeholder'=>'0.00', 'required', 'validationMessage'=>'Por favor ingrese ultimo costo.'))}}
            </div>
        </div>
        <div class="form-group">
    <div class="col-md-4">
            {{Form::submit('Guardar', array('class' => 'btn btn-warning'))}}
                </div>
</div>
{{ Form::close() }}
</div> <!-- del panel body -->

<script>
    $("#insumo").kendoAutoComplete({
                        dataTextField: "nombre",
                        filter: "contains",
                        minLength: 2,
                        dataSource: {
                            type: "json",
                            serverFiltering: true,
                            transport: {
                                read: "/bus_insumo_"
                            }
                        },
                        height:200
    });
</script>
@stop