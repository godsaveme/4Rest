@extends('layouts.master')
 

@section('content')
  @parent
@stop 
@section('sub-content')
<style scoped>
          .k-autocomplete {
              display: block;
              clear: left;
              width: 250px;
              vertical-align: middle;
          }

          .k-listview:after {
            content: ".";
            display: block;
            height: 0;
            clear: both;
            visibility: hidden;
        }
</style>
        <a href="{{URL('recetas')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>

<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> CREAR RECETA
</strong></div>

<div class="panel-body">
        {{ Form::open(array('id'=>'form_receta','url' => '', 'enctype' => 'multipart/form-data', 'class'=>'form-horizontal'))}}
        <fieldset>
  <legend></legend>
<div class="form-group">
    <div class="col-md-3">
			{{Form::label('nombre', 'Producto', array('class'=>'control-label'))}}
			    </div>
    <div class="col-md-4">
      {{Form::input('text', 'txtProd', '', array('id' => 'txtProd', 'placeholder' => 'Selecciona Producto..', 'required', 'validationMessage'=>'Producto es requerido.'))}}
      {{Form::hidden('producto_id','', array('id' => 'producto_id') )}}
		</div>
    <div class="col-md-1">
      <a href="javascript:void(0)" id="btn_buscar" class="btn btn-info">R</a>
    </div>
</div>
<div class="form-group">
    <div class="col-md-3">
      {{Form::label('costo', 'Costo', array('class'=>'control-label'))}}
          </div>
    <div class="col-md-5">
     <strong>S/. <span id="costop">0.00</span></strong>
    </div>
</div>
<br>
<br>
<div class="form-group">
    <div class="col-md-1">
			{{Form::label('insumo', 'Insumo', array('class'=>'control-label'))}}
			    </div>
    <div class="col-md-4">
      {{Form::input('text', 'insumo', '', array('id' => 'insumo', 'placeholder' => 'Selecciona Insumo..', 'estyle'=>'width: 120px'))}}
	</div>
</div>
<div class="form-group">
	<div class="col-md-12 text-center "><strong>Receta</strong></div>
</div>
	<div class="form-group">
		<div class="col-md-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="text-center" style="border: 1px solid silver; width:30%">Nombre</th>
						<th class="text-center" style="border: 1px solid silver; width:10%">Cantidad</th>
						<th class="text-center" style="border: 1px solid silver; width:20%">Unidad de Medida</th>
						<th class="text-center" style="border: 1px solid silver; width:20%">Costo</th>
						<th class="text-center" style="border: 1px solid silver; width:20%">Edit/Elim.</th>
					</tr>
				</thead>
				<tbody id="listView">
					<script type="text/x-kendo-template" id="template">
					<tr>
						<td  style="border: 1px solid silver;">#:nombre#</td>
						<td class="text-right"  style="border: 1px solid silver;">
						#:kendo.toString(cantidad,"n4")#
						</td>
						<td class="text-right"  style="border: 1px solid silver;">#:unidadmedida#</td>
						<td class="text-right"  style="border: 1px solid silver;">
						#:kendo.toString(costo,"c")#
						</td>
						<td class="text-right"  style="border: 1px solid silver;">
							<a class="k-button k-edit-button" href="\\#"><span class="k-icon k-edit"></span></a>
	           				<a class="k-button k-delete-button" href="\\#"><span class="k-icon k-delete"></span></a>
           				</td>
					</tr>
					</script>
					<script type="text/x-kendo-template" id="editTemplate">
					<tr>
						<td  style="border: 1px solid silver;">#:nombre#</td>
						<td class="text-right"  style="border: 1px solid silver;">
						<input type="text" data-bind="value:cantidad" data-role="numerictextbox" data-decimals="4"
        data-step="0.0001"
        data-format="n4" name="cantidad" required="required" data-type="number" min="0" validationMessage="required" />
                    	<span data-for="cantidad" class="k-invalid-msg"></span>
						</td>
						<td class="text-right"  style="border: 1px solid silver;">#:unidadmedida#</td>
						<td class="text-right"  style="border: 1px solid silver;">#:costo#</td>
						<td class="text-right"  style="border: 1px solid silver;">
							<a class="k-button k-update-button" href="\\#"><span class="k-icon k-update"></span></a>
           		<a class="k-button k-cancel-button" href="\\#"><span class="k-icon k-cancel"></span></a>
           	</td>
					</tr>
					</script>
				</tbody>
			</table>
		</div>
	</div>
