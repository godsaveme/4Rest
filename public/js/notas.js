$('select').on('change', function(event) {
	var familia ;
	if(parseInt($(this).val()) === 0){
		$(this).children('option').each(function() {
			if($(this).val() != 0 & $(this).val() != ''){
				buscarfamilia($(this).val(), $(this).text(), '#familias');
			}
		});
	}else{
		if($(this).val() !== ''){
			var id = $(this).val();
			var nfami = $('select option').filter(function() {
				return $(this).val() === id;
			}).text();
			buscarfamilia($(this).val(), nfami, '#familias');
		}
	}
});

$('body').on('click', '#familias li', function(){
	$(this).remove();
});
$('body').on('click', '#familiaslista li', function(){
	eliminarnotas($(this).attr('id-familia'));
	$(this).remove();
});

$('#guardarnota').on('click', function(event) {
	event.preventDefault();
	guardarnotas();
});

function guardarnotas(){
	var familias = {};
	var c= 0;
	$('#familias').children('li').each(function() {
		familias[c] = {id: $(this).attr('id-familia')};
		c++;
	});
	$.ajax({
		url: '/guardarnotas',
		type: 'POST',
		dataType: 'json',
		data: {familias: familias, idnota: $('#nombrenota').attr('data-idnota')},
	})
	.done(function(data) {
		$.each(data,function(index){
			var flag2 = $('#familiaslista li').filter(function() {
				return parseInt($(this).attr('id-familia')) === parseInt(data[index]['id']);
			}).attr('id-familia');
			if(flag2 ==null){
				familia = '<li id-familia="'+data[index]['id']+'" >'+data[index]['nombre']+'</li>';
				$('#familiaslista').append(familia);
			}
			//buscarfamilia(data[index]['id'], data[index]['nombre'], '#familiaslista');
		});
		$('#familias').html('');
	});
	
}

function eliminarnotas(id){
	$.ajax({
		url: '/eliminarnotas',
		type: 'POST',
		dataType: 'json',
		data: {idfamilia: id},
	})
	.done(function(data) {
		console.log(data);
	});
}

function buscarfamilia(id, nombre,contenedor){
	var flag = $('#familias li').filter(function() {
		return parseInt($(this).attr('id-familia')) === parseInt(id);
	}).attr('id-familia');
	var flag2 = $('#familiaslista li').filter(function() {
		return parseInt($(this).attr('id-familia')) === parseInt(id);
	}).attr('id-familia');
	if(flag ==null & flag2 ==null){
		familia = '<li id-familia="'+id+'" >'+nombre+'</li>';
		$(contenedor).append(familia);
	}
}
