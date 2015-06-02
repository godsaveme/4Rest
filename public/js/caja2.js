$(document).ready(function(){
var socket = io.connect('http://'+window.location.hostname+':3000');
socket.emit('loginuser',$('#usuario').text(), 
          $('#area').text()+'_'+$('#area').attr('data-ida'), 
          $('#usuario').attr('user_id'));
socket.on("Conectado", conectado);
function conectado(mensaje){
    console.log(mensaje);
}

$('body').timeago();


function checkbox (){
	$('input').each(function(){
    var self = $(this),
      label = self.next(),
      label_text = label.text();

    label.remove();
    self.iCheck({
      checkboxClass: 'icheckbox_line-green',
      radioClass: 'iradio_line-green',
      insert: '<div class="icheck_line-icon"></div>' + label_text
    });
  });
}

function verificartiempomozos() {
    var contadorespera = $('#lista_controlpedidos .E').length;
    if(contadorespera > 0){
        socket.emit('TiemposMozos', $('#area').attr('data-idlocal'));
    }
}
setInterval(verificartiempomozos,60000);

socket.on("NotificacionDemoraMozos", notificaciondemoramozos);

function notificaciondemoramozos(data){
	console.log(data[0]['TiempoEspera']);
    if (data[0]['TiempoEspera'] >= 2){
        document.getElementById('sonido_demora').play();
    }else{
        document.getElementById('sonido_demora').pause();
    }
}

//control pedidos
$("#windowscontrolpedidos").kendoWindow({
  				actions: ["Pin","Minimize","Maximize", "Close"],
  				visible: false,
  				title: 'Notificaiones Pedidos',
  				resizable: false,
  				width: '500px',
  				animation: false,
  				position: { top: 50 , left: 100}
});

$("#btn_controlpedidos").on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	$('#windowscontrolpedidos').data("kendoWindow").open();
});

//fincontrolpedidos


//notificaciones

var popupNotification = $("#popupNotification").kendoNotification({position: {
        bottom: 20,
        right: 20
    }}).data("kendoNotification");

var notificacionmesa = $("#notificaciones_mesas").kendoNotification({position: {
        top: 20,
        right: 20,
        width: "300",
        hideOnClick: true,
        autoHideAfter: 0,
        stacking: "down",
    }}).data("kendoNotification");

$("#windowsnotificaciones").kendoWindow({
  				actions: ["Pin","Minimize","Maximize", "Close"],
  				visible: false,
  				title: 'Notificaiones Pedidos',
  				resizable: false,
  				width: '350px',
  				height: '500px',
  				animation: false,
  				position: { top: 50 , left: 100}
});
var notificationpedido = $("#notificationpedidos").kendoNotification({
                        appendTo: "#windowsnotificaciones",
                        autoHideAfter: 0,
                        stacking: "down",
                        templates: [{
                            type: "info",
                            template: $("#notificacionpedidos").html()
                        }]
                    }).data("kendoNotification");

socket.on('NotificacionPedidos',notificacionespedidos);
socket.on('ActualizarControlpedidos',actulizarcontrolpedidos);
socket.on('ActulizarestadoAll', actulizarestadosall);
socket.on('ActulizarPedidosMesa',actulizarpedidosmesa);
socket.on('NotificacionMesa',notificaionesmesas);
socket.on('PrecuentaMesa',precuentamesa);
socket.on('SupervisorMesa', supervisormesa);
//notificaciones mesas clientes

function supervisormesa(mesa, results,estado, idrest,codigomesa){
	if ($('#area').attr('data-idlocal') == idrest) {
		if(estado == 0){
			notificacionmesa.show('Supervisor a ' + mesa, "warning");
			document.getElementById('sonido_mesas').play();
			$('#'+codigomesa).css('background', 'url(/images/alert-supervisor.jpg)');
			$('#'+codigomesa).css('background-size', 'cover');
		}else{
			notificacionmesa.show('Supervisor a ' + mesa + 'fue atentida por' + results[0]['login'] , "warning");
			document.getElementById('sonido_mesas').play();
			$('#'+codigomesa).css('background', 'url(/images/alert-supervisor.jpg)');
			$('#'+codigomesa).css('background-size', 'cover');
		}
	}
}

