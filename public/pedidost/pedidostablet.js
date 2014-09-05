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
					$('.productotitulo')
						.toggle()
						.html($(link).children('.nfamilia').text());
				});
    		}
	});
});