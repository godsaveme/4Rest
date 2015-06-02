$(function(){


var socket = io.connect('http://'+window.location.host+':3000');
socket.on("Recibirpedidos", recibirpedido);
socket.on('ActulizarestadoAll', actulizarestadosall);
function recibirpedido(){
	location.reload();
}

$('#btn_aceparea').on('click',function(event) {
		event.preventDefault();
		window.location.href = '/monitores/area/'+$('#select_areaid').val();
});

$.fn.timeago.defaults = {
    selector: 'time.timeago',
    attr: 'datetime',
    dir: 'up',
    lang: {
      units: {
      second: "s",
      seconds: "s",
      minute: "m",
      minutes: "m",
      hour: "h",
      hours: "hs",
      day: "d",
      days: "ds",
      month: "m",
      months: "ms",
      year: "y",
      years: "ys"
    },
    prefixes: {
      lt: "-",
      about: " ",
      over: "+",
      almost: " ",
      ago: " "
    },
    suffix: ""
    }
  };


$('body').timeago();

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
			if(data['respuesta'] == true){
				if(data['tiempo'].length > 0){
					$('#mesa_'+idpedido).text(data['tiempo']);
				}
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
	}
//finactulizarestados todos

})