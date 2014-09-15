Pedidos.Views.Productoscesta = Backbone.View.extend({
	events:{
		"click .itemremover  a" : "removeritem",
		"click .itemcontrol .plus": "pluscantidad",
		"click .itemcontrol .minus": "minuscantidad",
		"click .itemadicional a": "shownav"
	},
	tagName : "li",
	initialize : function () {
		var self = this;
		this.template = _.template($('#productocesta-template').html());
		this.model.on('destroy', function () {
			self.$el.remove();
		});
		this.model.on('change', function () {
				self.render();
				window.views.app.totales();
		});
		window.routers.base.on('route:mesa', function () {
			if (self.model.get('mesa_id') == window.variables.mesaid) {
				self.$el.show();
			}else{
				self.$el.hide();
			}
		});
	},
	render : function () {
		var data = this.model.toJSON();
		// junto data con el template;
		var html = this.template(data);
		this.$el.html(html);
	},
	removeritem:function(e){
		e.preventDefault();
		e.stopPropagation();
		this.model.destroy();
		this.$el.remove();
		window.views.app.totales();
	},
	pluscantidad:function(e){
		e.preventDefault();
		e.stopPropagation();
		var cantidad = parseInt(this.model.get('cantidad'));
		this.model.set('cantidad',++cantidad);
		this.model.set('preciot',
					(this.model.get('cantidad') * this.model.get('preciou')).toFixed(2));
		this.model.save();
	},
	minuscantidad: function(e){
		e.preventDefault();
		e.stopPropagation();
		var cantidad = parseInt(this.model.get('cantidad')) - 1;
		if(cantidad > 0 ){
			this.model.set('cantidad',cantidad);
			this.model.set('preciot',
						(this.model.get('cantidad') * this.model.get('preciou')).toFixed(2));
			this.model.save();
		}
	},
	shownav: function(e){
		e.preventDefault();
		$('#nav-notas-adicionales').show();
		$('#nav-pedido').hide();
		var self = this;
		if(window.variables.producto_id != this.model.get('idpro')){
			$.ajax({
				url: '/sesionproducto',
				type: 'POST',
				dataType: 'json',
				data: {producto_id: this.model.get('idpro')},
			})
			.done(function(data) {
				window.variables.productocestaview = self;
				window.variables.productocesta_id  = self.model.get('id');
				window.variables.productocestaselect = self.model;
				$('.select_product').text(self.model.get('nombre'));
				$('.count_notas').text(window.variables.productocestaselect.get('notas').length);
				$('.count_adicionales').text(window.variables.productocestaselect.get('adicionales').length);
				window.collections.notas.reset();
				window.collections.adicionales.reset();
				$('.notas ul').html('');
				$('.adicionales').html('');
			});
		}

	}
});