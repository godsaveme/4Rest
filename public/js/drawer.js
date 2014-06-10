$(".caja_derecha").kendoMobileDrawer({
	    container: "#contenido",
	    position: "right"
	});
	$(".caja_izquierda").kendoMobileDrawer({
	    container: "#contenido",
	    position: "left"
	});
	$('#btn_draweriz').on('click', function(event) {
		event.preventDefault();
		/* Act on the event */
		if($(this).attr('data-active') == 1){
			$(this).attr('data-active', 0);
			$(".caja_izquierda").data("kendoMobileDrawer").hide();
		}else{
			//alert($(this).attr('data-idcombi'));
			$(this).attr('data-active', 1);	
			$(".caja_izquierda").data("kendoMobileDrawer").show();
		}
	});
	$('#btn_drawerder').on('click', function(event) {
		event.preventDefault();
		/* Act on the event */
		if($(this).attr('data-active') == 1){
			$(this).attr('data-active', 0);
			$(".caja_derecha").data("kendoMobileDrawer").hide();
		}else{
			//alert($(this).attr('data-idcombi'));
			$(this).attr('data-active', 1);	
			$(".caja_derecha").data("kendoMobileDrawer").show();
		}
	});