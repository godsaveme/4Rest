@extends('layouts.master')
 

@section('content')
  @parent
@stop 
@section('sub-content')
  @parent
  <a href="{{URL('almacenes/ordenproduccion')}}" class='pull-right btn btn-info'><i class="fa fa-reply-all"></i> Volver</a>
<div id="cntnr2" style="opacity: 0;" class="panel-heading"><strong><i class="glyphicon glyphicon-th"></i> Detalle Orden de Producción
</strong></div>
<div id="cntnrGrid" style="opacity: 0;" >
<div class="panel-body">
<div class="row">
  <div class="col-md-3">
    <strong>Fecha</strong>
  </div>
  <div class="col-md-4">
    {{$ordendeproduccion->fechainicio}}
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <strong>Descripción</strong>
  </div>
  <div class="col-md-4">
    {{$ordendeproduccion->descripcion}}
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <strong>Observación</strong>
  </div>
  <div class="col-md-4">
    {{$ordendeproduccion->observacion}}
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
    <a href="javascript:void(0)" class="btn btn-default" id="btn_procesar">Actualizar Productos</a>
  </div>
  <div class="col-md-3 text-center">
    <a href="javascript:void(0)" class="btn btn-default" id="btn_todos">Orden Completa</a>
  </div>
</div>
<br>
  <table class="table table-hover" style="width:100%">
                <colgroup>
                    <col style="width:10%" />
                    <col style="width:40%" />
                    <col style="width:15%" />
                    <col style="width:15%" />
                    <col style="width:10%" />
                    <col style="width:10%" />
                </colgroup>
  <thead>
    <tr>
      <th class="text-center" style="border: 1px solid gray">Nº</th>
      <th class="text-center" style="border: 1px solid gray">Nombre</th>
      <th class="text-center" style="border: 1px solid gray">Cantidad</th>
      <th class="text-center" style="border: 1px solid gray">Cantidad Disponible</th>
      <th class="text-center" style="border: 1px solid gray">&nbsp;</th>
      <th class="text-center" style="border: 1px solid gray">
        <input id="selecionartodo" type="checkbox" value="1">
      </th>
    </tr>
  </thead>
  <tbody class="listarequerimientos">
    @foreach($productos as $producto)
    <tr>
      <td style="border: 1px solid gray">{{$contador++}}</td>
      <td style="border: 1px solid gray">{{$producto->nombre}}</td>
      <td class="text-right" style="border: 1px solid gray">
      <span class="{{$producto->pivot->id}}">{{$producto->pivot->cantidad}}</span></td>
      <td class="text-right" style="border: 1px solid gray">
        {{$producto->pivot->cantidaddisponible}}
      </td>
      <td style="border: 1px solid gray">
        @if ($producto->pivot->cantidaddisponible == $producto->pivot->cantidad)
          <input id="{{$producto->pivot->id}}" type="text" class="form-control" value="" style="height:25px;line-height:20px;" disabled="disabled">
        @else
          <input id="{{$producto->pivot->id}}" type="text" class="form-control" value="" style="height:25px;line-height:20px;">
        @endif
      </td>
      <td class="text-center" style="border: 1px solid gray">
        <input type="checkbox" value="{{$producto->pivot->id}}">
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div> <!-- del panel body -->
</div>

<script>
  function tomardetalles(){
      var productos ={};
      var i = 0;
      var y = 0;
      $('.listarequerimientos input[type=checkbox]:checked').each(function () {
        var newdato = {};
        var item = $(this);
            newdato['id'] = item.val();
            newdato['cantidad'] = $('#'+item.val()).val();
            productos[i]= newdato; 
            i++;
      });
      return productos;
  }

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

  $('#btn_todos').on('click', function(event){
    event.preventDefault();
    $('.listarequerimientos input[type=checkbox]').each(function () {
      $('#'+$(this).val()).val($('.'+$(this).val()).text());
    });
  });

  $('#btn_procesar').on('click', function(event){
    event.preventDefault();
    var productos = tomardetalles();

    $.ajax({
      url: '/actulizarstockproductos',
      type: 'post',
      dataType: 'json',
      data: {productos: productos},
    })
    .done(function(data) {
      $('input[type=checkbox]').prop('checked',false);
      if (data['estado']) {
         alert(data['mgs']);
         location.reload();
      }else{
        alert('Operacion no completada');
        console.log(data);
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