function precuentamesa(mesa, mozo,idrest,codigomesa){
	if ($('#area').attr('data-idlocal') == idrest) {
		notificacionmesa.show('Enviar precuenta' + mesa + 'atendido por:  ' + mozo, "warning");
	 	document.getElementById('sonido_mesas').play();
	 	$('#'+codigomesa).css('background', 'url(/images/alert-cuenta.jpg)');
	 	$('#'+codigomesa).css('background-size', 'cover');
	}
}

function notificaionesmesas(mesa, results,estado,idrest,codigomesa){
	if ($('#area').attr('data-idlocal') == idrest) {
		if(estado == 0){
			notificacionmesa.show('Enviar mozo a ' + mesa, "warning");
			document.getElementById('sonido_mesas').play();
			$('#'+codigomesa).css('background', 'url(/images/alert-mozo.jpg)');
			$('#'+codigomesa).css('background-size', 'cover');
		}else{
			notificacionmesa.show('Mandar a ' + results[0]['login'] + ' a ' + mesa, "warning");
			document.getElementById('sonido_mesas').play();
			$('#'+codigomesa).css('background', 'url(/images/alert-mozo.jpg)');
			$('#'+codigomesa).css('background-size', 'cover');
		}
	}
}
//finnotificaciones

//actulizarpedidosmesa
function actulizarpedidosmesa(idpedido, usuario){
	var mesaid;
	$.ajax({
		url: '/pedidomesa',
		type: 'POST',
		dataType: 'json',
		data: {idpedido: idpedido},
	})
	.done(function(data) {
		mesaid= data['mesa_id'];
		if($('#infomesa').attr('data-id') == mesaid){
			if($('#usuario').attr('user_id')!= usuario){
				location.reload();
			}
		}else{
			$('.btn_mesascajas').filter(function(index) {
				return $(this).attr('data-id') == mesaid;
			}).addClass('O');
			$('.btn_mesascajas').filter(function(index) {
				return $(this).attr('data-id') == mesaid;
			}).attr('data-estado', 'O');
		}
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
}
//finactulizarpedidosmesa

//actulizarestados todos
	function actulizarestadosall(data){
		var estado = data['estado'];
		var preestado = '';
		if(data['estado'] == 'P'){
			prestado = 'I';
		}else if (data['estado'] == 'E'){
			prestado = 'P';
		}else if (data['estado'] == 'D') {
			prestado = 'E';
		};	
		var oitempedido = $('.'+prestado).filter(function(index) {
			return $(this).attr('data-iddetped') == data['iddetallep'];
		});
		oitempedido.removeClass(prestado);
		oitempedido.addClass(data['estado']);
		oitempedido.attr('data-estado', data['estado']);
		if(estado == 'C'){
			estado = 'I';
		}
		oitempedido.find('img').attr('src', '/images/'+estado+'.png');

		if (data['adicionales'] !== null) {
			for (var i in data['adicionales']) {
				console.log(data['adicionales'][i]['iddetallep']);

				var estadoA = data['adicionales'][i]['estado'];
				var preestadoA = '';
				if(data['adicionales'][i]['estado'] == 'P'){
					prestadoA = 'I';
				}else if (data['adicionales'][i]['estado'] == 'E'){
					prestadoA = 'P';
				}else if (data['adicionales'][i]['estado'] == 'D') {
					prestadoA = 'E';
				};	
				var oitempedidoA = $('.'+prestadoA).filter(function(index) {
					return $(this).attr('data-iddetped') == data['adicionales'][i]['iddetallep'];
				});
				oitempedidoA.removeClass(prestado);
				oitempedidoA.addClass(data['adicionales'][i]['estado']);
				oitempedidoA.attr('data-estado', data['adicionales'][i]['estado']);
				if(estadoA == 'C'){
					estadoA = 'I';
				}
				oitempedidoA.find('img').attr('src', '/images/'+estadoA+'.png');
			}

			
		};

	}
//finactulizarestados todos

	var template_controlpedidos = kendo.template($('#refresh_listcontrolpedidos').html());



function actulizarcontrolpedidos(){
	$.ajax({
		url: '/controlpedidos',
		type: 'GET',
		dataType: 'json'
	})
	.done(function(data) {
		$('#lista_controlpedidos').html(template_controlpedidos({listaplatos: data}));
		$('.timeago').timeago('refresh');
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
}

function notificacionespedidos(data){
	if(data['estado'] == 'E'){
		notificationpedido.show({
                            mesa: data['mesa'],
                            mozo: data['usuario'],
                            producto: data['producto'] 
                        }, "info");
		popupNotification.show('Platos por recoger', "warning");
		document.getElementById('sonido_recibirpedido').play();
	}
}
$('#btn_notificaciones').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	$('#windowsnotificaciones').data("kendoWindow").open();
});
//finnotificaciones

//cerrarcaja
$('input[name=arqueo]').on('change', function(event) {
	event.preventDefault();
	var newarqueo = parseFloat($(this).val());
	var newdiferencia = parseFloat($('input[name=importetotal]').val()) - newarqueo;
	$('input[name=arqueo]').val(newarqueo.toFixed(2))
	$('input[name=diferencia]').val(newdiferencia.toFixed(2));
});
//fincerrarcaja

$('#btn_salirmesa').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	window.location.href = '/cajas';
});
    $("#tabstrip").kendoTabStrip({
        animation:  {
            open: {
                effects: "fadeIn"
            }
        }
    });

	$('.btn_mesascajas').on('click', function(event) {
		event.preventDefault();
		var idmesa = $(this).attr('data-id');
		if($(this).attr('data-estado') == 'O'){
			window.location.href = '/cajas/cargarmesa/' + idmesa;
		}else{
			//alert('entro');
            //cargar con mozo por defecto caja
			//window.location.href = '/cajas/cargarmesa/' + idmesa + '/21';
            $.ajax({
                url: '/traermozos',
                type: 'POST',
                dataType: 'json',
                data: {idres: 2},
            })
                .done(function(data) {
                    var contenido = '';
                    for(var i in data) {
                        contenido += '<li class="list-group-item"><input value ="'+data[i]['id']+'" type="radio" name="line-radio"><label>';
                        contenido += data[i]['login']+'</label></li>';
                    };
                    $('.listamozos').html(contenido);
                    checkbox ();
                    $('.modalwindow').data("kendoWindow").open();
                    $('.modalwindow').data("kendoWindow").center();
                    $('#btn_aceptar_mozo').attr('data-idmesa',idmesa);
                });
		}
	});
	$('#btn_cancelar_mozo').on('click', function(event) {
		event.preventDefault();
		$('.modalwindow').data("kendoWindow").close();
	});
	$('#btn_aceptar_mozo').on('click', function(event) {
		event.preventDefault();
		window.location.href = '/cajas/cargarmesa/' + $(this).attr('data-idmesa')+'/'+$('input[name=line-radio]:checked').val();
	});
	$(".modalwindow").kendoWindow({
  				actions: ["Close"],
  				visible: false,
  				modal: true,
  				title: 'Elegir Mozo',
  				resizable: false,
  				width: '250px',
  				animation: false
	});

