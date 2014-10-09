Pedidos.Collections.ProductosUsuario = Backbone.Collection.extend({
	model : Pedidos.Models.ProductosUsuario,
	url : '/usuarios/usuario-produtos',
	name: 'productosusuario',
});