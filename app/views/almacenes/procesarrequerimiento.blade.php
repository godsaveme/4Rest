@extends('layouts.master')
 

@section('content')
  @parent
@stop 
@section('sub-content')
  @parent
<div id="cntnr2" style="opacity: 0;" class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> Requerimientos
</strong></div>
              
<div id="cntnrGrid" style="opacity: 0;" >
<div class="panel-body">
<div class="row">
  <div class="col-md-3 text-center">
    <a href="javascript:void(0)" class="btn btn-default" id="btn_procesar">Procesar</a>
  </div>
  <div class="col-md-3 text-center">
    <a href="javascript:void(0)" class="btn btn-default" id="btn_entregar">Entregar</a>
  </div>
  <div class="col-md-3 text-center">
    <a href="javascript:void(0)" class="btn btn-default" id="btn_finalizar">Finalizar</a>
  </div>
  <div class="col-md-3 text-center">
    <a href="javascript:void(0)" class="btn btn-default" id="btn_cancelar">Cancelar</a>
  </div>
</div>
<br>
  <table class="table table-hover">
    <thead>
      <tr>
        <th style="width:3%;border: 1px solid gray" class="text-center">Código</th>
        <th style="width:20%;border: 1px solid gray" class="text-center">Área</th>
        <th style="width:32%;border: 1px solid gray" class="text-center">Nombre</th>
        <th style="width:10%;border: 1px solid gray" class="text-center">Cant.</th>
        <th style="width:10%;border: 1px solid gray" class="text-center">Cant. E.</th>
        <th style="width:10%;border: 1px solid gray" class="text-center">Estado</th>
        <th style="width:10%;border: 1px solid gray" class="text-center">Cant.</th>
        <th style="width:5%;border: 1px solid gray" class="text-center"><input id="selecionartodo" type="checkbox" value="1"></th>
      </tr>
    </thead>
    <tbody class="listarequerimientos">
    @foreach ($detallesrequerimientos as $requerimiento)
      <tr>
        <td style="border: 1px solid gray">{{$requerimiento->id}}</td>
        <td style="border: 1px solid gray">{{$requerimiento->requerimiento->area->nombre}}</td>
        <td style="border: 1px solid gray">
          @if (isset($requerimiento->insumo_id))
            {{$requerimiento->insumo->nombre}}
            <input type="hidden" id="selector_{{$requerimiento->id}}" value="0">
          @elseif (isset($requerimiento->producto_id))
            {{$requerimiento->producto->nombre}}
            <input type="hidden" id="selector_{{$requerimiento->id}}" value="1">
          @endif         
        </td>
        <td style="border: 1px solid gray" class="text-right">{{$requerimiento->cantidad}}</td>
        <td style="border: 1px solid gray" class="text-right">{{$requerimiento->cantidadentregada}}</td>
        <td style="border: 1px solid gray">
           @if ($requerimiento->estado == 1)
            Iniciado
            @elseif ($requerimiento->estado == 2)
            Proceso
            @elseif ($requerimiento->estado == 3)
            Despachado
            @elseif ($requerimiento->estado == 4)
            Recibido
            @elseif ($requerimiento->estado == 5)
            Finalizado
            @elseif ($requerimiento->estado == 6)
            Cancelado
            @endif
        </td>
        <td style="border: 1px solid gray"><input id="{{$requerimiento->id}}" type="text" class="form-control" style="height:25px;line-height:20px;"> </td>
        <td style="border: 1px solid gray" class="text-center"><input type="checkbox" value="{{$requerimiento->id}}"></td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div> <!-- del panel body -->
</div>
<script>
  $('#btn_procesar').on('click', function(event) {
    event.preventDefault();
      var productos ={};
      var insumos = {};
      var i = 0;
      var y = 0;
    $('.listarequerimientos input[type=checkbox]:checked').each(function () {
      var newdato = {};
      var item = $(this);
      if ($('#'+item.val()).val() > 0) {
        if($('#selector_'+item.val()).val() == 0){
          newdato['id'] = item.val();
          newdato['cantidad'] = $('#'+item.val()).val();
          insumos[i]= newdato; 
          i++;
        }else if($('#selector_'+item.val()).val() == 1){
          newdato['id'] = item.val();
          newdato['cantidad'] = $('#'+item.val()).val();
          productos[i]= newdato; 
          i++;
        }
      }else{
        alert('Estas Procesando items con cantidad 0 o nula');
        return false;
      }
    });

    $.ajax({
      url: '/procesarrequerimiento',
      type: 'post',
      dataType: 'json',
      data: {insumos:insumos, productos:productos},
    })
    .done(function(data) {
      console.log(data);
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