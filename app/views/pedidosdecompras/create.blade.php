@extends('layouts.master')
 
@section('sidebar')
     Pedido Compras
@stop

 
@section('content')
<div class="row">
    <div class="small-6 medium-6 large-6 columns">
      &nbsp;
    </div>
    <div class="small-6 medium-6 large-6 columns">
      {{HTML::link('pedidoscompras', 'Volver', array('class'=>'button radius right'))}}
    </div>
</div>
        {{ Form::open(array('url' => 'pedidoscompras/create', 'data-abide' => 'data-abide')) }}
<fieldset>
  <legend>Crear Pedido de Compra</legend>
  <div class="row">
    <div class="small-9 medium-7 large-6 columns">
      {{Form::label('tipo_orden', 'Tipo de Orden')}}
      {{Form::select('tipo_orden', array(1=>'Provedor', 2=>'Producción'), 1)}}
    </div>
    <div class="small-3 medium-5 large-6 columns">
      &nbsp;
    </div>
  </div>
  <div class="row">
    <div class="large-6 columns">
      {{Form::hidden('proveedor_id', '')}}
      {{Form::label('provedor', 'Provedor')}}
      {{Form::input('text', 'provedor', '')}}
    </div>
    <div class="large-6 columns">
      {{Form::label('insumo', 'Insumo')}}
      {{Form::input('text', 'insumo', '', array('id'=>'insumo'))}}
    </div>
  </div>
  <div class="row">
    <div class="small-5 medidum-7 large-8 columns">
      &nbsp;
    </div>
    <div class="small-7 medium-5 large-4 columns">
      {{Form::label('importeFinal', 'Impote Total')}}
      {{Form::input('text', 'importeFinal', '0.00', array('placeholder'=>'0.00'))}}
    </div>
  </div>
  <div class="row">
    <div class="small-5 medidum-7 large-8 columns">
      &nbsp;
    </div>
    <div class="small-7 medium-5 large-4 columns">
      {{Form::label('descuentofinal', 'Descuento Final')}}
      {{Form::input('text', 'descuentofinal', '0.00', array('placeholder'=>'0.00'))}}
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
      <ul class="pricing-table" id="lista_pe_insumos">
              <li class="title">
                <div class="row">
                  <div class="small-2 medium-2 large-2 columns">Insumo</div>
                  <div class="small-2 medium-2 large-2 columns">Unidad de Medida</div>
                  <div class="small-1 medium-1 large-1 columns">Cantidad</div>
                  <div class="small-2 medium-2 large-2 columns">Precio Unitario</div>
                  <div class="small-2 medium-2 large-2 columns">Precio Total</div>
                  <div class="small-2 medium-2 large-2 columns">Descuento</div>
                  <div class="small-1 medium-1 large-1 columns">Eliminar</div>
                </div>
              </li>
              <input type="hidden" value="" name="contador">
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="small-12 medium-12 large-12 columns">
      {{Form::submit('Guardar', array('class'=> 'button radius right'))}}
    </div>
  </div>
</fieldset>
        {{ Form::close() }}
@stop