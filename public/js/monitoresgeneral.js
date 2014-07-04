$('#btn_aceparea').on('click',function(event) {
		event.preventDefault();
		/* Act on the event */
		window.location.href = '/monitores/area/'+$('#select_areaid').val();
});

$('body').timeago();

//Tiemposenmesa
function tiempoenmesa(){
	$('.tiempoenmesa').each(function(index, el) {
		var idpedido = $(this).attr('data-idpedido');

		$.ajax({
			url: '/dev/tiempoenmesa',
			type: 'POST',
			dataType: 'json',
			data: {idpedido: idpedido},
		})
		.done(function(data) {
			if(data['respuesta'] == true){
				if(data['tiempo'].length > 0){
					$('#mesa_'+idpedido).text(data['tiempo']);
				}
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});
}
tiempoenmesa();
setInterval(tiempoenmesa,60000);
//fintiemposenmesa