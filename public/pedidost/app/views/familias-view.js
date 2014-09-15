Pedidos.Views.Familias = Backbone.View.extend({
	events:{
		"click" : "navigate"
	},
	tagName : "div",
	className : "producto",
	initialize : function () {
		var self = this;
		window.routers.base.on('route:root', function () {
			self.$el.show();
			self.render();
		});

		window.routers.base.on('route:combinaciones', function () {
			self.$el.hide();
		});
		window.routers.base.on('route:notas', function () {
				self.$el.hide();
		});

		window.routers.base.on('route:adicionales', function () {
				self.$el.hide();
		});
		window.routers.base.on('route:productos', function () {
				self.$el.hide();
		});
		window.routers.base.on('route:pcombinacion', function () {
				self.$el.hide();
		});
		this.template = _.template( $('#familia-template').html() );
		// this.template = swig.compile( $('#article-template').html() );
	},
	navigate : function () {
		Backbone.history.navigate('productos/'+this.model.get('id')+'/'+this.model.get('nombre'), {trigger: true});
	},
	render : function () {
		var data = this.model.toJSON();
		// junto data con el template;
		var html = this.template(data);
		this.$el.html( html );
	}
});