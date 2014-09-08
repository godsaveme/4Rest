Pedidos.Collections.Productoscesta = Backbone.Collection.extend({
	model : Pedidos.Models.Productoscesta,
	localStorage: new Backbone.LocalStorage("productoscesta-backbone"),
	sumacantidades: function(){
		var data = this.where({mesa_id: window.variables.mesaid});	
        return data.reduce(function(suma, value) { return suma + parseInt(value.get("cantidad")) }, 0);
    },
    sumaprecios:function(){
    	var data = this.where({mesa_id: window.variables.mesaid});
    	return data.reduce(function(suma, value) { return suma + parseFloat(value.get("preciot")) }, 0);
    }
});