<div class="form-group">
    <div class="col-md-12">
      {{Form::label('preproducto', 'Pre Producto', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-4">
      {{Form::input('text', 'preproducto', '', array('id' => 'preproducto', 'placeholder' => 'Selecciona Producto..', 'estyle'=>'width: 120px'))}}
  </div>
</div>
<div class="form-group">
	<div class="col-md-12 text-center "><strong>Pre-Producto</strong></div>
</div>
<div class="form-group">
    <div class="col-md-12">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center" style="border: 1px solid silver; width:30%">Nombre</th>
            <th class="text-center" style="border: 1px solid silver; width:10%">Cantidad</th>
            <th class="text-center" style="border: 1px solid silver; width:20%">Unidad de Medida</th>
            <th class="text-center" style="border: 1px solid silver; width:20%">Costo</th>
            <th class="text-center" style="border: 1px solid silver; width:20%">Edit/Elim.</th>
          </tr>
        </thead>
        <tbody id="listView2">
          <script type="text/x-kendo-template" id="template2">
          <tr>
            <td  style="border: 1px solid silver;">#:nombre#</td>
            <td class="text-right"  style="border: 1px solid silver;">
            #:kendo.toString(cantidad,"n4")#
            </td>
            <td class="text-right"  style="border: 1px solid silver;">#:unidadmedida#</td>
            <td class="text-right"  style="border: 1px solid silver;">
            #:kendo.toString(costo,"c")#
            </td>
            <td class="text-right"  style="border: 1px solid silver;">
              <a class="k-button k-edit-button" href="\\#"><span class="k-icon k-edit"></span></a>
                    <a class="k-button k-delete-button" href="\\#"><span class="k-icon k-delete"></span></a>
                  </td>
          </tr>
          </script>
          <script type="text/x-kendo-template" id="editTemplate2">
          <tr>
            <td  style="border: 1px solid silver;">#:nombre#</td>
            <td class="text-right"  style="border: 1px solid silver;">
            <input type="text" data-bind="value:cantidad" data-role="numerictextbox" name="UnitsInStock" required="required" data-type="number" min="0" validationMessage="required" />
                      <span data-for="cantidad" class="k-invalid-msg"></span>
            </td>
            <td class="text-right"  style="border: 1px solid silver;">#:unidadmedida#</td>
            <td class="text-right"  style="border: 1px solid silver;">#:costo#</td>
            <td class="text-right"  style="border: 1px solid silver;">
              <a class="k-button k-update-button" href="\\#"><span class="k-icon k-update"></span></a>
              <a class="k-button k-cancel-button" href="\\#"><span class="k-icon k-cancel"></span></a>
            </td>
          </tr>
          </script>
        </tbody>
      </table>
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

<script type="text/x-kendo-template" id="prod_templ">
  <h2>#: data.nombre #</h2>
  <h2>#: data.descripcion #</h2>
</script>
<script>
var ds= new kendo.data.DataSource({
        schema: {
            model: {
                id: "id",
                fields: {
                    id: { type: "number" },
                    nombre: { type: "string" },
                    costo: { type: "number" },
                    unidadmedida: {type: "string"},
                    cantidad: {type: "number"},
                    costou: {type: "number"}
                }
            }
        }
 });

 var dsprods= new kendo.data.DataSource({
        schema: {
            model: {
                id: "id",
                fields: {
                    id: { type: "number" },
                    nombre: { type: "string" },
                    costo: { type: "number" },
                    unidadmedida: {type: "string"},
                    cantidad: {type: "number"},
                    costou: {type: "number"}
                }
            }
        }
 });   

$("#listView").kendoListView({
    template: kendo.template($("#template").html()),
    editTemplate: kendo.template($("#editTemplate").html()),
    selectable: true,
    dataSource: ds,
    save: function(e) {
    	var Itemid = e.model.id;
    	var newcosto = e.model.cantidad * e.model.costou;
    	ds.pushUpdate({ id: Itemid, costo: newcosto, nombre: e.model.nombre,unidadmedida:e.model.unidadmedida, cantidad: e.model.cantidad, costou: e.model.costou });
  	},
    dataBound: function() {
      var data = ds.data();
      var costo = 0;
      for (var i = 0; i < data.length; i++) {
        costo = parseFloat(costo) + parseFloat(data[i].costo);
      }

      var data2 = dsprods.data();
      for (var i = 0; i < data2.length; i++) {
        costo = parseFloat(costo) + parseFloat(data2[i].costo);
      }
      $('#costop').text(costo.toFixed(2));
    }
 });

$("#listView2").kendoListView({
    template: kendo.template($("#template2").html()),
    editTemplate: kendo.template($("#editTemplate2").html()),
    selectable: true,
    dataSource: dsprods,
    save: function(e) {
      var Itemid = e.model.id;
      var newcosto = e.model.cantidad * e.model.costou;
      dsprods.pushUpdate({ id: Itemid, costo: newcosto , nombre: e.model.nombre, unidadmedida:e.model.unidadmedida, cantidad: e.model.cantidad, costou: e.model.costou});
    },
    dataBound: function() {
      var data = ds.data();
      var costo = 0;
      for (var i = 0; i < data.length; i++) {
        costo = parseFloat(costo) + parseFloat(data[i].costo);
      }

      var data2 = dsprods.data();
      for (var i = 0; i < data2.length; i++) {
        costo = parseFloat(costo) + parseFloat(data2[i].costo);
      }
      $('#costop').text(costo.toFixed(2));
    }
 });

	$("#txtProd").kendoAutoComplete({
                        dataTextField: "nombre",
                        filter: "contains",
                        minLength: 2,
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
	$("#insumo").kendoAutoComplete({
                        dataTextField: "nombre",
                        filter: "contains",
                        minLength: 2,
                        dataSource: {
                            type: "json",
                            serverFiltering: true,
                            transport: {
                                read: "/bus_insumo_"
                            }
                        },
                        select: onSelectInsumo,
                        height:200
    });
  $("#preproducto").kendoAutoComplete({
                        dataTextField: "nombre",
                        filter: "contains",
                        minLength: 2,
                        dataSource: {
                            type: "json",
                            serverFiltering: true,
                            transport: {
                                read: "/bus_prepro_"
                            }
                        },
                        select: onSelectPreproducto,
                        height:200
    });
  var auto_PROD = $('#txtProd').data('kendoAutoComplete');

//auto_PROD.readonly(true);

function onSelectProd(e){
   var dataItem = this.dataItem(e.item.index());
   var $promise = $.post('/compr_prod_receta', { productoid: dataItem.id });
   $promise.done(function(data){
      if (data) {
        alert('Producto con Receta. Escoja otro producto.');
        auto_PROD.value('');
      } else{
        $('#producto_id').val(dataItem.id);
        auto_PROD.readonly(true);
      };

   });
};

$('#btn_buscar').on('click', function(event) {
  event.preventDefault();
  /* Act on the event */
  auto_PROD.readonly(false);
});

function onSelectInsumo(e){
	$('#listView').removeClass('k-widget k-listview');
	 var dataItem = this.dataItem(e.item.index());
	   var ds_Prod = ds.data();
	   var flag = true;

	   flag = id_repeat(ds_Prod,dataItem);

	   if (flag == false) {
	   		ds.add({id: dataItem.id, nombre: dataItem.nombre, costo: dataItem.ultimocosto, 
	   			unidadmedida:dataItem.unidadMedida, cantidad: 1, costou: dataItem.ultimocosto});
	   }else{
	   		alert('Insumo Repetido');
	   };
}

function onSelectPreproducto(e){
  $('#listView2').removeClass('k-widget k-listview');
   var dataItem = this.dataItem(e.item.index());
     var ds_Prod = dsprods.data();
     var flag = true;
     flag = id_repeat(ds_Prod,dataItem);
     if (flag == false) {
        dsprods.add({id: dataItem.id, nombre: dataItem.nombre, costo: dataItem.costo, 
          unidadmedida:dataItem.unidadMedida, cantidad: 1, costou: dataItem.costo});
     }else{
        alert('Insumo Repetido');
     };
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
		return flag;
	}
}

</script>
@stop