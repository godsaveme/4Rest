Pedidos.Collections.Mesas = Backbone.Collection.extend({
	model : Pedidos.Models.Familias,
	url : '/mesas/mesas',
	name: 'mesas'
});