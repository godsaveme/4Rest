@extends('layouts.master')


@section('content')
	@parent
@stop 

@section('sub-content')
  @parent
<a id="cntnr1" style="opacity: 0;" href="{{URL('combinacions/create')}}" class='pull-right btn btn-primary'><i class="fa fa-edit"></i> Crear Combinación</a>

<div id="cntnr2" style="opacity: 0;" class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> COMBINACIONES
</strong></div>

                    

<div id="cntnrGrid" style="opacity: 0;">

<div class="panel-body">


    <table id="gridComb">
                    <colgroup>
                    <col style="width:120px" />
                    <col style="width:150px"  />
                    <col style="width:350px" />
                    <col style="width:120px" />
                    <col style="width:150px"  />
                    <col style="width:110px" />
                    <col style="width:110px" />
                    <col style="width:110px" />
                    <col style="width:110px" />
                    <col style="width:120px" />
                    <col style="width:150px"  />
                </colgroup>
      <thead>
        <tr>
          <th data-field="nombre">Nombre</th>
          <th data-field="descripcion">Descripción</th>
          <th data-field="pr">Productos Relacionados</th>
          <th data-field="precio">Precio</th>
          <th data-field="tc">Tipo de Combinación</th>
          <th data-field="hi">Hora Inicio</th>
          <th data-field="ht">Hora Termino</th>
          <th data-field="fi">Fecha Inicio</th>
          <th data-field="ft">Fecha Termino</th>
          <th data-field="editar">Editar</th>
          <th data-field="eliminar">Eliminar</th>
        </tr>
      </thead>
      <tbody>
        @foreach($combinacions as $comb)
     

        <tr>
          <td>{{$comb->nombre}}</td>
          <td>{{$comb->descripcion}}</td>
          <td> 
          @if($comb->nombre != 'Normal')
	          @foreach ($comb->productos as $dato)
	          {{$dato->nombre.', '}}
	          @endforeach

	      @else
	      {{ "<strong>En esta categoría están todos los productos a precios normales.</strong>"}}    
          @endif
           </td>
           <td> @if($comb->nombre != 'Normal') {{$comb->precio}} @else - @endif</td>
          <td>{{$comb->tipocomb->nombre}}</td>
          <td> @if(!empty($comb->horcomb->FechaInicio))
           {{ date('h:i a', strtotime($comb->horcomb->FechaInicio)) }} 
           @endif 
           </td>
          <td> @if(!empty($comb->horcomb->FechaTermino))
           {{ date('h:i a', strtotime($comb->horcomb->FechaTermino)) }} 
           @endif</td>
          <td> @if(!empty($comb->horcomb->FechaInicio))
           {{ date('d/m/Y', strtotime($comb->horcomb->FechaInicio)) }} 
           @endif</td>
          <td> @if(!empty($comb->horcomb->FechaTermino))
           {{ date('d/m/Y', strtotime($comb->horcomb->FechaTermino)) }}
            @endif</td>
          <td><a href="combinacions/edit/{{$comb->id}}" type="button" class="k-button">
        <!-- <span class="glyphicon glyphicon-pencil"></span> -->
                <span class="k-icon k-i-pencil"></span>
        Editar
      </a></td>
          <td><a onclick="onDestroy('combinacions/destroy/{{$comb->id}}','combinacions');" href="#" type="button" class="k-button">
        <!-- <span class="glyphicon glyphicon-remove"></span> -->
        <span class="k-icon k-i-close"></span>
      Eliminar
        </a></td>
        </tr>
        @endforeach
      </tbody>
    </table>


</div> <!-- del panel body -->

  </div>

@stop
