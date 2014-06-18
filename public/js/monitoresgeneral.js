$('#btn_aceparea').on('click',function(event) {
		event.preventDefault();
		/* Act on the event */
		window.location.href = '/monitores/area/'+$('#select_areaid').val();
});