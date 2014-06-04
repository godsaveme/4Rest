@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')

        <a href="{{URL('combinacions')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> CREAR COMBINACIÓN
</strong></div>

<div class="panel-body">
{{Form::open(array('id'=>'form_resto','url'=>'combinacions/store', 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal'))}}
<fieldset>
	<legend></legend>
  <div class="form-group">
    <div class="col-md-3">
			{{Form::label('nombre', 'Nombre',array('class'=>'control-label'))}}
			    </div>
    <div class="col-md-5">
			{{Form::input('text', 'nombre', '', array('class'=>'form-control','placeholder'=>'ej. Desayuno Oriental','autofocus', 'required', 'validationMessage'=>'Por favor entre un nombre.'))}}
		</div>
	</div>

  <div class="form-group">
    <div class="col-md-3">
			{{Form::label('descripcion', 'Descripcion',array('class'=>'control-label'))}}
						    </div>
    <div class="col-md-5">
			{{Form::input('text', 'descripcion', '', array('class'=>'form-control','placeholder'=>'ej. Desayuno al estilo oriental', 'required', 'validationMessage'=>'Por favor entre una descripción.'))}}
		</div>
	</div>

  <div class="form-group">
    <div class="col-md-4">
    {{Form::label('lblTipoComb', 'Tipo de Combinación',array('class'=>'control-label'))}}
			<select name="TipoComb_id" id="TipoComb_id" class="form-control">
				<option value=""> Elija el tipo de Combinacion</option>
				@foreach ($tipodecombinacion as $dato) {
				<option value=" {{$dato->id}} "> {{$dato->nombre}}</option>
				}
				@endforeach
			</select>
		</div>
		<div class="col-md-3">
		{{Form::label('HoraInicio', 'Hora Inicio',array('class'=>'control-label'))}}
			{{Form::input('text', 'HoraInicio', '', array('id'=>'HoraInicio','class'=>'form-control'))}}
		</div>
		<div class="col-md-3">
		{{Form::label('HoraTermino', 'Hora Termino',array('class'=>'control-label'))}}
			{{Form::input('text', 'HoraTermino', '', array('id'=>'HoraTermino','class'=>'form-control'))}}
		</div>
	</div>
    <div class="form-group">
    <div class="col-md-4">
	  	{{Form::label('FechaInicio', 'Fecha Inicio',array('class'=>'control-label'))}}
	  	{{Form::input('text', 'FechaInicio', '', array('id'=>'FechaInicio','class'=>'form-control'))}}
	  </div>
	  <div class="col-md-4">
	  	{{Form::label('FechaTermino', 'Fecha Termino',array('class'=>'control-label'))}}
	  	{{Form::input('text', 'FechaTermino', '', array('id'=>'FechaTermino','class'=>'form-control'))}}
	  </div>
	</div>
	<div class="form-group">
	  <div class="col-md-2">
	  	{{Form::label('b_produc', 'Productos',array('class'=>'control-label'))}}
	  </div>
	  <div class="col-md-10">
	  	{{Form::hidden('contador', '', array('id'=>'containgre'))}}
	  	{{Form::input('text', 'b_produc', '', array('id'=>'b_produc', 'placeholder' => 'Buscar Productos....','class'=>'form-control'))}}
	  </div>
	</div>

	<div id="lista_proc">
	<div class="form-group">
	  <div class="col-md-12">
                <ul class="pricing-table" id="lista_productosc">
                	{{Form::hidden('flag_pro', '', array('id'=>'flag_pro'))}}	
                  <li class="title">Lista de Productos</li>
                </ul> 
              </div>
        </div>
	</div>

	<div class="form-group">
	  <div class="col-md-4">
	  	{{Form::submit('Guardar', array('class' => 'btn btn-warning'))}}
	  </div>
	</div>

</fieldset>
{{Form::close()}}
</div> <!-- del panel body -->
@stop