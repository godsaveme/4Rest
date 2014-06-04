$(document).ready(function(){
	var dataSourcetemp = new kendo.data.DataSource({
                        data: movies,
                        change: function() { // subscribe to the CHANGE event of the data source
                            $("#movies tbody").html(kendo.render(template, this.view())); // populate the table
                        }
                    });
	nombrelocal();
	productos();
	combinaciones();
	$('#restaurante_id').on('change', function(event) {
		event.preventDefault();
		nombrelocal();
	});

	$('#familia_id').on('change', function(event) {
		event.preventDefault();
		productos();
	});
	$('#tipocomb_id').on('change', function(event) {
		event.preventDefault();
		combinaciones();
	});

});

function nombrelocal(){
		if($('#restaurante_id').val() > 0){
			var restaurante = $("#restaurante_id option:selected").text();
			$('#nombre_local').text(restaurante);
			$('#restaurante_id').attr('disabled', 'disabled');
		}else{
			$('#nombre_local').text('-');
		}
}

function productos(){
	if ($('#familia_id').val()> 0) {
		$.ajax({
		url: '/getproductos',
		type: 'GET',
		dataType: 'json',
		data: {familia_id:$('#familia_id').val()},
		})
		.done(function(data){
			var options = '<option selected="selected" value="0">Seleciona un Producto</option>';
			for (var i in data) {
				options += '<option value="'+data[i]['id']+'">'+data[i]['nombre']+'</option>';
			};
			$('#producto_id').html(options);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	}	
}

function combinaciones(){
	if ($('#tipocomb_id').val()> 0) {
		$.ajax({
		url: '/getcombinaciones',
		type: 'GET',
		dataType: 'json',
		data: {tcombi_id:$('#tipocomb_id').val()},
		})
		.done(function(data){
			var options = '<option selected="selected" value="0">Seleciona una combinacion</option>';
			for (var i in data) {
				options += '<option value="'+data[i]['id']+'">'+data[i]['nombre']+'</option>';
			};
			$('#combinacion_id').html(options);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	}	
}