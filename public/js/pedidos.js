var app = new kendo.mobile.Application(document.body, { skin: 'flat'
/*init: function() {
            setTimeout(function() {
                kendo.fx(".splash").fadeOut().duration(700).play();
            }, 0)
        }*/
    });
$("#btngroup_cestapedidos").kendoMobileButtonGroup();
$('body').on('click','.km-button', function(event) {
  event.preventDefault();
  /* Act on the event */
});
$(function(){
  /*Inicializar elementos de KEndo*/
  var PBC = $("#PanelBarCesta").kendoPanelBar({
    mobile: "phone",
    height: kendo.support.mobileOS.wp ? "24em" : 430,
    animation: {
      expand: {
        effects: false
      },
      collapse:{
        effects: false
      }
    }
  });

  $("#sortable-handlers").kendoSortable({
    mobile: "phone",
    height: kendo.support.mobileOS.wp ? "24em" : 430,
    handler: ".handler",
    hint:function(element) {
      return element.clone().addClass("hint");
    }
  });
  /*FIN Inicializar elementos de KEndo*/
});

var templateprocomb = kendo.template($("#template_productosc").html());
var templateprof = kendo.template($('#template_productosf').html());
var dataSourcelistaproductosenviados = new kendo.data.DataSource({
                data: [ ]});
function abrirMesa(e){
  dataSourcecombi.data([]);
  dataSourceprof.data([]);
  var data = e.button.data();
  var idmesa = data.idmesa;
  dataSourcelistaproductosenviados.data([]);
  $("#productosenviados").html('');
  $.ajax({
    url: '/abrirmesa',
    type: 'POST',
    dataType: 'json',
    data: {mesaid: idmesa},
  })
  .done(function(data) {
    if(data['respuesta'] === 'true'){
      if(data['arrayprof']){
        for (var i in data['arrayprof']) {
        $("#productosenviados").prepend(templateprof(data['arrayprof'][i]));
        dataSourcelistaproductosenviados.add(data['arrayprof'][i]);
        };
      }
      if(data['arrayproco']){
        for (var i in data['arrayproco']) {
        $("#productosenviados").prepend(templateprocomb(data['arrayproco'][i]));
        dataSourcelistaproductosenviados.add(data['arrayproco'][i]);
        };
      }
      productosenviadostotal();
      $('#infomesa').text(data['nombremesa']);
      $('#infomesa').attr('data-id', idmesa);
      $('#infomozo').attr('data-idpedido', data['idpedido']);
      $('#infomozo').attr('data-idmozo',data['idmozo']);
      $('#infomozo').text(data['nombreusuario']);
      CalcularPrecioTotal()
    }else if(data['respuesta'] === 'false'){
      $('#infomesa').text(data['nombremesa']);
      $('#infomesa').attr('data-id', idmesa);
      $('#infomozo').attr('data-idpedido', 0);
      $('#infomozo').attr('data-idmozo',$('#usuario').attr('user_id'));
      $('#infomozo').text($('#usuario').text());
      CalcularPrecioTotal();
    }
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });
}

function productosenviadostotal(){
  var dataproductosenviados  =  dataSourcelistaproductosenviados.data();
  var total =  0;
  for (var i = dataproductosenviados.length - 1; i >= 0; i--) {
      var newtotal  =  parseFloat(total)  +  parseFloat(dataproductosenviados[i]['precio']);
      total = newtotal;
  };
  $('.montoTotalcu').html('S/.'+ total.toFixed(2));
  $('.NmrItms').html(dataproductosenviados.length);
  $('#infomesa').data('itotal', total.toFixed(2));
  $('#tab_cesta .km-badge').text(dataproductosenviados.length);
  $('#tab_cesta').attr('data-badge', dataproductosenviados.length);
}