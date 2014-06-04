@extends('layouts.master')


@section('content')
@parent
@stop 
@section('sub-content')
    @parent
<a id="cntnr1" style="opacity: 0;" href="{{URL('mesas/create')}}" class='pull-right btn btn-primary'><i class="fa fa-edit"></i> Crear Mesa</a>

<div id="cntnr2" style="opacity: 0;" class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> MESAS
</strong></div>

                    

<div id="cntnrGrid" style="opacity: 0;">

<div class="panel-body">

<p class=""><em><span class="text-danger">Estado -> L: Libre / O: Ocupado / R: Reservado</span></em></p>
<table id="gridMesas">
    <colgroup>
    <col />
    <col />
    <col style="width:110px" />
    <col style="width:80px" />
    <col style="width:80px" />
    <col style="width:130px" />
    <col style="width:130px" />
</colgroup>
<thead>
    <tr>
        <th data-field="nombre">Nombre</th>
        <th data-field="descripcion">Descripción</th>
        <th data-field="salon">Salón</th>
        <th data-field="habilitado">Habilitado</th>
        <th data-field="estado">Estado</th>
        <th data-field="editar">Editar</th>
        <th data-field="eliminar">Eliminar</th>
    </tr>
</thead>
<tbody>
    @foreach($mesas as $mesa)
    <tr>
        <td>{{$mesa->nombre}}</td>
        <td>{{$mesa->descripcion}}</td>
        <td>{{$mesa->salon->nombre}}</td>
        <td> @if($mesa->habilitado==1)  Sí @else No @endif</td>
        <td> @if($mesa->estado=='O') O @elseif($mesa->estado=='L') L @elseif($mesa->estado=='R') R @else No tiene estado asignado. @endif </td>

        <td>
            <a href="mesas/edit/{{$mesa->id}}" type="button" class="k-button">
                <!-- <span class="glyphicon glyphicon-pencil"></span> -->
                <span class="k-icon k-i-pencil"></span>
                Editar
            </a>
        </td>

        <td>
            <a onclick="onDestroy('mesas/destroy/{{$mesa->id}}','mesas');" href="#" type="button" class="k-button">
                <!-- <span class="glyphicon glyphicon-remove"></span> -->
                <span class="k-icon k-i-close"></span>
                Eliminar
            </a>
        </td>
    </tr>
    @endforeach
</tbody>
</table>

</div> <!-- del panel body -->

</div>

@stop