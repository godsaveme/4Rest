var socket = io.connect('http://'+window.location.host+':3000');
	socket.on('ActulizarestadoAll', function(data){
		var mesa = window.collections.mesas.findWhere({pedido_id: data.pedido});
			mesa = mesa.toJSON();
			if(window.variables.usuarioid  == mesa.usuario_id && data.estado == 'E' ){
				navigator.vibrate(1500);
				$('.notificaciones i').css('color', 'red');
				//alert('Tienes platos por recoger para la' + mesa.nombre);
			}
		window.collections.productosmesa.fetch();
		window.collections.productosusuario.fetch();
	});

	socket.on("Recibirpedidos", function(datos, mesa, pedido){
		window.variables.pedidoid = pedido;
		window.collections.productosmesa.fetch();
	});

	socket.on("refreshmesas", function(){
		window.collections.mesas.fetch();
	});

	socket.on("liberarmesa", function(idmesa){
		liberarmesa(idmesa);
		socket.emit('ocuparmesa',idmesa); 
	});

	function liberarmesa(idmesa){
		$.ajax({
			url: '/liberarmesa',
			type: 'POST',
			dataType: 'json',
			data: {mesa_id: idmesa},
		})
		.done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	}

	function enviarorden(){
		if (window.app.state != "mesa") {
			alert('Revisa el pedido antes de enviarlo!');
			return false;
		}
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
				Backbone.history.navigate('/mesa', {trigger:true});
				precuenta(1, 0);
				window.collections.productosmesa.fetch();
				window.collections.mesas.fetch();
				$('.pedido').show();
	    		$('.carta').hide();
	    		socket.emit('ocuparmesa',window.variables.mesaid); 
	    		socket.emit('Enviaracocina', window.variables.nombremesa, window.variables.pedidoid, data.orden, data.mozoid);
				
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

    function getPrecuenta(){
    	if (window.app.state == "precuenta") {
    		var html = '<i class="fa fa-calculator"></i> Precuenta';
    		$('.btn_precuenta').html(html);
    		Backbone.history.navigate('/mesa', {trigger:true});
    	}else if(window.app.state == "mesa"){
    		var html = '<i class="fa fa-calculator"></i> Mesa';
    		$('.btn_precuenta').html(html);
    		precuenta(1, 0);
   			Backbone.history.navigate('/precuenta', {trigger:true});
    	}
    	
    }

    function mostarcarta(){
    	var text = $('.flagcarta span').text();
    	if (text == 'Carta') {
    		$('.flagcarta span').text('Mesa');
    		Backbone.history.navigate('', {trigger:true});
    		$('.pedido').hide();
    		$('.carta').show();
    	}else{
    		$('.flagcarta span').text('Carta');
    		Backbone.history.navigate('/mesa', {trigger:true});
    		$('.pedido').show();
    		$('.carta').hide();
    	}
    }

    function mostarsalones(){
		$('.salones').css('display', 'block');
    	$('.mesas').css('display', 'block');
    	$('.comanda').css('display', 'none');
    	$('#nombremesa').html('');
    	liberarmesa(window.variables.mesaid);
    	socket.emit('ocuparmesa',window.variables.mesaid);
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


	function precuenta(tipo, pre){
	var precuenta = {};
	$.ajax({
			url: '/precuenta',
			type: 'POST',
			dataType: 'json',
			data: {idpedido: window.variables.pedidoid, tipopre: tipo,
					mesa: '', mozo: '', precuenta: pre}
		})
		.done(function(data) {
			if (tipo == 1) 
			{
				var preciototal = data.reduce(function(suma, value) 
								{ return suma + parseFloat(value.precio) }, 0);
				var datos = {items: data, total: preciototal.toFixed(2)};
				var html = window.variables.templateprecuenta(datos);
				window.variables.precuenta = data;
				if (window.app.state != "mesa") {
					$('.precuenta').html(html);
					$('.precuenta').show();
				}
			}
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
