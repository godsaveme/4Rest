@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')

        <a href="{{URL('combinacions')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> EDITAR COMBINACIÓN
</strong></div>

<div id="dialog">
<form id="xFg" action="#">
  <p>Cantidad: <input id="cantidad" type="number" min="1" value="1" required>  </p>
  <p>Precio:  <input id="precioX" type="number" min="0" value="1" required> </p>
  <input type="submit" id="btnAsignar" value="Enviar" class="k-button"><input type="button" id="btnCancelar" value="Cancelar" class="k-button">
  </form>
</div>

<div class="panel-body">
{{Form::open(array('id'=>'form_resto','url'=>'/combinacions/update', 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal'))}}
<fieldset>
	<legend></legend>
  <div class="form-group">
    <div class="col-md-3">
    {{Form::hidden('id',$combinacion->id)}}
			{{Form::label('nombre', 'Nombre',array('class'=>'control-label'))}}
			    </div>
    <div class="col-md-5">
			{{Form::input('text', 'nombre', $combinacion->nombre, array('class'=>'form-control','placeholder'=>'ej. Desayuno Oriental','autofocus', 'required', 'validationMessage'=>'Por favor entre un nombre.'))}}
		</div>
	</div>

  <div class="form-group">
    <div class="col-md-3">
			{{Form::label('descripcion', 'Descripcion',array('class'=>'control-label'))}}
						    </div>
    <div class="col-md-5">
			{{Form::input('text', 'descripcion', $combinacion->descripcion, array('class'=>'form-control','placeholder'=>'ej. Desayuno al estilo oriental', 'required', 'validationMessage'=>'Por favor entre una descripción.'))}}
		</div>
	</div>

		  <div class="form-group">
    <div class="col-md-3">
			{{Form::label('precio', 'Precio',array('class'=>'control-label'))}}
						    </div>
    <div class="col-md-5">
			{{Form::input('text', 'precio', $combinacion->precio, array('class'=>'','placeholder'=>'##.##', 'required', 'validationMessage'=>'Por favor entre un precio', 'min' => '0'))}}
		</div>
	</div>

  <div class="form-group">
    <div class="col-md-3">
    {{Form::label('lblTipoComb', 'Tipo de Combinación',array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
    {{Form::select('TipoComb_id', $tipodecombinacion, $combinacion->TipoComb_id, array('class' => 'form-control'))}}

	</div>
	</div>
    <div class="form-group">
    <div class="col-md-4">
	  	{{Form::label('FechaInicio', 'Fecha Inicio',array('class'=>'control-label'))}}
	  	{{Form::input('text', 'FechaInicio', $combinacion->horcomb->FechaInicio, array('id'=>'FechaInicio','class'=>'form-control'))}}
	  </div>
	  <div class="col-md-4">
	  	{{Form::label('FechaTermino', 'Fecha Termino',array('class'=>'control-label'))}}
	  	{{Form::input('text', 'FechaTermino', $combinacion->horcomb->FechaTermino, array('id'=>'FechaTermino','class'=>'form-control'))}}
	  </div>
	</div>

		<div class="form-group">
	  <div class="col-md-3">
	  	{{Form::label('slctDias', 'Seleccionar Días',array('class'=>'control-label'))}} 
	  	
	  </div>
	  <div class="col-md-9">
	  <?php   //$horcomb = Horcomb::where('combinacion_id','=',$combinacion->id)->first(); 
	  	$arrDias;

	  	foreach ($combinacion->horcomb->dias as $x) {
	  		$arrDias[] = $x->valor;
	  	}
	  	
	  	if (!isset($arrDias)) {
	  		$arrDias[] = 0;
	  	}

	  	$check_flag = false;


	  ?>
	  <br>	  	
	  	<label>{{Form::checkbox('tdia', 1 , '',array('id' => 'tdia'))}} <strong>Todos los días </strong></label> <br>
		<?php  if (in_array(2, $arrDias)) { $check_flag =  true;}else{$check_flag =  false;} ?>
		<label>{{Form::checkbox('foobar2', 2,$check_flag ,array('id' => 'lun2'))}} Lunes </label>
		<?php  if (in_array(3, $arrDias)) { $check_flag =  true;}else{$check_flag =  false;} ?>
	  	<label>{{Form::checkbox('foobar3', 3, $check_flag,array('id' => 'mar3'))}} Martes </label>
	  	<?php  if (in_array(4, $arrDias)) { $check_flag =  true;}else{$check_flag =  false;} ?>
	  	<label>{{Form::checkbox('foobar4', 4, $check_flag,array('id' => 'mie4'))}} Miércoles </label>
	  	<?php  if (in_array(5, $arrDias)) { $check_flag =  true;}else{$check_flag =  false;} ?>
	  	<label>{{Form::checkbox('foobar5', 5, $check_flag,array('id' => 'jue5'))}} Jueves </label>
	  	<?php  if (in_array(6, $arrDias)) { $check_flag =  true;}else{$check_flag =  false;} ?>
	  	<label>{{Form::checkbox('foobar6', 6, $check_flag,array('id' => 'vie6'))}} Viernes </label>
	  	<?php  if (in_array(7, $arrDias)) { $check_flag =  true;}else{$check_flag =  false;} ?>
	  	<label>{{Form::checkbox('foobar7', 7, $check_flag,array('id' => 'sab7'))}} Sábado </label>
	  	<?php  if (in_array(1, $arrDias)) { $check_flag =  true;}else{$check_flag =  false;} ?>
	  	<label>{{Form::checkbox('foobar1', 1, $check_flag,array('id' => 'dom1'))}} Domingo </label> 


	  </div>
	</div>

	<div class="form-group">
		<div class="col-md-5">
			{{Form::label('productos', 'Seleccione Productos',array('class'=>'control-label'))}} 
		</div>
		<div class=" col-md-7">
			{{Form::input('text', 'txtProd', '', array('id' => 'txtProd', 'placeholder' => 'Productos..'))}}
		</div>
	</div>

	<div class="form-group">
	<div class="col-md-12 text-center "><strong>Cesta de Productos</strong></div>
</div>
	<div class="form-group">
		<div class="col-md-12">

 <script type="text/javascript">

$(document).ready(function($) {

//precio readonly se calcula por los grids
  $("#precio").data("kendoNumericTextBox").readonly();

                  $("#precioX").kendoNumericTextBox({
                        format: "c",
                        decimals: 3
                    });
                   $("#cantidad").kendoNumericTextBox({
                        format: "# Und."
                    });

                  var ntbprecio = $("#precioX").data("kendoNumericTextBox");
                  var ntbcantidad = $("#cantidad").data("kendoNumericTextBox");

 }); 

 var ds= new kendo.data.DataSource({
        data: {{$productos}},
        pageSize: 100,
        change: onChangeDs,
        group: { field: "familianombre", aggregates: [
                                        { field: "cantidad", aggregate: "average" },
                                        { field: "precio", aggregate: "average" }
                                        ]
                },
       // aggregate: [ { field: "familiaid", aggregate: "average" }],
                        
        schema: {
            model: {
                id: "id",
                fields: {
                    id: { type: "number", editable:false, nullable: false, validation:{required:true} },
                    nombre: { type: "string", editable: false },
                    descripcion: { type: "string" },                    
                    cantidad: {type: "number", validation: {min:1, required:true}},
                    precio: {type: "number", validation: {min:0, required:true}},
                    familiaid: {type: "number"},
                    familianombre: {type: "string"}
                }
            }
        }
 });

 function onChangeDs(e){
  //alert('entro');
  //ds.fetch(function(){


              //var data = this.data();
                var view = this.view();
              var $sumPrecio = 0;
              var sumCantidad;
              console.log($sumPrecio);
              if ( view.length > 0 ) {
                      for (var i = 0; i < view.length; i++) {
                        console.log(view[i].aggregates.precio.average);
                        $sumPrecio = $sumPrecio + + (view[i].aggregates.cantidad.average*view[i].aggregates.precio.average);
                        //sumCantidad += view[i].aggregates.precio.average;
                      };
            }
              var ntbprecioComb = $("#precio").data("kendoNumericTextBox");
              ntbprecioComb.value($sumPrecio.toFixed(2));
              console.log($sumPrecio);
           // });
 } 

 </script>

 <div id="gridProdComb"></div>
 <script>
 $(document).ready(function($) {
        $("#gridProdComb").kendoGrid({
    dataSource: ds,                            
    height: 525,
    groupable: {
    messages: {
      empty: "Agrupar jalando un campo aquí."
    }
  },
    sortable: true,
    //selectable: true,
    scrollable: true,
    sortable: true,
    //filterable: true,
    resizable: true,
    pageable: {
      refresh: true,
      pageSizes: true
    },
    columns: [
                            { field: "nombre", title: "Nombre Producto", groupable: false },
                            { field: "descripcion", title: "Descripción", groupable:false },
                            { field: "cantidad", title: "Cantidad", format: "{0:0.00}",width: "90px", groupable:false },
                            { field: "precio", title: "Precio" , format: "{0:c}", width: "90px", groupable:false},
                            { field: "familianombre", title: "Nombre de la Familia" , groupHeaderTemplate: "Familia:  <a href='javascript:void(0)' class='familyname'>#= value#</a>." },
                            //{ field: "familiaid", title: "ID Fam", }
                            { command: ["destroy"], title: "&nbsp;", groupable:false}],
    editable: "inline"
  });
});
 </script>

 


 
		</div>
	</div>


	<div class="form-group">
	  <div class="col-md-4">
	  	{{Form::submit('Modificar', array('class' => 'btn btn-warning'))}}
	  </div>
	</div>

</fieldset>
{{Form::close()}}
</div> <!-- del panel body -->

<script type="text/javascript">
 	$(document).ready(function() {



 		                      function startChange() {
                        var startDate = start.value(),
                        endDate = end.value();

                        if (startDate) {
                            startDate = new Date(startDate);
                            startDate.setDate(startDate.getDate());
                            end.min(startDate);
                        } else if (endDate) {
                            start.max(new Date(endDate));
                        } else {
                            endDate = new Date();
                            start.max(endDate);
                            end.min(endDate);
                        }
                    }

                    function endChange() {
                        var endDate = end.value(),
                        startDate = start.value();

                        if (endDate) {
                            endDate = new Date(endDate);
                            endDate.setDate(endDate.getDate());
                            start.max(endDate);
                        } else if (startDate) {
                            end.min(new Date(startDate));
                        } else {
                            endDate = new Date();
                            start.max(endDate);
                            end.min(endDate);
                        }
                    }

					//var today = kendo.date.today();

                    var start = $("#FechaInicio").kendoDateTimePicker({
                        //value: today,
                        change: startChange,
                        format: "yyyy/MM/dd HH:mm"
                    }).data("kendoDateTimePicker");

                    var end = $("#FechaTermino").kendoDateTimePicker({
                        //value: today,
                        change: endChange,
                        format: "yyyy/MM/dd HH:mm"
                    }).data("kendoDateTimePicker");

                   start.max(end.value());
                    end.min(start.value());
 	});
</script>

<script type="text/x-kendo-template" id="prod_templ">
  <h4>#: data.nombre #</h4>

    <p>Familia: #: data.familianombre #</p>

</script>

<script type="text/javascript">

    var validatorxFg = $("#xFg").kendoValidator().data("kendoValidator");




$(document).ready(function($) {

                  var ntbprecio = $("#precioX").data("kendoNumericTextBox");
                  var ntbcantidad = $("#cantidad").data("kendoNumericTextBox");

       $('#xFg').submit(function(event) {


        if (validatorxFg.validate()) {
     

    event.preventDefault();

    var data = ds.data();
    var familianombre = $('#btnAsignar').data("familyname");


   for(var i = 0; i < data.length; i++) {

      if ( data[i].familianombre == familianombre ) {
          data[i].set("cantidad", ntbcantidad.value());
          data[i].set("precio", ntbprecio.value());
          //ds.sync();
      } else{

      };

    }

    }

    $("#dialog").data('kendoWindow').close();

  });

}); //del document    
</script>

<script type="text/javascript">

                      $("#txtProd").kendoAutoComplete({
                        dataTextField: "nombre",
                        filter: "contains",
                        minLength: 2,
                        template: kendo.template($("#prod_templ").html()),
                        //headerTemplate: kendo.template($("#header_templ").html()),
                        dataSource: {
                            type: "json",
                            serverFiltering: true,
                            transport: {
                                read: "/bus_prod_"
                            }
                        },
                        select: onSelect,
                        change: onChange,
                        height:200
                    });

  var auto_PRODx = $('#txtProd').data('kendoAutoComplete');

function onSelect(e){
   var dataItem = this.dataItem(e.item.index());

   var ds_Prod = ds.data();

   var flag = true;

   var $cant__ = 1.00;
   var $price__ = 1.00;

   flag = id_repeat(ds_Prod,dataItem);

   if (flag == false) {


             for(var i = 0; i < ds_Prod.length; i++) {

                if ( dataItem.familianombre == ds_Prod[i].familianombre) {
                    $cant__ = ds_Prod[i].cantidad;
                    $price__ = ds_Prod[i].precio; 
                    break;
                }
              }

      ds.add({id: dataItem.id, nombre: dataItem.nombre, descripcion: dataItem.descripcion, cantidad: $cant__, precio: $price__, familiaid: dataItem.familiaid, familianombre: dataItem.familianombre});

   }else{
      alert('Producto Repetido. Seleccione otro.');

   };

};

function onChange(e){

    this.value('');
}

function id_repeat(data,dataItem){

  var flag = true;

  //console.log(data.length);

  if (data.length != 0) {

    var lastElem = dataItem; // ultimo elemento
    
      for (var i = data.length - 1; i >= 0; i--) {
        if (lastElem.id == data[i].id ) {
          flag = true;
          return flag;
        }else{
          flag = false;
        };
      };
      return flag;
    
  }else{
    flag = false;
    return flag
  };

}

$(document).ready(function($) {
    $("#precio").data("kendoNumericTextBox").value({{$combinacion->precio}});
 });
</script>


<style scoped>
                .k-autocomplete {
                    display: block;
                    clear: left;
                    width: 400px;
                    vertical-align: middle;
                }
              span.k-numerictextbox {
                    display: block;
                    clear: left;
                    width: 200px;
                    vertical-align: middle;
                }

                .producto {
            float: left;
            position: relative;
            width: 135px;
            height: 180px;
            margin: 0 10px;
            padding: 0;
        }
          .producto h3{
            margin: 0;
            padding: 3px 5px 0 0;
            max-width: 96px;
            overflow: hidden;
            line-height: 1.1em;
            font-size: .9em;
            font-weight: normal;
            text-transform: uppercase;
            color: #999;
          }

          .k-listview:after {
            content: ".";
            display: block;
            height: 0;
            clear: both;
            visibility: hidden;
        }

        .k-numerictextbox{
          width: 100px;
        }

        .familyname{
        -moz-user-select: none; 
        -o-user-select: none; 
        -webkit-user-select: none; 
        -ie-user-select: none; 
        user-select: none; 
        }
            </style>


            <script>
                $(document).ready(function() {




                    var window = $("#dialog");
                                //.bind("click", function() {
                                //    window.data("kendoWindow").open();

                                //});

                    if (!window.data("kendoWindow")) {
                        window.kendoWindow({
                            width: "300px",
                            animation: false,
                            title: "Asigna Precio y Cantidad",
                            modal:true,
                            actions: [
                                "Pin",
                                "Close"
                            ]
                        });
                    }
                    window.data('kendoWindow').close();
                    $('body').on('click', '#btnCancelar', function(event) {
                      event.preventDefault();
                      window.data('kendoWindow').close();
                    });

                        $('body').on('click', '.familyname', function(event) {
                        event.preventDefault();
                        window.data('kendoWindow').center();
                        window.data('kendoWindow').open();
                        $('#btnAsignar').data('familyname', $(this).html());
                        console.log($('#btnAsignar').data('familyname'));

                      });

                });
            </script>

@stop