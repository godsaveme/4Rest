@extends('layouts.master')
 

@section('content')
  @parent
@stop 
@section('sub-content')


        
        <a href="{{URL('productos')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>


<div class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> MODIFICAR PRODUCTO
</strong></div>

<div class="panel-body">
        {{ Form::open(array('id'=>'form_resto','url' => 'productos/edit', 'enctype' => 'multipart/form-data', 'class'=>'form-horizontal')) }}
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
            {{Form::text('precio', $precio->precio, array('class' => 'form-control', 'placeholder'=>'#.##', '', 'validationMessage'=>'Por favor entre un precio.',  'min'=>'0'))}}
          </div>
          <div class="col-md-4">
        {{Form::label('stock', 'Stock', array('class'=>'control-label'))}}
        {{Form::text('stock', $producto->stock ,array('class' => 'form-control','placeholder'=>'#.##','min'=>'0'))}}
          </div>
          <div class="col-md-2">
            {{Form::label('stockMin', 'Stock Min', array('class'=>'control-label'))}}
            {{Form::text('stockMin', $producto->stockMin, array('class' => 'form-control','placeholder'=>'#.##','min'=>'0'))}}
          </div>
          <div class="col-md-2">
            {{Form::label('stockMax', 'Stock Max', array('class'=>'control-label'))}}
            {{Form::text('stockMax', $producto->stockMax, array('class' => 'form-control','placeholder'=>'#.##','min'=>'0'))}}
          </div>
          <div class="col-md-1">
            &nbsp;
          </div>
        </div>
      <div class="form-group">
                    <div class="col-md-3">
        {{Form::label('estado', 'Estado', array('class'=>'control-label'))}} 
        {{Form::select('estado', array(1=>'Activo', 0=>'Inactivo'),$producto->estado, array('class' => 'form-control'))}}
      </div>
      <div class="col-md-3">
      {{Form::label(' id_tipoarepro', 'Area de Producción', array('class'=>'control-label'))}}
      {{Form::select('  id_tipoarepro', array('' => "Seleccione un área") + $tipoarea,$producto->id_tipoarepro, array('class' => 'form-control'))}}
      </div>
      <div class="col-md-3">
        {{Form::label('familia_id', 'Familia', array('class'=>'control-label'))}}
        <select name="familia_id" id="" class='form-control'>
          <option value="">Escoja una familia</option>
          @foreach ($familias as $dato) 
            <option value=" {{$dato->id}} " @if($dato->id == $producto->familia_id) selected @endif > {{$dato->nombre}}</option>
          
          @endforeach
        </select>
      </div>
      <div class="col-md-3">

                    {{Form::label('unidadMedida', 'Unidad Medida', array('class'=>'control-label'))}}
            {{Form::select('unidadMedida', array('Unidades' => 'Unidades', 'Kilogramos' => 'Kilogramos', 'Litros' => 'Litros'),$producto->unidadMedida, array('class' => 'form-control'))}}

      </div>
      <div class="col-md-2">
        {{Form::label('selector_adicional', 'Adicionales', array('class'=>'control-label'))}} 
        {{Form::select('selector_adicional', array(1=>'Si', 0=>'No'),$producto->selector_adicional, array('class' => 'form-control'))}}
      </div>
    </div>
    <div id="adiconales">
      {{Form::hidden('contaadic', '', array('id'=>'contaadic'))}}
    <div class="form-group" id="b_pro_adi" style="display: none">
      <div class="col-md-5 ">
        <label for="b_pro">Productos Adicionales</label>
        <input type="text" id="b_proadi" placeholder="Buscar Productos Adicionales">
      </div>
      <div class="col-md-7 ">&nbsp;</div>
      <div class="row"> 
          <div class="col-md-12"> 
            <ul class="pricing-table" id="lista_adiconales">
              <li class="title">Lista de Productos Adicionales</li>
            </ul> 
          </div>
      </div>
    </div>
    </div>
        <div class="row">
          <div class="col-md-3">&nbsp;</div>
          <div class="col-md-3">
          <a href="javascript:void(0);" class="button tiny radius" onclick="select_ingre('1');" id="s_ins">Insumos</a>
          </div>
          <div class="col-md-2">&nbsp;</div>
          <div class="col-md-2">
            <a href="javascript:void(0);" class="button tiny radius " onclick="select_ingre('2');" id="s_pro">Productos</a>
          </div>
          <div class="small-2 medium-2 large-3 columns">&nbsp;</div>
        </div>
        <div id="b_listaingre">
          <div class="row" id="b_ins_" style="display:none">
            <div class="large-5 columns">
              <label for="b_ingre">Ingredientes</label>
              <input type="text" id="b_ingre" placeholder="Buscar Ingredientes">
            </div>
            <div class="large-7 columns">&nbsp;</div>
          </div>
    <div class="row" id="b_pro_" style="display:none">
      <div class="large-5 columns">
        <label for="b_pro">Productos</label>
        <input type="text" id="b_pro" placeholder="Buscar Productos">
      </div>
      <div class="large-7 columns">&nbsp;</div>
    </div>
        </div>
            <div id="ingr_sel" style="display:none;">
            <div class="row"> 
              <div class="large-12 columns"> 
                <ul class="pricing-table" id="lista_insumos">
                  <li class="title">Lista de Insumos</li>
                </ul> 
              </div>
            </div>
            </div>
            <div id="pro_sel" style="display:none;">
            <div class="row"> 
              <div class="large-12 columns"> 
                <ul class="pricing-table" id="lista_productos">
                  <li class="title">Lista de Productos</li>
                </ul> 
              </div>
            </div>
            </div>
            <input id='sel_pro_ins' type="hidden" name='sel_pro_ins' value="">
            <input id='containgre' type="hidden" name='containgre' value="">
    <div class="form-group">
              <div class="col-md-8">
        {{Form::submit('Modificar',array('class' => 'btn btn-warning'))}}
      </div>
      <div class="col-md-4">
        &nbsp;
      </div>
    </div>
</fieldset>
        {{ Form::close() }}
        </div> <!-- del panel body -->
@stop