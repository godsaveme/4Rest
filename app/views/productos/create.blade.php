@extends('layouts.master')
 

@section('content')
  @parent
@stop 
@section('sub-content')


        
        <a href="{{URL('productos')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> CREAR PRODUCTO
</strong></div>

<div class="panel-body">
        {{ Form::open(array('id'=>'form_resto','url' => 'productos/create', 'enctype' => 'multipart/form-data', 'class'=>'form-horizontal')) }}
        <fieldset>
  <legend></legend>
          <div class="form-group">
                <div class="col-md-3">
            {{Form::label('nombre', 'Nombre', array('class'=>'control-label'))}}
              </div>
              <div class="col-md-9">
              {{Form::text('nombre', '', array('class' => 'form-control','placeholder'=>'ej. Pie de Limón', 'required', 'autofocus', 'validationMessage'=>'Por favor entre un nombre '))}}
              </div>
          </div>

          <div class="form-group">
                  <div class="col-md-3">
            {{Form::label('descripcion', 'Descripción', array('class'=>'control-label'))}}
                             </div>
              <div class="col-md-9">
            {{Form::text('descripcion', '', array('class' => 'form-control','placeholder'=>'Producto nuevo a la fecha.', 'required', 'validationMessage'=>'Por favor entre una descripción '))}}
          </div>
        </div>

          <div class="form-group">
                    <div class="col-md-3">

                    {{Form::label('precio', 'Precio', array('class'=>'control-label'))}}

          </div>
          <div class="col-md-4">
            {{Form::text('precio', '', array('class' => 'form-control', 'placeholder'=>'#.##', '', 'validationMessage'=>'Por favor entre un precio.',  'min'=>'0', 'required'))}}
          </div>



        </div>

        <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">

            <label> {{Form::checkbox('havePrice', '', true,array('id' => 'havePrice'))}} Habilitar precio </label>
            <p class="text-warning"> El precio se habilita para que el producto aparezca en la Carta de 4Rest. <br>
            Si desactiva el precio, el producto solamente se podrá utilizar para hacer combinaciones .
             </p>
          </div>
        </div>
      <div class="form-group">
                    <div class="col-md-3">
          {{Form::label('estado', 'Estado', array('class'=>'control-label'))}} 
          {{Form::select('estado', array(1=>'Activo', 0=>'Inactivo'),1, array('class' => 'form-control'))}}
        </div>
        <div class="col-md-3">
        {{Form::label(' id_tipoarepro', 'Area de Producción', array('class'=>'control-label'))}}
        {{Form::select('  id_tipoarepro', $tipoarea,'', array('class' => 'form-control'))}}
        </div>
        <div class="col-md-3">
          {{Form::label('familia_id', 'Familia', array('class'=>'control-label'))}}
          <select name="familia_id" id="" class='form-control'>
            @foreach ($familias as $dato) {
              <option value=" {{$dato->id}} "> {{$dato->nombre}}</option>
            }
            @endforeach
          </select>
        </div>
        <div class="col-md-3">

                      {{Form::label('unidadMedida', 'Unidad Medida', array('class'=>'control-label'))}}
              {{Form::select('unidadMedida', array('Unidades' => 'Unidades', 'Kilogramos' => 'Kilogramos', 'Litros' => 'Litros'),'', array('class' => 'form-control'))}}

      </div>

    </div>

    <div class="form-group">
        <div class="col-md-3">
          {{Form::label('proveedor_id', 'Proveedor', array('class'=>'control-label'))}} 
          {{Form::select('proveedor_id', $areas + array(0=>'Ninguna'),0, array('class' => 'form-control'))}}
        </div>
    </div>

    <div class="form-group">
              <div class="col-md-4">
        {{Form::submit('Guardar',array('class' => 'btn btn-warning'))}}
      </div>
    </div>

</fieldset>
        {{ Form::close() }}
        </div> <!-- del panel body -->

        <script type="text/javascript">

        $(document).ready(function($) {

          var precio = $("#precio").data("kendoNumericTextBox");


          var $checked;


          $('body').on('click', '#havePrice', function(event) {
            
            $checked = $('#havePrice').prop('checked');
              if ($checked) {
                  precio.enable(true);
                  
              }else{
                  precio.enable(false);

              };
            
          });

          });
        </script>
@stop