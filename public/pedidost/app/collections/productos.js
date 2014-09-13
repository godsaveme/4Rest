Pedidos.Collections.Productos = Backbone.Collection.extend({
	model : Pedidos.Models.Productos,
	url : '/productos/productos',
	name: 'productos'
});