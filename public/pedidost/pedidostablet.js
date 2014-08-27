	function enviarorden(){
    	alert('enviarorden');
	}

    function precuenta(){
    	alert('precuenta');
    }

    function mostarcarta(){
    	$('.pedido').toggle();
    	$('.carta').toggle();
    }

    function mostarsalones(){
		$('.salones').css('display', 'block');
    	$('.mesas').css('display', 'block');
    	$('.comanda').css('display', 'none');
    	$('#nombremesa').html('');
	}

$(function(){
	NProgress.start();
    setTimeout(function() { NProgress.done()}, 1000);
    $('.mesa').hammer().bind("swiperight", function(event){
    	$('.salones').css('display', 'none');
    	$('.mesas').css('display', 'none');
    	$('.comanda').css('display', 'block');
    	var nombre = '<i class="fa fa-cutlery"></i>'+ '&nbsp;' + $(this).attr('salon-nombre').substring(0,8) +'-'+ $(this).children('.nombre_mesa').text();
    	$('#nombremesa').html(nombre);
    });

    $('.btn_accion').each(function(i, link){
    		var funcion = $(this).prop('hash').substring(1);
			$(link)
				.on('click', function(event){
					event.preventDefault();
					window[funcion]();
				});
	});

	$('.producto').each(function(i, link){
    		var conttogle = $(this).attr('data-togle');
    		if(conttogle){
    			$(link)
				.on('click', function(event){
					$('.familia').toggle();
					$(conttogle).toggle();
				});
    		}
	});
});