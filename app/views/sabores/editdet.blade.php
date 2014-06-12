@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')

        <a href="{{URL('sabores/indexdet')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> Crear Sabor a Producto
</strong></div>

<div class="panel-body">
{{Form::open(array('id'=>'form_resto','url'=>'/sabores/updatedet', 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal'))}}
<fieldset>
	<legend></legend>
  <div class="form-group">
    <div class="col-md-3">      
			{{Form::label('nombre', 'Producto', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
      {{Form::input('text', 'txtProd', $producto->nombre, array('id' => 'txtProd', 'placeholder' => 'Selecciona Producto..', 'required', 'validationMessage'=>'Producto es requerido.'))}}
      {{Form::hidden('producto_id',$producto->id, array('id' => 'producto_id') )}}
		</div>
	</div>


	<div class="form-group">
		<div class="col-md-3">
			{{Form::label('sabores', 'Sabores',array('class'=>'control-label'))}}
		</div>
		<div class=" col-md-5">
			{{Form::input('text', 'txtSabor', '', array('id' => 'txtSabor', 'placeholder' => 'Selecciona Sabores..'))}}
		</div>
	</div>




<div class="form-group">
	<div class="col-md-12 text-center "><strong>Cesta de Sabores</strong></div>
</div>
	<div class="form-group">
		<div class="col-md-12">
<script type="text/x-kendo-tmpl" id="template">
     
       <div class="sabor">
         <strong> Nombre: </strong>  #:nombre#,
         <strong>Descripción: </strong> #:descripcion#
       
       <h3>
           <a class="k-button k-edit-button" href="\\#"><span class="k-icon k-edit"></span></a>
           <a class="k-button k-delete-button" href="\\#"><span class="k-icon k-delete"></span></a>
       </h3>
       </div>
     
 </script>

 <script type="text/x-kendo-tmpl" id="editTemplate">
     <div>
       <dl>
          <dt>Nombre</dt>
         <dd>#:nombre#</dd>
         <dt>Descripción</dt>
         <dd>#:descripcion#</dd>
       </dl>
       <div>
           <a class="k-button k-update-button" href="\\#"><span class="k-icon k-update"></span></a>
           <a class="k-button k-cancel-button" href="\\#"><span class="k-icon k-cancel"></span></a>
       </div>
     </div>
 </script>

 <script type="text/javascript">
 var ds= new kendo.data.DataSource({

      data: {{$sabores}},

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



<script type="text/x-kendo-template" id="prod_templ">
  <h2>#: data.nombre #</h2>
  <h2>#: data.descripcion #</h2>
</script>

<script type="text/x-kendo-template" id="sabor_templ">

  <h2>#: data.nombre #</h2>
  <p>#: data.descripcion #</p>

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
                        select: onSelectProd,
                        height:200
                    });

  var auto_PROD = $('#txtProd').data('kendoAutoComplete');
  auto_PROD.readonly(true);

//auto_PROD.readonly(true);

function onSelectProd(e){
   var dataItem = this.dataItem(e.item.index());

   var $promise = $.post('/compr_prod_sabr', { productoid: dataItem.id });

   $promise.done(function(data){
      if (data) {
        alert('Producto con Sabores. Escoja otro producto.');
        auto_PROD.value('');
      } else{
        $('#producto_id').val(dataItem.id);
        auto_PROD.readonly(true);
      };

   });

  


};




                      $("#txtSabor").kendoAutoComplete({
                        dataTextField: "nombre",
                        filter: "contains",
                        minLength: 2,
                        template: kendo.template($("#sabor_templ").html()),
                        dataSource: {
                            type: "json",
                            serverFiltering: true,
                            transport: {
                                read: "/bus_sabor_"
                            }
                        },
                        select: onSelectSabor,
                        height:200
                    });



function onSelectSabor(e){
   var dataItem = this.dataItem(e.item.index());

   var ds_Prod = ds.data();
   //$('#persona_id').val(dataItem.id);
   //$('#persona_id').text(dataItem.id);

   var flag = true;

   flag = id_repeat(ds_Prod,dataItem);

   if (flag == false) {
   		ds.add({id: dataItem.id, nombre: dataItem.nombre, descripcion: dataItem.descripcion });
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

	/*var validator = $("#form_resto").kendoValidator().data("kendoValidator");

	$('#form_resto').submit(function(event) {

		if (validator.validate()) {

			event.preventDefault();

			$(this).find(':submit').attr('disabled','disabled');

			var $form = $(this),
				$arrForm = $form.serializeArray();
			$arrForm.push({name: 'wordlist', value: JSON.stringify(ds.data())});

			//var form_resto = $('#form_resto').serializeArray();
			//form_resto.push({name: 'wordlist', value: JSON.stringify(ds.data())});

      if (ds.total() > 0) {



			var $response = $.post("/sabores/updatedet", $arrForm);

			$response.done(function( data ) {
							console.log(data);
	    						if (data){
	    							alert('Operación agregada correctamente');
									window.location = "/sabores/indexdet";
								}else{
									alert('Operación no agregada. Error.');
								}
	  					});
    }else{
      alert('Se requiere por lo menos agregar un sabor');
      $(this).find(':submit').removeAttr('disabled');
    };

		}

	});*/

</script>


<style scoped>
                .k-autocomplete {
                    display: block;
                    clear: left;
                    width: 400px;
                    vertical-align: middle;
                }

                .sabor {
            float: left;
            position: relative;
            width: 135px;
            height: 100px;
            margin: 0 5px;
            padding: 0;
        }
          .sabor h3{
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
            </style>
          

@stop