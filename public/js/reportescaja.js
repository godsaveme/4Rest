var datareporte = new kendo.data.DataSource({
							  data: [ ],
							  schema: {
							    model: { id: "id" }
							  }
							});
$("#datepicker").kendoDatePicker({change: reportediario, format: "dd/MM/yyyy"});

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

function reportediario () {
    $('#fecha_caja').text($("#datepicker").val());
	datareporte.data([]);
	$.ajax({
		url: '/reportediariocaja',
		type: 'POST',
		dataType: 'json',
		data: {idrest: $('#restauranteinfo').attr('data-id'), fecha: kendo.toString(this.value(), 'd')},
	})
	.done(function(data) {
		datareporte.data(data);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
}

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
                fecha: $('#fecha_caja').text(),
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