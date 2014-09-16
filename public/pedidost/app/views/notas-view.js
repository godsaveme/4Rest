Pedidos.Views.Notas = Backbone.View.extend({
	events:{
		"click" : "selectnota"
	},
	tagName : "li",
	initialize : function () {
		var self = this;
		this.template = _.template( $('#nota-template').html());
	},
	selectnota : function () {
		if (window.variables.combinacionnotas == 1) 
		{
			var notas = window.variables.productocestaselect.notas;
			notas.push({nombre: this.model.get('descripcion'),idnota: this.model.get('id')});
			var productos = window.variables.combinacionselect.model.get('productos');
				productos[window.variables.indice].notas = notas;
				window.variables.combinacionselect.model.set('productos', productos);
				window.variables.combinacionselect.model.save();
				window.variables.combinacionselect.render();
				$('.count_notas').text(notas.length);
		}
		else
		{
			var notas = window.variables.productocestaselect.get('notas');
			notas.push({nombre: this.model.get('descripcion'),idnota: this.model.get('id')});
			window.variables.productocestaselect.set('notas', notas);
			window.variables.productocestaselect.save();
			window.variables.productocestaview.render();
			$('.count_notas').text(window.variables.productocestaselect.get('notas').length);
		}
		this.$el.css('background', '#137fee');
	},
	render : function () {
		var data = this.model.toJSON();
		// junto data con el template;
		var html = this.template(data);
		this.$el.html( html );
	}
});