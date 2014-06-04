function CalcularPrecioTotal(){
                    $total = 0;
                    $c = 0;
                    $('.montoTotal').each(function(index) {
                      $total += parseFloat($(this).text());
                      ++$c;
                    });
                    $('.montoTotalcu').html('S/.'+ $total.toFixed(2));
                    $('.NmrItms').html($c);
                    $('#infomesa').data('itotal', $total.toFixed(2));
                    $('#tab_cesta .km-badge').text($c);
  					$('#tab_cesta').attr('data-badge', $c);
    }
//productos normales
var dataSourceprof= new kendo.data.DataSource({
  data: [ ],
  schema: {
    model: { id: "id" }
  }
});
$("#enviarpf").kendoListView({
     dataSource: dataSourceprof,
    template: kendo.template($('#template_cestaproductos').html())
});
var idprocesta = 0;
$('body').on('click','.product', function(event) {
	event.preventDefault();
	if ($('#infomesa').attr('data-id')>0) {
		var newprofcesta = {};
		idprocesta++;
		$('#enviarpf').removeClass('k-widget k-listview');
		newprofcesta['id'] = idprocesta;
		newprofcesta['idpro'] = $(this).attr('data-proid');
		newprofcesta['nombre'] = $(this).attr('data-pronombre');
		newprofcesta['precio'] = $(this).attr('data-proprecio');
		newprofcesta['preciot'] = $(this).attr('data-proprecio');
		newprofcesta['numsabores'] = $(this).attr('data-cantsabores');
		newprofcesta['cantidad'] = 1;
		newprofcesta['notas'] = '';
		newprofcesta['sabores']= '';
		newprofcesta['cantidadnotas'] = 0;
		newprofcesta['cantidadadicionales'] = 0;
		newprofcesta['cantidadsabores'] = 0;
		newprofcesta['adicionales'] = '';
		dataSourceprof.add(newprofcesta);
		dataSourceprof.sort({ field: "id", dir: "desc" });
		CalcularPrecioTotal();
		if ($(this).attr('data-cantsabores') > 0) {
			window.location.href = '#page1';
		};
	}else{
		alert('Tienes que selecionar una mesa!!');
	}
});

$('body').on('click', '#enviarpf .reitemcesta', function(event) {
	event.preventDefault();
	var dataItem = dataSourceprof.get($(this).attr('data-iddatasour'));
	dataSourceprof.remove(dataItem);
	CalcularPrecioTotal();
});

$('body').on('click', '#enviarpf .btn_pluscanti', function(event) {
	event.preventDefault();
	/* Act on the event */
	var dataItem = dataSourceprof.get($(this).attr('data-iddatasour'));
	var newcantidad = dataItem.cantidad + 1;
	var newprecio = dataItem.precio*newcantidad;
	dataSourceprof.pushUpdate({ id: $(this).attr('data-iddatasour'), cantidad: newcantidad, preciot: parseFloat(newprecio).toFixed(2) });
	CalcularPrecioTotal();
});

$('body').on('click', '#enviarpf .btn_mincanti', function(event) {
	event.preventDefault();
	/* Act on the event */
	var dataItem = dataSourceprof.get($(this).attr('data-iddatasour'));
	var newcantidad = dataItem.cantidad - 1;
	var newprecio = dataItem.precio*newcantidad;
	if(newcantidad>0){
		dataSourceprof.pushUpdate({ id: $(this).attr('data-iddatasour'), cantidad: newcantidad , preciot: parseFloat(newprecio).toFixed(2)});
		CalcularPrecioTotal();
	}
});
//finproductosnormales

//combinaciones
var templatecombiiz = kendo.template($("#template_combi_iz").html());
var templatecombide = kendo.template($('#template_combi_de').html());
var dataSourcecombitemp= new kendo.data.DataSource({
  data: [ ],
  schema: {
    model: { id: "id" }
  }
});
var dataSourcecombi= new kendo.data.DataSource({
  data: [ ],
  schema: {
    model: { id: "id" }
  }
});
$("#enviarcombi").kendoListView({
     dataSource: dataSourcecombi,
    template: kendo.template($('#template_cestacombinaciones').html())
});
$('#enviarcombi').removeClass('k-widget k-listview');
$('.btn_createcombi').on('click', function(event) {
		event.preventDefault();
		/* Act on the event */
		var nombrecombi = $(this).text();
		var idcombi = $(this).attr('data-idcombi');
		var precicombi= $(this).attr('data-combiprecio');
		if($(this).attr('data-active') == 1){
			$(this).attr('data-active', 0);
			$(".caja_derecha").data("kendoMobileDrawer").hide();
			$('.panel_combinaciones').css('display', 'none');
		}else{
			//alert($(this).attr('data-idcombi'));
			$(this).attr('data-active', 1);
			$.ajax({
				url: '/getcombinaciones',
				type: 'POST',
				dataType: 'json',
				data: {idcombi: $(this).attr('data-idcombi')},
			})
			.done(function(data) {
				dataSourcecombitemp.data([]);
				$('#listplatoscombi').removeClass('k-widget k-listview');
				$(".templatecombiiz").html(templatecombiiz({
				            nombrecombinacion: nombrecombi,
				            familias: data
				        }));
				$('.templatecombide').html(templatecombide({
				            nombrecombinacion: nombrecombi,
				            familias: data
				        }));
				$('#menutitulo').text(nombrecombi);
				$('.cantidad_menu').text(0);
				$('#menutitulo').data('idcombi', idcombi);
				$('#menutitulo').data('combiprecio', precicombi);
				$('#menutitulo').data('cantidad', 0);
				$('#menutitulo').data('idarrcombitemp', 0);
				$('.panel_combinaciones').css('display', 'block');
				$(".caja_derecha").data("kendoMobileDrawer").show();
			});
		}
	});
