@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')

        <a href="{{URL('mesas')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


@if (!isset($mesa)) 

<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> CREAR MESA
</strong></div>

<div class="panel-body">

{{ Form::open(array('id'=>'form_resto', 'url' => 'mesas/store' , 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal')) }}
<fieldset>
  <legend></legend>

  <div class="form-group">
   <div class="col-md-3">

    {{Form::label('nombre', 'Nombre', array('class'=>'control-label'))}}
</div>
<div class="col-md-5">
    {{Form::text('nombre', '', array('class' => 'form-control','placeholder'=>'ej. Mesa 01', 'required', 'validationMessage'=>'Por favor entre un nombre.'))}}
</div>
</div>
<div class="form-group">
    <div class="col-md-3">
        {{Form::label('descripcion', 'Descripcion', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
        {{Form::text('descripcion', '', array('class' => 'form-control','placeholder'=>'ej. Mesa en buenas condiciones.', 'required', 'validationMessage'=>'Por favor entre una descripción.'))}}

    </div>

</div>

<div class="form-group">
    <div class="col-md-3">
        {{Form::label('salones', 'Salones', array('class'=>'control-label'))}}
    </div>

    <div class="col-md-5">
        {{Form::select('salon_id', $salones,'', array('class' => 'form-control'))}}
    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
        {{Form::label('Habilitado', 'Habilitado', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
        <div class="radio">
            <label>
                {{Form::radio('habilitado',1,true)}}Sí
            </label>
        </div>
        <div class="radio">
            <label>
                {{Form::radio('habilitado',0)}}No
            </label>
        </div>

    </div>

</div>

<div class="form-group">
    <div class="col-md-3">
        {{Form::label('mesa', 'Código', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-7">
        <div class="input-group">
          <span class="input-group-addon">http://192.168.1.247/dev/clientes/</span>
          <input type="text" name="mesa" class="form-control" placeholder="Código" id="input_codigo">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button" id="btn_generarqr">Generar</button>
          </span>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-md-offset-4" id="imagencodigoqr">
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-md-offset-1">
        <a href="#" download="quiquesiervos.pdf" class="btn btn-default" type="button" id="btn_imagenqr"
        style="display:none">Guardar Imagen</a>
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

@else
<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> EDITAR MESA
</strong></div>

<div class="panel-body">
{{ Form::open(array('id'=>'form_resto','url' => 'mesas/update/'.$mesa->id , 'enctype' => 'multipart/form-data', 'class'=>'form-horizontal')) }}
<fieldset>
  <legend></legend>
  <div class="form-group">
   <div class="col-md-3">

    {{Form::label('nombre', 'Nombre', array('class'=>'control-label'))}}
</div>
<div class="col-md-5">
    {{Form::text('nombre', $mesa->nombre, array('class' => 'form-control','placeholder'=>'ej. Mesa 01', 'required', 'validationMessage'=>'Por favor entre un nombre.'))}}
</div>
</div>
<div class="form-group">
    <div class="col-md-3">
        {{Form::label('descripcion', 'Descripcion', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
        {{Form::text('descripcion', $mesa->descripcion, array('class' => 'form-control','placeholder'=>'ej. Mesa en buenas condiciones.', 'required', 'validationMessage'=>'Por favor entre una descripción.'))}}

    </div>

</div>

<div class="form-group">
    <div class="col-md-3">
        {{Form::label('salones', 'Salones', array('class'=>'control-label'))}}
    </div>

    <div class="col-md-5">
        {{Form::select('salon_id', $salones, $mesa->salon_id, array('class' => 'form-control'))}}
    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
        {{Form::label('Habilitado', 'Habilitado')}}
    </div>
    <div class="col-md-5">
        @if($mesa->habilitado==1)
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
    <div class="col-md-3">
        {{Form::label('mesa', 'Código', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-7">
        <div class="input-group">
          <span class="input-group-addon">http://192.168.1.247/dev/clientes/</span>
          <input type="text" name="mesa" class="form-control" value="{{$mesa->mesa}}" placeholder="Código" id="input_codigo">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button" id="btn_generarqr">Generar</button>
          </span>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-md-offset-4" id="imagencodigoqr">
        @if (isset($codigo))
            {{$qrcode}}
        @endif
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-md-offset-1">
        <a href="{{URL::to('/imagesqr/'.$nombrepng)}}" download="{{$nombrepng}}" class="btn btn-default" type="button" id="btn_imagenqr" @if (!isset($codigo)) style="display:none" @endif>Guardar Imagen</a>
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
