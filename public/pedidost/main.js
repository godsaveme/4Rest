$(function(){
	window.variables.templateprecuenta = _.template($('#precuenta-template').html());
	window.variables.sabores = 0;
	window.variables.usuarioid = $('.salones').attr('data-userid');
	window.routers.base = new Pedidos.Routers.Base();
	window.collections.tipocombinaciones = new Pedidos.Collections.Tipocombinaciones();
	window.collections.familias = new Pedidos.Collections.Familias();
	window.collections.combinaciones = new Pedidos.Collections.Combinaciones();
	window.collections.productos = new Pedidos.Collections.Productos();
	window.collections.pcombinaciones = new Pedidos.Collections.Pcombinaciones();
	window.collections.combinacionescesta = new Pedidos.Collections.Combinacionescesta();
	window.collections.productoscesta = new Pedidos.Collections.Productoscesta();
	window.collections.productosmesa = new Pedidos.Collections.Productosmesa();
	window.collections.cocinas = new Pedidos.Collections.Cocinas();
	window.collections.mesas = new Pedidos.Collections.Mesas();
	window.collections.usuario = new Pedidos.Collections.Usuario();
	window.collections.notas = new Pedidos.Collections.Notas();
	window.collections.adicionales = new Pedidos.Collections.Adicionales();
	window.collections.sabores = new Pedidos.Collections.Sabores();
	window.collections.productosusuario = new Pedidos.Collections.ProductosUsuario();
	window.views.app =new Pedidos.Views.App($('body'));


	window.collections.tipocombinaciones.on('add', function (model) {
		var view = new Pedidos.Views.Tipocombinaciones({model: model});
		view.render();
		view.$el.appendTo('.carta');
	});

	window.collections.familias.on('add', function (model) {
		var view = new Pedidos.Views.Familias({model: model});
		view.render();
		view.$el.appendTo('.carta');
	});

	window.collections.combinaciones.on('add', function (model) {
		var view = new Pedidos.Views.Combinaciones({model: model});
		view.render();
		view.$el.appendTo('.listaproductos');
	});

	window.collections.productos.on('add', function (model) {
		var view = new Pedidos.Views.Productos({model: model});
		view.render();
		view.$el.appendTo('.listaproductos');
	});

	window.collections.pcombinaciones.on('add', function (model) {
		var view = new Pedidos.Views.Pcombinaciones({model: model});
		view.render();
		view.$el.appendTo('.carta');
	});

	window.collections.combinacionescesta.on('add', function (model) {
		var view = new Pedidos.Views.Combinacionescesta({model: model});
		view.render();
		view.$el.prependTo('.cestaitems');
		window.views.app.totales();
	});

	window.collections.productoscesta.on('add', function (model) {
		var view = new Pedidos.Views.Productoscesta({model: model});
		view.render();
		view.$el.prependTo('.cestaitems');
		window.views.app.totales();
	});

	window.collections.productosmesa.on('add', function (model) {
		var view = new Pedidos.Views.Productosmesa({model: model});
		view.render();
		view.$el.appendTo('.cestaitems');
		window.views.app.totales();
	});

	window.collections.mesas.on('add', function (model) {
		var view = new Pedidos.Views.Mesas({model: model});
		view.render();
		view.$el.appendTo('.mesas');
	});

	window.collections.usuario.on('add', function (model) {
		socket.emit('loginuser', model.get('login'), model.get('areanombre')
				+'_'+model.get('area_id'), model.get('id'));
	});

	window.collections.notas.on('add', function (model) {
		var view = new Pedidos.Views.Notas({model: model});
		view.render();
		view.$el.appendTo('.notas ul');
	});

	window.collections.adicionales.on('add', function (model) {
		var view = new Pedidos.Views.Adicionales({model: model});
		view.render();
		view.$el.appendTo('.adicionales');
	});

	window.collections.sabores.on('add', function (model) {
		var view = new Pedidos.Views.Sabores({model: model});
		view.render();
		view.$el.appendTo('.sabores');
	});

	window.collections.productosusuario.on('add', function (model) {
		var view = new Pedidos.Views.ProductosUsuario({model: model});
		view.render();
		view.$el.appendTo('.platosusuario');
	});

	window.collections.combinacionescesta.fetch();
	window.collections.productoscesta.fetch();

	var xhrtiposdecombinacion = window.collections.tipocombinaciones.fetch();
	xhrtiposdecombinacion.done(function () {
		window.collections.familias.fetch();
	});	
	var xhr = window.collections.usuario.fetch();
		xhr = window.collections.combinaciones.fetch();
		xhr = window.collections.productos.fetch();
		xhr = window.collections.pcombinaciones.fetch();
		xhr = window.collections.cocinas.fetch();
		xhr = window.collections.mesas.fetch();
		xhr = window.collections.productosusuario.fetch();

	xhr.done(function () {
		console.log('Start app');
		Backbone.history.start({
			root : '/pedidos',
			pushState: true,
			silent : false
		});
	});	
});