var viewModel_listacombinaciones = kendo.observable({
    listacombinaciones: dataSourcecombitemp
});

// refreshes the list view
$('body').on('click', '.btn_pluscmenu', function(event) {
	event.preventDefault();
	/* Act on the event */
	newcantidad = $('#menutitulo').data('cantidad') + 1;
	$('.cantidad_menu').text(newcantidad);
	$('#menutitulo').data('cantidad', newcantidad);
	cantidad = $('#fcombicantidad').val();
	var prueba = {};
	var producombi ={};
	for (var i = 0; i < cantidad; i++) {
		prueba['producombi'+i]= {nombre: '-', idprocombi: ''};
		producombi[i] = 'producombi'+i;
	};
	prueba['nombrecombi'] = $('#menutitulo').text();
	prueba['cantidad'] = cantidad;
	prueba['producombi'] = producombi;
	prueba['id'] = $('#menutitulo').data('idarrcombitemp');
	prueba['idcombi'] = $('#menutitulo').data('idcombi');
	prueba['preciot'] = $('#menutitulo').data('combiprecio');
	$('#menutitulo').data('idarrcombitemp', parseInt(prueba['id']) + 1);
	dataSourcecombitemp.add(prueba);
	kendo.bind($("#listplatoscombi"), viewModel_listacombinaciones);
	console.log(dataSourcecombitemp);
});

$('body').on('click', '.btn_minuscmenu', function(event) {
	event.preventDefault();
	/* Act on the event */
	if ( $('#menutitulo').data('cantidad') >0) {
		newcantidad = $('#menutitulo').data('cantidad') - 1;
		$('.cantidad_menu').text(newcantidad);
		$('#menutitulo').data('cantidad', newcantidad);
		var data = dataSourcecombitemp.data();
		var lastItem = data[data.length - 1];
		var newid = parseInt($('#menutitulo').data('idarrcombitemp')) - 1;
		$('.negrita').each( function() {
			if($(this).attr('data-idselec') == $('#menutitulo').data('idarrcombitemp')){
				$(this).attr('data-idselec', newid);
			}
		});
		$('#menutitulo').data('idarrcombitemp', newid);
		dataSourcecombitemp.pushDestroy(lastItem);
	}
});

$('body').on('click', '.procombi', function(event) {
	event.preventDefault();
	var classfami = '.'+$(this).attr('data-faid');
	var idselec = $(classfami).attr('data-idselec');
	if( idselec < $('#menutitulo').data('cantidad')){
		var fcantidad = $(classfami).attr('data-cantidad');
		if(fcantidad > 0){
			newpcantidad = fcantidad - 1;
			var profila =  {};
				profila['id'] = idselec;
			var newprocombi = {}
				newprocombi['nombre'] =$(this).text();
				newprocombi['idprocombi']= $(this).attr('data-procombiid');
				newprocombi['precio'] = $(this).attr('data-procompre');
				newprocombi['cantidadnotas'] = 0;
				newprocombi['cantidadsabores'] = 0;
				newprocombi['cantidadadicionales'] = 0;
				newprocombi['notas'] = '';
				newprocombi['sabores']= '';
				newprocombi['adicionales'] = '';
				profila['producombi'+$(classfami).attr('data-idfila')] = newprocombi;
			}
			dataSourcecombitemp.pushUpdate(profila);
			$(classfami).attr('data-cantidad', newpcantidad);
			var newfila = parseInt($(classfami).attr('data-idfila')) + 1;
			$(classfami).attr('data-idfila', newfila);
			if(newpcantidad == 0){
				var newfila0 = newfila - $(this).attr('data-cantidad');
				$(classfami).attr('data-cantidad',$(this).attr('data-cantidad'));
				$(classfami).attr('data-idfila', newfila0);
				$(classfami).attr('data-idselec', parseInt(idselec) + 1);
			}
			console.log(dataSourcecombitemp);
			kendo.bind($("#listplatoscombi"), viewModel_listacombinaciones);
		}
});

$('body').on('click', '#btn_cancelar_combi', function(event) {
	event.preventDefault();
	/* Act on the event */
	$('.btn_createcombi').attr('data-active', 0);
	$(".caja_derecha").data("kendoMobileDrawer").hide();
	$('.panel_combinaciones').css('display', 'none');
});
$('body').on('click', '#btn_ordenarcombi', function(event) {
	event.preventDefault();
	/* Act on the event */
	if ($('#infomesa').attr('data-id')>0) {
		var datax = dataSourcecombitemp.data();
		for (var i = datax.length - 1; i >= 0; i--) {
			var datacom = dataSourcecombi.data();
			var newid = datacom.length;
			var newdatacom = {};
			newdatacom['id'] = newid;
			newdatacom['idcombi']= datax[i].idcombi;
			newdatacom['nombrecombi'] = datax[i].nombrecombi;
			newdatacom['cantidad'] = 1;
			newdatacom['fcantidad'] = datax[i].cantidad;
			newdatacom['precio']= datax[i].preciot;
			newdatacom['preciot'] = datax[i].preciot;
			newdatacom['producombi'] = datax[i].producombi;
			for (var j = 0; j < datax[i].cantidad; j++) {
					newdatacom['producombi'+j] = datax[i]['producombi'+j];
			};
				dataSourcecombi.add(newdatacom);
				dataSourcecombi.sort({ field: "id", dir: "desc" });
		};
		CalcularPrecioTotal();
		$('.btn_createcombi').attr('data-active', 0);
		$(".caja_derecha").data("kendoMobileDrawer").hide();
		$('.panel_combinaciones').css('display', 'none');
		dataSourcecombitemp.data([]);
	}else{
		alert('Tienes que selecionar una mesa');
	}
});

