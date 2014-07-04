var datareporte = new kendo.data.DataSource({
							  data: [ ]
							});

var viewModel_reporteventasemanal = kendo.observable({
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