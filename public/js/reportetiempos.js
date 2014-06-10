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

$('#btn_enviarfechas').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	$.ajax({
		url: '/reportetiempos',
		type: 'POST',
		dataType: 'json',
		data: {fechainicio: $('#fecha_inicio').val(), 
		fechafin: $('#fecha_fin').val(), 
		idrestaurante: $('#restauranteinfo').attr('data-id')}
	})
	.done(function(data) {
		datareportetiempo.data([]);
		datareportetiempo.data(data);
		$('#btn_enviarfechas').text('Buscar');
		$('#text_producto').text('Promedio');
		$('#promedio').css('display' ,'block');
		$('#maximo').css('display' ,'block');
		$('.sub_promedio').css('display' ,'block');
		$('.sub_maximo').css('display' ,'block');
		console.log(data);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
});

var datareportetiempo = new kendo.data.DataSource({
							  data: [ ],
							  schema: {
							    model: { id: "producto_id" }
							  }
							});

var viewModel_reportetiempos = kendo.observable({
	datosreporte: datareportetiempo
});

kendo.bind($("#reportetiempos"), viewModel_reportetiempos);

$('body').on('click', '.tiempo_productos', function(event) {
	event.preventDefault();
	/* Act on the event */
	$.ajax({
		url: '/tiemposproductos',
		type: 'POST',
		dataType: 'json',
		data: {fechainicio: $('#fecha_inicio').val(), 
		fechafin: $('#fecha_fin').val(), 
		idrestaurante: $('#restauranteinfo').attr('data-id'),
		idpro: $(this).attr('data-idproducto')},
	})
	.done(function(data){
		datareportetiempo.data([]);
		datareportetiempo.data(data);
		$('#btn_enviarfechas').text('Regresar');
		$('#text_producto').text('Tiempos');
		$('#promedio').css('display' ,'none');
		$('#maximo').css('display' ,'none');
		$('.sub_promedio').css('display' ,'none');
		$('.sub_maximo').css('display' ,'none');
		console.log(data);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
});