Pedidos.Collections.Notas = Backbone.Collection.extend({
	model : Pedidos.Models.Notas,
	url : '/notas/allnotas',
	name: 'notas'
});
