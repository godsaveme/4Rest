@extends('layouts.master')
 

@section('content')
  @parent
@stop 
@section('sub-content')


        
        <a href="{{URL('productos')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> MODIFICAR PRODUCTO
</strong></div>

<div class="panel-body">
        {{ Form::open(array('id'=>'form_resto','url' => 'productos/edit', 'enctype' => 'multipart/form-data', 'class'=>'form-horizontal')) }}
        <fieldset>
  <legend></legend>
        
                
          {{Form::hidden('id', $producto->id)}}
          
              <div class="form-group">
                <div class="col-md-3">
            {{Form::label('nombre', 'Nombre', array('class'=>'control-label'))}}
              </div>
              <div class="col-md-9">
              {{Form::text('nombre', $producto->nombre, array('class' => 'form-control','placeholder'=>'ej. Pie de Limón', 'required', 'autofocus', 'validationMessage'=>'Por favor entre un nombre '))}}
              </div>
          </div>

          <div class="form-group">
                  <div class="col-md-3">
            {{Form::label('descripcion', 'Descripción', array('class'=>'control-label'))}}
                             </div>
              <div class="col-md-9">
            {{Form::text('descripcion', $producto->descripcion, array('class' => 'form-control','placeholder'=>'Producto nuevo a la fecha.', 'required', 'validationMessage'=>'Por favor entre una descripción '))}}
          </div>
        </div>

          <div class="form-group">
                    <div class="col-md-3">

                    {{Form::label('precio', 'Precio', array('class'=>'control-label'))}}

          </div>
          <div class="col-md-4">
          <?php 
          $price = '';
          if (!empty($precio->precio)) {
            $price_ = $precio->precio;
          } else{
              $price_ = '' ;
            } ?>
            {{Form::text('precio', $price_, array('class' => '', 'placeholder'=>'#.##', '', 'validationMessage'=>'Por favor entre un precio.',  'min'=>'0', 'required'))}}
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
        {{Form::select('estado', array(1=>'Activo', 0=>'Inactivo'),$producto->estado, array('class' => 'form-control'))}}
      </div>
      <div class="col-md-3">
      {{Form::label(' id_tipoarepro', 'Tipo de Área de Producción', array('class'=>'control-label'))}}
      {{Form::select('  id_tipoarepro', $tipoarea,$producto->id_tipoarepro, array('class' => 'form-control'))}}
      </div>
      <div class="col-md-3">
        {{Form::label('familia_id', 'Familia', array('class'=>'control-label'))}}
        <select name="familia_id" id="" class='form-control'>
          @foreach ($familias as $dato) 
            <option value=" {{$dato->id}} " @if($dato->id == $producto->familia_id) selected @endif > {{$dato->nombre}}</option>
          
          @endforeach
        </select>
      </div>
      <div class="col-md-3">

                    {{Form::label('unidadMedida', 'Unidad Medida', array('class'=>'control-label'))}}
            {{Form::select('unidadMedida', array('Unidades' => 'Unidades', 'Kilogramos' => 'Kilogramos', 'Litros' => 'Litros'),$producto->unidadMedida, array('class' => 'form-control'))}}

      </div>

    </div>

    <div class="form-group">
        <div class="col-md-3">
          {{Form::label('receta', 'Tipo', array('class'=>'control-label'))}} 
          {{Form::select('receta', array('0' => 'Sin Receta','1' => 'Con Receta'),$producto->receta, array('class' => 'form-control'))}}
        </div>
        <div class="col-md-3">

                    {{Form::label('costo', 'Costo', array('class'=>'control-label'))}}<br>

        
            {{Form::text('costo', $producto->costo, array('class' => '', 'placeholder'=>'#.##', '', 'validationMessage'=>'Por favor entre un costo.',  'min'=>'0', ''))}}
          </div>
    </div>



    <div class="form-group">
              <div class="col-md-4">
        {{Form::submit('Modificar',array('class' => 'btn btn-warning'))}}
      </div>
    </div>
</fieldset>
        {{ Form::close() }}
        </div> <!-- del panel body -->

        <script type="text/javascript">



        $(document).ready(function($) {

          var precio = $("#precio").data("kendoNumericTextBox");

          if (precio.value() != null) {
            precio.enable(true);
            $('#havePrice').prop('checked',true);
          } else{
            precio.enable(false);
            $('#havePrice').prop('checked',false);
          };

          var $checked;


          $('body').on('click', '#havePrice', function(event) {
            
            $checked = $('#havePrice').prop('checked');
              if ($checked) {
                  precio.enable(true);
                  
              }else{
                  precio.enable(false);

              };
            
          });


          var costo = $("#costo").data("kendoNumericTextBox");
          var receta = $("#receta").val();

                    if (receta == 0) {
                      costo.enable(true);
                      //$('#receta').prop('checked',true);
                    } else{
                      costo.enable(false);
                      //$('#havePrice').prop('checked',false);
                    };

                    var $xrec;

                    $('body').on('change', '#receta', function(event) {

                        $xrec = $(this).val();
                        //alert($xrec);
                        if ($xrec == 0) {
                            costo.enable(true);

                        }else{
                            costo.enable(false);

                        };

                    });


          });
        </script>
@stop
