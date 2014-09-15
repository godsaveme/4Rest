Pedidos.Views.Adicionales = Backbone.View.extend({
	events:{
		"click" : "selectadicional"
	},
	tagName : "div",
	className : "producto",
	initialize : function () {
		var self = this;
		this.template = _.template( $('#adicional-template').html() );
		window.routers.base.on('route:root', function () {
			self.$el.hide();
			$('.sabores').hide();
		});
	},
	selectadicional : function () {
		$('.producto').css('background', '');
		if (window.variables.combinacionnotas == 1) 
		{
			var adicionales = window.variables.productocestaselect.adicionales;
			adicionales.push({idadicional: this.model.get('id') , cantidad:1 , precio: this.model.get('precio'), 
						nombre: this.model.get('nombre')});
			var productos = window.variables.combinacionselect.model.get('productos');
				productos[window.variables.indice].adicionales = adicionales;
				window.variables.combinacionselect.model.set('productos', productos);
				window.variables.combinacionselect.model.save();
				window.variables.combinacionselect.render();
				$('.count_adicionales').text(adicionales.length);
		}
		else
		{
			var adicionales = window.variables.productocestaselect.get('adicionales');
			adicionales.push({idadicional: this.model.get('id') , cantidad:1 , precio: this.model.get('precio'), 
						nombre: this.model.get('nombre')});
			window.variables.productocestaselect.set('adicionales', adicionales);
			window.variables.productocestaselect.save();
			window.variables.productocestaview.render();
			$('.count_adicionales').text(window.variables.productocestaselect.get('adicionales').length);
		}
		this.$el.css('background', '#137fee');
	},
	render : function () {
		var data = this.model.toJSON();
		// junto data con el template;
		var html = this.template(data);
		this.$el.html( html );
	}
});