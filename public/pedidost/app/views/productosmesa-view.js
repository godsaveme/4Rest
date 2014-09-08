Pedidos.Views.Productosmesa = Backbone.View.extend({
	events:{
		"click" : "actualizarestado",
		"click .productomesacombinaciones li" : "actualizarestado"
	},
	tagName : "li",
	className: "productosmesa",
	initialize : function () {
		var self = this;
		this.model.on('change', function () {
				self.render();
		});
		this.template = _.template( $('#productomesa-template').html() );
		this.templateExtend = _.template( $('#combinacionmesa-template').html() );
	},
	render : function () {
		var data = this.model.toJSON();
		// junto data con el template;
		if(this.model.get('tipo') == 1){
			this.$el.attr('class', 'productosmesa '+this.model.get('estado'));(this.model.get('estado'));
			var html = this.template(data);
		}else if(this.model.get('tipo') == 2){
			var html = this.templateExtend(data);
		}
		this.$el.html( html );
	},
	actualizarestado: function(e){
		if (this.model.get('tipo') == 1) {
			var estado = this.model.get('estado');
			if (estado == 'E') {
				actulizarproductomesa(estado, this.model.get('id'));
			}else{
				return false;
			}
		}else if (this.model.get('tipo') == 2) {
			var objeto = $(e.currentTarget);
			var estado = objeto.attr('class');
			if (estado == 'E') {
				actulizarproductomesa(estado, objeto.attr('data-id'));
			}else{
				return false;
			}
		}
	},
});