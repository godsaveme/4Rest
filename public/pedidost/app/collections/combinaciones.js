Pedidos.Collections.Combinaciones = Backbone.Collection.extend({
	model : Pedidos.Models.Combinaciones,
	url : '/combinacions/listacombinaciones',
	name: 'combinaciones',
	reset: function (){
		
	}
});