$('body').on('click', '#enviarcombi .reitemcesta', function(event) {
	event.preventDefault();
	var dataItem = dataSourcecombi.get($(this).attr('data-iddatasour'));
	dataSourcecombi.remove(dataItem);
});

$('body').on('click', '#enviarcombi .btn_pluscanti', function(event) {
	event.preventDefault();
	/* Act on the event */
	var dataItem = dataSourcecombi.get($(this).attr('data-iddatasour'));
	var newcantidad = dataItem.cantidad + 1;
	var newprecio = dataItem.precio*newcantidad;
	dataSourcecombi.pushUpdate({ id: $(this).attr('data-iddatasour'), cantidad: newcantidad, preciot: parseFloat(newprecio).toFixed(2) });
	CalcularPrecioTotal();
});

$('body').on('click', '#enviarcombi .btn_mincanti', function(event) {
	event.preventDefault();
	/* Act on the event */
	var dataItem = dataSourcecombi.get($(this).attr('data-iddatasour'));
	var newcantidad = dataItem.cantidad - 1;
	var newprecio = dataItem.precio*newcantidad;
	if(newcantidad>0){
		dataSourcecombi.pushUpdate({ id: $(this).attr('data-iddatasour'), cantidad: newcantidad , preciot: parseFloat(newprecio).toFixed(2)});
	CalcularPrecioTotal();
	}
});
//fincombinaciones
//enviar pedidos
function ordenarpedidos(e) {
        var dataprof = dataSourceprof.data();
		var dataproc = dataSourcecombi.data();
		if(dataprof.length !== 0 || dataproc.length !== 0 ){
			$.ajax({
	              type: 'POST',
	                      url: '/verificarcocinas',
	                      dataType: "json",
	                      data:{parametro:$('#area').attr('data-idlocal')},
	                      success: function (data){
	                        var idc;
	                        var con = 0;
	                        var arrayareas2 =[];
	                        $.each(data,function(index){
	                          arrayareas2.push(data[index]['areanombre']+'_'+data[index]['id']);
	                          if( idc == data[index]['id_tipo']){
	                            con++;
	                          }
	                          idc = data[index]['id_tipo'];
	                        });
	                        enviarcocina(data, arrayareas2, con);
	                      }
	    });
		}
}

$('#ordenarpedidos').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	var dataprof = dataSourceprof.data();
	var dataproc = dataSourcecombi.data();
	if(dataprof.length !== 0 || dataproc.length !== 0 ){
		$.ajax({
              type: 'POST',
                      url: '/verificarcocinas',
                      dataType: "json",
                      data:{parametro:$('#area').attr('data-idlocal')},
                      success: function (data){
                        var idc;
                        var con = 0;
                        var arrayareas2 =[];
                        $.each(data,function(index){
                          arrayareas2.push(data[index]['areanombre']+'_'+data[index]['id']);
                          if( idc == data[index]['id_tipo']){
                            con++;
                          }
                          idc = data[index]['id_tipo'];
                        });
                        enviarcocina(data, arrayareas2, con);
                      }
    });
	}
});

//enviar mensaje a cocinas
function notificacioncocina(mesa,pedido,areas,data){
  socket.emit('Enviaracocina',mesa, pedido, areas,data);
}

