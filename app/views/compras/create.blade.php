@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')

        <a href="{{URL('almacenes')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> INGRESAR COMPRA
</strong></div>

<div class="panel-body">
{{ Form::open(array('id'=>'form_empresa','url' => 'compras/create' , 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal', 'style'=>'display: none')) }}
<fieldset>
<legend>Crear Empresa</legend>
<div class="form-group">
    <div class="col-md-3">
        {{Form::label('rsocial', 'Razon Social', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-7">
        {{Form::text('rsocial', '', array('class'=>'form-control', 'required', 'placeholder'=>'Empresa S.A.'))}}   
    </div>
</div>
<div class="form-group">
    <div class="col-md-3">
        {{Form::label('ruc', 'RUC', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
        {{Form::text('ruc', '', array('class'=>'form-control', 'required', 'placeholder'=>'0001'))}}
    </div>
</div>
<div class="form-group">
    <div class="col-md-3">
        {{Form::label('direccion', 'Dirección', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-6">
        {{Form::text('direccion', '', array('class'=>'form-control', 'required','placeholder'=>'Av. #'))}}
    </div>
</div>
<div class="form-group">
    <div class="col-md-2">
        <a href="javascript:void(0)" class="btn btn-default cancelarregistro">Cancelar</a>
    </div>
    <div class="col-md-2">
        {{Form::submit('Guardar', array('class' => 'btn btn-warning', 'id'=>'btn_suempresa') )}}
    </div>
</div>
</fieldset>
{{ Form::close() }}

{{ Form::open(array('id'=>'form_persona','url' => 'compras/create' , 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal', 'style'=>'display: none')) }}
<fieldset>
<legend>Crear Persona</legend>
<div class="form-group">
    <div class="col-md-3">
        {{Form::label('nombres', 'Nombre(s)', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-6">
        {{Form::text('nombres', '', array('class'=>'form-control', 'required', 'placeholder'=>'Nombre '))}}   
    </div>
</div>
<div class="form-group">
    <div class="col-md-3">
        {{Form::label('apPaterno', 'Apellido Paterno', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-6">
        {{Form::text('apPaterno', '', array('class'=>'form-control', 'required', 'placeholder'=>'ApellidoP'))}}   
    </div>
</div>
<div class="form-group">
    <div class="col-md-3">
        {{Form::label('apMaterno', 'Apellido Materno', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-6">
        {{Form::text('apMaterno', '', array('class'=>'form-control', 'required', 'placeholder'=>'ApellidoM '))}}   
    </div>
</div>
<div class="form-group">
    <div class="col-md-3">
        {{Form::label('dni', 'DNI', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
        {{Form::text('dni', '', array('class'=>'form-control', 'required', 'placeholder'=>'12345678'))}}
    </div>
</div>
<div class="form-group">
    <div class="col-md-3">
        {{Form::label('direccion2', 'Dirección', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-6">
        {{Form::text('direccion2', '', array('class'=>'form-control', 'required','placeholder'=>'Av. #'))}}
    </div>
</div>
<div class="form-group">
    <div class="col-md-2">
        <a href="javascript:void(0)" class="btn btn-default cancelarregistro">Cancelar</a>
    </div>
    <div class="col-md-2">
        {{Form::submit('Guardar', array('class' => 'btn btn-warning', 'id'=>'btn_supersona') )}}
    </div>
</div>
</fieldset>
{{ Form::close() }}

{{ Form::open(array('id'=>'form_compra','url' => 'compras/create' , 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal')) }}
<fieldset>
  <legend></legend>
  <div class="form-group">
      <div class="col-md-4">
          {{Form::label('restaurante_id', 'Seleccione Local', array('class'=>'control-label'))}}
          {{Form::select('restaurante_id', $restaurantes, '', array('class'=>'form-control', 'required'))}}
      </div>
      <div class="col-md-3">
          {{Form::label('estado', 'Estado', array('class'=>'control-label'))}}
          {{Form::select('estado', array(1=>'Pagado',0=>'Credito'), '', array('class'=>'form-control', 'required'))}}
      </div>
  </div>
  <div class="form-group">
      <div class="col-md-3">
          {{Form::label('tipocomprobante_id', 'Tipo Comprobante', array('class'=>'control-label'))}}
          {{Form::select('tipocomprobante_id', $tipodocumentos, '', array('class'=>'form-control', 'required'))}}
      </div>
      <div class="col-md-2">
          {{Form::label('serie', 'Serie', array('class'=>'control-label'))}}
          {{Form::text('serie', '', array('class'=>'form-control text-right', 'required', 'placeholder'=>'0001'))}}
      </div>
      <div class="col-md-2">
          {{Form::label('numero', 'Numero', array('class'=>'control-label'))}}
          {{Form::text('numero', '', array('class'=>'form-control text-right', 'required','placeholder'=>'0001'))}}
      </div>
      <div class="col-md-3">
          {{Form::label('importetotal', 'Importe Total', array('class'=>'control-label'))}}
          {{Form::text('importetotal', '', array('class'=>'form-control text-right', 'required', 'placeholder'=>'0.00'))}}
      </div>
  </div>
  <div class="form-group">
      <div class="col-md-2">
          {{Form::label('subtotal', 'Sub Total', array('class'=>'control-label'))}}
          {{Form::text('subtotal', '', array('class'=>'form-control text-right', 'required','placeholder'=>'0.00'))}}
      </div>
      <div class="col-md-2">
          {{Form::label('igv', 'Sub Total', array('class'=>'control-label'))}}
          {{Form::text('igv', '', array('class'=>'form-control text-right', 'required','placeholder'=>'0.00'))}}
      </div>
      <div class="col-md-7">
          {{Form::label('provedor', 'Provedor', array('class'=>'control-label'))}}
          <br>
          {{Form::text('provedor', '', array('placeholder'=>'Buscar DNI/RUC, NOMBRE','required','style'=>'width: 320px'))}}
          {{Form::hidden('provedor_id', '',array('id'=>'provedor_id'))}}
          <a href="javascript:void(0)" class="btn btn-info" id="reset_provedor">R</a>
          <a href="javascript:void(0)" class="btn btn-default" id="btn_newpersona">NP</a>
          <a href="javascript:void(0)" class="btn btn-default"id="btn_newempresa">NE</a>
      </div>
  </div>
  <div class="form-group">
      <div class="col-md-2">
          Insumo
      </div>
      <div class="col-md-8">
          {{Form::text('insumo', '', array('id'=>'insumo', 'placeholder'=>'Buscar Insumo..','style'=>'width: 200px'))}}
          <a href="/insumos/create" class="btn btn-info" target="_blank">Crear Insumo</a>
      </div>
  </div>
  <div class="form-group">
      <div class="col-md-12">
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th style="border: 1px solid silver; width:25%">Nombre</th>
                      <th style="border: 1px solid silver; width:10%">Presentación</th>
                      <th style="border: 1px solid silver; width:10%">Cantidad</th>
                      <th style="border: 1px solid silver; width:10%">Porción</th>
                      <th style="border: 1px solid silver; width:10%">Total</th>
                      <th style="border: 1px solid silver; width:10%">Costo U.</th>
                      <th style="border: 1px solid silver; width:10%">Costo T.</th>
                      <th style="border: 1px solid silver; width:15%">&nbsp;</th>
                  </tr>
              </thead>
              <tbody id="listView">
              <script type="text/x-kendo-template" id="template">
                  <tr>
                      <td style="border: 1px solid silver;">#:nombre# <strong class="pull-right">(#:unidadmedida#)</strong></td>
                      <td style="border: 1px solid silver;">#:kendo.toString(presentacion,'n2')#</td>
                      <td style="border: 1px solid silver;">#:kendo.toString(cantidad,'n2')#</td>
                      <td style="border: 1px solid silver;">#:kendo.toString(porcion,'n2')#</td>
                      <td style="border: 1px solid silver;">#:kendo.toString(total,'n2')#</td>
                      <td style="border: 1px solid silver;">#:kendo.toString(costou,'c2')#</td>
                      <td style="border: 1px solid silver;">#:kendo.toString(costot,'c2')#</td>
                      <td style="border: 1px solid silver;">
                        <a class="k-button k-edit-button" href="\\#"><span class="k-icon k-edit"></span></a>
                        <a class="k-button k-delete-button" href="\\#"><span class="k-icon k-delete"></span></a>
                      </td>
                  </tr>
              </script>
              <script type="text/x-kendo-template" id="editTemplate">
                <tr>
                    <td style="border: 1px solid silver;">
                        #:nombre# <strong class="pull-right">(#:unidadmedida#)</strong>
                    </td>
                  <td style="border: 1px solid silver; width:10%">
                    <input type="text" data-bind="value:presentacion" data-role="numerictextbox" name="presentacion" required="required" data-type="number" min="0" validationMessage="required" style="width: 95px" style="width: 95px"/>
                    </td>
                  <td style="border: 1px solid silver;">
                  <input type="text" data-bind="value:cantidad" data-role="numerictextbox" name="cantidad" required="required" data-type="number" min="0" validationMessage="required" style="width: 95px" />
                  </td>
                  <td style="border: 1px solid silver;">
                  <input type="text" data-bind="value:porcion" data-role="numerictextbox" name="porcion" required="required" data-type="number" min="0" validationMessage="required" style="width: 95px" />
                  </td>
                  <td style="border: 1px solid silver;">#:kendo.toString(total,'n2')#</td>
                  <td style="border: 1px solid silver;">
                  <input type="text" data-bind="value:costou" data-role="numerictextbox" name="costou" required="required" data-type="number" min="0" validationMessage="required" style="width: 95px" />
                  </td>
                  <td style="border: 1px solid silver;">#:kendo.toString(costot,'c2')#</td>
                  <td style="border: 1px solid silver;">
                    <a class="k-button k-update-button" href="\\#"><span class="k-icon k-update"></span></a>
                    <a class="k-button k-cancel-button" href="\\#"><span class="k-icon k-cancel"></span></a>
                  </td>
                </tr>
              </script>
              </tbody>
              <tfoot>
                
                <tr>
                    <td colspan="6"  style="border: 1px solid silver;">
                        Total
                    </td>
                    <td class="text-right" style="border: 1px solid silver;">
                        <span id="Total">
                            &nbsp;
                        </span>
                    </td>
                    <td style="border: 1px solid silver;">
                        &nbsp;
                    </td>
                </tr>
              </tfoot>
          </table>
      </div>
  </div>
<!--{{ Form::file('imagen') }}-->
<div class="form-group">
    <div class="col-md-4">
        {{Form::submit('Guardar', array('class' => 'btn btn-warning') )}}
    </div>
</div>
</fieldset>
{{ Form::close() }}
</div> <!-- del panel body -->

<script>
    var ds= new kendo.data.DataSource({
        schema: {
            model: {
                id: "id",
                fields: {
                    id: { type: "number" },
                    nombre: { type: "string" },
                    unidadmedida:{type: "string"},
                    presentacion: {type: "nomber"},
                    cantidad: {type: "number"},
                    porcion: {type:"number"},
                    total: {type: "number"},
                    costou: {type: "number"},
                    costot: {type: "number"}
                }
            }
        }
    });
    var dataSourcepersonas = new kendo.data.DataSource({transport: {
                                                      read: "/prueba"
                                                    },
                                                      serverFiltering: true
                                                    });

    $("#listView").kendoListView({
        template: kendo.template($("#template").html()),
        editTemplate: kendo.template($("#editTemplate").html()),
        dataSource: ds,
        save: function(e) {
        var Itemid = e.model.id;
        var newtotal = e.model.presentacion*e.model.cantidad*e.model.porcion;
        var newcosto = e.model.cantidad * e.model.costou;
        ds.pushUpdate({id: e.model.id, nombre: e.model.nombre, unidadmedida: e.model.unidadmedida,
                    presentacion:e.model.presentacion,cantidad:e.model.cantidad,porcion:e.model.porcion,
                    total:newtotal,costou: e.model.costou, costot: newcosto});
        },
        dataBound: function() {
            var data = ds.data();
            var costo = 0;
            for (var i = 0; i < data.length; i++) {
                costo = costo + data[i].costot;
            }
            $('#Total').text(costo.toFixed(2));
        }
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

    $("#provedor").kendoAutoComplete({
    dataTextField: "nombres",
    filter: "nombres",
    minLength: 3,
    dataSource: dataSourcepersonas,
    select: function(e) {
            var dataItem = this.dataItem(e.item.index());
            $('#provedor_id').val(dataItem.id);
            auto_PROD.readonly(true);
          }
    });
    var auto_PROD = $('#provedor').data('kendoAutoComplete');

    $('#form_empresa').on('submit',function(event){
        event.preventDefault();
        var newdatos = {nombres: $("#rsocial").val(),
                        ruc: $('#ruc').val(),
                        direccion: $('#direccion').val(),
                        cliente: 9};
        var tiporegistro = 2;
        registrarcliente(tiporegistro, newdatos);
    });

    $('#form_persona').on('submit',function(event){
        event.preventDefault();
        var newdatos = {nombres: $("#nombres").val(),
                        apPaterno: $("#apPaterno").val(),
                        apMaterno: $("#apMaterno").val(),
                        dni: $('#dni').val(),
                        direccion: $('#direccion2').val(),
                        cliente: 10};
        var tiporegistro = 1;
        registrarcliente(tiporegistro, newdatos);
    });
    function registrarcliente(tiporegistro, datos){

        $.ajax({
            url: '/registrarcliente',
            type: 'POST',
            dataType: 'json',
            data: {datos: datos, rtipo: tiporegistro},
        })
        .done(function(data) {
            $('#form_empresa input').val('');
            $('#form_persona input').val('');
            $('#provedor_id').val(data['id']);
            $('#provedor').val(data['nombres']);
            auto_PROD.readonly(true);
            alert('Registrado Correctamente');
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    }

    $('.cancelarregistro').on('click', function(event){
        event.preventDefault();
        $('#form_empresa input').val('');
        $('#form_persona input').val('');
        $('#form_persona').css('display','none');
        $('#form_empresa').css('display','none');
    });

    $('#reset_provedor').on('click',function(event){
        event.preventDefault();
        auto_PROD.readonly(false);
    });

    $('#btn_newpersona').on('click',function(event){
        event.preventDefault();
        $('#form_persona').css('display','block');
         $('#form_empresa').css('display', 'none');
        $('#form_persona input').val('');
        $('#form_empresa input').val('');
        $('#btn_supersona').val('Guardar');
        $('#nombres').focus();
    });

    $('#btn_newempresa').on('click',function(event){
        event.preventDefault();
        $('#form_empresa').css('display', 'block');
        $('#form_persona').css('display','none');
        $('#form_persona input').val('');
        $('#form_empresa input').val('');
        $('#btn_suempresa').val('Guardar');
        $('#rsocial').focus();
    });

    function onSelectInsumo(e){
    $('#listView').removeClass('k-widget k-listview');
     var dataItem = this.dataItem(e.item.index());
       var ds_Prod = ds.data();
       var flag = true;
       flag = id_repeat(ds_Prod,dataItem);
       if (flag == false) {
            ds.add({id: dataItem.id, nombre: dataItem.nombre, unidadmedida: dataItem.unidadMedida.substring(0, 2),
                    presentacion:0,cantidad:0,porcion:0,total:0,costou: 0, costot: 0});
       }else{
            alert('Insumo Repetido');
       };
    }

    function id_repeat(data,dataItem){
        var flag = true;
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

    $('#subtotal').on('focus', function(){
        var importetotal = Number($('#importetotal').val());
        var subtotal =importetotal/1.18;
        var igv = importetotal - subtotal;
        $(this).val(subtotal.toFixed(2));
        $('#igv').val(igv.toFixed(2));
    });

    $('#form_compra').on('submit',function(event){
        event.preventDefault();
        if(Number($('#subtotal').val()) > 0){
            var total = Number($('#subtotal').val()) + Number($('#igv').val());
            if(total != Number($('#importetotal').val())){
                alert('Verificar montos');
                return false;
            }
        }
        if(Number($('#importetotal').val()) != Number($('#Total').text())){
            alert('Importe Total no coincide con la suma de costo de insumos');
            return false;
        }

        var data = ds.data();
        if (data.length <= 0) {
            alert('Ingresa insumos');
            return false;
        };

        if($('#provedor_id').val() == ''){
            alert('Seleciona Provedor');
            return false;
        }

        var insumos = {};
        for (var i = 0; i < data.length; i++) {
            if (data[i].total == 0 || data[i].costot == 0) {
                alert('Revisa las cantidades de insumos');
                return false;
            }
            var newdata = {id: data[i].id, 
                        nombre: data[i].nombre, 
                        unidadmedida: data[i].unidadmedida,
                        presentacion:data[i].presentacion,
                        cantidad:data[i].cantidad,
                        porcion:data[i].porcion,
                        total:data[i].total,
                        costou: data[i].costou, 
                        costot: data[i].costot};
            insumos[i] = newdata;
        }
        $.ajax({
        url: '/compras/create',
        type: 'POST',
        dataType: 'json',
        data: { restaurante_id: $('#restaurante_id').val(),
            estado:$('#estado').val(),
            tipocomprobante_id: $('#tipocomprobante_id').val(),
            serie: $('#serie').val(),
            numero: $('#numero').val(),
            importetotal: $('#importetotal').val(),
            subtotal: $('#subtotal').val(),
            igv: $('#igv').val(),
            provedor_id: $('#provedor_id').val(),
            insumos: insumos
        }
        })
        .done(function(data){
            if(data['estado']){
                alert('Compra Registrada Correctamente');
                $(location).attr('href', data.route);
            }else{
                alert('Operacion No Completada');
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    });
</script>
@stop