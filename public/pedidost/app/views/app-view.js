Pedidos.Views.App = Backbone.View.extend({
	events : {
		"click .productotitulo" : "navigateHome",
		"click #agregar_cesta": "agregarcesta",
		"click #notas": "shownotas",
		"click #adicionales": "showadicionales",
		"click .btn_mesa": "backmesa"
	},
	initialize : function ($el) {
		this.$el = $el;
		window.routers.base.on('route:root', function () {
			$('#nav-notas-adicionales').hide();
		});
		
	},
	navigateHome : function () {
		if(window.app.combinacion){
			Backbone.history.navigate('', {trigger:true});
		}
		$('.productotitulo').toggle();
		Backbone.history.navigate('', {trigger:true});
	},
	agregarcesta:function(){
		
		if (window.app.state == "sabores") {
			if(window.variables.sabores == 0){
				if(window.variables.combinacionsabores == 1){
					Backbone.history.navigate('/pcombinacion/'+window.app.combinacion, {trigger:true});
				}else{
					var model = new Pedidos.Models.Productoscesta(window.variables.productocesta);
					window.collections.productoscesta.add(model);
					model.save();
					window.variables.productocesta = {};
					$('.producto').removeClass('productoselected');
					Backbone.history.navigate('', {trigger:true});
				}
			}else{
				alert('Te falta selecionar sabores.');
				return false;
			}
			return false;
		}
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
	totales: function(){
		var totalcantidad = window.collections.productoscesta.sumacantidades() 
							+ window.collections.combinacionescesta.sumacantidades()
							+ window.collections.productosmesa.sumacantidades();
		var totalprecio = window.collections.productoscesta.sumaprecios() 
							+ window.collections.combinacionescesta.sumaprecios()
							+ window.collections.productosmesa.sumaprecios();

		$(".totalitems").text(totalcantidad);
		$(".totalprecio").text(totalprecio.toFixed(2));
	},
	shownotas: function(e){
		e.preventDefault();
		window.collections.notas.fetch();
		$('.pedido').hide();
    	$('.carta').show();
    	$('.notas').show();
    	Backbone.history.navigate('/notas', {trigger:true});
	},
	showadicionales: function(e){
		e.preventDefault();
		window.collections.adicionales.fetch();
		$('.pedido').hide();
    	$('.carta').show();
    	$('.adicionales').show();
    	Backbone.history.navigate('/adicionales', {trigger:true});
	},
	backmesa: function(e){
		e.preventDefault();
		$('.pedido').show();
    	$('#nav-notas-adicionales').toggle();
		$('#nav-pedido').toggle();
		$('.carta').hide();
    	$('.notas').hide();
		Backbone.history.navigate('/mesa', {trigger:true});
	}
});