function enviarcocina(data, arrayareas2, con){
  if (con != 0) {
    var arrayareas =[];
    var mostrarareas;
    var id;
     $.each(data,function(index){
          if( id == data[index]['id_tipo']){
            mostrarareas = '<li>';
            mostrarareas += '<a href="javascript:void(0)" data-nar="'+data[index]['areanombre']+'_'+data[index]['id']+'" class="button tiny radius secondary">';
            mostrarareas += data[index]['areanombre'];
            mostrarareas += '</a>';
            mostrarareas += '</li>';
            $('#'+data[index]['nombre']+'_'+data[index]['id_tipo']).append(mostrarareas);
            con++;
          }else{
            mostrarareas = '<strong>'+data[index]['nombre']+'</strong>';
            mostrarareas += '<ul id ="'+data[index]['nombre']+'_'+data[index]['id_tipo']+'" class="button-group">';
            mostrarareas += '<li>';
            mostrarareas += '<a href="javascript:void(0)" data-nar="'+data[index]['areanombre']+'_'+data[index]['id']+'" class="button tiny radius secondary">';
            mostrarareas += data[index]['areanombre'];
            mostrarareas += '</a>';
            mostrarareas += '</li>';
            mostrarareas += '</ul>';
            $('#cocinas').append(mostrarareas);
          }
          id = data[index]['id_tipo'];
    });
          $('#cocinas').css('display','block');
          $('#btnEnviarOrdenes').css('display', 'none');
          mostrarareas = '<button type="button" class="button radius tiny right" id="btnEnviarOrdenes2">';
          mostrarareas += 'Enviar órdenes </button>';
          $('#cocinas').append(mostrarareas);
          $('body').on('click','#cocinas ul li',function(){
            var pos = arrayareas.indexOf($(this).find('a').attr('data-nar'));
            if(pos == -1){
              arrayareas.push($(this).find('a').attr('data-nar'));
            }
            $(this).find('a').addClass('success');
            $(this).find('a').removeClass('secondary');
            $(this).siblings().find('a').removeClass('success');
            $(this).siblings().find('a').addClass('secondary');
            $('#cocinas li .secondary').each(function(){
              var pos = arrayareas.indexOf($(this).attr('data-nar'));
              pos > -1 && arrayareas.splice( pos, 1 );
            });
          });
          $('body').on('click','#btnEnviarOrdenes2',function(){
            if(arrayareas.length){
              enviarordenes(arrayareas,$('#mesa_').text(), $('#mesa_').attr('data-idpe'));
              $('#cocinas').css('display','none');
              $('#cocinas').html('');
               $('#btnEnviarOrdenes').css('display', 'block');
            }else{
              alert('Seleciona a donde enviaras los pedidos');
            }
          });
  }else{
    enviarordenes(arrayareas2);
  }
}
//finenviarmensaje a cocinas
function enviarordenes(cocinas){
	var dataprofe = dataSourceprof.data();
	var dataproce = dataSourcecombi.data();
	var datacombinenvi = {};
	var dataprodfcenvi = {};
	for (var i = dataproce.length - 1; i >= 0; i--) {
		var newdata = {};
		newdata['nombrecombi'] = dataproce[i].nombrecombi;
		newdata['idcombi'] = dataproce[i].idcombi;
		newdata['cantidad'] = dataproce[i].cantidad;
		newdata['fcantidad'] = dataproce[i].fcantidad;
		newdata['precio']= dataproce[i].preciot;
		newdata['preciot'] = dataproce[i].preciot;
		var producombi = {};
		for (var j = 0; j < dataproce[i].fcantidad; j++) {
				var newnotas = {};
				for (var y = dataproce[i]['producombi'+j]['cantidadnotas'] - 1; y >= 0; y--) {
					newnotas[y] = {idnota:dataproce[i]['producombi'+j]['notas'][y]['idnota'],
								   nombre: dataproce[i]['producombi'+j]['notas'][y]['nombre']};
				}
				var newadicionales = {};
				for (var y = dataproce[i]['producombi'+j]['cantidadadicionales'] - 1; y >= 0; y--) {
					newadicionales[j] =  {idadicional:dataprofe[i]['adicionales'][j]['idadicional'] ,
											nombre: dataprofe[i]['adicionales'][j]['nombre'],
											precio: dataprofe[i]['adicionales'][j]['preciot'],
											cantidad: dataprofe[i]['adicionales'][j]['cantidad']}

				}
				var newsabores = {};
				for (var y = dataproce[i]['producombi'+j]['cantidadsabores'] - 1; y >= 0; y--) {
					newsabores[j] =  {idsabor:dataprofe[i]['sabores'][j]['idsabor'] ,
									nombre: dataprofe[i]['sabores'][j]['nombre']}
				}
				newdata['producombi'+j] = 	{idprocombi: dataproce[i]['producombi'+j]['idprocombi'],
										   	nombre: dataproce[i]['producombi'+j]['nombre'],
										   	precio: dataproce[i]['producombi'+j]['precio'],
											notas:newnotas,
											sabores:newsabores,
											adicionales:newadicionales};
				producombi[j]= 'producombi'+j;
		};
		newdata['producombi'] = producombi;
		datacombinenvi[i] = newdata;
		console.log(newdata);
	};

	for (var i = dataprofe.length - 1; i >= 0; i--) {
		var newdata = {};
		newdata['idpro'] = dataprofe[i].idpro;
		newdata['nombre'] = dataprofe[i].nombre;
		newdata['precio'] = dataprofe[i].precio;
		newdata['preciot']= dataprofe[i].preciot;
		newdata['cantidad'] = dataprofe[i].cantidad;
		var newnotas = {};
		for (var j = dataprofe[i].cantidadnotas - 1; j >= 0; j--) {
			newnotas[j] = {idnota:dataprofe[i]['notas'][j]['idnota'] , nombre: dataprofe[i]['notas'][j]['nombre']};
		}
		var newadicionales = {};
		for (var j = dataprofe[i].cantidadadicionales - 1; j >= 0; j--) {
			newadicionales[j] =  {idadicional:dataprofe[i]['adicionales'][j]['idadicional'] ,
									nombre: dataprofe[i]['adicionales'][j]['nombre'],
									precio: dataprofe[i]['adicionales'][j]['preciot'],
									cantidad: dataprofe[i]['adicionales'][j]['cantidad']}

		}
		var newsabores = {};
		for (var j = dataprofe[i].cantidadsabores - 1; j >= 0; j--) {
			newsabores[j] =  {idsabor:dataprofe[i]['sabores'][j]['idsabor'] ,
							nombre: dataprofe[i]['sabores'][j]['nombre']}
		}
		newdata['notas'] = newnotas;
		newdata['sabores']= newsabores;
		newdata['adicionales'] = newadicionales;
		dataprodfcenvi[i] = newdata;
	};
	$.ajax({
		url: '/enviarpedidos',
		type: 'POST',
		dataType: 'json',
		data: {prof: dataprodfcenvi, proc: datacombinenvi, mozoid: $('#infomozo').attr('data-idmozo'),
				 pedidoid:$('#infomozo').attr('data-idpedido'), cocinas : cocinas,
				 idmesa: $('#infomesa').attr('data-id') }
	})
	.done(function(data) {
			var templateprocomb = kendo.template($("#template_productosc").html());
			var templateprof = kendo.template($('#template_productosf').html());
			var pedido = data['pedidoid'];
			if(data['arrayprof']){
				for (var i in data['arrayprof']) {
				$("#productosenviados").prepend(templateprof(data['arrayprof'][i]));
				};
			}
			if(data['arrayproco']){
				for (var i in data['arrayproco']) {
				$("#productosenviados").prepend(templateprocomb(data['arrayproco'][i]));
				};
			}
			$('#infomozo').attr('data-idpedido',data['pedidoid']);
			dataSourcecombi.data([]);
			dataSourceprof.data([]);
			CalcularPrecioTotal();
			precuenta(1, 0);
			//notificacioncocina($('#infomesa').text(), pedido, cocinas, data['orden']);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
}
//fin enviarpedidos

//notas
$('body').on('mouseenter', '#enviarpf .notas', function(event) {
  event.preventDefault();
  $(this).tooltipster({
        trigger: 'click',
        position:'bottom',
        content: 'Cargando.....',
        theme: 'tooltipster-shadow',
        contentAsHTML: 'true',
        interactive: 'true',
        functionBefore: function(origin, continueTooltip) {
          continueTooltip();
          var idpro = $(this).attr('data-id');
          var filaid = $(this).attr('data-filaid');
           if (origin.data('ajax') !== 'cached') {
            $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {idpro: idpro},
            url: '/mostrarnotas',
            success: function(data) {
              var contenido = '<div style="width: 25em" class="list-group">';
              		contenido += '<div class="list-group-item">';
               		contenido += '<input type="search" id="inputpro_'+idpro+filaid+'" class="form-control" value="" required="required" title=""> <br>';
               		contenido += '<button type="button" class="btn btn-primary btn-sm" style="margin-right: 5px;"'
               		contenido += 'onclick = "guardarnotapro('+idpro+','+filaid+')">Guardar</button>';
               		contenido += '</div>';
                  for( var i in data){
                    contenido += '<a class="list-group-item" href="javascript:void(0)" onclick="selecionanotapro('+idpro+','+data[i]['id']+',\''+data[i]['descripcion']+'\','+filaid+');" >'
                    contenido += data[i]['descripcion']+'</a>'
                  }
                  contenido += '</div>';
              origin.tooltipster('content', contenido).data('ajax', 'cached');
            }
            });
           }
        },
  });
});