//actulizar estados
$('#productosenviados').on('click', '.E', function(event) {
	event.preventDefault();
	/* Act on the event */
	var oitem = $(this);
     if($(this).attr('data-estado') == 'E'){
     	actulizarestados($(this).attr('data-estado'), $(this).attr('data-iddetped'));
     }
});

$('#lista_controlpedidos').on('click', '.E', function(event) {
	event.preventDefault();
	/* Act on the event */
	var oitem = $(this);
     if($(this).attr('data-estado') == 'E'){
     	actulizarestados($(this).attr('data-estado'), $(this).attr('data-iddetped'));
     }
});

function actulizarestados(estado, iddetalle){
    $.ajax({
        type: 'POST',
        url: '/mozonotificaciones',
        dataType: "json",
        data:{estado: estado, iddetallep: iddetalle},
        success: function(data){
        	socket.emit('NotificarPedidos', data, data['areapro']);
        	verificartiempomozos();
        }
    });
}

//fin actulizar estados

//Tiemposenmesa
function tiempoenmesa(){
	$('.tiempoenmesa').each(function(index, el) {
		var idpedido = $(this).attr('data-idpedido');

		$.ajax({
			url: '/dev/tiempoenmesa',
			type: 'POST',
			dataType: 'json',
			data: {idpedido: idpedido},
		})
		.done(function(data) {
			console.log(data);
			if(data['tiempo'].length > 0){
				$('#mesa_'+idpedido).text(data['tiempo']);
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});
}
tiempoenmesa();
setInterval(tiempoenmesa,60000);
//fintiemposenmesa

})