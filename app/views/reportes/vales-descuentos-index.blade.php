@extends('layouts.cajamaster')
@section('js')
	{{HTML::script('js/reportescaja.js')}}
@stop
@section('content')
<div class="container">
	<div class="panel panel-primary" id="reportediariocaja">
       <div class="row">
            <div class="col-sm-1">
            &nbsp;
            </div>
           <div class="col-sm-6">
               <h1>Selecciona Sucursal</h1>
               <ul  class="list-group">
               @foreach($restaurantes as $restaurante)
                   <li class="list-group-item">
                       <a href="/reportes/vales-descuentos/{{$restaurante->id}}">{{$restaurante->nombreComercial}}</a>
                   </li>
               @endforeach
               </ul>
           </div>
       </div>
    </div>
</div>
@stop