function guardarnotapro(idpro, filaid){

	$.ajax({
		url: '/crearnotapro',
		type: 'POST',
		dataType: 'json',
		data: {idpro: idpro, nota: $('#inputpro_'+idpro+filaid).val()},
	})
	.done(function(data) {
		selecionanotapro(idpro, data['id'], data['descripcion'], filaid);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
}

function selecionanotapro(idpro, idnota, nombre, filaid){
	dataSourceprof.fetch(function(){
		var data = this.get(filaid);
		var onotas = data.notas;
		var nocantidad = data.cantidadnotas;
		var n =  -1;
		if(onotas){
			for (var i = nocantidad - 1; i >= 0; i--) {
				if(data['notas'][i]['idnota'] == idnota){
					n = 1;
				}
			}
		}else{
			n = onotas.indexOf(idnota);
		}
		if (parseInt(n) == -1) {
			var newnotas = {};
			if(onotas){
				for (var i = nocantidad - 1; i >= 0; i--) {
					newnotas[i] = {idnota:data['notas'][i]['idnota'] , nombre: data['notas'][i]['nombre']};
				}
					newnotas[nocantidad] = {idnota: idnota, nombre: nombre};
					var newcantidadnotas = parseInt(nocantidad) + 1;
			}else{
				newnotas[nocantidad] = {idnota: idnota, nombre: nombre};
				var newcantidadnotas = parseInt(nocantidad) + 1;
			}
			dataSourceprof.pushUpdate({id: filaid, notas: newnotas, cantidadnotas: newcantidadnotas});
		};
	});
}

$('body').on('mouseenter', '#enviarcombi .notas', function(event) {
  event.preventDefault();
  $(this).tooltipster({
        trigger: 'click',
        position:'bottom',
        content: 'Cargando.....',
        theme: 'tooltipster-shadow',
        contentAsHTML: 'true',
        interactive: 'true',
        functionBefore: function(origin, continueTooltip) {
          continueTooltip();
          var idpro = $(this).attr('data-id');
          var filaid = $(this).attr('data-filaid');
          var procombi = $(this).attr('data-procombi');
           if (origin.data('ajax') !== 'cached') {
            $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {idpro: idpro},
            url: '/mostrarnotas',
            success: function(data) {
               var contenido = '<div class="list-group" style="width: 25em">';
               		contenido += '<div class="list-group-item">';
               		contenido += '<input type="search" id="inputprocombi_'+idpro+filaid+procombi+'" class="form-control" value="" required="required" title=""> <br>';
               		contenido += '<button type="button" class="btn btn-primary btn-sm" style="margin-right: 5px;"'
               		contenido += 'onclick = "guardarnotaprocombi('+idpro+','+filaid+',\''+procombi+'\')">Guardar</button>';
               		contenido += '</div>';
                  for( var i in data){
                    contenido += '<a class="list-group-item" href="javascript:void(0)" onclick="selecionanotapro2('+idpro+','+data[i]['id']+',\''+data[i]['descripcion']+'\','+filaid+',\''+procombi+'\');" >'
                    contenido += data[i]['descripcion']+'</a>'
                  }
                  contenido += '</div>';
              origin.tooltipster('content', contenido).data('ajax', 'cached');
            }
            });
           }
        },
  });
});

