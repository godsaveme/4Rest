Pedidos.Views.Combinaciones = Backbone.View.extend({
	events:{
		"click" : "navigate"
	},
	tagName : "div",
	className : "producto",
	initialize : function () {
		var self = this;
		window.routers.base.on('route:root', function () {
			self.$el.hide();
			$('.listaproductos').hide();
			$('.productotitulo').hide();
		});
		window.routers.base.on('route:combinaciones', function () {
			if(window.app.combinacion == self.model.get('TipoCombinacionId') ){
				$('.listaproductos').show();
				$('.productotitulo').show();
				$('.productotitulo').html(window.app.nombre);
				self.$el.show();
				$('.productotitulo').html('Carta');
			}else{
				self.$el.hide();
			}
		});
		window.routers.base.on('route:pcombinacion', function () {
				self.$el.hide();
		});
		this.template = _.template( $('#combinacion-template').html() );
	},
	navigate : function () {
		window.variables.combinacioncesta = {
			combinacion_id: this.model.get('CombinacionId'),
			nombre: this.model.get('CombinacionNombre'),
			cantidad: 1,
			preciou:this.model.get('CombinacionPrecio'),
			preciot: this.model.get('CombinacionPrecio'),
			productos: {},
			mesa_id:window.variables.mesaid
		};
		Backbone.history.navigate('pcombinacion/'+this.model.get('CombinacionId'), {trigger: true});
	},
	render : function () {
		var data = this.model.toJSON();
		// junto data con el template;
		var html = this.template(data);
		this.$el.html( html );
	}
});