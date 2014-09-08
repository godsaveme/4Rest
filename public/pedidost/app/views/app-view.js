Pedidos.Views.App = Backbone.View.extend({
	events : {
		"click .productotitulo" : "navigateHome",
		"click #agregar_cesta": "agregarcesta",
		"click .mesa": "sesionmesa"
	},
	initialize : function ($el) {
		this.$el = $el;
	},
	navigateHome : function () {
		$('.productotitulo').toggle();
		Backbone.history.navigate('', {trigger:true});
	},
	agregarcesta:function(){
		window.variables.resetvalores = 1;
		var contador = 0;
		for (var i in window.variables.combinacioncesta.productos) {
			contador++;
		}
		if(contador > 0){
			var model = new Pedidos.Models.Combinacionescesta(window.variables.combinacioncesta);
			window.collections.combinacionescesta.add(model);
			model.save();
			window.collections.pcombinaciones.resetvalores();
			window.variables.combinacioncesta.productos = {};
		}
		window.variables.resetvalores = 0;
	},
	sesionmesa:function (e){
		var objeto = $(e.currentTarget);
		window.collections.productosmesa.reset();
		$('.productosmesa').remove();
		$('.salones').css('display', 'none');
    	$('.mesas').css('display', 'none');
    	$('.comanda').css('display', 'block');
    	var nombre = '<i class="fa fa-cutlery"></i>'+ '&nbsp;' + $(objeto).attr('salon-nombre').substring(0,8) +'-'+ $(objeto).children('.nombre_mesa').text();
    	$('#nombremesa').html(nombre);
    	window.variables.nombremesa = $(objeto).children('.nombre_mesa').text();
    	$.ajax({
    		url: '/sesionmesa',
    		type: 'POST',
    		dataType: 'json',
    		data: {mesaid: $(objeto).attr('data-id')},
    	})
    	.done(function(data) {
    		window.variables.mesaid = data.session;
    		window.variables.pedidoid = data.pedidoid;
    		window.collections.productosmesa.fetch();
    		window.views.app.totales();
    		Backbone.history.navigate('mesa', {trigger:true});
    	})
    	.fail(function() {
    		console.log("error");
    	})
    	.always(function() {
    		console.log("complete");
    	});
    	
	},
	totales: function(){
		var totalcantidad = window.collections.productoscesta.sumacantidades() 
							+ window.collections.combinacionescesta.sumacantidades()
							+ window.collections.productosmesa.sumacantidades();
		var totalprecio = window.collections.productoscesta.sumaprecios() 
							+ window.collections.combinacionescesta.sumaprecios()
							+ window.collections.productosmesa.sumaprecios();

		$(".totalitems").text(totalcantidad);
		$(".totalprecio").text(totalprecio.toFixed(2));
	}
});