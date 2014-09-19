Pedidos.Routers.Base = Backbone.Router.extend({
	routes : {
		"" : "root",
		"combinaciones/:id/:nombre" : "combinaciones",
		"productos/:id/:nombre" : "productos",
		"pcombinacion/:id":"pcombinacion",
		"mesa":"mesa",
		"notas":"notas",
		"sabores":"sabores",
		"adicionales": "adicionales",
		"precuenta": "precuenta",
		"pedidospendientes": "pedidospendientes"
	},
	root : function () {
		window.app.state = "root";
		window.app.combinacion = null;
	},
	combinaciones : function (id,nombre) {
		window.app.state = "combinaciones";
		window.app.combinacion = id;
		window.app.tipocombinacion = id;
		window.app.tipocombinacionnombre = nombre;
		window.app.nombre = nombre;

	},
	productos:function(id,nombre){
		window.app.state = "productos";
		window.app.familia = id;
		window.app.nombre = nombre;
	},
	pcombinacion: function(id){
		window.app.state = "pcombinacion";
		window.app.combinacion = id;
	},
	mesa:function(){
		window.app.state = "mesa";
	},
	nota: function(){
		window.app.state = "notas";
	},
	sabores: function(){
		window.app.state = "sabores";
	},
	adicionales: function(){
		window.app.state = "adicionales";
	},
	precuenta: function(){
		window.app.state = "precuenta";
	},
	pedidospendientes: function(){
		window.app.state = "pedidospendientes";
	}
});