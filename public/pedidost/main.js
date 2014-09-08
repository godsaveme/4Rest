$(function(){
	window.variables.sabores = 0;
	window.routers.base = new Pedidos.Routers.Base();
	window.collections.familias = new Pedidos.Collections.Familias();
	window.collections.tipocombinaciones = new Pedidos.Collections.Tipocombinaciones();
	window.collections.combinaciones = new Pedidos.Collections.Combinaciones();
	window.collections.productos = new Pedidos.Collections.Productos();
	window.collections.pcombinaciones = new Pedidos.Collections.Pcombinaciones();
	window.collections.combinacionescesta = new Pedidos.Collections.Combinacionescesta();
	window.collections.productoscesta = new Pedidos.Collections.Productoscesta();
	window.collections.productosmesa = new Pedidos.Collections.Productosmesa();
	window.collections.cocinas = new Pedidos.Collections.Cocinas();
	window.views.app =new Pedidos.Views.App( $('body') );

	window.collections.familias.on('add', function (model) {
		// Agregar nuevas vistas de articulos aqui
		var view = new Pedidos.Views.Familias({model: model});
		view.render();
		view.$el.appendTo('.carta');
	});

	window.collections.tipocombinaciones.on('add', function (model) {
		// Agregar nuevas vistas de articulos aqui
		var view = new Pedidos.Views.Tipocombinaciones({model: model});
		view.render();
		view.$el.prependTo('.carta');
	});


	window.collections.combinaciones.on('add', function (model) {
		// Agregar nuevas vistas de articulos aqui
		var view = new Pedidos.Views.Combinaciones({model: model});
		view.render();
		view.$el.appendTo('.listaproductos');
	});

	window.collections.productos.on('add', function (model) {
		// Agregar nuevas vistas de articulos aqui
		var view = new Pedidos.Views.Productos({model: model});
		view.render();
		view.$el.appendTo('.listaproductos');
	});

	window.collections.pcombinaciones.on('add', function (model) {
		// Agregar nuevas vistas de articulos aqui
		var view = new Pedidos.Views.Pcombinaciones({model: model});
		view.render();
		view.$el.appendTo('.carta');
	});

	window.collections.combinacionescesta.on('add', function (model) {
		// Agregar nuevas vistas de articulos aqui
		var view = new Pedidos.Views.Combinacionescesta({model: model});
		view.render();
		view.$el.prependTo('.cestaitems');
		window.views.app.totales();
	});

	window.collections.productoscesta.on('add', function (model) {
		// Agregar nuevas vistas de articulos aqui
		var view = new Pedidos.Views.Productoscesta({model: model});
		view.render();
		view.$el.prependTo('.cestaitems');
		window.views.app.totales();
	});

	window.collections.productosmesa.on('add', function (model) {
		// Agregar nuevas vistas de articulos aqui
		var view = new Pedidos.Views.Productosmesa({model: model});
		view.render();
		view.$el.appendTo('.cestaitems');
		window.views.app.totales();
	});

	window.collections.combinacionescesta.fetch();
	window.collections.productoscesta.fetch();

	var xhr = window.collections.combinaciones.fetch();
	 	xhr = window.collections.familias.fetch();
		xhr = window.collections.tipocombinaciones.fetch();
		xhr = window.collections.productos.fetch();
		xhr = window.collections.pcombinaciones.fetch();
		xhr = window.collections.cocinas.fetch();

	xhr.done(function () {
		console.log('Start app');
		Backbone.history.start({
			root : '/pedidos',
			pushState: true,
			silent : false
		});
	});
});