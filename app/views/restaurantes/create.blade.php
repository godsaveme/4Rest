@extends('layouts.master')
 
@section('content')
  @parent
@stop 
@section('sub-content')

        <a href="{{URL('restaurantes')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


@if (!isset($restaurante)) 

<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> CREAR RESTAURANTE (Sucursal)
</strong></div>

<div class="panel-body">

        {{ Form::open(array('id'=>'form_resto','url' => 'restaurantes/store' , 'enctype' => 'multipart/form-data', 'class'=>'form-horizontal')) }}
        <fieldset>
            <legend>Datos Generales</legend>
          <div class="form-group">
                <div class="col-md-3">
              {{Form::label('nombreComercial', 'Nombre Comercial', array('class'=>'control-label'))}}
              </div>
              <div class="col-md-9">
              {{Form::text('nombreComercial', '', array('class' => 'form-control','placeholder'=>'ej. K & C International SAC', 'required', 'autofocus', 'validationMessage'=>'Por favor entre un nombre '))}}
              </div>
          </div>

          <div class="form-group">
                  <div class="col-md-3">
                {{Form::label('razonSocial', 'Razón Social', array('class'=>'control-label'))}}
                 </div>
              <div class="col-md-9">
                {{Form::text('razonSocial', '', array('class' => 'form-control','placeholder'=>'Kango Heladerías', 'required', 'validationMessage'=>'Por favor entre una Razón Social '))}}
              </div>
            </div>

          <div class="form-group">
                    <div class="col-md-8">
                  {{Form::label('direccion', 'Dirección', array('class'=>'control-label'))}}
                  {{Form::text('direccion', '', array('class' => 'form-control','placeholder'=>'ej. las begonias 132', 'required', 'validationMessage'=>'Por favor entre una dirección '))}}
                </div>
                <div class="col-md-4">
                  {{Form::label('txtRuc', 'RUC', array('class'=>'control-label'))}}
                  {{Form::text('ruc', '', array('id'=>'txtRuc','class' => 'form-control','placeholder'=>'11 dígitos.', 'required' , 'validationMessage'=>'Número de RUC incompleto (11 dígitos)', 'pattern'=>'[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]'))}}
                </div>
          </div>
          <div class="form-group">
                    <div class="col-md-2">
                  {{Form::label('serie', 'Serie', array('class'=>'control-label'))}}
                  {{Form::text('serie', '', array('id'=>'txtSerie','class' => 'form-control','placeholder'=>'ej. BKF-5351','required', 'validationMessage'=>'Por favor entre una Serie. '))}}
                </div>
                <div class="col-md-4">
                  {{Form::label('numerodeticket', 'Número de Ticket', array('class'=>'control-label'))}}
                  {{Form::text('numerodeticket', '', array('id'=>'txtNumSerie','class' => 'form-control','placeholder'=>'8 dígitos','required', 'validationMessage'=>'Por favor entre un número de Ticket. (8 dígitos)', 'pattern'=>'[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]'))}}
                </div>
                 <div class="col-md-6">
                  &nbsp;
                </div>
          </div>
          </fieldset>
            <fieldset>
            <legend>Ubicación</legend>
          <div class="form-group">
              <div class="col-md-4">
                {{Form::label('ciudad', 'Ciudad', array('class'=>'control-label'))}}
                {{Form::text('provincia', '', array('class' => 'form-control','placeholder'=>'Chiclayo'))}}
              </div>

                        <div class="col-md-4">
                {{Form::label('departamento', 'Departamento', array('class'=>'control-label'))}}
                {{Form::text('departamento', '', array('class' => 'form-control','placeholder'=>'Lambayeque'))}}
              </div>

                        <div class="col-md-4">
                {{Form::label('pais', 'País', array('class'=>'control-label'))}}
                {{Form::text('pais', '', array('class' => 'form-control','placeholder'=>'Perú'))}}
              </div>

          </div>
        </fieldset>
          <fieldset>
            <legend>Teléfonos</legend>
                    <div class="row">
          <div class="col-md-4">
            {{Form::label('telefono', 'Teléfono Fijo', array('class'=>'control-label'))}}
            {{Form::text('tel', '', array('id'=>'txtTel','class' => 'form-control','placeholder'=>'Sólo dígitos','pattern'=>'[0-9]+', 'validationMessage'=>'Por favor entre un número de Teléfono válido'))}}
          </div>

                    <div class="col-md-4">
            {{Form::label('celular', 'Celular', array('class'=>'control-label'))}}
            {{Form::text('cel', '', array('id'=>'txtCell','class' => 'form-control','placeholder'=>'Sólo dígitos','pattern'=>'[0-9]+', 'validationMessage'=>'Por favor entre un número de Celular válido'))}}
          </div>

                    <div class="col-md-4">
            {{Form::label('fax', 'Fax', array('class'=>'control-label'))}}
            {{Form::text('fax', '', array('id'=>'txtFax','class' => 'form-control','placeholder'=>'Sólo dígitos','pattern'=>'[0-9]+', 'validationMessage'=>'Por favor entre un número de Fax válido'))}}
          </div>
          
          </div>
          </fieldset>
          <div class="form-group">
            <div class="col-md-12">
              {{Form::label('comentarios','Comentarios', array('class'=>'control-label'))}}
              {{Form::textarea('comentarios' , '', array('class' => 'form-control','placeholder'=>'...'))}}  

            </div>

            </div>
            <div class="form-group">
              <div class="col-md-8">
            {{ Form::file('imagen') }}
          </div>

               </div>   
               <div class="form-group">
               <div class="col-md-8">
                 <p class="text-muted">Válido solamente formato de imágenes.</p>
                 </div>
               </div>
              <div class="form-group">
              <div class="col-md-4">
            {{Form::submit('Guardar' , array('class' => 'btn btn-warning'))}}
            </div>
            </div>
        {{ Form::close() }}

