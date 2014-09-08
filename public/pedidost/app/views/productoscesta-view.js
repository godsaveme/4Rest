Pedidos.Views.Productoscesta = Backbone.View.extend({
	events:{
		"click .itemremover  a" : "removeritem",
		"click .itemcontrol .plus": "pluscantidad",
		"click .itemcontrol .minus": "minuscantidad"
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
	}
});