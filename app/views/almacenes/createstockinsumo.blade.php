@extends('layouts.master')


@section('content')
@parent
@stop
@section('sub-content')
        <a href="{{URL('almacenes/show/'.$almacen->id)}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>

<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> Ingresar Stock de Producto o Insumo.
</strong></div>

<div class="panel-body">
    {{ Form::open(array('id'=>'form_resto','url' => 'almacenes/createstock', 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal')) }}
    {{Form::hidden('almacen_id', $almacen->id)}}
    {{Form::hidden('insumo_id', 0, ['id'=>'insumo_id'])}}
    {{Form::hidden('tipo', 0,['id'=>'tipo'])}}
  <div class="form-group">
    <div class="col-md-3">
            {{Form::label('nombre', 'Nombre', array('class'=>'control-label'))}}
            </div>
    <div class="col-md-5">
            {{Form::text('nombre', '', array('style'=>'width:250px','placeholder'=>'ej. Azúcar','autofocus', 'required', 'validationMessage'=>'Por favor entre un nombre.', 'id'=>'insumo'))}}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                    {{Form::label('stock', 'Stock Actual',array('class'=>'control-label'))}}
                        </div>
            <div class="col-md-5">
                    {{Form::text('stock', '', array('placeholder'=>'0.00', 'required', 'validationMessage'=>'Por favor entre el stock actual.'))}}
            </div>
        </div>
        <div class="form-group">
    <div class="col-md-4">
            {{Form::submit('Guardar', array('class' => 'btn btn-warning'))}}
                </div>
</div>
{{ Form::close() }}
</div> <!-- del panel body -->

<script>
    $("#insumo").kendoAutoComplete({
                        dataTextField: "nombre",
                        filter: "contains",
                        minLength: 2,
                        dataSource: {
                            type: "json",
                            serverFiltering: true,
                            transport: {
                                read: "/bus_insumo_prod"
                            },
                            group: { field: "Tipo" }
                        },
                        height:200,
                        select: selectinsumo
    });

  var auto_Ins = $('#insumo').data('kendoAutoComplete');

    function selectinsumo(e)
    {
        var dataItem = this.dataItem(e.item.index());
        console.log(dataItem);
        
           var $promise = $.post('/compr_ins_stockInicial_prod_receta', { insumoid: dataItem.id, tipo: dataItem.Tipo,almacenid: {{$almacen->id}} });
               $promise.done(function(data){
                  if (data['boolean']) {
                    alert(data['msg']);
                    auto_Ins.value('');
                  } else{
                    $('#insumo_id').val(dataItem.id);
                    $('#tipo').val(dataItem.Tipo);
                    auto_Ins.readonly(true);
                  };

               });
    }


</script>
@stop