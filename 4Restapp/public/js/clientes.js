$( document ).ready(function() {
	var socket = io.connect('http://'+window.location.hostname+':3000');
	$('a[title]').tooltip();
	$('#llamar_mozo').on('click', function(event) {
		event.preventDefault();
		$.ajax({
			url: '/dev/llamarmozo',
			type: 'POST',
			dataType: 'json',
			data: {codigomesa: $(this).attr('data-codigom')},
		})
		.done(function(data) {
			if(data['dato'] == 1){
				$('#mensajes').append($('#alerta_cliente').clone());
			}else{
				socket.emit('LlamarMozo', $('#llamar_mozo').attr('data-mesa'),
							$('#llamar_mozo').attr('data-codigom'), $('#nmesa').attr('data-idres'));
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});

	$('#pedir_cuenta').on('click', function(event) {
		event.preventDefault();
		/* Act on the event */
		$.ajax({
			url: '/dev/pedircuenta',
			type: 'POST',
			dataType: 'json',
			data: {codigomesa: $(this).attr('data-codigom')},
		})
		.done(function(data) {
			var contenidoprecuenta = '';
			contenidoprecuenta +='<tr>';
			contenidoprecuenta += '<td>Descripcion</td>';
			contenidoprecuenta += '<td>Precio U.</td>';
			contenidoprecuenta += '<td>Cantidad</td>';
			contenidoprecuenta += '<td>Total</td>'
			contenidoprecuenta +='</tr>';
			var importetotal = 0;
			if(data['productos'].length> 0){
				for (var i in data['productos']) {
					contenidoprecuenta +='<tr>';
					contenidoprecuenta +='<td class="text-left">'+data['productos'][i]['nombre']+'</td>';
					contenidoprecuenta += '<td class="text-right">'+data['productos'][i]['preciou'].toFixed(2)+'</td>';
					contenidoprecuenta += '<td class="text-right">'+data['productos'][i]['cantidad']+'</td>';
					contenidoprecuenta += '<td class="text-right">'+data['productos'][i]['precio'].toFixed(2)+'</td>';
					contenidoprecuenta +='</tr>';
					importetotal = parseFloat(importetotal) + parseFloat(data['productos'][i]['precio']);
				}
			}

			if(importetotal > 0){
				contenidoprecuenta +='<tr>';
				contenidoprecuenta +='<td>Total</td>';
				contenidoprecuenta += '<td class="text-right">';
				contenidoprecuenta +='</td>';
				contenidoprecuenta += '<td class="text-right">';
				contenidoprecuenta += '</td>';
				contenidoprecuenta += '<td class="text-right">'+importetotal.toFixed(2)+'</td>';
				contenidoprecuenta +='</tr>'; 
				$('#montohead').text('S/.' + importetotal.toFixed(2))
			}

			if(data['dato'] == 1){
				$('#itemsprecuenta').html(contenidoprecuenta);
				$('#precuenta').css('display', 'block');
				$('#home').css('display', 'none');
				socket.emit('PedirCuenta', $('#nmesa').text(), data['productos'][0]['login'], $('#nmesa').attr('data-idres'), $('#llamar_mozo').attr('data-codigom'));
			}else if(data['dato'] == 2){
				$('#mensajes').append($('#alerta_cliente').clone());
				$('#itemsprecuenta').html(contenidoprecuenta);
				$('#precuenta').css('display', 'block');
				$('#home').css('display', 'none');
			}else{
				alert('No Tienes nada por Pagar');
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});

	$('#llamar_supervisor').on('click', function(event) {
		event.preventDefault();
		/* Act on the event */
		$.ajax({
			url: '/dev/llamarsupervisor',
			type: 'POST',
			dataType: 'json',
			data: {codigomesa: $(this).attr('data-codigom')},
		})
		.done(function(data) {
			if(data['dato'] == 1){
				$('#mensajes').append($('#alerta_cliente').clone());
			}else{
				socket.emit('LlamarSupervisor', $('#llamar_mozo').attr('data-mesa'),
				$('#llamar_mozo').attr('data-codigom'), $('#nmesa').attr('data-idres'));
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});

	$('#regresar_cliente').on('click',function(event) {
		event.preventDefault();
		/* Act on the event */
		$('#precuenta').css('display', 'none');
		$('#home').css('display', 'block');
	});
});