</div> <!-- del panel body -->

@else
<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> EDITAR RESTAURANTE (Sucursal)
</strong></div>

<div class="panel-body">

      {{ Form::open(array('id'=>'form_resto','url' => 'restaurantes/update/'.$restaurante->id , 'enctype' => 'multipart/form-data', 'class'=>'form-horizontal')) }}
         <fieldset>
            <legend>Datos Generales</legend>
          <div class="form-group">
                <div class="col-md-3">
              {{Form::label('nombreComercial', 'Nombre Comercial', array('class'=>'control-label'))}}
              </div>
              <div class="col-md-9">
              {{Form::text('nombreComercial', $restaurante->nombreComercial, array('class' => 'form-control','placeholder'=>'ej. K & C International SAC', 'required', 'autofocus', 'validationMessage'=>'Por favor entre un nombre '))}}
              </div>
          </div>

          <div class="form-group">
                  <div class="col-md-3">
                {{Form::label('razonSocial', 'Razón Social', array('class'=>'control-label'))}}
                 </div>
              <div class="col-md-9">
                {{Form::text('razonSocial', $restaurante->razonSocial, array('class' => 'form-control','placeholder'=>'Kango Heladerías', 'required', 'validationMessage'=>'Por favor entre una Razón Social '))}}
              </div>
            </div>

          <div class="form-group">
                    <div class="col-md-8">
                  {{Form::label('direccion', 'Dirección', array('class'=>'control-label'))}}
                  {{Form::text('direccion', $restaurante->direccion, array('class' => 'form-control','placeholder'=>'ej. las begonias 132', 'required', 'validationMessage'=>'Por favor entre una dirección '))}}
                </div>
                <div class="col-md-4">
                  {{Form::label('ruc', 'RUC', array('class'=>'control-label'))}}
                  {{Form::text('ruc', $restaurante->ruc, array('id'=>'txtRuc','class' => 'form-control','placeholder'=>'11 dígitos.', 'required' , 'validationMessage'=>'Número de RUC incompleto (11 dígitos)', 'pattern'=>'[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]'))}}
                </div>
          </div>
          <div class="form-group">
                    <div class="col-md-2">
                  {{Form::label('serie', 'Serie', array('class'=>'control-label'))}}
                  {{Form::text('serie', $restaurante->serie, array('id'=>'txtSerie','class' => 'form-control','placeholder'=>'ej. BKF-5351','required', 'validationMessage'=>'Por favor entre una Serie. '))}}
                </div>
                <div class="col-md-4">
                  {{Form::label('numerodeticket', 'Número de Ticket', array('class'=>'control-label'))}}
                  {{Form::text('numerodeticket', $restaurante->numerodeticket, array('id'=>'txtNumSerie','class' => 'form-control','placeholder'=>'8 dígitos','required', 'validationMessage'=>'Por favor entre un número de Ticket. (8 dígitos)', 'pattern'=>'[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]'))}}
                </div>
                 <div class="col-md-6">
                  &nbsp;
                </div>
          </div>
          </fieldset>
            <fieldset>
            <legend>Ubicación</legend>
          <div class="form-group">
              <div class="col-md-4">
                {{Form::label('ciudad', 'Ciudad', array('class'=>'control-label'))}}
                {{Form::text('provincia', $restaurante->provincia, array('class' => 'form-control','placeholder'=>'Chiclayo'))}}
              </div>

                        <div class="col-md-4">
                {{Form::label('departamento', 'Departamento', array('class'=>'control-label'))}}
                {{Form::text('departamento', $restaurante->departamento, array('class' => 'form-control','placeholder'=>'Lambayeque'))}}
              </div>

                        <div class="col-md-4">
                {{Form::label('pais', 'País', array('class'=>'control-label'))}}
                {{Form::text('pais', $restaurante->pais, array('class' => 'form-control','placeholder'=>'Perú'))}}
              </div>

          </div>
        </fieldset>
          <fieldset>
            <legend>Teléfonos</legend>
                    <div class="row">
          <div class="col-md-4">
            {{Form::label('telefono', 'Teléfono Fijo', array('class'=>'control-label'))}}
            {{Form::text('tel', $restaurante->tel, array('id'=>'txtTel','class' => 'form-control','placeholder'=>'Sólo dígitos','pattern'=>'[0-9]+', 'validationMessage'=>'Por favor entre un número de Teléfono válido'))}}
          </div>

                    <div class="col-md-4">
            {{Form::label('celular', 'Celular', array('class'=>'control-label'))}}
            {{Form::text('cel', $restaurante->cel, array('id'=>'txtCell','class' => 'form-control','placeholder'=>'Sólo dígitos','pattern'=>'[0-9]+', 'validationMessage'=>'Por favor entre un número de Celular válido'))}}
          </div>

                    <div class="col-md-4">
            {{Form::label('fax', 'Fax', array('class'=>'control-label'))}}
            {{Form::text('fax', $restaurante->fax, array('id'=>'txtFax','class' => 'form-control','placeholder'=>'Sólo dígitos','pattern'=>'[0-9]+', 'validationMessage'=>'Por favor entre un número de Fax válido'))}}
          </div>
          
          </div>
          </fieldset>
          <div class="form-group">
            <div class="col-md-12">
              {{Form::label('comentarios','Comentarios', array('class'=>'control-label'))}}
              {{Form::textarea('comentarios' , $restaurante->comentarios, array('class' => 'form-control','placeholder'=>'...'))}}  

            </div>

            </div>
            <div class="form-group">
              <div class="col-md-8">
            {{ Form::file('imagen') }}
          </div>

               </div>   
               <div class="form-group">
               <div class="col-md-8">
                 <p class="text-muted">Válido solamente formato de imágenes.</p>
                 </div>
               </div>
               <div class="form-group">
              <div class="col-md-4">
            {{Form::submit('Modificar' , array('class' => 'btn btn-warning'))}}
            </div>
            </div>
        {{ Form::close() }}
  
</div> <!-- del panel body -->

@endif



@stop