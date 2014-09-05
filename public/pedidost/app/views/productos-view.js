Pedidos.Views.Productos = Backbone.View.extend({
	events:{
		"click" : "selectproducto"
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
				self.$el.hide();
		});
		window.routers.base.on('route:productos', function () {
			if(window.app.familia === self.model.get('familia_id') &&  self.model.get('combinacion_id') == 1 ){
				$('.listaproductos').show();
				$('.productotitulo').show();
				$('.productotitulo').html(window.app.nombre);
				self.$el.show();
			}else{
				self.$el.hide();
			}
		});
		window.routers.base.on('route:pcombinacion', function () {
				self.$el.hide();
		});
		this.template = _.template( $('#producto-template').html() );
	},
	selectproducto : function () {
		window.variables.sabores = this.model.get('cantsabores');
		$('.producto').css('background', '');
		this.$el.css('background', '#137fee');
		if (window.variables.sabores > 0) {
			console.log('sabor');
		}else{
			window.variables.productocesta = {
				adicionales:[],
				cantidad: 1,
				mesa_id: 0,
				nombre: this.model.get('nombre'),
				notas:[],
				preciot: this.model.get('precio'),
				preciou: this.model.get('precio'),
				producto_id: this.model.get('productoid'),
				sabores:[]
			};
			var model = new Pedidos.Models.Productoscesta(window.variables.productocesta);
			window.collections.productoscesta.add(model);
			model.save();
			window.variables.productocesta = {};
		}
	},
	render : function () {
		var data = this.model.toJSON();
		// junto data con el template;
		var html = this.template(data);
		this.$el.html( html );
	}
});