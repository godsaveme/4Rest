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
		this.model.on('change', function () {
				self.render();
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