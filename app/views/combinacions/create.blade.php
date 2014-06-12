@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')

        <a href="{{URL('combinacions')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> CREAR COMBINACIÓN
</strong></div>

<div class="panel-body">
{{Form::open(array('id'=>'form_resto','url'=>'', 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal'))}}
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
    <div class="col-md-3">
			{{Form::label('precio', 'Precio',array('class'=>'control-label'))}}
						    </div>
    <div class="col-md-5">
			{{Form::input('text', 'precio', '', array('class'=>'form-control','placeholder'=>'##.##', 'required', 'validationMessage'=>'Por favor entre un precio', 'min' => '0'))}}
		</div>
	</div>

  <div class="form-group">
    <div class="col-md-3">
    {{Form::label('lblTipoComb', 'Tipo de Combinación',array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
			<select name="TipoComb_id" id="TipoComb_id" class="form-control">
				@foreach ($tipodecombinacion as $dato) {
				<option value=" {{$dato->id}} "> {{$dato->nombre}}</option>
				}
				@endforeach
			</select>
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
	  <div class="col-md-3">
	  	{{Form::label('slctDias', 'Seleccionar Días',array('class'=>'control-label'))}} 
	  	
	  </div>
	  <div class="col-md-9">
	  	<label>{{Form::checkbox('tdia', 1 , '',array('id' => 'tdia'))}} <strong>Todos los días </strong></label> <br>
	  	<label>{{Form::checkbox('foobar2', 2, '',array('id' => 'lun2'))}} Lunes </label>
	  	<label>{{Form::checkbox('foobar3', 3, '',array('id' => 'mar3'))}} Martes </label>
	  	<label>{{Form::checkbox('foobar4', 4, '',array('id' => 'mie4'))}} Miércoles </label>
	  	<label>{{Form::checkbox('foobar5', 5, '',array('id' => 'jue5'))}} Jueves </label>
	  	<label>{{Form::checkbox('foobar6', 6, '',array('id' => 'vie6'))}} Viernes </label>
	  	<label>{{Form::checkbox('foobar7', 7, '',array('id' => 'sab7'))}} Sábado </label>
	  	<label>{{Form::checkbox('foobar1', 1, '',array('id' => 'dom1'))}} Domingo </label> 


	  </div>
	</div>

	<div class="form-group">
		<div class="col-md-3">
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
<script type="text/x-kendo-tmpl" id="template">
    <div class="producto">

       <p> <strong>Nombre:</strong> #:nombre#</p>
         <p> <strong>Descripción:</strong> #:descripcion#</p>
         <p> <strong>Cantidad:</strong> #:cantidad#</p>
       
       <h3>
           <a class="k-button k-edit-button" href="\\#"><span class="k-icon k-edit"></span></a>
           <a class="k-button k-delete-button" href="\\#"><span class="k-icon k-delete"></span></a>
       </h3>
     </div>
 </script>

 <script type="text/x-kendo-tmpl" id="editTemplate">
     <div class="producto">
       
          <p> <strong>Nombre:</strong> #:nombre#</p>
         <p> <strong>Descripción:</strong> #:descripcion#</p>
         <p> <strong>Cantidad:</strong> <input type="text" data-bind="value:cantidad" data-role="numerictextbox" data-type="number" min="1" name="descripcion" required="required" /></p>
       
       <h3>
           <a class="k-button k-update-button" href="\\#"><span class="k-icon k-update"></span></a>
           <a class="k-button k-cancel-button" href="\\#"><span class="k-icon k-cancel"></span></a>
       </h3>
     </div>
 </script>

 <script type="text/javascript">
 var ds= new kendo.data.DataSource({

        schema: {
            model: {
                id: "id",
                fields: {
                    id: { type: "number" },
                    nombre: { type: "string" },
                    descripcion: { type: "string" },
                    familia: {type: "string"},
                    cantidad: {type: "string"}
                }
            }
        }
 });   
 </script>

 <div id="listView"></div>
 <script>
 $("#listView").kendoListView({
    template: kendo.template($("#template").html()),
    editTemplate: kendo.template($("#editTemplate").html()),
    selectable: true,
    dataSource: ds
 });
 </script>
		</div>
	</div>

	<div class="form-group">
	  <div class="col-md-4">
	  	{{Form::submit('Guardar', array('class' => 'btn btn-warning' ))}}
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

					var today = kendo.date.today();

                    var start = $("#FechaInicio").kendoDateTimePicker({
                        value: today,
                        change: startChange,
                        format: "yyyy/MM/dd HH:mm"
                    }).data("kendoDateTimePicker");

                    var end = $("#FechaTermino").kendoDateTimePicker({
                        value: today,
                        change: endChange,
                        format: "yyyy/MM/dd HH:mm"
                    }).data("kendoDateTimePicker");

                   start.max(end.value());
                    end.min(start.value());
 	});
</script>

<script type="text/x-kendo-template" id="prod_templ">
  <h2>#: data.nombre #</h2>
  <article>
    <img src="">
    <p>descripción del producto</p>
  </article>
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
   //$('#persona_id').val(dataItem.id);
   //$('#persona_id').text(dataItem.id);

   var flag = true;

   flag = id_repeat(ds_Prod,dataItem);

   if (flag == false) {
   		ds.add({id: dataItem.id, nombre: dataItem.nombre, descripcion: dataItem.descripcion, cantidad: dataItem.cantidad});
      //event.preventDefault();
      //alert(auto_PRODx.value());
      //auto_PRODx.value('hola');
   }else{
   		alert('Producto Repetido. Seleccione otro.');

   };

   //$('#txtProd').val('');


   

   //listView.refresh();
   //console.log(dataItem.id);
   //console.log(dataItem.nombre);
   //console.log(dataItem.descripcion);
   //console.log(ds.get(1));
   
   //console.log(ds_Prod[0].id);
   //ds.sync();
   //console.log($('#persona_id').val());
};

function onChange(e){
    //var value = this.value();
    //alert(value);
    this.value('');
}

function id_repeat(data,dataItem){

	var flag = true;

	console.log(data.length);

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
</script>

<script type="text/javascript">

	var validator = $("#form_resto").kendoValidator().data("kendoValidator");

	$('#form_resto').submit(function(event) {

		if (validator.validate()) {

			event.preventDefault();

			$(this).find(':submit').attr('disabled','disabled');

			var $form = $(this),
				$arrForm = $form.serializeArray();
			$arrForm.push({name: 'wordlist', value: JSON.stringify(ds.data())});

			//var form_resto = $('#form_resto').serializeArray();
			//form_resto.push({name: 'wordlist', value: JSON.stringify(ds.data())});

			var $response = $.post("/combinacions/store", $arrForm);

			$response.done(function( data ) {
							console.log(data);
	    						if (data){
	    							alert('Combinación agregada correctamente');
									window.location = "/combinacions";
								}else{
									alert('Combinación no agregada. Error');
								}
	  					});


		}

	});

</script>

<style scoped>
                .k-autocomplete {
                    display: block;
                    clear: left;
                    width: 400px;
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
            </style>

@stop