function guardarnotaprocombi(idpro, filaid, procombi){
	$.ajax({
		url: '/crearnotapro',
		type: 'POST',
		dataType: 'json',
		data: {idpro: idpro, nota: $('#inputprocombi_'+idpro+filaid+procombi).val()},
	})
	.done(function(data) {
		selecionanotapro2(idpro, data['id'], data['descripcion'], filaid, procombi);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
}

function selecionanotapro2(idpro, idnota, nombre, filaid, procombi){
	dataSourcecombi.fetch(function(){
		var data = this.get(filaid);
		var onotas = data[procombi]['notas'];
		var nocantidad = data[procombi]['cantidadnotas'];
		var n =  -1;
		var newdatos = {};
		if(onotas){
			for (var i = nocantidad - 1; i >= 0; i--) {
				if(data[procombi]['notas'][i]['idnota'] == idnota){
					n = 1;
				}
			}
		}else{
			n = onotas.indexOf(idnota);
		}
		if (parseInt(n) == -1) {
			var newnotas = {};
			if(onotas){
				for (var i = nocantidad - 1; i >= 0; i--) {
					newnotas[i] = {idnota:data[procombi]['notas'][i]['idnota'] , nombre: data[procombi]['notas'][i]['nombre']};
				}
					newnotas[nocantidad] = {idnota: idnota, nombre: nombre};
					var newcantidadnotas = parseInt(nocantidad) + 1;
					newdatos['id'] = filaid;
					var newprocombi = {}
						newprocombi['notas'] = newnotas;
					var newcantidadnotas = parseInt(nocantidad) + 1;
						newprocombi['cantidadnotas'] = newcantidadnotas;
						newprocombi['nombre'] =data[procombi]['nombre'];
						newprocombi['idprocombi']= data[procombi]['idprocombi'];
						newprocombi['precio'] = data[procombi]['precio'];
						newprocombi['cantidadsabores'] = data[procombi]['cantidadsabores'];
						newprocombi['cantidadadicionales'] = data[procombi]['cantidadadicionales'];
						newprocombi['sabores']= data[procombi]['sabores'];
						newprocombi['adicionales'] = data[procombi]['adicionales'];
					newdatos[procombi] = newprocombi;

			}else{
				newdatos['id'] = filaid;
				newnotas[nocantidad] = {idnota: idnota, nombre: nombre};
				var newprocombi = {}
					newprocombi['notas'] = newnotas;
				var newcantidadnotas = parseInt(nocantidad) + 1;
					newprocombi['cantidadnotas'] = newcantidadnotas;
					newprocombi['nombre'] =data[procombi]['nombre'];
					newprocombi['idprocombi']= data[procombi]['idprocombi'];
					newprocombi['precio'] = data[procombi]['precio'];
					newprocombi['cantidadsabores'] = data[procombi]['cantidadsabores'];
					newprocombi['cantidadadicionales'] = data[procombi]['cantidadadicionales'];
					newprocombi['sabores']= data[procombi]['sabores'];
					newprocombi['adicionales'] = data[procombi]['adicionales'];
				newdatos[procombi] = newprocombi;
			}
			dataSourcecombi.pushUpdate(newdatos);
			console.log(dataSourcecombi);
		};
	});
}
//fin notas

//adicionales
$('body').on('mouseenter', '#enviarpf .btn_adi', function(event) {
  event.preventDefault();
  $(this).tooltipster({
        trigger: 'click',
        position: 'bottom',
        content: 'Cargando.....',
        theme: 'tooltipster-shadow',
        contentAsHTML: 'true',
        interactive: 'true',
        functionBefore: function(origin, continueTooltip) {
          continueTooltip();
          var idpro = $(this).attr('data-id');
          var filaid = $(this).attr('data-filaid');
           if (origin.data('ajax') !== 'cached') {
            $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {idpro: idpro},
            url: '/adicionales',
            success: function(data) {
              var contenido = '<div style="width: 25em" class="list-group">';
                  for( var i in data){
                    contenido += '<a class="list-group-item" href="javascript:void(0)" onclick="selecionaradicionalp('+idpro+','+data[i]['id']+',\''+data[i]['nombre']+'\','+filaid+',\''+data[i]['precio']+'\');" >'
                    contenido += data[i]['nombre']+'</a>'
                  }
                  contenido += '</div>';
              origin.tooltipster('content', contenido).data('ajax', 'cached');
            }
            });
           }
        },
  });
});

function selecionaradicionalp(idpro, idadi, nombreadi, filaid, adiprecio){
	dataSourceprof.fetch(function(){
		var data = this.get(filaid);
		var oadicional = data.adicionales;
		var nocantidad = data.cantidadadicionales;
		var n =  -1;
		var newadicional = {};
		if(oadicional){
			for (var i = nocantidad - 1; i >= 0; i--) {
				var ocantidad = data['adicionales'][i]['cantidad'];
				var newcantidad = 0;
				if(data['adicionales'][i]['idadicional'] == idadi){
					newcantidad = parseInt(ocantidad) + 1;
					n = 1;
				}else{
					newcantidad = ocantidad;
				}
				var newprecio = parseFloat(data['adicionales'][i]['precio']) * parseInt(newcantidad);
				newadicional[i] = {idadicional:data['adicionales'][i]['idadicional'] , 
									   nombre: data['adicionales'][i]['nombre'],
									   precio: data['adicionales'][i]['precio'],
									   preciot: parseFloat(newprecio).toFixed(2),
									   cantidad: newcantidad};
			}
			var newcantidadadicionales = nocantidad;
		}else{
			n = oadicional.indexOf(idadi);
		}
		if (parseInt(n) == -1) {
			if(oadicional){
				for (var i = nocantidad - 1; i >= 0; i--) {
					newadicional[i] = {idadicional:data['adicionales'][i]['idadicional'] , 
									   nombre: data['adicionales'][i]['nombre'],
									   precio: data['adicionales'][i]['precio'],
									   cantidad: data['adicionales'][i]['cantidad'],
										preciot: data['adicionales'][i]['preciot']};
				}
					newadicional[nocantidad] = {idadicional: idadi, nombre: nombreadi, 
												precio: adiprecio, preciot:adiprecio, cantidad: 1};
					var newcantidadadicionales = parseInt(nocantidad) + 1;
			}else{
				newadicional[nocantidad] = {idadicional: idadi, nombre: nombreadi, 
											precio: adiprecio, preciot: adiprecio,cantidad: 1};
			}
			var newcantidadadicionales = parseInt(nocantidad) + 1;
		}
		dataSourceprof.pushUpdate({id: filaid, adicionales: newadicional, cantidadadicionales: newcantidadadicionales});
		console.log(dataSourceprof);
	});
CalcularPrecioTotal();
}

