Pedidos.Views.Combinacionescesta = Backbone.View.extend({
	events:{
		"click .itemremover  a" : "removeritem",
		"click .itemcontrol .plus": "pluscantidad",
		"click .itemcontrol .minus": "minuscantidad",
		"click .itemproducto .combinaciones li":  "selectproductocombinacion",
		"click .itemadicional a": "notasyadicionales"
	},
	tagName : "li",
	initialize : function () {
		var self = this;
		this.template = _.template($('#combinacioncesta-template').html());
		this.model.on('change', function () {
				self.render();
				window.views.app.totales();
		});
		this.model.on('destroy', function () {
			self.$el.remove();
		});
		window.routers.base.on('route:mesa', function () {
			if (self.model.get('mesa_id') === window.variables.mesaid) {
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
	selectproductocombinacion: function(e){
		$(".itemproducto .combinaciones li").css('background', '');
		var objeto = $(e.currentTarget);
		window.variables.indice = $(objeto).attr('data-indice');
		window.variables.combinacionnotas = 1;
		window.variables.combinacionselect = this;
		var producto = window.variables.combinacionselect.model.get('productos');
		window.variables.productocestaselect = producto[window.variables.indice];
		$.ajax({
				url: '/sesionproducto',
				type: 'POST',
				dataType: 'json',
				data: {producto_id: window.variables.productocestaselect.id},
		})
		.done(function(data) {
			window.collections.notas.reset();
			window.collections.adicionales.reset();
			$('.select_product').text(window.variables.productocestaselect.nombre);
			$('.count_notas').text(window.variables.productocestaselect.notas.length);
			$('.count_adicionales').text(window.variables.productocestaselect.adicionales.length);
			$('.notas ul').html('');
			$('.adicionales').html('');
		});
		this.$(objeto).css('background', '#137fee');
	},
	notasyadicionales: function (e){
		e.preventDefault();
		if(window.variables.productocestaselect.id > 0){
			$('#nav-notas-adicionales').show();
			$('#nav-pedido').hide();
		}else{
			return false;
		}
	}
});