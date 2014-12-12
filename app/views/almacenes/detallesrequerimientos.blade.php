@extends('layouts.master')
 

@section('content')
  @parent
@stop 
@section('sub-content')
  @parent
  <a href="{{URL('almacenes/ordenproduccion')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>
<div id="cntnr2" style="opacity: 0;" class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> Detalle Requerimiento
</strong></div>
              
<div id="cntnrGrid" style="opacity: 0;" >
<div class="panel-body">
<div class="row">
  <div class="col-md-3">
    <strong>Fecha</strong>
  </div>
  <div class="col-md-4">
    {{$requerimiento->fechainicio}}
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <strong>Descripción</strong>
  </div>
  <div class="col-md-4">
    {{$requerimiento->descripcion}}
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <strong>Observación</strong>
  </div>
  <div class="col-md-4">
    {{$requerimiento->observacion}}
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <strong>Responsable</strong>
  </div>
  <div class="col-md-4">
  -
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-3 text-center">
    <a href="javascript:void(0)" class="btn btn-default" id="btn_recibir">Recibir</a>
  </div>
</div>
<br>
  <table class="table-bordered" style="width:100%">
                <colgroup>
                    <col style="width:10%" />
                    <col style="width:30%" />
                    <col style="width:15%" />
                    <col style="width:15%" />
                    <col style="width:20%" />
                    <col style="width:10%">
                </colgroup>
  <thead>
    <tr>
      <th class="text-center">Nº</th>
      <th class="text-center">Nombre</th>
      <th class="text-center">Cantidad</th>
      <th class="text-center">Cantidad Entregada</th>
      <th class="text-center">Estado</th>
      <th class="text-center"><input id="selecionartodo" type="checkbox" value="1"></th>
    </tr>
  </thead>
  <tbody class="listarequerimientos">
    @foreach($requerimientos as $requerimiento)
    <tr>
      <td class="text-center">{{$contador++}}</td>
      <td>
         @if (isset($requerimiento->insumo_id))
            {{$requerimiento->insumo->nombre}} <strong class="pull-right">({{substr($requerimiento->insumo->unidadMedida,0,2)}})</strong>
            <input type="hidden" id="selector_{{$requerimiento->id}}" value="0">
          @elseif (isset($requerimiento->producto_id))
            {{$requerimiento->producto->nombre}} <strong class="pull-right">({{substr($requerimiento->producto->unidadMedida,0,2)}})</strong>
            <input type="hidden" id="selector_{{$requerimiento->id}}" value="1">
          @endif  
      </td>
      <td class="text-right">{{$requerimiento->cantidad}}</td>
      <td class="text-right">{{$requerimiento->cantidadentregada}}</td>
      <td class="text-center">
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
      <td class="text-center">
        <input type="checkbox" value="{{$requerimiento->id}}">
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div> <!-- del panel body -->
</div>
<script>
  $('#selecionartodo').on('click', function(){
    if ($(this).prop('checked')) {
      $('.listarequerimientos input[type=checkbox]').each(function () {
        $(this).prop('checked',true)
      });
    }else{
      $('.listarequerimientos input[type=checkbox]').each(function () {
        $(this).prop('checked',false)
      });
    }
  });

  function tomarrequerimientos(){
    var requerimiento = {};
    var productos ={};
    var insumos = {};
    var i = 0;
    var y = 0;
    $('.listarequerimientos input[type=checkbox]:checked').each(function () {
      var newdato = {};
      var item = $(this);
        if($('#selector_'+item.val()).val() == 0){
          newdato['id'] = item.val();
          insumos[i]= newdato; 
          i++;
        }else if($('#selector_'+item.val()).val() == 1){
          newdato['id'] = item.val();
          productos[i]= newdato; 
          i++;
        }
    });
    requerimiento['productos'] = productos;
    requerimiento['insumos'] = insumos;
    return requerimiento;
  }

  $('#btn_recibir').on('click', function(event) {
    event.preventDefault();
    var requerimiento = tomarrequerimientos();

    $.ajax({
      url: '/recibirrequerimiento',
      type: 'post',
      dataType: 'json',
      data: {insumos:requerimiento.insumos, productos: requerimiento.productos},
    })
    .done(function(data) {
      $('input[type=checkbox]').prop('checked',false);
      if (data['estado']) {
        alert(data['mgs']);
        location.reload();
      }else{
        alert('Operacion no completada');
        console.log(data.mgs);
      }
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