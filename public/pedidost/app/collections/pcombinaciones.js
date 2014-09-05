Pedidos.Collections.Pcombinaciones = Backbone.Collection.extend({
	model : Pedidos.Models.Productos,
	url : '/combinacions/productoscombinaciones',
	name: 'pcombinaciones',
	resetvalores:function(){
    	this.each(function(i){
    		i.set("combcantidad",i.get("combcantidad2"));
    	});
    }
});