$('body').on('click', '#enviarpf .btn_minadi', function(event) {
	event.preventDefault();
		var data = dataSourceprof.get($(this).attr('data-idfila'));
		var filaid = data.id;
		var oidadi = $(this).attr('data-idadi');
		var oadicional = data.adicionales;
		var nocantidad = data.cantidadadicionales;
		var newcantidadadicionales = nocantidad;
		var newadicional = {};
		var contador = 0;
		for (var i = 0; i < nocantidad; i++) {
				var ocantidad = data['adicionales'][i]['cantidad'];
				var newcantidad = 0;
				if(data['adicionales'][i]['idadicional'] == oidadi){
					newcantidad = parseInt(ocantidad) - 1;
					n = 1;
				}else{
					newcantidad = ocantidad;
				}
				var newprecio = parseFloat(data['adicionales'][i]['precio']) * parseInt(newcantidad);
				if(newcantidad > 0){
					newadicional[contador] = {idadicional:data['adicionales'][i]['idadicional'] , 
									   nombre: data['adicionales'][i]['nombre'],
									   precio: data['adicionales'][i]['precio'],
									   preciot: parseFloat(newprecio).toFixed(2),
									   cantidad: newcantidad};
									   contador++;
				}else{
					newcantidadadicionales = parseInt(nocantidad) -1;
				}
			}
		dataSourceprof.pushUpdate({id: filaid, adicionales: newadicional, cantidadadicionales: newcantidadadicionales});
		CalcularPrecioTotal();
});
//finacionales

//sabores
$('body').on('mouseenter', '.produnombre', function(event) {
	event.preventDefault();
	/* Act on the event */
	var cantsabores = $(this).attr('data-numsabores');
	var data = dataSourceprof.get($(this).attr('data-iddatasour'));
	if(cantsabores){
		$(this).tooltipster({
	        trigger: 'click',
	        position: 'bottom',
	        content: 'Cargando.....',
	        theme: 'tooltipster-shadow',
	        contentAsHTML: 'true',
	        interactive: 'true',
	        functionBefore: function(origin, continueTooltip) {
	          continueTooltip();
	          var idpro = data.idpro;
	          var filaid = $(this).attr('data-iddatasour');
	           if (origin.data('ajax') !== 'cached') {
	            $.ajax({
	            type: 'POST',
	            dataType: 'json',
	            data: {idpro: idpro},
	            url: '/sabores',
	            success: function(data) {
	              var contenido = '<div style="width: 25em" class="list-group">';
	                  for( var i in data){
	                    contenido += '<a class ="list-group-item" href="javascript:void(0)" onclick="selecionasaborp('+idpro+','+data[i]['id']+',\''+data[i]['nombre']+'\','+filaid+');" >'
	                    contenido += data[i]['nombre']+'</a>'
	                  }
	                  contenido += '</div>';
	              origin.tooltipster('content', contenido).data('ajax', 'cached');
	            }
	            });
	           }
	        },
	  });
	}
});

function selecionasaborp(idpro, idsabor, nombresabor, filaid){
	dataSourceprof.fetch(function(){
		var data = this.get(filaid);
		var osabores = data.sabores;
		var nocantidad = data.cantidadsabores;
		var newsabor = {};
		if (nocantidad < data.numsabores) {
			if(osabores){
				for (var i = nocantidad - 1; i >= 0; i--) {
					newsabor[i] = {idsabor: data['sabores'][i]['idsabor'] , 
									nombre: data['sabores'][i]['nombre']};
				}
					newsabor[nocantidad] = {idsabor: idsabor, nombre: nombresabor };
			}else{
				newsabor[nocantidad] = {idsabor: idsabor, nombre: nombresabor};
			}
			var newcantidadsabores = parseInt(nocantidad) + 1;
			dataSourceprof.pushUpdate({id: filaid, sabores: newsabor, cantidadsabores: newcantidadsabores});
			console.log(dataSourceprof);
		}
	});
}

$('body').on('click', '#enviarpf .btn_minsabor', function(event) {
	event.preventDefault();
		var data = dataSourceprof.get($(this).attr('data-idfila'));
		var filaid = data.id;
		var oidsabor = $(this).attr('data-idsabor');
		var osabores = data.sabores;
		var newcantidadsabores = parseInt(data.cantidadsabores) - 1;
		var newsabor= {};
		var contador = 0;
		for (var i = parseInt(data.cantidadsabores) - 1; i >= 0; i--) {
			if(data['sabores'][i]['idsabor'] != oidsabor){
				newsabor[contador] = {idsabor: data['sabores'][i]['idsabor'] , 
									nombre: data['sabores'][i]['nombre']};
									contador++;
			}
		}
		dataSourceprof.pushUpdate({id: filaid, sabores: newsabor, cantidadsabores: newcantidadsabores});
});
//finsabores


