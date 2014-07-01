var datareporte = new kendo.data.DataSource({
							  data: [ ],
							  schema: {
							    model: { id: "id" }
							  }
							});

var start = $("#fecha_inicio").kendoDatePicker({
                        format: "yyyy-MM-dd",
                        change: startChange
                    }).data("kendoDatePicker");

var end = $("#fecha_fin").kendoDatePicker({
    format: "yyyy-MM-dd",
    change: endChange
}).data("kendoDatePicker");

function startChange() {
    var startDate = start.value(),
    endDate = end.value();

    if (startDate) {
        startDate = new Date(startDate);
        startDate.setDate(startDate.getDate());
        end.min(startDate);
    } else if (endDate) {
        start.max(new Date(endDate));
    } else {
        endDate = new Date();
        start.max(endDate);
        end.min(endDate);
    }
}

function endChange() {
    var endDate = end.value(),
    startDate = start.value();

    if (endDate) {
        endDate = new Date(endDate);
        endDate.setDate(endDate.getDate());
        start.max(endDate);
    } else if (startDate) {
        end.min(new Date(startDate));
    } else {
        endDate = new Date();
        start.max(endDate);
        end.min(endDate);
    }
}


var viewModel_reportecajadiario = kendo.observable({
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
        var montoinicial = 0;
        var data = datareporte.data();
        if(data.length > 0){
            montoinicial = data[0]['fondodecaja'];
        }
        return montoinicial;
    },
    diferencia: function(){
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
    datosreporte: datareporte
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
                fechafin: $('#fecha_fin').val()},
    })
    .done(function(data) {
        datareporte.data(data);
        $('#text_fechainicio').text($('#fecha_inicio').val());
        $('#text_fechafin').text($('#fecha_fin').val());
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
                totalvale:$('#totalvale').text(),
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
                rango: $('#rangoti').text()},
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