Pedidos.Views.ProductosUsuario = Backbone.View.extend({
	events:{
		"click li" : "actualizarestado"
	},
	tagName : "ul",
	initialize : function () {
		var self = this;
		this.model.on('change', function () {
				self.render();
		});
		this.template = _.template( $('#productosusuario-template').html());
	},
	render : function () {
		var data = this.model.toJSON();
		// junto data con el template;
		var html = this.template(data);
		this.$el.html( html );
	},
	actualizarestado: function(e){
		var objeto = $(e.currentTarget);
		var estado = objeto.attr('class');
		if (estado == 'E') {
			actulizarproductomesa(estado, objeto.attr('data-id'));
		}else{
			return false;
		}

	}
});