Pedidos.Views.App = Backbone.View.extend({
	events : {
		"click .productotitulo" : "navigateHome",
		"click #agregar_cesta": "agregarcesta"
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