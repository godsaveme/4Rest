@extends('layouts.master')
 

@section('content')
  @parent
@stop 
@section('sub-content')
  @parent

<a id="cntnr1" style="opacity: 0;" href="{{URL('recetas/create')}}" class='pull-right btn btn-primary'><i class="fa fa-edit"></i> Crear Receta</a>

<div id="cntnr2" style="opacity: 0;" class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> PRODUCTOS c/receta
</strong></div>
<div id="cntnrGrid" style="opacity: 0;">

<div class="panel-body">

<table id="gridRece" style="width:100%">
        <colgroup>
            <col style="width:130px"/>
            <col style="width:130px"/>
            <col style="width:130px" />
            <col style="width:130px" />
        </colgroup>
  <thead>
    <tr>
      <th data-field="nombre">Nombre</th>
      <th data-field="descripcion">Costo</th>
      <th data-field="familia">Familia</th>
      <th data-field="editar">Editar</th>
    </tr>
  </thead>
  <tbody>
@foreach ($productos as $dato)
 <tr>
    <td>{{$dato->nombreProd}}</td>
    <td>{{$dato->costo}}</td>
    <td>{{$dato->nombreFam}}</td>
	<td>
		<a href="/recetas/edit/{{$dato->id}}" type="button" class="k-button">
	        <span class="k-icon k-i-pencil"></span>
	        Editar
	    </a>
	</td>
</tr>
@endforeach
  </tbody>
</table>

</div> <!-- del panel body -->

</div>

@stop