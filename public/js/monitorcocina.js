var socket = io.connect('http://'+window.location.host+':3000');
socket.emit('loginuser',$('#usuario').text(), 
          $('#area').text()+'_'+$('#area').attr('data-ida'), 
          $('#usuario').attr('user_id'));
socket.on("Conectado", conectado);
function conectado(mensaje){
    console.log(mensaje);
}

$('body').timeago();
socket.on("Recibirpedidos", recibirpedido);
socket.on('ActulizarestadoAll', actulizarestadosall);

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
        oitempedido.find('img').attr('src', '/images/'+estado+'.png');
        if(data['estado'] == 'E'){
            restarplatospanel(data['proid'], data['cantidad']);
            oitempedido.remove();
            contarli();
        }
    }
//finactulizarestados todos

$('.hora').each(function(){
        id = $(this).find('div').attr('id');
        hora = $(this).attr('data-fechai').split(",");
        $('#'+id).countup({
            start: new Date(hora[0],hora[1],hora[2],hora[3],hora[4],hora[5])
        });
        $('.countDays').remove();
        $('.countDiv0').remove();
});
var template_cocina = kendo.template($("#template_platoscocina").html());

function recibirpedido(datos, mesa, pedido){
    var orden;
    var datostemplate = {};
    console.log(datos);
     for (var i in datos) {
         if (datos[i]['cocina'] == $('#area').text()+'_'+$('#area').attr('data-ida')) {
            orden = datos[i]['orden'];
        }
     };
	$.ajax({
            type: 'POST',
            url: '/enviarcocina',
            dataType: "json",
            data:{orden:orden, pedido:pedido, idarea : $('#area').attr('data-ida')},
            success: function (data) {
                datostemplate['mesa'] = mesa;
                datostemplate['pedidoid'] = pedido;
                datostemplate['orden'] = orden;
                datostemplate['platos'] = data;
                var fecha=new Date();
                var dia = corregirtiempo(fecha.getDate());
                var mes = corregirtiempo(parseInt(fecha.getMonth()) + 1);
                var hora = corregirtiempo(fecha.getHours());
                var minuto = corregirtiempo(fecha.getMinutes());
                var segundo = corregirtiempo(fecha.getSeconds());
                datostemplate['cronometro'] = fecha.getFullYear()+'-'+mes+'-'+dia+'T'+hora+':'+minuto+':'+segundo;
                if (data.length > 0) {
                    $('#contaitnerplatos').append(template_cocina(datostemplate));
                }
                $('.timeago').timeago('refresh');
                $('.countDays').remove();
                $('.countDiv0').remove();
                for (var i in data) {
                    sumarplatospanel(data[i]['productoid'], data[i]['cantidad'], data[i]['nombre']);
                }
            }
    });
}



function corregirtiempo(valor){
    if (valor < 10) {
        valor = '0'+valor;
        return valor;
    }else{
        return valor;
    }
}

//notificaciones a mozos
function notificarpedidos(data, tipo, area){
    socket.emit('NotificarPedidos', data, area);
}

function contarli(){
    var cantli = 0 ;
    $('.panel-info').each(function(){
        olistgroup = $(this).children(".list-group");
        cantli = olistgroup.children('.list-group-item').size()
        if(cantli == 0){
            $(this).parent().remove();
        }
    });
}

function actulizarestados(estado, iddetalle){
    $.ajax({
        type: 'POST',
        url: '/mozonotificaciones',
        dataType: "json",
        data:{estado: estado, iddetallep: iddetalle},
        success: function(data){
            notificarpedidos(data, 1, data['areapro']);
            verficiaresperapedidos();
        }
    });
}

var template_panelplatoscocina = kendo.template($("#template_platospanel").html());

function sumarplatospanel(id, canti, nombre){
    var flag = $("#panel_platosacumulados li").filter(function() {
                return $(this).attr('data-idpro') == id;
                });
    if (flag.attr('data-idpro') >= 0) {
        cantidad = parseInt(flag.find('span').text()) + parseInt(canti);
        flag.find('span').text(cantidad);
    }else{
        var datos = {};
        datos['nombre']= nombre;
        datos['producto_id']= id;
        datos['cantidad']= canti;
        $("#panel_platosacumulados").append(template_panelplatoscocina(datos));
    }
}

function restarplatospanel(id, canti){
     var flag = $("#panel_platosacumulados li").filter(function() {
                return $(this).attr('data-idpro') == id;
                });
        if(flag){
            cantidad = parseInt(flag.find('span').text()) - parseInt(canti);
            if(cantidad >= 1){
                flag.find('span').text(cantidad);
            }else{
                flag.remove();
            }
        }
}

function verficiaresperapedidos() {
    var contadorespera = $('#contaitnerplatos .I').length;
    if(contadorespera > 0){
        socket.emit('TiemposCocina', $('#area').attr('data-ida'), $('#usuario').text());
    }
}
setInterval(verficiaresperapedidos,60000);

socket.on("NotificacionDemora", notificaciondemora);

function notificaciondemora(data){
    if (data[0]['TiempoEspera'] >= 2){
            }else{
        
    }
}