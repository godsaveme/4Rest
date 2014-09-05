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
		$('.salones').css('display', 'none');
    	$('.mesas').css('display', 'none');
    	$('.comanda').css('display', 'block');
    	var nombre = '<i class="fa fa-cutlery"></i>'+ '&nbsp;' + $(objeto).attr('salon-nombre').substring(0,8) +'-'+ $(objeto).children('.nombre_mesa').text();
    	$('#nombremesa').html(nombre);
	}
});