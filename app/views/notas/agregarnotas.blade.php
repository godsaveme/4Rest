@extends('layouts.master')
@section('sidebar')
     Agregar Notas a Productos
@stop
@section('content')
<h1 data-idnota = "{{$id}}" id="nombrenota">{{$nota->descripcion}}</h1>
<div class="row">
  <div class="small-7 medium-5 large-5 columns">{{Form::select('familias', array(''=>'Seleciona Famila',
  0 => 'Todas') + $familias, '')}}</div>
  <div class="small-5 medium-7 large-7 columns">&nbsp;</div>
</div>
<div class="row">
<div class="large-12 columns">
  <ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4 " id="familiaslista">
  @foreach ($productos as $dato)
  <li id-familia ="{{$dato->familia->id}}">{{$dato->familia->nombre}}</li>
  @endforeach
  </ul>
  <ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4 " id="familias">
  </ul>
</div>
</div>
<div class="row">
<div class="large-12 columns">
{{HTML::link('javascript::void(0)', 'Guardar', array('id' =>'guardarnota', 'class'=> 'button radius right'))}}
</div>
</div>
@stop
@section('js')
{{HTML::script('js/notas.js')}}
@stop