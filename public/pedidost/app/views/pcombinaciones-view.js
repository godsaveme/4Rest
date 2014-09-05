Pedidos.Views.Pcombinaciones = Backbone.View.extend({
	events:{
		"click .producto" : "selectproducto",
		"click .combinaciontitle": "resetcantidad"
	},
	tagName : "div",
	className : "procombinaciones",
	initialize : function () {
		var self = this;
		this.model.on('change', function () {
			if(window.variables.resetvalores == 1){
				self.render();
			}
		});
		window.routers.base.on('route:root', function () {
			self.$el.hide();
			$('#nav-combinacion').hide();
			$('#nav-pedido').show();
		});
		window.routers.base.on('route:combinaciones', function () {
			self.$el.hide();
		});
		window.routers.base.on('route:productos', function () {
			self.$el.hide();
		});
		window.routers.base.on('route:pcombinacion', function () {
			$('#nav-pedido').hide();
			$('#nav-combinacion').show();
			if(window.app.combinacion === self.model.get('combinacion_id')){
				self.$el.show();
			}else{
				self.$el.hide();
			}
		});
		this.template = _.template( $('#pcombinaciones-template').html() );
	},
	selectproducto: function (e) {
		var cantidad = parseInt( this.model.get('combcantidad'), 10 );
		var cantidad2 = parseInt(this.model.get('combcantidad2'),10);
		var orden = 0;
		var objeto = $(e.currentTarget);
		var producto_id = objeto.attr('data-id');
		if(cantidad > 0){
			orden = cantidad;
			this.model.set('combcantidad', --cantidad);
			this.$('.combinaciontitle .cantidad').html('('+cantidad+')');
		}else{
			for (var i = cantidad2; i > 0; i--) {
				delete window.variables.combinacioncesta.productos[this.model.get('fnombre')+i];
			};
			orden = cantidad2;
			this.$('.producto').removeClass('productoselected');
			this.model.set('combcantidad', --cantidad2);
			this.$('.combinaciontitle .cantidad').html('('+cantidad2+')');
		}
			objeto.addClass('productoselected');
			window.variables.producto = window.collections.productos
										.findWhere({productoid: producto_id, combinacion_id: window.app.combinacion})
										.toJSON();
			window.variables.combinacioncesta.productos[this.model.get('fnombre')+orden]={
				adicionales:{},
				cantidads:window.variables.producto.cantsabores,
				id:window.variables.producto.productoid,
				nombre: window.variables.producto.nombre,
				notas:[],
				sabores:[],
				adicionales:[]
			}
	},
	resetcantidad:function(){
		this.$('.producto').removeClass('productoselected');
		this.model.set('combcantidad', this.model.get('combcantidad2'));
		this.$('.combinaciontitle .cantidad').html('('+this.model.get('combcantidad2')+')');
	}
	,
	render : function () {
		var data = this.model.toJSON();
		// junto data con el template;
		var html = this.template(data);
		this.$el.html( html );
	}
});