Pedidos.Collections.Productosmesa = Backbone.Collection.extend({
	model : Pedidos.Models.Productos,
	url : '/mesas/productosmesa',
	name: 'productosmesa',
	sumacantidades: function(){
        return this.reduce(function(suma, value) { return suma + parseInt(value.get("cantidad")) }, 0);
    },
    sumaprecios:function(){
    	return this.reduce(function(suma, value) { return suma + parseFloat(value.get("precio")) }, 0);
    }
});
