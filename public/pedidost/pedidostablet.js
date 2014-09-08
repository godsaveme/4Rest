var socket = io.connect('http://'+window.location.host+':3000');
	socket.on('ActulizarestadoAll', function(){
	window.collections.productosmesa.fetch();
	});
	function enviarorden(){
		var eproductos = JSON.stringify(window.collections.productoscesta.where({mesa_id: window.variables.mesaid}));
		var ecombinaciones = JSON.stringify(window.collections.combinacionescesta.where({mesa_id: window.variables.mesaid}));
		var ecocinas = window.collections.cocinas.toJSON();
		if (eproductos.length > 2 || ecombinaciones.length > 2 ) {
			$.ajax({
				url: '/enviarpedidosnew',
				type: 'POST',
				dataType: 'json',
				data: {mozoid: 0, 
						prof: eproductos ,
						proc:ecombinaciones, 
						cocinas: ecocinas, 
						idmesa: window.variables.mesaid,
						pedidoid: window.variables.pedidoid},
			})
			.done(function(data) {
				window.variables.pedidoid = data.pedidoid;
				eproductos = window.collections.productoscesta.where({mesa_id: window.variables.mesaid});
				ecombinaciones = window.collections.combinacionescesta.where({mesa_id: window.variables.mesaid});
				_.invoke(eproductos, 'destroy');
				_.invoke(ecombinaciones, 'destroy');
				window.collections.productosmesa.fetch();
				$('.pedido').show();
	    		$('.carta').hide();
	    		socket.emit('Enviaracocina', window.variables.nombremesa, window.variables.pedidoid, data.orden, data.mozoid);
				Backbone.history.navigate('', {trigger:true});
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		}else{
			return false;
		}
	}

    function precuenta(){
    	alert('precuenta');
    }

    function mostarcarta(){
    	$('.pedido').toggle();
    	$('.carta').toggle();
    }

    function mostarsalones(){
		$('.salones').css('display', 'block');
    	$('.mesas').css('display', 'block');
    	$('.comanda').css('display', 'none');
    	$('#nombremesa').html('');
    	Backbone.history.navigate('', {trigger:true});
	}

	function actulizarproductomesa(estado,iddetallep){
		$.ajax({
			url: '/mozonotificaciones',
			type: 'POST',
			dataType: 'json',
			data: {estado: estado,iddetallep: iddetallep},
		})
		.done(function(data) {
			socket.emit('NotificarPedidos', data, data.areapro);
			window.collections.productosmesa.fetch();
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	}

$(function(){
	NProgress.start();
    setTimeout(function() { NProgress.done()}, 1000);
    $('.btn_accion').each(function(i, link){
    		var funcion = $(this).prop('hash').substring(1);
			$(link)
				.on('click', function(event){
					event.preventDefault();
					window[funcion]();
				});
	});
});