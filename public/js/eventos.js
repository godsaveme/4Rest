$("#fecha").kendoDatePicker({
    format: "yyyy/MM/dd"
});
$("#hora").kendoTimePicker({
    format: "HH:mm"
});

$("#horafin").kendoTimePicker({
    format: "HH:mm"
});

var onewcliente = {};
onewcliente['nombres'] = '-';
onewcliente['direccion'] = '-';
onewcliente['dni'] = '-';
$('#cliente').data('cliente', onewcliente);
//cliente
$(".windowsregistrarclienteevento").kendoWindow({
  				actions: ["Close"],
  				visible: false,
  				modal: true,
  				title: 'Registrar Cliente',
  				resizable: false,
  				draggable: false,
  				animation: false,
  				width: '900px',
  				position: { top: 20 , left: 20}
});

var dataSourcepersonas = new kendo.data.DataSource({transport: {
		                                              read: "/prueba"
		                                            },
		                                              serverFiltering: true
		                                            });
$("#cliente").kendoAutoComplete({
    dataTextField: "nombres",
    filter: "nombres",
    minLength: 3,
    dataSource: dataSourcepersonas,
    select: function(e) {
            var item = e.item;
            var text = item.text();
            dataSourcepersonas.filter( { field: "nombres", operator: "startswith", value: text});
            var filtro = dataSourcepersonas.view();
            var newcliente = {};
            for (var i = filtro.length - 1; i >= 0; i--) {
            	if (filtro[i]['nombres'] == text) {
            		newcliente['nombres'] = filtro[i]['nombres'];
		            newcliente['direccion'] = filtro[i]['direccion'];
		            newcliente['dni'] = filtro[i]['dni'];
            	}
            };
            $('#cliente').data('cliente',newcliente);
            $('#datos_clienteevento').html(templatecliente(newcliente));
            console.log( $('#cliente').data('cliente'));
          }
});

$('#btn_nuevoclienteevento').on('click', function(event) {
	event.preventDefault();
	$(".windowsregistrarclienteevento").data("kendoWindow").open();
});

var template = kendo.template($("#template").html());
var templateem = kendo.template($('#template_cliem').html());
var templatecliente = kendo.template($('#template_cliente').html());
$('#datos_clienteevento').html(templatecliente(onewcliente));

function previewpersona() {
    $("#datos_persona").html(template({
        nombres: $("#input_nombres").val(),
        apPaterno: $("#input_apPaterno").val(),
        apMaterno: $("#input_apMaterno").val(),
        dni: $('#input_dni').val(),
        Direccion: $('#input_direccion').val()
    }));
}

function previewempresa() {
    $("#datos_empresa").html(templateem({
        nombres: $("#input_rs").val(),
        ruc: $('#input_ruc').val(),
        Direccion: $('#input_direccionem').val()
    }));
}

previewpersona();
previewempresa();

$('#frm_clipersona input').on('change', function(event) {
	event.preventDefault();
	/* Act on the event */
	previewpersona();
});


$('#frm_cliempresa input').on('change', function(event) {
	event.preventDefault();
	/* Act on the event */
	previewempresa();
});

$('#btn_rpersona').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	$('#cliente').data('rclitipo', 1);
	$('#cont_cliperona').css('display', 'block');
	$('#cont_cliempresa').css('display', 'none');
});

$('#btn_rempresa').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	$('#cliente').data('rclitipo', 2);
	$('#cont_cliperona').css('display', 'none');
	$('#cont_cliempresa').css('display', 'block');
});

$('.registrarcliente').on('click',function(event) {
	event.preventDefault();
	/* Act on the event */
	
	if($('#cliente').data('rclitipo') == 1){
		var flag = $('#frm_clipersona input').filter(function(index) {
		return $(this).val() == '';
		});

		if (flag.length>0) { return false};

		var newdatos = {
				        nombres: $("#input_nombres").val(),
				        apPaterno: $("#input_apPaterno").val(),
				        apMaterno: $("#input_apMaterno").val(),
				        dni: $('#input_dni').val(),
				        direccion: $('#input_direccion').val()
				    	};
	}else if ($('#cliente').data('rclitipo') == 2) {
		var flag = $('#frm_cliempresa input').filter(function(index) {
		return $(this).val() == '';
		});

		if (flag.length>0) { return false};
		var newdatos = {
				        nombres: $("#input_rs").val(),
				        ruc: $('#input_ruc').val(),
				        direccion: $('#input_direccionem').val()
				    	};
	}

	$.ajax({
		url: '/registrarcliente',
		type: 'POST',
		dataType: 'json',
		data: {datos: newdatos, rtipo: $('#cliente').data('rclitipo')},
	})
	.done(function(data) {
			var newcliente = {};
            newcliente['nombres'] = data[0]['nombres'];
            newcliente['direccion'] = data[0]['direccion'];
            newcliente['dni'] = data[0]['dni'];
		$('#cliente').data('cliente',newcliente);
		$(".windowsregistrarclienteevento").data("kendoWindow").close();
		$(".windowsregistrarclienteevento input").val('');
		$('#datoscliente').val($('#cliente').data('cliente'));
		console.log($('#cliente').data('cliente'));
		previewpersona();
		previewempresa();
		alert('Operacion Completada');
		$('#datos_clienteevento').html(templatecliente(newcliente));
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
});
//fincliente

$('body').on('change', '.inpt_cobrar', function(event) {
	event.preventDefault();
	/* Act on the event */
	var itotal = validarvalores($('#costo').val());
	var ipagado = validarvalores($('#ipagado').val());
	var vuelto = validarvalores($('#ivuelto').val());
	if(ipagado == 0){
		$('#ipagado').val('0.00');
	}
	if(itotal == 0){
		$('#costo').val('0.00');
	}

	if (vuelto == 0) {
		$('#ivuelto').val('0.00')
	};
	vuelto = parseFloat(ipagado) - parseFloat(itotal);
	$('#costo').val(parseFloat(itotal).toFixed(2))
	$('#ipagado').val(parseFloat(ipagado).toFixed(2))
	$('#ivuelto').val(parseFloat(vuelto).toFixed(2))
});