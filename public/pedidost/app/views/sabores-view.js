Pedidos.Views.Sabores = Backbone.View.extend({
	events:{
		"click" : "selectsabor"
	},
	tagName : "div",
	className : "producto",
	initialize : function () {
		var self = this;
		this.template = _.template( $('#sabor-template').html() );
		window.routers.base.on('route:root', function () {
			self.$el.hide();
			$('.sabores').hide();
		});
		window.routers.base.on('route:pcombinacion', function () {
			self.$el.hide();
			$('.sabores').hide();
		});
	},
	selectsabor : function () {
		if (window.variables.combinacionsabores == 1) 
		{
			if(window.variables.sabores > 0){
				window.variables.sabores = window.variables.sabores - 1;
			}else{
				window.variables.sabores = 
					window.variables.combinacioncesta.productos[window.variables.indice].cantidads - 1;
				window.variables.combinacioncesta.productos[window.variables.indice].sabores = [];
				$('.producto').removeClass('productoselected');
			}
			var sabores = window.variables.combinacioncesta.productos[window.variables.indice].sabores;
			sabores.push({nombre: this.model.get('nombre'),idsabor: this.model.get('id')});
			window.variables.combinacioncesta.productos[window.variables.indice].sabores = sabores;
			$('.count_sabores').text(window.variables.sabores);
			this.$el.addClass('productoselected');
		}
		else
		{
			if(window.variables.sabores > 0){
				window.variables.sabores = window.variables.sabores - 1;
			}else{
				window.variables.sabores = window.variables.productocesta.cantidadsabores - 1;
				window.variables.productocesta.sabores = [];
				$('.producto').removeClass('productoselected');
			}
			var sabores = window.variables.productocesta.sabores;
			sabores.push({nombre: this.model.get('nombre'),idsabor: this.model.get('id')});
			window.variables.productocesta.sabores = sabores;
			$('.count_sabores').text(window.variables.sabores);
			this.$el.addClass('productoselected');
		}
	},
	render : function () {
		var data = this.model.toJSON();
		// junto data con el template;
		var html = this.template(data);
		this.$el.html( html );
	}
});