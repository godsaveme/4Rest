@extends('layouts.master')
@section('css')
    <link href="/css/fileinput/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
@stop

@section('js')
    <script src="/js/fileinput/fileinput.min.js"></script>
    <script src="/js/fileinput/fileinput_locale_es.js"></script>
@stop

@section('content')
  @parent
@stop 
@section('sub-content')


        
        <a href="{{URL('productos')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> MODIFICAR PRODUCTO
</strong></div>

<div class="panel-body">
        {{ Form::open(array('id'=>'','url' => 'productos/edit', 'enctype' => 'multipart/form-data', 'class'=>'form-horizontal','files' =>true)) }}
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
         <div class="col-md-4">
             {{Form::label('checkImage','Cambiar Imagen de Producto',array('class'=>'control-label'))}}
             {{Form::checkbox('checkImage','Cambiar imagen',false,array('class' =>''))}}
             {{Form::file('imagen',array('accept' =>'image/*','name' => 'imagen','class'=>'file','id'=>'imagen','disabled'))}}



         </div>
    </div>


    <div class="form-group">
            <div class="col-md-5">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-info">
                    <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          Atributos
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                              <div class="checkbox" style="border-bottom: 1px dotted #e7e7e7; padding-bottom: 10px; margin-bottom: 5px;">
                                  <label>
                                    <input type="checkbox" id="prodAttr"> Este producto tiene atributos
                                  </label>
                                  </div>
                                  <div id="aparProdAttr">
                                  <div class="col-md-6">
                                    Atributo:

                                  <select class="form-control" id="prodAttrSend" name="prodAttrSend" disabled required>
                                    <option value="0">-</option>
                                    <option value="sabores">Sabores</option>
                                  </select>
                                  </div>
                                        <div class="col-md-6">
                                      <label for="cantDef" >Cantidad por defecto:</label>
                                       {{Form::text('cantdef', $producto->cantidadsabores, array('class' => '', 'placeholder'=>'#.##','required', 'validationMessage'=>'Requerido',  'min'=>'1', 'id' => 'cantdef','disabled'))}}
                                        </div>
                                        </div>

                        </div>
                    </div>
                  </div>
                </div>

            </div>
            <div class="col-md-6 col-md-offset-1">
            {{Form::label('imgprod', 'Imagen Actual del Producto', array('class'=>'control-label'))}}<br><br>
                {{HTML::image($producto->imagen,'Imagen del Producto',array('class' => 'img-responsive img-thumbnail'))}}
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


                                    var cantdef = $("#cantdef").data("kendoNumericTextBox");
                                                                if (cantdef.value() != null) {
                                                                            $('#collapseOne').addClass('in');
                                                                            cantdef.enable(true);
                                                                            $('#prodAttrSend').removeAttr('disabled','disabled');
                                                                            $('#prodAttrSend').val('sabores');
                                                                            $('#prodAttr').prop('checked',true);
                                                                          } else{
                                                                            cantdef.enable(false);
                                                                            $('#prodAttrSend').attr('disabled','disabled');
                                                                            $('#prodAttr').prop('checked',false);
                                                                          };


                                                            var $checked3;


                                                            $('body').on('change', '#prodAttr', function(event) {

                                                              $checked3 = $(this).is( ":checked" );
                                                                if ($checked3) {
                                                                    $('#prodAttrSend').removeAttr('disabled');
                                                                    cantdef.enable(true);

                                                                }else{
                                                                    $('#prodAttrSend').attr('disabled','disabled');
                                                                    cantdef.enable(false);
                                                                };

                                                            });


          });
        </script>

        <script>

        $(document).ready(function(){



        $("#imagen").fileinput({


            maxFileSize: 500

        });

            $('body').on('change', '#checkImage', function(event) {
                                                                          $checked5 = $(this).is( ":checked" );
                                                                          //alert($checked5);
                                                                            if (!$checked5) {

                                                                            $('#imagen').attr('disabled', 'disabled');
                                                                            $('#imagen').fileinput('refresh');

                                                                            }else{
                                                                                $("#imagen").fileinput("enable");
                                                                                $('#imagen').fileinput('refresh');

                                                                            };

                                                                        });

                                                                      })
        </script>

@stop
