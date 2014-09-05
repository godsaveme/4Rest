Pedidos.Collections.Productoscesta = Backbone.Collection.extend({
	model : Pedidos.Models.Productoscesta,
	localStorage: new Backbone.LocalStorage("productoscesta-backbone"),
	sumacantidades: function(){
        return this.reduce(function(suma, value) { return suma + parseInt(value.get("cantidad")) }, 0);
    },
    sumaprecios:function(){
    	return this.reduce(function(suma, value) { return suma + parseFloat(value.get("preciot")) }, 0);
    }
});