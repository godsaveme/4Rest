


var datareporte = new kendo.data.DataSource({
							  data: [ ]
							});
$('#restauranteinfo').data('idtipo', '0');
$('#restauranteinfo').data('tipobusqueda', '0');

$(function(){
var viewModel_reporteventasemanal = kendo.observable({
	ventatotal:function(){
		var ventasemana = 0;
		var data = datareporte.data();
		for (var i = data.length - 1; i >= 0; i--) {
        	ventasemana += parseFloat(data[i]['total']);
        };
        if($('#restauranteinfo').data('solesunidades') == 1){
        return ventasemana.toFixed(2);
    	}else{
    		return ventasemana;
    	}
	},
	ventalunes:function(){
		var ventasemana = 0;
		var data = datareporte.data();
		for (var i = data.length - 1; i >= 0; i--) {
			if (data[i]['Lunes'] != '-') {
				ventasemana += parseFloat(data[i]['Lunes']);
			}
        };
        if($('#restauranteinfo').data('solesunidades') == 1){
        return ventasemana.toFixed(2);
    	}else{
    		return ventasemana;
    	}
	},
	ventamartes:function(){
		var ventasemana = 0;
		var data = datareporte.data();
		for (var i = data.length - 1; i >= 0; i--) {
        	if (data[i]['Martes'] != '-') {
				ventasemana += parseFloat(data[i]['Martes']);
			}
        };
        if($('#restauranteinfo').data('solesunidades') == 1){
        return ventasemana.toFixed(2);
    	}else{
    		return ventasemana;
    	}
	},
	ventamiercoles:function(){
		var ventasemana = 0;
		var data = datareporte.data();
		for (var i = data.length - 1; i >= 0; i--) {
        	if (data[i]['Miercoles'] != '-') {
				ventasemana += parseFloat(data[i]['Miercoles']);
			}
        };
        if($('#restauranteinfo').data('solesunidades') == 1){
        return ventasemana.toFixed(2);
    	}else{
    		return ventasemana;
    	}
	},
	ventajueves:function(){
		var ventasemana = 0;
		var data = datareporte.data();
		for (var i = data.length - 1; i >= 0; i--) {
        	if (data[i]['Jueves'] != '-') {
				ventasemana += parseFloat(data[i]['Jueves']);
			}
        };
        if($('#restauranteinfo').data('solesunidades') == 1){
        return ventasemana.toFixed(2);
    	}else{
    		return ventasemana;
    	}
	},
	ventaviernes:function(){
		var ventasemana = 0;
		var data = datareporte.data();
		for (var i = data.length - 1; i >= 0; i--) {
        	if (data[i]['Viernes'] != '-') {
				ventasemana += parseFloat(data[i]['Viernes']);
			}
        };
        if($('#restauranteinfo').data('solesunidades') == 1){
        return ventasemana.toFixed(2);
    	}else{
    		return ventasemana;
    	}
	},
	ventasabado:function(){
		var ventasemana = 0;
		var data = datareporte.data();
		for (var i = data.length - 1; i >= 0; i--) {
        	if (data[i]['Sabado'] != '-') {
				ventasemana += parseFloat(data[i]['Sabado']);
			}
        };
        if($('#restauranteinfo').data('solesunidades') == 1){
        return ventasemana.toFixed(2);
    	}else{
    		return ventasemana;
    	}
	},
	ventadomingo:function(){
		var ventasemana = 0;
		var data = datareporte.data();
		for (var i = data.length - 1; i >= 0; i--) {
        	if (data[i]['Domingo'] != '-') {
				ventasemana += parseFloat(data[i]['Domingo']);
			}
        };
        if($('#restauranteinfo').data('solesunidades') == 1){
        return ventasemana.toFixed(2);
    	}else{
    		return ventasemana;
    	}
	},
    datosreporte: datareporte
});

kendo.bind($("#reportesemanal"), viewModel_reporteventasemanal);

$('#btn_summitinfo').on('click',function(event) {
	event.preventDefault();
	/* Act on the event */
	$('#restauranteinfo').data('solesunidades', '1');
	datareporte.data([]);
	solestipocombinacion();
});

$('#btn_summitinfo2').on('click',function(event) {
	event.preventDefault();
	/* Act on the event */
	$('#restauranteinfo').data('solesunidades', '2');
	datareporte.data([]);
	unidadestipocombinacion();
});



$('body').on('click', '.familias', function(event) {
	event.preventDefault();
	/* Act on the event */
	var idbusqueda = $(this).attr('data-id');
	datareporte.data([]);
	if($('#restauranteinfo').data('solesunidades') == 1){
		if($('#restauranteinfo').data('tipobusqueda') == 0){
		solesfamilias(idbusqueda);
		}else if($('#restauranteinfo').data('tipobusqueda') == 1){
			solesproductos(idbusqueda);
		}
	}else if($('#restauranteinfo').data('solesunidades') == 2){
		if($('#restauranteinfo').data('tipobusqueda') == 0){
			unidadesfamilias(idbusqueda);
		}else if($('#restauranteinfo').data('tipobusqueda') == 1){
			unidadesproductos(idbusqueda);
		}
	}
});

function solestipocombinacion(){
	$('#btn_summitinfo').css('display', 'inline-block');
	$('#btn_summitinfo2').css('display', 'inline-block');
	$('#btn_regresar').css('display', 'none');
	$.ajax({
		url: '/reporteventassemanales',
		type: 'POST',
		dataType: 'json',
		data: {year: $('#year').val(), semana: $('#semana').val(), idrest: $('#restauranteinfo').attr('data-id')},
	})
	.done(function(data) {
		$('#restauranteinfo').data('idtipo', '0');
		$('#restauranteinfo').data('tipobusqueda', '0');
		datareporte.data(data);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
}

function solesfamilias(idtipocombi){
	$('#btn_summitinfo').css('display', 'none');
	$('#btn_summitinfo2').css('display', 'none');
	$('#btn_regresar').css('display', 'inline-block');
	$.ajax({
		url: '/reporteventassemanasfamilias',
		type: 'POST',
		dataType: 'json',
		data: {	year: $('#year').val(), 
				semana: $('#semana').val(), 
				idrest: $('#restauranteinfo').attr('data-id'),
				tipocomb: idtipocombi
			},
	})
	.done(function(data) {
		$('#restauranteinfo').data('tipobusqueda', '1');
		$('#restauranteinfo').data('idtipo', idtipocombi);
		datareporte.data(data);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
}

function unidadestipocombinacion(){
	$('#btn_summitinfo').css('display', 'inline-block');
	$('#btn_summitinfo2').css('display', 'inline-block');
	$('#btn_regresar2').css('display', 'none');
	$.ajax({
		url: '/reporteventasunidadessemanales',
		type: 'POST',
		dataType: 'json',
		data: {year: $('#year').val(), 
				semana: $('#semana').val(), 
				idrest: $('#restauranteinfo').attr('data-id')},
	})
	.done(function(data) {
		$('#restauranteinfo').data('idtipo', '0');
		$('#restauranteinfo').data('tipobusqueda', '0');
		datareporte.data(data);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
}

function unidadesfamilias(idtipocombi){
	$('#btn_summitinfo').css('display', 'none');
	$('#btn_summitinfo2').css('display', 'none');
	$('#btn_regresar2').css('display', 'inline-block');
	$.ajax({
		url: '/reporteventassemanasfamiliasuni',
		type: 'POST',
		dataType: 'json',
		data: {	year: $('#year').val(), 
				semana: $('#semana').val(), 
				idrest: $('#restauranteinfo').attr('data-id'),
				tipocomb: idtipocombi
			},
	})
	.done(function(data) {
		$('#restauranteinfo').data('tipobusqueda', '1');
		$('#restauranteinfo').data('idtipo', idtipocombi);
		datareporte.data(data);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
}

 	

function solesproductos(idfamilia){
	$('#btn_summitinfo').css('display', 'none');
	$('#btn_summitinfo2').css('display', 'none');
	$.ajax({
		url: '/reporteventassemanasproductos',
		type: 'POST',
		dataType: 'json',
		data: {	year: $('#year').val(), 
				semana: $('#semana').val(), 
				idrest: $('#restauranteinfo').attr('data-id'),
				famiid: idfamilia
			},
	})
	.done(function(data) {
		$('#restauranteinfo').data('tipobusqueda', '2');
		datareporte.data(data);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
}

function unidadesproductos(idfamilia){
	$('#btn_summitinfo').css('display', 'none');
	$('#btn_summitinfo2').css('display', 'none');
	$.ajax({
		url: '/reporteventassemanasproductosuni',
		type: 'POST',
		dataType: 'json',
		data: {	year: $('#year').val(), 
				semana: $('#semana').val(), 
				idrest: $('#restauranteinfo').attr('data-id'),
				famiid: idfamilia
			},
	})
	.done(function(data) {
		$('#restauranteinfo').data('tipobusqueda', '2');
		datareporte.data(data);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
}

$('body').on('click', '#btn_regresar', function(event) {
	event.preventDefault();
	/* Act on the event */
	if($('#restauranteinfo').data('tipobusqueda') == 1){
		solestipocombinacion();
	}else if($('#restauranteinfo').data('tipobusqueda') == 2){
		solesfamilias($('#restauranteinfo').data('idtipo'));
	}
});

$('body').on('click', '#btn_regresar2', function(event) {
	event.preventDefault();
	/* Act on the event */
	if($('#restauranteinfo').data('tipobusqueda') == 1){
		unidadestipocombinacion();
	}else if($('#restauranteinfo').data('tipobusqueda') == 2){
		unidadesfamilias($('#restauranteinfo').data('idtipo'));
	}
});

})

function sesion(){
		var sesion = $('#restauranteinfo').data('tipobusqueda');
		return sesion;
	}
	function sesionid(){
		var sesion = $('#restauranteinfo').data('idtipo');
		return sesion;
	}

function totalventasporcentaje(){
	var ventasemana = 0;
		var data = datareporte.data();
		for (var i = data.length - 1; i >= 0; i--) {
        	ventasemana += parseFloat(data[i]['total']);
        };
        if($('#restauranteinfo').data('solesunidades') == 1){
        return ventasemana.toFixed(2);
    	}else{
    		return ventasemana;
    	}
}
