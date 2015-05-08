@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')

        <a href="{{URL('sabores')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> EDITAR SABOR
</strong></div>

<div class="panel-body">

{{ Form::open(array('id'=>'form_resto','url' => 'sabores/update/'.$sabor->id , 'enctype' => 'multipart/form-data' , 'class'=>'form-horizontal')) }}
<fieldset>
  <legend></legend>

  <div class="form-group">
    <div class="col-md-3">
        {{Form::label('nombre', 'Nombre', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
        {{Form::text('nombre',$sabor->nombre, array('class' => 'form-control','placeholder'=>'ej. Chocolate', 'autofocus','required', 'validationMessage'=>'Por favor entre un nombre.'))}}
    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
        {{Form::label('descripcion', 'Descripción', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
        {{Form::text('descripcion', $sabor->descripcion, array('class' => 'form-control','placeholder'=>'ej. Sabor para el helado', 'required', 'validationMessage'=>'Por favor entre una descripción.'))}}
    </div>

</div>

<div class="form-group">
    <div class="col-md-3">
        {{Form::label('Insumo', 'Insumo', array('class'=>'control-label'))}}
    </div>

    <div class="col-md-5">
        @if (!empty($sabor->insumo->nombre))
        {{Form::text('insumosac',$sabor->insumo->nombre, array('id' => 'insumosac', 'required'))}}
        {{Form::text('insumo_id',$sabor->insumo_id,array('id' => 'insumo_id','style' => 'display:none'))}}
        @else
        {{Form::text('insumosac','', array('id' => 'insumosac', 'required'))}}
        {{Form::text('insumo_id','',array('id' => 'insumo_id','style' => 'display:none'))}}
        @endif

    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
        {{Form::label('porcion', 'Porción', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
        {{Form::text('porcion', $sabor->porcion, array('class' => '','placeholder'=>'###', 'required', 'validationMessage'=>'Por favor entre una cantidad.'))}}
    </div>

</div>

<div class="form-group">
    <div class="col-md-3">
        {{Form::label('habilitado', 'Estado', array('class'=>'control-label'))}}
    </div>
    <div class="col-md-5">
        {{Form::select('habilitado', array('1' => 'Activo' ,'0' => 'Desactivado'), $sabor->habilitado, array('class' => 'form-control') )}}
    </div>

</div>

<!--{{ Form::file('imagen') }}-->
<div class="form-group">
    <div class="col-md-4">

        {{Form::submit('Modificar', array('class' => 'btn btn-warning') )}}

    </div>
</div>
</fieldset>
{{ Form::close() }}
</div> <!-- del panel body -->
<img src="">



<script type="text/x-kendo-template" id="insumo_ac">
	<h3>#: data.nombre #</h3>
	<article>
		<img src="">
		<p>#: data.descripcion #</p>
		<p>Stock: #: data.stock # #: data.unidadMedida #</p>
		<p>Stock Mínimo: #: data.stockMin # #: data.unidadMedida #</p>
		<p>Stock Máximo: #: data.stockMax # #: data.unidadMedida #</p>
	</article>
</script>

<script type="text/javascript">

	                    $("#insumosac").kendoAutoComplete({
                        dataTextField: "nombre",
                        filter: "contains",
                        minLength: 3,
                        template: kendo.template($("#insumo_ac").html()),
                        dataSource: {
                            type: "json",
                            serverFiltering: true,
                            transport: {
                                read: "/buscarinsumos"
                            }
                        },
                        select: onSelect
                    });



function onSelect(e){
   var dataItem = this.dataItem(e.item.index());
   $('#insumo_id').val(dataItem.id);
   //$('#id_insumo').text(dataItem.id);
   //console.log($('#id_insumo').val());
};
</script>



@stop