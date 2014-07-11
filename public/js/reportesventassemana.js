var datareporte = new kendo.data.DataSource({
							  data: [ ]
							});

var viewModel_reporteventasemanal = kendo.observable({
	ventatotal:function(){
		var ventasemana = 0;
		var data = datareporte.data();
		for (var i = data.length - 1; i >= 0; i--) {
        	ventasemana += parseFloat(data[i]['total']);
        };
        return ventasemana.toFixed(2);
	},
	ventalunes:function(){
		var ventasemana = 0;
		var data = datareporte.data();
		for (var i = data.length - 1; i >= 0; i--) {
			if (data[i]['Lunes'] != '-') {
				ventasemana += parseFloat(data[i]['Lunes']);
			}
        };
        return ventasemana.toFixed(2);
	},
	ventamartes:function(){
		var ventasemana = 0;
		var data = datareporte.data();
		for (var i = data.length - 1; i >= 0; i--) {
        	if (data[i]['Martes'] != '-') {
				ventasemana += parseFloat(data[i]['Martes']);
			}
        };
        return ventasemana.toFixed(2);
	},
	ventamiercoles:function(){
		var ventasemana = 0;
		var data = datareporte.data();
		for (var i = data.length - 1; i >= 0; i--) {
        	if (data[i]['Miercoles'] != '-') {
				ventasemana += parseFloat(data[i]['Miercoles']);
			}
        };
        return ventasemana.toFixed(2);
	},
	ventajueves:function(){
		var ventasemana = 0;
		var data = datareporte.data();
		for (var i = data.length - 1; i >= 0; i--) {
        	if (data[i]['Jueves'] != '-') {
				ventasemana += parseFloat(data[i]['Jueves']);
			}
        };
        return ventasemana.toFixed(2);
	},
	ventaviernes:function(){
		var ventasemana = 0;
		var data = datareporte.data();
		for (var i = data.length - 1; i >= 0; i--) {
        	if (data[i]['Viernes'] != '-') {
				ventasemana += parseFloat(data[i]['Viernes']);
			}
        };
        return ventasemana.toFixed(2);
	},
	ventasabado:function(){
		var ventasemana = 0;
		var data = datareporte.data();
		for (var i = data.length - 1; i >= 0; i--) {
        	if (data[i]['Sabado'] != '-') {
				ventasemana += parseFloat(data[i]['Sabado']);
			}
        };
        return ventasemana.toFixed(2);
	},
	ventadomingo:function(){
		var ventasemana = 0;
		var data = datareporte.data();
		for (var i = data.length - 1; i >= 0; i--) {
        	if (data[i]['Domingo'] != '-') {
				ventasemana += parseFloat(data[i]['Domingo']);
			}
        };
        return ventasemana.toFixed(2);
	},
    datosreporte: datareporte
});

kendo.bind($("#reportesemanal"), viewModel_reporteventasemanal);

$('#btn_summitinfo').on('click',function(event) {
	event.preventDefault();
	/* Act on the event */
	datareporte.data([]);
	$.ajax({
		url: '/reporteventassemanales',
		type: 'POST',
		dataType: 'json',
		data: {year: $('#year').val(), semana: $('#semana').val(), idrest: $('#restauranteinfo').attr('data-id')},
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
	
});

$('#btn_summitinfo2').on('click',function(event) {
	event.preventDefault();
	/* Act on the event */
	datareporte.data([]);
	$.ajax({
		url: '/reporteventasunidadessemanales',
		type: 'POST',
		dataType: 'json',
		data: {year: $('#year').val(), semana: $('#semana').val(), idrest: $('#restauranteinfo').attr('data-id')},
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
	
});

function totalventasporcentaje(){
	var ventasemana = 0;
		var data = datareporte.data();
		for (var i = data.length - 1; i >= 0; i--) {
        	ventasemana += parseFloat(data[i]['total']);
        };
        return ventasemana.toFixed(2);
}