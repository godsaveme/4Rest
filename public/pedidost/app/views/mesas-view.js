Pedidos.Views.Mesas = Backbone.View.extend({
	events:{
		"click" : "navigate"
	},
	tagName : "div",
	className : "mesa",
	initialize : function () {
		var self = this;
        this.model.on('change', function () {
                self.render();
        });
		this.template = _.template( $('#mesa-template').html() );
		// this.template = swig.compile( $('#article-template').html() );
	},
	navigate : function () {
        if (this.model.get('actividad') == 1) {
            alert('Ya se esta procesando un pedido en esta mesa');
            return false;
        }
		window.collections.productosmesa.reset();
        window.variables.nombremesa = this.model.get('nombre');
		$('.productosmesa').remove();
        $('.precuenta').html('');
		$('.salones').css('display', 'none');
    	$('.mesas').css('display', 'none');
    	$('.comanda').css('display', 'block');
    	var nombre = '<i class="fa fa-cutlery"></i>'
    				+ '&nbsp;Salon 01'
    				+'-'+ this.model.get('nombre');
    	$('#nombremesa').html(nombre);
    	$.ajax({
    		url: '/sesionmesa',
    		type: 'POST',
    		dataType: 'json',
    		data: {mesaid: this.model.get('id')},
    	})
    	.done(function(data) {
    		window.variables.mesaid = data.session;
    		window.variables.pedidoid = data.pedidoid;
    		window.collections.productosmesa.fetch();
    		window.views.app.totales();
            socket.emit('ocuparmesa',window.variables.mesaid); 
    		Backbone.history.navigate('mesa', {trigger:true});
    	})
    	.fail(function() {
    		console.log("error");
    	})
    	.always(function() {
    		console.log("complete");
    	});
	},
	render : function () {
		var data = this.model.toJSON();
		// junto data con el template;
		var html = this.template(data);
		this.$el.html( html );

        if (this.model.get('estado') == 'O') {
            this.$el.addClass('ocupada');
            if (this.model.get('importeapagar') == null && 
                this.model.get('importetotal') > 0) {
                this.$el.addClass('pagada');
            }
            if ( this.model.get('usuario_id') == window.variables.usuarioid) {
                this.$el.addClass('usuario');
            }
        }
	}
});