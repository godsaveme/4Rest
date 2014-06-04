var socket = io.connect('http://'+window.location.host+':3000');
socket.on("Recibirpedidos", recibirpedido);

$('.hora').each(function(){
        id = $(this).find('div').attr('id');
        hora = $(this).attr('data-fechai').split(",");
        $('#'+id).countup({
            start: new Date(hora[0],hora[1],hora[2],hora[3],hora[4],hora[5])
        });
        $('.countDays').remove();
        $('.countDiv0').remove();
});
var template_cocina = kendo.template($("#template_platoscocina").html())

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
$('#contaitnerplatos').on('click', '.list-group-item', function(){
     var oitem = $(this);
     if($(this).attr('data-estado') == 'I' || $(this).attr('data-estado') == 'C'){
        restarplatospanel($(this).attr('data-idpro'), $(this).find('span').text());
     }
     actulizarestados($(this).attr('data-estado'), $(this).attr('data-iddetped'));
});

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

$('body').on('click','#platospanel li', function(){
    var oplato = $(this);
    $('.bullet-item').filter(function() {
        if($(this).attr('data-idpro') == oplato.attr('data-idpro')){
            if($(this).attr('data-estado')== 'C' || $(this).attr('data-estado')== 'I'){
                actulizarestados($(this).attr('data-estado'), $(this).attr('data-iddetped'));
            }
        }
    });
    $(this).remove();
});

$('body').on('dblclick', '.title', function(event) {
    var oparent = $(this).parent();
    oparent.children('.bullet-item').each(function() {
        restarplatospanel($(this).attr('data-idpro'), $(this).find('span').text());
        actulizarestados('P', $(this).attr('data-iddetped'));
    });
});


function actulizarestados(estado, iddetalle){
    $.ajax({
        type: 'POST',
        url: '/mozonotificaciones',
        dataType: "json",
        data:{estado: estado, iddetallep: iddetalle},
        success: function(data){
            if(data['estado']){
            $('.list-group-item').each(function(){
                if($(this).attr('data-iddetped') == data['iddetallep']){
                    $(this).removeClass($(this).attr('data-estado'));
                    $(this).addClass(data['estado']);
                    if(data['estado'] == 'E'){
                    $(this).remove();
                    contarli();
                    }else{
                        $(this).attr('data-estado', data['estado']);
                    }
                }
            });
            }
            notificarpedidos(data, 1, data['areapro']);
        }
    });
}

function restarplatospanel(id, canti){
     var flag = $("#platospanel li").filter(function() {
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