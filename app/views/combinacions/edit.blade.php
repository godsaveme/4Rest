@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')

        <a href="{{URL('combinacions')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> EDITAR COMBINACIÓN
</strong></div>

<div class="panel-body">
{{Form::open(array('id'=>'form_resto','url'=>'combinacions/store', 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal'))}}
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
			{{Form::input('text', 'precio', $combinacion->precio, array('class'=>'form-control','placeholder'=>'##.##', 'required', 'validationMessage'=>'Por favor entre un precio', 'min' => '0'))}}
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
			{{Form::select('Slc_Fam', $familias, '', array('class'=>'form-control'))}}
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
     <div>
       <dl>
         <dt>Nombre</dt> <dd>#:nombre#</dd>
         <dt>Descripción</dt> <dd>#:descripcion#</dd>
         <dt>Cantidad</dt> <dd>#:cantidad#</dd>
       </dl>
       <div>
           <a class="k-button k-edit-button" href="\\#"><span class="k-icon k-edit"></span></a>
           <a class="k-button k-delete-button" href="\\#"><span class="k-icon k-delete"></span></a>
       </div>
     </div>
 </script>

 <script type="text/x-kendo-tmpl" id="editTemplate">
     <div>
       <dl>
          <dt>Nombre</dt>
         <dd>#:nombre#</dd>
         <dt>Descripción</dt>
         <dd>#:descripcion#</dd>
         <dd><input type="text" data-bind="value:cantidad" data-role="numerictextbox" data-type="number" min="1" name="descripcion" required="required" /></dd>
       </dl>
       <div>
           <a class="k-button k-update-button" href="\\#"><span class="k-icon k-update"></span></a>
           <a class="k-button k-cancel-button" href="\\#"><span class="k-icon k-cancel"></span></a>
       </div>
     </div>
 </script>

 <script type="text/javascript">
 var ds= new kendo.data.DataSource({

 		data:   <?php echo Combinacion::join('precio','precio.combinacion_id' ,'=','combinacion.id')
 							->join('producto','precio.producto_id','=','producto.id')
 							->where('combinacion.id','=',$combinacion->id)
 							->select('producto.id as id','producto.nombre as nombre','producto.descripcion as descripcion', 'precio.cantidad as cantidad')
 							->get()->toJson(); ?>,
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
    //selectable: true,
    dataSource: ds
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
                        dataSource: {
                            type: "json",
                            serverFiltering: true,
                            transport: {
                                read: "/bus_prod_"
                            }
                        },
                        select: onSelect,
                        height:200
                    });



function onSelect(e){
   var dataItem = this.dataItem(e.item.index());

   var ds_Prod = ds.data();
   //$('#persona_id').val(dataItem.id);
   //$('#persona_id').text(dataItem.id);

   var flag = true;

   flag = id_repeat(ds_Prod,dataItem);

   if (flag == false) {
   		ds.add({id: dataItem.id, nombre: dataItem.nombre, descripcion: dataItem.descripcion, cantidad: dataItem.cantidad});
   }else{
   		alert('Producto Repetido');
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

			var $response = $.post("/combinacions/update", $arrForm);

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

@stop