//precuenta
var precuentatemplate = kendo.template($('#template_precuenta').html());
var dataSourceprecuenta = new kendo.data.DataSource({
							  data: [ ],
							  schema: {
							    model: { id: "id" }
							  }
							});
var dataSourcecuenta = new kendo.data.DataSource({
							  data: [ ],
							  schema: {
							    model: { id: "id" }
							  }
							});
$(".modalwindowprecuenta").kendoWindow({
  				actions: ["Close"],
  				visible: false,
  				modal: true,
  				title: 'Precuenta',
  				resizable: false,
  				width: '300px',
  				animation: false,
  				position: { top: 50 , left: 100}
});

function btnprecuenta(e){
	if($('#infomozo').attr('data-idpedido') != 0){
		$('.k-window').css('min-width','90px');
		precuenta(1,1);
	}
}

$('#btn_precuenta').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	if($('#infomozo').attr('data-idpedido') != 0){
		$('.k-window').css('min-width','90px');
		precuenta(1,1);
	}
});

$('#btn_cancelarpre').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	$('.modalwindowprecuenta').data("kendoWindow").close();
});

$('#btn_aceptarpre').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	precuenta(2, 0);
	$('.modalwindowprecuenta').data("kendoWindow").close();
});

function precuenta(tipo, pre){
	var precuenta = {};
	var datosprecu = dataSourceprecuenta.data();
	if(datosprecu.length > 0 & tipo == 2){
		for (var i =  0; i < datosprecu.length ; i++) {
			var newdato = {};
					newdato['id'] = i;
					newdato['proid'] = datosprecu[i]['id'];
					newdato['nombre'] = datosprecu[i]['nombre'];
					newdato['cantidad'] = datosprecu[i]['cantidad'];
					newdato['precio'] = datosprecu[i]['precio'];
					newdato['preciou'] = datosprecu[i]['preciou'];
					newdato['combinacion_id'] = datosprecu[i]['combinacion_id'];
					newdato['combinacion_c'] = datosprecu[i]['combinacion_c'];
					newdato['cobrar']= 0;
					newdato['modificar']= 0;
			precuenta[i] = newdato;
		}
	}
	$.ajax({
			url: '/precuenta',
			type: 'POST',
			dataType: 'json',
			data: {idpedido: $('#infomozo').attr('data-idpedido'), tipopre: tipo,
					mesa: $('#infomesa').text(), mozo: $('#infomozo').text(), precuenta: precuenta}
		})
		.done(function(data) {
			if(data){
				dataSourcecuenta.data([]);
				dataSourceprecuenta.data([]);
				var itotal = 0;
				for (var i in data) {
					var newdato = {};
					newdato['id'] = i;
					newdato['proid'] = data[i]['id'];
					newdato['nombre'] = data[i]['nombre'];
					newdato['cantidad'] = data[i]['cantidad'];
					newdato['precio'] = data[i]['precio'];
					newdato['preciou'] = data[i]['preciou'];
					newdato['combinacion_id'] = data[i]['combinacion_id'];
					newdato['combinacion_c'] = data[i]['combinacion_c'];
					newdato['cobrar']= 0;
					newdato['modificar']= 0;
					dataSourceprecuenta.add(newdato);
					dataSourcecuenta.add(newdato);
					var newitotal = itotal + parseFloat(data[i]['precio']);
					itotal = newitotal;
				}
				$('#input_itotal').val(parseFloat(itotal).toFixed(2));
				$('#infomesa').data('itotal', parseFloat(itotal).toFixed(2));
				$('#itotal_partircuenta').text(parseFloat(itotal).toFixed(2));
			}
			if(tipo==1 & pre == 1){
				$('#listaprecuenta').html(precuentatemplate({precuenta: dataSourceprecuenta.data()}));
				$('.modalwindowprecuenta').data("kendoWindow").open();
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
}
//precuenta

//cerrar mesa
function cerrar_mesa(e){
		$.ajax({
		url: '/cerrarmesa',
		type: 'POST',
		dataType: 'json',
		data: {idpedido: $('#infomozo').attr('data-idpedido')},
		})
		.done(function(data) {
			if(data == 'true'){
				dataSourcecombi.data([]);
			  	dataSourceprof.data([]);
			 	dataSourcelistaproductosenviados.data([]);
			  	$("#productosenviados").html('');
			  	productosenviadostotal();
				$('#infomesa').text('');
				$('#infomesa').attr('data-id', '');
				$('#infomozo').attr('data-idpedido', '');
				$('#infomozo').attr('data-idmozo','');
				$('#infomozo').text('');
				window.location.href = '#page1';
			}else{
				alert(data);
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
}
$('#btn_cerrarmesa').on('click', function(event) {
	event.preventDefault();
	$.ajax({
		url: '/cerrarmesa',
		type: 'POST',
		dataType: 'json',
		data: {idpedido: $('#infomozo').attr('data-idpedido')},
	})
	.done(function(data) {
		if(data == 'true'){
			window.location.href = '/cajas';
		}else{
			alert(data);
		}
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
});

//fincerrarmesa

//salir_mesa
function salir_mesa(e){
	dataSourcecombi.data([]);
  	dataSourceprof.data([]);
 	dataSourcelistaproductosenviados.data([]);
  	$("#productosenviados").html('');
	window.location.href = '#page1';
	productosenviadostotal();
	$('#infomesa').text('');
	$('#infomesa').attr('data-id', '');
	$('#infomozo').attr('data-idpedido', '');
	$('#infomozo').attr('data-idmozo','');
	$('#infomozo').text('');
}
//finsalirmesa