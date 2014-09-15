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
		window.routers.base.on('route:notas', function () {
				$('.productotitulo').hide();
				self.$el.hide();
		});
		window.routers.base.on('route:combinaciones', function () {
				self.$el.hide();
		});
		window.routers.base.on('route:adicionales', function () {
				$('.productotitulo').hide();
				self.$el.hide();
		});
		window.routers.base.on('route:sabores', function () {
				$('.productotitulo').hide();
				self.$el.hide();
		});
		window.routers.base.on('route:productos', function () {
			if(window.app.familia == self.model.get('familia_id') &&  self.model.get('combinacion_id') == 1 ){
				$('.listaproductos').show();
				$('.productotitulo').show();
				$('.productotitulo').html('Carta');
				window.variables.combinacionsabores = 0;
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
		var self = this;
		window.variables.sabores = this.model.get('cantsabores');
		$('.producto').css('background', '');
		window.variables.productocesta = {
				adicionales:new Array(),
				cantidad: 1,
				mesa_id: window.variables.mesaid,
				nombre: this.model.get('nombre'),
				notas:new Array(),
				preciot: this.model.get('precio'),
				preciou: this.model.get('precio'),
				idpro: this.model.get('productoid'),
				sabores:new Array(),
				cantidadsabores: window.variables.sabores
			};
		this.$el.css('background', '#137fee');
		if (window.variables.sabores > 0) {
			window.collections.sabores.reset();
			$.ajax({
				url: '/sesionproducto',
				type: 'POST',
				dataType: 'json',
				data: {producto_id: self.model.get('productoid')},
			})
			.done(function(data) {
				window.collections.sabores.fetch();
				$('.productonombre').text(self.model.get('nombre'));
				$('.count_sabores').text(window.variables.sabores);
		    	$('.carta').show();
		    	$('.sabores').show();
		    	$('#nav-pedido').hide();
				$('#nav-combinacion').show();
		    	Backbone.history.navigate('/sabores', {trigger:true});
			});
		}else{
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