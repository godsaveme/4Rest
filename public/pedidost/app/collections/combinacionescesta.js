Pedidos.Collections.Combinacionescesta = Backbone.Collection.extend({
	model : Pedidos.Models.Combinacionescesta,
	localStorage: new Backbone.LocalStorage("combinacionescesta-backbone"),
	sumacantidades: function(){
        return this.reduce(function(suma, value) { return suma + parseInt(value.get("cantidad")) }, 0);
    },
    sumaprecios:function(){
    	return this.reduce(function(suma, value) { return suma + parseFloat(value.get("preciot")) }, 0);
    }
});