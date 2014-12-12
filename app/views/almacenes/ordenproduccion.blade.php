@extends('layouts.master')
@section('content')
@parent
@stop
@section('sub-content')
<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> Listar Ordenes
</strong></div>

<div class="panel-body">

{{ Form::open(array('id'=>'form_almacenes','url' => 'almacenes/store' , 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal')) }}
<fieldset>
  <legend></legend>
    <div class="form-group">
        <div class="col-md-3">
            {{Form::label('almacen_id', 'Almacen', array('class'=>'control-label'))}}
        </div>
        <div class="col-md-4">
            {{Form::select('almacen_id', $areasproduccion, '',array('class'=>'form-control'))}}
        </div>
        <div class="col-md-1">
            {{Form::submit('Seleccionar', array('class' => 'btn btn-warning') )}}
        </div>
    </div>
</fieldset>
{{ Form::close() }}
    <a id="cntnr2" href="javascript:void(0)" class='btn btn-primary'><i class="fa fa-edit"></i> Crear Requerimiento</a>
    <a id="cntnr1" href="javascript:void(0)" class=' btn btn-primary'><i class="fa fa-edit"></i> Crear Orden</a>
    <br>
    <br>
    <div class="panel-body">
        <div class="listaordenes">
        <script type="text/x-kendo-template" id="templatedetalle">
            <div class="row">
                <div class="col-md-3">
                    <a href="/almacenes/detalleordenes/#:id#" class="btn btn-default">Ver Orden</a>
                </div>
                <div class="col-md-3">
                    <a href="/almacenes/requerimientos/#:id#" class="btn btn-default">Ver Requerimiento</a>
                </div>
                <div class="col-md-3">
                    <a href="/almacenes/requerimientoadicional/#:id#" class="btn btn-default">Requerimiento</a>
                </div>
            </div>
        </script>
        </div>
    </div>
    <div class="crearorden" style="display:none">
    {{ Form::open(array('id'=>'form_ordenproduccion','url' => '' , 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal')) }}
    <fieldset>
      <legend></legend>
        <div class="form-group">
            <div class="col-md-3">
                {{Form::label('descripcion', 'Descripcion', array('class'=>'control-label'))}}
            </div>
            <div class="col-md-9">
                {{Form::text('descripcion', '', array('class' => 'form-control' , 'placeholder'=>'Descripcion....', 'required' , 'validationMessage'=>'Campo requerido') ) }}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                {{Form::label('observacion', 'Observacion', array('class'=>'control-label'))}}
            </div>
            <div class="col-md-9">
                {{Form::text('observacion', '', array('class' => 'form-control' , 'placeholder'=>'Observacion....')) }}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2">
              {{Form::label('producto', 'Producto', array('class'=>'control-label'))}}
            </div>
            <div class="col-md-4">
              {{Form::input('text', 'producto', '', array('id' => 'producto', 'placeholder' => 'Selecciona Producto..', 'estyle'=>'width: 120px'))}}
          </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center" style="border: 1px solid silver; width:70% ">Nombre</th>
                        <th class="text-center" style="border: 1px solid silver; width:10%">Cantidad</th>
                        <th class="text-center" style="border: 1px solid silver; width:20%">Edit/Elim.</th>
                      </tr>
                    </thead>
                    <tbody id="listView">
                      <script type="text/x-kendo-template" id="template">
                      <tr>
                        <td  style="border: 1px solid silver;">#:nombre# <strong class="pull-right">(#:unidad#)</strong></td>
                        <td class="text-right"  style="border: 1px solid silver;">
                        #:kendo.toString(cantidad,"n2")#
                        </td>
                        <td class="text-right"  style="border: 1px solid silver;">
                          <a class="k-button k-edit-button" href="\\#"><span class="k-icon k-edit"></span></a>
                                <a class="k-button k-delete-button" href="\\#"><span class="k-icon k-delete"></span></a>
                        </td>
                      </tr>
                      </script>
                      <script type="text/x-kendo-template" id="editTemplate">
                      <tr>
                        <td  style="border: 1px solid silver;">#:nombre# <strong class="pull-right">(#:unidad#)</strong></td>
                        <td class="text-right"  style="border: 1px solid silver;">
                        <input type="text" data-bind="value:cantidad" data-role="numerictextbox" name="UnitsInStock" required="required" data-type="number" min="0" validationMessage="required" />
                                  <span data-for="cantidad" class="k-invalid-msg"></span>
                        </td>
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
            <div class="col-md-2">
                <a href="javascript:void(0)" class="btn btn-default btn_cancelarcreate">
                Cancelar</a>
            </div>
            <div class="col-md-4">
                {{Form::submit('Guardar',array('class' => 'btn btn-warning'))}}
            </div>
        </div>
    </fieldset>
    {{ Form::close() }}
    </div>

    <div class="crearreqquerimiento" style="display:none">
        {{ Form::open(array('id'=>'form_requerimiento','url' => '' , 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal')) }}
    <fieldset>
      <legend></legend>
        <div class="form-group">
            <div class="col-md-3">
                {{Form::label('descripcion', 'Descripcion', array('class'=>'control-label'))}}
            </div>
            <div class="col-md-9">
                {{Form::text('descripcion', '', array('class' => 'form-control' , 'placeholder'=>'Descripcion....', 'required' , 'validationMessage'=>'Campo requerido') ) }}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                {{Form::label('observacion', 'Observacion', array('class'=>'control-label'))}}
            </div>
            <div class="col-md-9">
                {{Form::text('observacion', '', array('class' => 'form-control' , 'placeholder'=>'Observacion....')) }}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2">
              {{Form::label('insumo', 'Insumo', array('class'=>'control-label'))}}
            </div>
            <div class="col-md-4">
              {{Form::input('text', 'insumo', '', array('id' => 'insumo', 'placeholder' => 'Selecciona Insumo..', 'estyle'=>'width: 120px'))}}
          </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center" style="border: 1px solid silver; width:70% ">Nombre</th>
                        <th class="text-center" style="border: 1px solid silver; width:10%">Cantidad</th>
                        <th class="text-center" style="border: 1px solid silver; width:20%">Edit/Elim.</th>
                      </tr>
                    </thead>
                    <tbody id="listViewinsumo">
                      <script type="text/x-kendo-template" id="templateinsumo">
                      <tr>
                        <td  style="border: 1px solid silver;">#:nombre# <strong class="pull-right">(#:unidad#)</strong></td>
                        <td class="text-right"  style="border: 1px solid silver;">
                        #:kendo.toString(cantidad,"n2")#
                        </td>
                        <td class="text-right"  style="border: 1px solid silver;">
                          <a class="k-button k-edit-button" href="\\#"><span class="k-icon k-edit"></span></a>
                                <a class="k-button k-delete-button" href="\\#"><span class="k-icon k-delete"></span></a>
                        </td>
                      </tr>
                      </script>
                      <script type="text/x-kendo-template" id="editTemplateinsumo">
                      <tr>
                        <td  style="border: 1px solid silver;">#:nombre# <strong class="pull-right">(#:unidad#)</strong></td>
                        <td class="text-right"  style="border: 1px solid silver;">
                        <input type="text" data-bind="value:cantidad" data-role="numerictextbox" name="UnitsInStock" required="required" data-type="number" min="0" validationMessage="required" />
                                  <span data-for="cantidad" class="k-invalid-msg"></span>
                        </td>
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
            <div class="col-md-2">
                <a href="javascript:void(0)" class="btn btn-default btn_cancelarcreate">
                Cancelar</a>
            </div>
            <div class="col-md-4">
                {{Form::submit('Guardar',array('class' => 'btn btn-warning'))}}
            </div>
        </div>
    </fieldset>
    {{ Form::close() }}
    </div>
</div>

<script>

$('.btn_cancelarcreate').on('click', function(event) {
    event.preventDefault();
    /* Act on the event */
    $('.listaordenes').css('display', 'block');
    $('.crearorden').css('display', 'none');
    $('.crearreqquerimiento').css('display', 'none');
});

$("#producto").kendoAutoComplete({
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

var dsordenes= new kendo.data.DataSource({
        schema: {
            model: {
                id: "id",
                fields: {
                    id: { type: "number" },
                    descripcion: { type: "string" },
                    areaproduccion_id: { type: "number" },
                    observacion: {type: "string"},
                    fechainicio: {type: "date"},
                    fechacancelacion: {type: "date"}
                }
            }
        }
 });

var dsproductos= new kendo.data.DataSource({
        schema: {
            model: {
                id: "id",
                fields: {
                    id: { type: "number" },
                    nombre: { type: "string" },
                    unidad: {type: "string"},
                    cantidad: {type: "number"}
                }
            }
        }
 });

var dsinsumos= new kendo.data.DataSource({
        schema: {
            model: {
                id: "id",
                fields: {
                    id: { type: "number" },
                    unidad: {type: "string"},
                    cantidad: {type: "number"}
                }
            }
        }
 });

$("#listView").kendoListView({
    template: kendo.template($("#template").html()),
    editTemplate: kendo.template($("#editTemplate").html()),
    selectable: true,
    dataSource: dsproductos
 });

$("#listViewinsumo").kendoListView({
    template: kendo.template($("#templateinsumo").html()),
    editTemplate: kendo.template($("#editTemplateinsumo").html()),
    selectable: true,
    dataSource: dsinsumos
 });

$(".listaordenes").kendoGrid({
                    dataSource: dsordenes,
                    height: 525,
                    sortable: true,
                    pageable: {
                        refresh: true,
                        pageSizes: true,
                        buttonCount: 5
                    },
                     detailTemplate: kendo.template($("#templatedetalle").html()),
                    columns: [{
                        field: "id",
                        title: "Codigo",
                        width: 100
                    }, {
                        field: "descripcion",
                        title: "Descripcion"
                    }, {
                        field: "observacion",
                        title: "Observacion"
                    }, {
                        field: "fechainicio",
                        title: "Fecha Inicio"
                    },{
                        field: "fechacancelacion",
                        title: "Fecha Cancelacion"
                    }]
                });

$('#form_almacenes').submit(function(event) {
    /* Act on the event */
    event.preventDefault();
    buscarordenes();
});

$('#cntnr1').on('click', function(event) {
    event.preventDefault();
    /* Act on the event */
    $('.listaordenes').css('display', 'none');
    $('.crearorden').css('display', 'block');
});

$('#cntnr2').on('click', function(event) {
    event.preventDefault();
    /* Act on the event */
    $('.listaordenes').css('display', 'none');
    $('.crearreqquerimiento').css('display', 'block');
});

function onSelectProd(e){
    $('#listView').removeClass('k-widget k-listview');
     var dataItem = this.dataItem(e.item.index());
       var ds_Prod = dsproductos.data();
       var flag = true;
       flag = id_repeat(ds_Prod,dataItem);
       if (flag == false) {
            console.log();
            dsproductos.add({id: dataItem.id, unidad: dataItem.unidadMedida.substring(0, 2),nombre: dataItem.nombre , cantidad: 0 });
       }else{
            alert('Producto Repetido');
       };
}

function buscarordenes(){
    $.ajax({
        url: '/buscarordenesproduccion',
        type: 'POST',
        dataType: 'json',
        data: {areaproduccion_id: $('#almacen_id').val()}
    })
    .done(function(data) {
        dsordenes.data(data);
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
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

$('#form_ordenproduccion').on('submit', function(event) {
    event.preventDefault();
    /* Act on the event */
    var productos = new Array();
    var dsproducto =  dsproductos.data();
    for (var i = 0; i < dsproducto.length; i++) {
        var newdata = {};
        newdata['id'] = dsproducto[i].id;
        newdata['nombre'] = dsproducto[i].nombre;
        newdata['cantidad'] = dsproducto[i].cantidad;
        if (dsproducto[i].cantidad > 0) {
            productos[i] = newdata; 
        }else{
            alert('Estas enviando un producto sin cantidad.');
            return false;
        }
    }
    console.log(productos);
    $.ajax({
        url: '/create_ordenproduccion',
        type: 'POST',
        dataType: 'json',
        data: {areaproduccion_id: $('#almacen_id').val(),
                productos: productos,
                descripcion: $('#descripcion').val(),
                observacion: $('#observacion').val()},
    })
    .done(function(data) {
        if (data.estado) {
            dsproductos.data([]);
            $('#descripcion').val('');
            $('#observacion').val('');
            $('.listaordenes').css('display', 'block');
            $('.crearorden').css('display', 'none');
            alert('Operación agregada correctamente');
        }else{
            dsproductos.data([]);
            $('#descripcion').val('');
            $('#observacion').val('');
            $('.listaordenes').css('display', 'block');
            $('.crearorden').css('display', 'none');
            alert('Operación no completada');
        }
        console.log(data);
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
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

function onSelectInsumo(e){
    $('#listViewinsumo').removeClass('k-widget k-listview');
       var dataItem = this.dataItem(e.item.index());
       var ds_Insumo = dsinsumos.data();
       var flag = true;
       flag = id_repeat(ds_Insumo,dataItem);
       if (flag == false) {
            dsinsumos.add({id: dataItem.id,unidad: dataItem.unidadMedida.substring(0, 2), nombre: dataItem.nombre , cantidad: 0 });
       }else{
            alert('Producto Repetido');
       };
}

$('#form_requerimiento').on('submit', function(event) {
    event.preventDefault();
    /* Act on the event */
    var insumos = new Array();
    var dsinsumo =  dsinsumos.data();
    for (var i = 0; i < dsinsumo.length; i++) {
        var newdata = {};
        newdata['id'] = dsinsumo[i].id;
        newdata['nombre'] = dsinsumo[i].nombre;
        newdata['cantidad'] = dsinsumo[i].cantidad;
        if (dsinsumo[i].cantidad > 0) {
            insumos[i] = newdata;
        }else{
            alert('Estas enviando un producto sin cantidad.');
            return false;
        }
    }
    $.ajax({
        url: '/create_requerimiento',
        type: 'POST',
        dataType: 'json',
        data: {areaproduccion_id: $('#almacen_id').val(),
                insumos: insumos,
                descripcion: $('#form_requerimiento #descripcion').val(),
                observacion: $('#form_requerimiento #observacion').val()},
    })
    .done(function(data) {
        if (data.estado) {
            dsinsumos.data([]);
            $('#form_requerimiento #descripcion').val('');
            $('#form_requerimiento #observacion').val('');
            $('.listaordenes').css('display', 'block');
            $('.crearreqquerimiento').css('display', 'none');
            alert('Operación agregada correctamente');
        }else{
            dsinsumos.data([]);
            $('#descripcion').val('');
            $('#observacion').val('');
            $('.listaordenes').css('display', 'block');
            $('.crearreqquerimiento').css('display', 'none');
            alert('Operación no completada');
        }
        console.log(data);
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
});
</script>
<!-- del panel body -->
@stop