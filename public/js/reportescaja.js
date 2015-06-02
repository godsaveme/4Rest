$(function(){


var datareporte = new kendo.data.DataSource({
							  data: [ ],
							  schema: {
							    model: { id: "id" }
							  }
							});

var start = $("#fecha_inicio").kendoDatePicker({
                        format: "yyyy-MM-dd"
                    }).data("kendoDatePicker");

$("#fecha_fin").kendoDatePicker({
    format: "yyyy-MM-dd"
}).data("kendoDatePicker");
$('#btn_enviarfechasvd').on('click',function(){
    //window.location.href = '/reportes/vales-descuentos/2?fechainicio='+$('#fecha_inicio').val()+'&fechafin='+$('#fecha_fin').val();
    window.location.href = window.location.href+'?fechainicio='+$('#fecha_inicio').val()+'&fechafin='+$('#fecha_fin').val();
  
});

var viewModel_reportecajadiario = kendo.observable({
     datosreporte: datareporte,
	totalefectivo:function(){
		var sum = 0;
        var data = datareporte.data();
        for (var i = data.length - 1; i >= 0; i--) {
        	sum += parseFloat(data[i]['totalefectivo']);
        };
        return sum.toFixed(2);
	},
	totaltarjeta: function(){
		var sum = 0;
        var data = datareporte.data();
        for (var i = data.length - 1; i >= 0; i--) {
        	sum += parseFloat(data[i]['totaltarjeta']);
        };
        return sum.toFixed(2);
	},
    totalvale: function(){
        var sum = 0;
        var data = datareporte.data();
        for (var i = data.length - 1; i >= 0; i--) {
            sum += parseFloat(data[i]['totalvale']);
        };
        return sum.toFixed(2);
    },
    totaldsctoAut: function(){
        var sum = 0;
        var data = datareporte.data();
        for (var i = data.length - 1; i >= 0; i--) {
            sum += parseFloat(data[i]['totaldsctoAut']);
        };
        return sum.toFixed(2);
    },
    totalImProm: function(){
        var sum = 0;
        var data = datareporte.data();
        for (var i = data.length - 1; i >= 0; i--) {
            sum += parseFloat(data[i]['totalImProm']);
        };
        return sum.toFixed(2);
    },
	totalventas: function(){
		var sum = 0;
        var data = datareporte.data();
        for (var i = data.length - 1; i >= 0; i--) {
        	sum += parseFloat(data[i]['totalventas']);
        };
        return sum.toFixed(2);
	},
	totalabonosacaja: function(){
		var sum = 0;
        var data = datareporte.data();
        for (var i = data.length - 1; i >= 0; i--) {
        	sum += parseFloat(data[i]['ingresoscaja']);
        };
        return sum.toFixed(2);
	},
	totalgastos: function(){
		var sum = 0;
        var data = datareporte.data();
        for (var i = data.length - 1; i >= 0; i--) {
        	sum += parseFloat(data[i]['gastos']);
        };
        return sum.toFixed(2);
	},
	totalventas: function() {
		var sum = 0;
        var data = datareporte.data();
        for (var i = data.length - 1; i >= 0; i--) {
        	sum += parseFloat(data[i]['totalventas']);
        };
        return sum.toFixed(2);
    },
    montoinicial: function(){
        var sum = 0;
        var data = datareporte.data();
        for (var i = data.length - 1; i >= 0; i--) {
            sum += parseFloat(data[i]['fondodecaja']);
        };
        return sum.toFixed(2);
    },
    diferencias: function(){
    	var sum = 0;
        var data = datareporte.data();
        for (var i = data.length - 1; i >= 0; i--) {
        	sum += parseFloat(data[i]['dif']);
        }
        return sum.toFixed(2);
    },
    ticketemitidos: function(){
    	var sum = 0;
        var data = datareporte.data();
        for (var i = data.length - 1; i >= 0; i--) {
        	sum += parseFloat(data[i]['totaltickets']);
        };
        return sum.toFixed(0);
    },
    anulados: function(){
    	var sum = 0;
        var data = datareporte.data();
        for (var i = data.length - 1; i >= 0; i--) {
        	sum += parseFloat(data[i]['totalanulados']);
        };
        return sum.toFixed(0);
    },
    totalfondocaja: function(){
        var sum = 0;
        var data = datareporte.data();
        for (var i = data.length - 1; i >= 0; i--) {
            sum += parseFloat(data[i]['fondodecaja']);
        };
        return sum.toFixed(2);
    },
    totalproductos: function(){
    	var sum = 0;
        var data = datareporte.data();
        for (var i = data.length - 1; i >= 0; i--) {
        	sum += parseFloat(data[i]['tproductos']);
        };
        return sum.toFixed(0);
    },
    rango: function(){
        var data = datareporte.data();
        var ticketini = 0;
        var ticketfin = 0;
        if(data.length > 0){
            ticketini = data[0]['tinicial'];
            ticketfin = data[data.length - 1]['tfinal']; 
        }
        var inifin = ticketini+'/'+ ticketfin;
        return inifin;
    },
    totaldescuento: function(){
        var sum = 0;
        var data = datareporte.data();
        for (var i = data.length - 1; i >= 0; i--) {
            sum += parseFloat(data[i]['totaldescuentos']);
        };
        return sum.toFixed(2);
    },
    identificador: function(){
        var identifier = 0;
        var data = datareporte.data();
        if(data.length > 0){
            identifier = data[0]['cajaid'];
        }

        return identifier;
    },
    fechainicio:function(){
        var fecha = $('#fecha_inicio').val();
        return fecha;
    },
    fechafin:function(){
        var fecha = $('#fecha_inicio').val();
        return fecha;
    },
    turno:function(a){
        var dato;
        var data = datareporte.data();
        if(data.length > 0){
            var dataitem = datareporte.at(a);
            if(dataitem){
                dato = dataitem.turno;
            }else{
                dato = '-';
            }  
        }else{
            dato = '-';
        }
        console.log(data.length);
        return dato;
    },
    responsable: function(a){
        var dato;
        var data = datareporte.data();
        if(data.length > 0){
            var dataitem = datareporte.at(a);
            if(dataitem){
                dato = dataitem.usuario;
            }else{
                dato = '-';
            }
        }else{
            dato = '-';
        }
        return dato;
    },
    venta:function(a){
        var dato;
        var data = datareporte.data();
        if(data.length > 0){
            var dataitem = datareporte.at(a);
            if(dataitem){
                dato = dataitem.totalventas;
            }else{
                dato = (0).toFixed(2);
            }
        }else{
            dato = (0).toFixed(2);
        }
        return dato;
    },
    efectivo:function(a){
        var dato;
        var data = datareporte.data();
        if(data.length > 0){
            var dataitem = datareporte.at(a);
            if(dataitem){
                dato = dataitem.totalefectivo;
            }else{
                dato = (0).toFixed(2);
            }
        }else{
            dato = (0).toFixed(2);
        }
        return dato;
    },
    tarjeta: function(a){
        var dato;
        var data = datareporte.data();
        if(data.length > 0){
            var dataitem = datareporte.at(a);
            if(dataitem){
                dato = dataitem.totaltarjeta;
            }else{
                dato = (0).toFixed(2);
            }
        }else{
            dato = (0).toFixed(2);
        }
        return dato;

    },
    descuentos: function(a){
        var dato;
        var data = datareporte.data();
        if(data.length > 0){
            var dataitem = datareporte.at(a);
            if(dataitem){
                dato = dataitem.totaldescuentos;
            }else{
                dato = (0).toFixed(2);
            }
        }else{
            dato = (0).toFixed(2);
        }
        return dato;

    },
    valePersonal: function(a){
        var dato;
        var data = datareporte.data();
        if (data.length > 0) {
            var dataitem = datareporte.at(a);
            if (dataitem) {
                dato = dataitem.totalvale;
            }else{
                dato = (0).toFixed(2);
            }
        }else{
            dato = (0).toFixed(2);
        }
        return dato;
        
    }, 
    descuentoautorizado: function(a){
        var dato;
        var data = datareporte.data();
        if(data.length > 0){
            var dataitem = datareporte.at(a);
            if(dataitem){
                dato = dataitem.totaldsctoAut;
            }else{
                dato = (0).toFixed(2);
            }
        }else{
            dato = (0).toFixed(2);
        }
        return dato;

    },
    importePromocional: function(a){
        var dato;
        var data = datareporte.data();
        if(data.length > 0){
            var dataitem = datareporte.at(a);
            if(dataitem){
                dato = dataitem.totalImProm;
            }else{
                dato = (0).toFixed(2);
            }
        }else{
            dato = (0).toFixed(2);
        }
        return dato;

    },

    cajaid: function(a){
        var dato;
        var data = datareporte.data();
        if(data.length > 0){
            var dataitem = datareporte.at(a);
            if(dataitem){
                dato = dataitem.cajaid;
            }else{
                dato = 0;
            }
        }else{
            dato = 0;
        }
        return dato;

    },
    fondocaja: function(a){
        var dato;
        var data = datareporte.data();
        if(data.length > 0){
            var dataitem = datareporte.at(a);
            if(dataitem){
                dato = dataitem.fondodecaja;
            }else{
                dato = (0).toFixed(2);
            }
        }else{
            dato = (0).toFixed(2);
        }
        return dato;

    },
    diferencia: function(a){
        var dato;
        var data = datareporte.data();
        if(data.length > 0){
            var dataitem = datareporte.at(a);
            if(dataitem){
                dato = dataitem.dif;
            }else{
                dato = (0).toFixed(2);
            }
        }else{
            dato = (0).toFixed(2);
        }
        return dato;

    },
    producto: function(a){
        var dato;
        var data = datareporte.data();
        if(data.length > 0){
            var dataitem = datareporte.at(a);
            if(dataitem){
                dato = dataitem.tproductos;
            }else{
                dato = 0;
            }
        }else{
            dato = 0;
        }
        return dato;

    },
    ticket: function(a){
        var dato;
        var data = datareporte.data();
        if(data.length > 0){
            var dataitem = datareporte.at(a);
            if(dataitem){
                dato = dataitem.totaltickets;
            }else{
                dato = 0;
            }
        }else{
            dato = 0;
        }
        return dato;

    },
    anulado: function(a){
        var dato;
        var data = datareporte.data();
        if(data.length > 0){
            var dataitem = datareporte.at(a);
            if(dataitem){
                dato = dataitem.totalanulados;
            }else{
                dato = 0;
            }
        }else{
            dato = 0;
        }
        return dato;

    }
});

kendo.bind($("#reportediariocaja"), viewModel_reportecajadiario);


$('#btn_enviarfechas').on('click', function(event) {
    event.preventDefault();
    /* Act on the event */
    datareporte.data([]);
    $.ajax({
        url: '/reportediariocaja',
        type: 'POST',
        dataType: 'json',
        data: {idrest: $('#restauranteinfo').attr('data-id'), 
                fechainicio: $('#fecha_inicio').val(), 
                fechafin: $("#fecha_inicio").val()},
    })
    .done(function(data) {
        datareporte.data(data);
        $('#text_fechainicio').text($('#fecha_inicio').val());
        $('#text_fechafin').text($("#fecha_inicio").val());
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
});

$('body').on('click', '#btn_imprimircajadiario', function(event) {
    event.preventDefault();
    /* Act on the event */
    $.ajax({
        url: '/imprimirdiariocaja',
        type: 'POST',
        dataType: 'json',
        data: {totalefectivo: $('#totalefectivo').text(),
               totaltarjeta: $('#totaltarjeta').text(),
            totalimprom: $('#totalImProm').text(),
                totalvale:$('#totalvale').text(),
                totaldsctoaut: $('#totaldsctoAut').text(),
                totaldscto: $('#totaldescuentos').text(),
                totalventas: $('#totalventas').text(),
                totalgastos:$('#totalgastos').text(),
                totalabonosacaja:$('#totalabonosacaja').text(),
                totalcaja:$('#totalcaja').text(),
                arqueo:$('#arqueo').text(),
                diferencia:$('#diferencia').text(),
                anulados:$('#tanulados').text(),
                emitidos: $('#temitidos').text(),
                pvendidos: $('#pvendidos').text(),
                fecha: $('#text_fechainicio').text()+'/'+$('#text_fechafin').text(),
                rango: $('#rangoti').text()}
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

})