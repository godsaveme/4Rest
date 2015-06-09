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
var dataSourcecombi= new kendo.data.DataSource({
  data: [ ],
  schema: {
    model: { id: "id" }
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

var popupNotification = $("#popupNotification").kendoNotification().data("kendoNotification");
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

var dataSourceprof= new kendo.data.DataSource({
  data: [ ],
  schema: {
    model: { id: "id" }
  }
});

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

$(document).ready(function() {

var popupNotification = $("#popupNotification").kendoNotification().data("kendoNotification");

var socket = io.connect('http://'+window.location.hostname+':3000');	
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
    }
    CalcularPrecioTotal();

    $("#carta").kendoPanelBar({
        animation: false,
    });
    /*$("#newCarta").kendoPanelBar({
        animation: false,
    });*/

/*$("#newCarta").kendoMobileListView({
            dataSource: kendo.data.DataSource.create({
            	transport: {
            		read: {
            			url: "/getCarta",
            			dataType: "json"
            		}
            	},
            	 group: "familia" 
            }),
            template: $("#customListViewTemplate").html(),
            headerTemplate: "<h2> ${value}</h2>"	
        });*/

     var templateCesta = kendo.template($("#template_newCesta").html());

            var dataSourceNewCarta = new kendo.data.DataSource({
                transport: {
                    read: {
                        url: "/getCarta",
                        dataType: "json"
                    }
                },
                requestStart: function() {
                    kendo.ui.progress($("#newCarta"), true);
                },
                requestEnd: function() {
                    kendo.ui.progress($("#newCarta"), false);
                    
                },
                change: function() {
                    $("#newCarta").html(kendo.render(templateCesta, this.view()));
                    //$(document).ready(function() {
                    $("#newCarta").kendoPanelBar({
				        animation: false,
				    });
                	//});
                },
                group: { field: "familia" }
            });

            dataSourceNewCarta.read();


           //prod autocomplete
                $(document).ready(function() {
                    var autocomplete = $("#prodAutoCompl").kendoAutoComplete({
                        minLength: 3,
                        filter: "contains",
                        dataTextField: "nombre",
                        placeholder: "Ingrese nombre de Producto...",
                        headerTemplate: '<div class="dropdown-header">' +
                                '<span class="k-widget k-header">Nombre - Precio </span>' +
                            '</div>',
                        template: '<span class="k-state-default"> #: (data.nombre).substring(0,40) # - <span style="font-weight:bold;">S/.#:data.precio #</span></span>' ,
                        dataSource: {
                            transport: {
                                read:{
                                    dataType: "json",
                                    url: "/colorao"
                                }
                            }
                        },
                        height: 300,
                        select: onSelectProd,
                        close: function(){
                        	$("#prodAutoCompl").val('');
                        	$("#prodAutoCompl").focus();
                        }
                    }).data("kendoAutoComplete");


                    //add readonly input_num
                    $(".input_num").attr("readonly","readonly");
                    $('#input_descuento').removeAttr('readonly','readonly');

                });

	function onSelectProd(e) {
                        
                            var dataItem = this.dataItem(e.item.index());
                            //kendoConsole.log("event :: select (" + dataItem + ")" );
                            console.log("event :: select (" + dataItem.nombre + ")");
                            var newprofcesta = {};
							idprocesta++;
							$('#enviarpf').removeClass('k-widget k-listview');
							newprofcesta['id'] = idprocesta;
							newprofcesta['idpro'] = dataItem.id;
							newprofcesta['nombre'] = dataItem.nombre;
							newprofcesta['precio'] = dataItem.precio;
							newprofcesta['preciot'] = dataItem.precio;
							newprofcesta['numsabores'] = dataItem.cantidadsabores;
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
							
							//$(".kendoNumr").kendoNumericTextBox();

							//var numerictextbox = $(".kendoNumr").data("kendoNumericTextBox");
							//numerictextbox.readonly();
                        
                    }

    //fin prod autocomplete
//cesta de pedidos

//productos normales

$("#enviarpf").kendoListView({
     dataSource: dataSourceprof,
    template: kendo.template($('#template_cestaproductos').html())
});
var idprocesta = 0;
$('body').on('click','.product', function(event) {
	event.preventDefault();
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

$('#listplatoscombi').kendoListView({
				     dataSource: dataSourcecombitemp,
				    template: kendo.template($('#template_listacombi').html())
	});
var listView = $("#listplatoscombi").data("kendoListView");
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
	console.log(cantidad);
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
	$('.btn_createcombi').attr('data-active', 0);
	$(".caja_derecha").data("kendoMobileDrawer").hide();
	$('.panel_combinaciones').css('display', 'none');
	dataSourcecombitemp.data([]);
	//add 08-12-14 00:04
	CalcularPrecioTotal();
});

$('body').on('click', '#enviarcombi .reitemcesta', function(event) {
	event.preventDefault();
	var dataItem = dataSourcecombi.get($(this).attr('data-iddatasour'));
	dataSourcecombi.remove(dataItem);
	//add 08-12-14 00:04
	CalcularPrecioTotal();
	/*dataSourceprof.data([]);
	console.log(dataSourceprof);*/
});

$('body').on('click', '#enviarcombi .btn_pluscanti', function(event) {
	event.preventDefault();
	/* Act on the event */
	var dataItem = dataSourcecombi.get($(this).attr('data-iddatasour'));
	var newcantidad = dataItem.cantidad + 1;
	var newprecio = dataItem.precio*newcantidad;
	dataSourcecombi.pushUpdate({ id: $(this).attr('data-iddatasour'), cantidad: newcantidad, preciot: parseFloat(newprecio).toFixed(2) });
	//add 08-12-14 10:51
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
		//add 08-12-14 10:51
		CalcularPrecioTotal();
	}
});
//fincombinaciones

//enviar pedidos
$('#ordenarpedidos').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	var dataprof = dataSourceprof.data();
	var dataproc = dataSourcecombi.data();
	var $btn = $(this).button('loading');
	if(dataprof.length !== 0 || dataproc.length !== 0 ){
		$.ajax({
              type: 'GET',
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
                            //verifica si hay mas de una area de produccion de untipo en espec
                          }
                          idc = data[index]['id_tipo'];
                        });
                        enviarcocina(data, arrayareas2, con);
                      }
    });
	}else{
		$btn.button('reset');
        alert('No hay pedidos para enviar');
	}
});
//enviar mensaje a cocinas

function enviarcocina(data, arrayareas2, con){
  if (con != 0) {
    var arrayareas =[];
    var mostrarareas;
    var id;
    $('#ordenarpedidos').button('reset');
    //alert('por aqui');
    return false;
  }else{
  	//$('#ordenarpedidos').button('reset');
  	//return false;
    enviarordenes(arrayareas2);
  }
}
//finenviarmensaje a cocinas
function notificacioncocina(infomesa, pedido, cocinas, usuario){
	socket.emit('Enviaracocina', infomesa, pedido, cocinas,usuario);
}

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
        console.log(newdata);
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

            if(data == 'can_order'){
                alert('El pedido ya ha sido cerrado. Por favor actualice el navegador.');
            }

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
			//add ventana cobrar
			//$('.k-window').css('min-width','98%');
			//$('.modalwindowscuenta').data("kendoWindow").open();
			//$('.top span').removeClass('k-widget k-numerictextbox screen k-numeric-wrap k-state-default k-expand-padding');
			//fin add ventana cobrar
			console.log(data);
			notificacioncocina($('#infomesa').text()+'/'+$('#infomozo').text(), pedido, data['orden'], $('#usuario').attr('user_id'));
			$('#ordenarpedidos').button('reset');
	})
	.fail(function(data) {
		console.log(data);
	})
	.always(function() {
		console.log("complete");
	});
}

//fin enviarpedidos
//cestadepedidos

//notas
$('body').on('mouseenter', '#enviarpf .notas', function(event) {
  event.preventDefault();
  $(this).tooltipster({
        trigger: 'click',
        position:'right',
        content: 'Cargando.....',
        theme: 'tooltipster-light',
        animation: 'grow',
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
              var contenido = '<div style="width: 25em; height: 300px; overflow-y: scroll" class="list-group">';
              		contenido += '<div class="list-group-item">';
               		contenido += '<input type="search" id="inputpro_'+idpro+filaid+'" class="form-control search_nota" value="" required="required" title=""> <br>';
               		contenido += '<button type="button" class="btn btn-primary btn-sm" style="margin-right: 5px;"'
               		contenido += 'onclick = "guardarnotapro('+idpro+','+filaid+')">Guardar</button>';
               		contenido += '</div>';
                  for( var i in data){
                    contenido += '<a class="list-group-item" href="javascript:void(0)" onclick="selecionanotapro('+idpro+','+data[i]['id']+',\''+data[i]['descripcion']+'\','+filaid+');" >'
                    contenido += data[i]['descripcion']+'</a>'
                  }
                  contenido += '</div>';
              origin.tooltipster('content', contenido).data('ajax', 'cached');
              $( ".search_nota" ).keypress(function( event ) {
              		if ( event.which == 13 ) {
						guardarnotapro(idpro,filaid);
					}
				});
              $(".search_nota").focus();
            }
            });
           }
        },
  });
});





$('body').on('mouseenter', '#enviarcombi .notas', function(event) {
  event.preventDefault();
  $(this).tooltipster({
        trigger: 'click',
        position:'right',
        content: 'Cargando.....',
        theme: 'tooltipster-light',
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
               var contenido = '<div class="list-group" style="width: 25em; height: 300px; overflow-y: scroll">';
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






//adicionales
$('body').on('mouseenter', '#enviarpf .btn_adi', function(event) {
  event.preventDefault();
  $(this).tooltipster({
        trigger: 'click',
        position:'right',
        content: 'Cargando.....',
        theme: 'tooltipster-light',
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
              var contenido = '<div style="width: 25em; height: 300px; overflow-y: scroll" class="list-group">';
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
    //alert(cantsabores+' '+data);
    //console.log(cantsabores+' '+data);
	if(cantsabores){
		$(this).tooltipster({
	        trigger: 'click',
	        position:'right',
	        content: 'Cargando.....',
	        theme: 'tooltipster-light',
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
                    if (data.length>0){
                        var contenido = '<div style="width: 25em; height: 300px; overflow-y: scroll" class="list-group">';
                    for (var i in data) {
                        contenido += '<a class ="list-group-item" href="javascript:void(0)" onclick="selecionasaborp(' + idpro + ',' + data[i]['id'] + ',\'' + data[i]['nombre'] + '\',' + filaid + ');" >'
                        contenido += data[i]['nombre'] + '</a>'
                    }
                    contenido += '</div>';
                    origin.tooltipster('content', contenido).data('ajax', 'cached');
                }else{
                        origin.tooltipster('content', 'Producto sin sabores').data('ajax', 'cached');
                    }
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
            if(data['sabores'][i]['idsabor'] == oidsabor) oidsabor = -1;
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

$('#btn_precuenta').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	if($('#infomozo').attr('data-idpedido') != 0){
		$('.k-window').css('min-width','90px');
		precuenta(1,1);
	}else{
        alert('No se ha abierto la Mesa');
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

//cuenta
var onewcliente = {};
onewcliente['nombres'] = '-';
onewcliente['direccion'] = '-';
onewcliente['dni'] = '-';
    onewcliente['id'] = null;
$('#infomesa').data('cliente', onewcliente);

$(".modalwindowscuenta").kendoWindow({
  				actions: [],
  				visible: false,
  				modal: true,
  				title: 'Cuenta - ' + $('#infomesa').text() ,
  				resizable: false,
  				draggable: false,
  				animation: false,
  				position: { top: 20 , left: 20}
});

$('body').on('click', '#btn_cobrar', function(event) {
	event.preventDefault();
	/* Act on the event */
	if($('#infomozo').attr('data-idpedido') != 0){
		precuenta(1, 0);
		$('.k-window').css('min-width','98%');
		$('.modalwindowscuenta').data("kendoWindow").open();
		$('.top span').removeClass('k-widget k-numerictextbox screen k-numeric-wrap k-state-default k-expand-padding');
	}else{
        alert('No se ha abierto la Mesa');
    }
});

$("#resultado").kendoNumericTextBox({
    culture: "de-DE",
    spinners: false,
    placeholder: "0.00",
    decimals: 2
});

$(".btn_calcu").on('click', function(event) {
	event.preventDefault();
	vlr1 = $(this).val();
	vlr = vlr1.split('S/. ').join('');
    atual = $("#resultado").siblings('input').val();
    if(atual == ""){
    	atual = 0;
    }
    if(vlr=="C"){
        $("#resultado").siblings('input').val("");
        $("#resultado").val("");
    }else{
        if(vlr=="="){
            $("#resultado").siblings('input').val(eval(atual));
            $("#resultado").val(eval(atual));
        }else{
        	var resultado = parseFloat(atual) + parseFloat(vlr);
        	if(atual == '' & vlr == 0){
        		$("#resultado").siblings('input').val('0.');
        		$("#resultado").val('0.');
        	}else if(atual == '' & vlr == '.'){
        		$("#resultado").siblings('input').val('0.');
        		$("#resultado").val('0.');
        	}else if(vlr == '.'){
        		var n = atual.indexOf(vlr);
        		if(n > 0){
        			return false;
        		}else{
        			$("#resultado").siblings('input').val(atual + vlr);
            		$("#resultado").val(atual + vlr);
        		}
        	}else{
        		$("#resultado").siblings('input').val(resultado.toFixed(2));
            	$("#resultado").val(resultado.toFixed(2));
        	}
        }
    }
});

$('#btn_montoexacto').on('click', function(event){
	event.preventDefault();
	$("#resultado").siblings('input').val($('#input_itotal').val());
    $("#resultado").val($('#input_itotal').val());
});

$(".input_num").keydown(function(event) {
   if(event.shiftKey)
   {
        event.preventDefault();
   }

   if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 190)    {
   }
   else {
        if (event.keyCode < 95) {
          if (event.keyCode < 48 || event.keyCode > 57) {
                event.preventDefault();
          }
        }
        else {
              if (event.keyCode < 96 || event.keyCode > 105) {
                  event.preventDefault();
              }
        }
      }
});

$("#input_idescuento").keydown(function(event) {
   if(event.shiftKey)
   {
        event.preventDefault();
   }

   if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 190)    {
   	
   }
   else {
        if (event.keyCode < 95) {
          if (event.keyCode < 48 || event.keyCode > 57) {
                event.preventDefault();
          }
        }
        else {
              if (event.keyCode < 96 || event.keyCode > 105) {
                  event.preventDefault();
              }
        }
      }
});

function validarvalores(a){
	if(a == ''){
		return 0;
	}else{
		return a;
	}
}
function calculardescuento(){
	var idescuento = validarvalores($('#input_descuento').val()) / 100;
	var descuento = parseFloat($('#infomesa').data('itotal'))* idescuento ;
	var newtotal = parseFloat($('#infomesa').data('itotal')) - parseFloat(descuento);
	$('#input_itotal').val(parseFloat(newtotal).toFixed(2));
	$('#input_idescuento').val(parseFloat(descuento).toFixed(2));
}


function importepagado(){
	var importepagado = parseFloat($('#input_ipagado').val());
	var iefectivo = validarvalores($('#input_iefectivo').val());
	var itarjeta = validarvalores($('#input_itarjeta').val());
	console.log('importepagado:' + importepagado);
	if(importepagado > parseFloat($('#input_itotal').val())){
		var newresta = parseFloat($('#input_itotal').val()) - parseFloat(itarjeta);
		var newefectivo = newresta;
		if(newefectivo > 0){
			$('#input_iefectivo').val(newefectivo.toFixed(2));
            //mod arreglando para poder pagar con tarjeta  y efec a la vez
			//importepagado = importepagado + parseFloat(itarjeta);
			$('#input_ipagado').val(importepagado.toFixed(2));
		}else{
			$('#input_iefectivo').val('0.00');
            //mod arreglando para poder pagar con tarjeta  y efec a la vez
			//importepagado = importepagado + parseFloat(itarjeta);
			$('#input_ipagado').val(importepagado.toFixed(2));
		}
	}else{
		importepagado = parseFloat(iefectivo) + parseFloat(itarjeta);
		$('#input_ipagado').val(importepagado.toFixed(2));
	}
}

function calcularvuelto(){
	calculardescuento();
	var ivale =validarvalores($('#input_ivale').val());
	var newtotal = parseFloat($('#input_itotal').val()) - parseFloat(ivale);
	$('#input_itotal').val(newtotal.toFixed(2));
	importepagado();
	var vuelto = parseFloat($('#input_ipagado').val()) - parseFloat($('#input_itotal').val());
	$('#input_ivuelto').val(parseFloat(vuelto).toFixed(2));
	$('#infomesa').data('vuelto', parseFloat(vuelto).toFixed(2));
}

$('.input_num').on('change', function(event) {
	event.preventDefault();
	/* Act on the event */
	calcularvuelto();
	var newvalue = validarvalores($(this).val());
	$(this).val(parseFloat(newvalue).toFixed(2));
});

$('#btn_efectivo').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	var newvalor = validarvalores($('#resultado').val());
	var iefectivo = validarvalores($('#input_iefectivo').val());
	var ipagadot = validarvalores($('#input_ipagado').val());
	var itarjeta = validarvalores($('#input_itarjeta').val());
	var newsubtotal = parseFloat(itarjeta) + parseFloat(newvalor);
	console.log('iefectivo:' +iefectivo);
	$('#input_iefectivo').val(parseFloat(newvalor).toFixed(2));
	$("#resultado").siblings('input').val("");
    $("#resultado").val("");
	calcularvuelto();
	$('#infomesa').data('contable',1);
});

$('#btn_tarjeta').on('click', function(event) {
    if(parseFloat(validarvalores($('#input_iefectivo').val())) <= parseFloat($('#input_itotal').val()) ){
        if(parseFloat($('#input_itotal').val()) >= parseFloat($('#resultado').val()) ) {
            event.preventDefault();
            /* Act on the event */
            var newvalor = validarvalores($('#resultado').val());
            var iefectivo = validarvalores($('#input_iefectivo').val());
            var ipagadot = validarvalores($('#input_ipagado').val());
            var itarjeta = validarvalores($('#input_itarjeta').val());
            var newsubtotal = parseFloat(iefectivo) + parseFloat(newvalor);
            console.log('itarjeta:' + itarjeta);
            $('#input_itarjeta').val(parseFloat(newvalor).toFixed(2));
            $("#resultado").siblings('input').val("");
            $("#resultado").val("");
            calcularvuelto();
            $('#infomesa').data('contable', 1);
            $('#input_descuento').attr('readonly','readonly');
            $('#input_idescuento').attr('readonly','readonly');
        }else{
            alert('Monto de Tarjeta no puede ser mayor al monto total');
        }
    }else{
        alert('Monto cubierto en su totalidad');
    }
});
$('#btn_vale').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	var newvalor = validarvalores($('#resultado').val());
	$('#input_ivale').val(parseFloat(newvalor).toFixed(2));
	$("#resultado").siblings('input').val("");
    $("#resultado").val("");
	calcularvuelto();
	$('#infomesa').data('contable',0);
	$('#infomesa').data('vale',1);
});

$('#btn_valepersonal').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	var newvalor = validarvalores($('#resultado').val());
	$('#input_ivale').val(parseFloat(newvalor).toFixed(2));
	$("#resultado").siblings('input').val("");
    $("#resultado").val("");
	calcularvuelto();
	$('#infomesa').data('contable',0);
	$('#infomesa').data('vale',2);
});

$('#btn_cobrarclose').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	$('.modalwindowscuenta').data("kendoWindow").close();
	$('.cont_inputcaja input').val('');
	$('.datos_cliente input').val('');
	$('#infomesa').data('cliente',onewcliente);
});

$('.cont_inputcaja input').val('');

$('#input_idescuento').on('change', function(event) {
	event.preventDefault();
	/* Act on the event */
	var descuento = $(this).val();
	var idescuento =  descuento * 100 / parseFloat($('#infomesa').data('itotal'));
	$('#input_idescuento').val(parseFloat(descuento).toFixed(2));
	$('#input_descuento').val(parseFloat(idescuento).toFixed(2));
	calcularvuelto();
});

$('#btn_cobraraceptar').on('click', function(event) {
	event.preventDefault();
	var obtncobrar = $(this);
	obtncobrar.css('display', 'none');
	/* Act on the event */
	calcularvuelto();
	if ($('#infomesa').data('vuelto') >= 0) {
		if ($('#infomesa').data('partircuenta') == 1) {
			var cuenta = dataSourcecuenta.data();
		}else{
			var cuenta = dataSourceprecuenta.data();
		}
		var newtipo = validarvalores($('#infomesa').data('partircuenta'));
		var newcuenta = {};
		for (var i = cuenta.length - 1; i >= 0; i--) {
			var newdato = {};
			newdato['proid'] = cuenta[i]['proid'];
			newdato['nombre'] = cuenta[i]['nombre'];
			newdato['cantidad'] = cuenta[i]['cantidad'];
			newdato['precio'] = cuenta[i]['precio'];
			newdato['preciou'] = cuenta[i]['preciou'];
			newdato['combinacion_id'] = cuenta[i]['combinacion_id'];
			newdato['combinacion_c'] = cuenta[i]['combinacion_c'];
			newdato['cobrar']= cuenta[i]['cobrar'];
			newdato['modificar']= cuenta[i]['modificar'];
			newcuenta[i] = newdato;
		}
		if ($('#input_itarjeta').val() > 0) {
			if($('#input_dtarjeta').val() == ''){
				alert('Ingrese los 4 ultimos digitos de la Tarjeta');
				obtncobrar.css('display', 'block');
				return false;
			}
		}

		if($('#infomesa').data('contable') == 1){
			cobrar_contable(obtncobrar,newtipo,newcuenta);
		}else if ($('#infomesa').data('contable') == 0){
			cobrar_nocontable(obtncobrar,newtipo,newcuenta);
		}
	}else{
		obtncobrar.css('display', 'block');
	}
});

function cobrar_contable(obtncobrar,newtipo,newcuenta){
	if(validarvalores($('#input_ivale').val()) > 0 ){
		obtncobrar.css('display', 'block');
		popupNotification.show('Operacion no permitida, no puedes usar vale personal o desccuento autorizado, parte cuenta si necesitas cobrar con vale', "error");
		return false;
	}
	$.ajax({
			url: '/cobrarmesa',
			type: 'POST',
			dataType: 'json',
			data: { tipo: newtipo, 
					cobrar: newcuenta, 
					pedidoid: $('#infomozo').attr('data-idpedido'),
					itotal: validarvalores($('#input_itotal').val()),
					iefectivo:validarvalores($('#input_iefectivo').val()),
					itarjeta: validarvalores($('#input_itarjeta').val()),
					dtarjeta: $('#input_dtarjeta').val(),
					ivale: validarvalores($('#input_ivale').val()),
					idescuento:validarvalores($('#input_idescuento').val()),
					descuento:validarvalores($('#input_descuento').val()) ,
					ipagado:validarvalores($('#input_ipagado').val()),
					mesa: $('#infomesa').text(), mozo: $('#infomozo').text(),
					vuelto: validarvalores($('#input_ivuelto').val()),
					cliente: $('#infomesa').data('cliente'),
					caja_id: $('#infomesa').attr('data-cajaid'),
					detcajaid: $('#infomesa').attr('data-detcajaid'),
					idmozo: $('#infomozo').attr('data-idmozo')
					}
		})
		.done(function(data) {
			if(data =='True'){
				$('#buscar_cliente').val('');
				$('#infomesa').data('partircuenta', 0);
				$('#infomesa').data('cliente',onewcliente);
				$('.modalwindowscuenta').data("kendoWindow").close();
				$('.cont_inputcaja input').val('');
				popupNotification.show('Operacion Completada Correctamente.', "success");
				obtncobrar.css('display', 'block');
							/*$.ajax({
								url: '/cerrarmesa',
								type: 'POST',
								dataType: 'json',
								data: {idpedido: $('#infomozo').attr('data-idpedido')},
							})
							.done(function(data) {
								if(data == 'true'){
									window.location.href = '/cajas/index';
								}else{
									alert(data);
								}
							})
							.fail(function() {
								console.log("error");
							})
							.always(function() {
								console.log("complete");
							});*/
			}else{
				popupNotification.show('Operacion No completada', "error");
				obtncobrar.css('display', 'block');
			}
		})
		.fail(function() {
			obtncobrar.css('display', 'block');
			popupNotification.show('Operacion no completada', "error");
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
}

function cobrar_nocontable(obtncobrar,newtipo,newcuenta){
	if(validarvalores($('#input_iefectivo').val()) > 0 && validarvalores($('#input_itarjeta').val()) > 0){
		obtncobrar.css('display', 'block');
		popupNotification.show('Operacion no permitida, solo puedes usar una forma de pago.', "error");
		return false;
	}else if(validarvalores($('#input_itotal').val()) > 0){
		obtncobrar.css('display', 'block');
		popupNotification.show('Operacion no permitida, tienes que descontar el valor total, caso contrario parte cuenta.', "error");
		return false;
	}else if($('#infomesa').data('cliente').nombres == '-' && $('#infomesa').data('cliente').dni == '-'){
		obtncobrar.css('display', 'block');
		popupNotification.show('Operacion no permitida, tienes que elegir una persona.', "error");
		return false;
	}
	$.ajax({
			url: '/cobrarvale',
			type: 'POST',
			dataType: 'json',
			data: { tipo: newtipo, 
					cobrar: newcuenta, 
					pedidoid: $('#infomozo').attr('data-idpedido'),
					itotal: validarvalores($('#input_itotal').val()),
					iefectivo:validarvalores($('#input_iefectivo').val()),
					itarjeta: validarvalores($('#input_itarjeta').val()),
					dtarjeta: $('#input_dtarjeta').val(),
					ivale: validarvalores($('#input_ivale').val()),
					idescuento:validarvalores($('#input_idescuento').val()),
					descuento:validarvalores($('#input_descuento').val()) ,
					ipagado:validarvalores($('#input_ipagado').val()),
					mesa: $('#infomesa').text(), mozo: $('#infomozo').text(),
					vuelto: validarvalores($('#input_ivuelto').val()),
					cliente: $('#infomesa').data('cliente'),
					caja_id: $('#infomesa').attr('data-cajaid'),
					detcajaid: $('#infomesa').attr('data-detcajaid'),
					idmozo: $('#infomozo').attr('data-idmozo'),
					tipovale: $('#infomesa').data('vale')
					}
		})
		.done(function(data) {
			if(data =='True'){
				$('#buscar_cliente').val('');
				$('#infomesa').data('partircuenta', 0);
				$('#infomesa').data('cliente',onewcliente);
				$('.modalwindowscuenta').data("kendoWindow").close();
				$('.cont_inputcaja input').val('');
				popupNotification.show('Operacion Completada Correctamente', "success");
				obtncobrar.css('display', 'block');
			}else{
				popupNotification.show('Operacion No completada', "error");
				obtncobrar.css('display', 'block');
			}
		})
		.fail(function() {
			obtncobrar.css('display', 'block');
			popupNotification.show('No tienes nada por cobrar', "error");
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
}


//fincuenta

$(".modalwindowspartircuenta").kendoWindow({
  				actions: ["Close"],
  				visible: false,
  				modal: true,
  				title: 'Partir Cuenta - ' + $('#infomesa').text() ,
  				resizable: false,
  				draggable: false,
  				animation: false,
  				width: '500px',
  				position: { top: 20 , left: 20}
});

//partircuenta
$("#lispartircuenta").kendoListView({
     dataSource: dataSourcecuenta,
    template: kendo.template($('#template_partircuenta').html())
});
$('#btn_partircuenta').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	if($('#infomozo').attr('data-idpedido') != 0){
		$('.k-window').css('min-width','90px');
		precuenta(1, 0);
		$('.modalwindowspartircuenta').data("kendoWindow").open();
	}else{
        alert('Mesa no abierta');
    }
});

function itotalpartircuenta(){
	var data = dataSourcecuenta.data();
	var total = 0;
	for (var i = data.length - 1; i >= 0; i--) {
		if (data[i]['cobrar'] == 1) {
			var newtotal = total + parseFloat(data[i]['precio']);
			total = newtotal;
		}
	}
	$('#itotal_partircuenta').text(parseFloat(total).toFixed(2));
}

$('body').on('click', '.btn_partirplus',function(event) {
	event.preventDefault();
	/* Act on the event */
	//var modfc;
	var modfc = 1;
	var datacuenta = dataSourcecuenta.get($(this).attr('data-fila'));
	var dataprecuenta = dataSourceprecuenta.get($(this).attr('data-fila'));
	var newcantidad = datacuenta.cantidad + 1;
	var newprecio = datacuenta.preciou*newcantidad;
	if(datacuenta.cantidad != dataprecuenta.cantidad & datacuenta.cobrar == 1){
		//verificando si son iguales para que ya no modifique
		if(newcantidad == dataprecuenta.cantidad){ modfc = 0;};
		dataSourcecuenta.pushUpdate({ id: $(this).attr('data-fila'), 
								cantidad: newcantidad, 
								precio: parseFloat(newprecio).toFixed(2),
								modificar: modfc,
								cobrar: datacuenta.cobrar });
		itotalpartircuenta();
	}
});

$('body').on('click','.btn_partirminus', function(event) {
	event.preventDefault();
	/* Act on the event */
	var datacuenta = dataSourcecuenta.get($(this).attr('data-fila'));
	var newcantidad = datacuenta.cantidad - 1;
	var newprecio = datacuenta.preciou*newcantidad;
	if(newcantidad > 0 & datacuenta.cobrar == 1){
		dataSourcecuenta.pushUpdate({ id: $(this).attr('data-fila'), 
								cantidad: newcantidad, 
								precio: parseFloat(newprecio).toFixed(2), 
								modificar:1,
								cobrar: datacuenta.cobrar
								});
		itotalpartircuenta();
	}
});

$('body').on('click', '.btn_selectitem', function(event) {
	event.preventDefault();
	/* Act on the event */
	var datacuenta = dataSourcecuenta.get($(this).attr('data-fila'));
	if (datacuenta.cobrar == 1) {
		$(this).css('background', 'none');
		dataSourcecuenta.pushUpdate({ id: $(this).attr('data-fila'), 
									cobrar: 0 });
	}else{
		$(this).css('background', 'rgba(56,156,6,0.2)');
		dataSourcecuenta.pushUpdate({ id: $(this).attr('data-fila'), 
									cobrar: 1 });
	}
	itotalpartircuenta();
});

$('#btn_cancelarpartircu').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	$('.modalwindowspartircuenta').data("kendoWindow").close();
});

$('#btn_aceptarpartircu').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	dataSourcecuenta.filter( { field: "cobrar", operator: "eq", value: 1});
	var filtro = dataSourcecuenta.view();
	$('#infomesa').data('itotal', $('#itotal_partircuenta').text());
	$('#input_itotal').val($('#itotal_partircuenta').text());
	if (filtro.length > 0) {
		$('#infomesa').data('partircuenta', 1);
	}
	$('.modalwindowspartircuenta').data("kendoWindow").close();
	$('.k-window').css('min-width','75%');
	$('.modalwindowscuenta').data("kendoWindow").open();
	$('.top span').removeClass('k-widget k-numerictextbox screen k-numeric-wrap k-state-default k-expand-padding');
	dataSourcecuenta.filter( { field: "cobrar", operator: "eq", value: 0});
});
//finpartircuenta

//cerrar mesa
$('#btn_cerrarmesa').on('click', function(event) {
	event.preventDefault();

    if ($('#infomozo').attr('data-idpedido') != 0) {

        $.ajax({
            url: '/cerrarmesa',
            type: 'POST',
            dataType: 'json',
            data: {idpedido: $('#infomozo').attr('data-idpedido')},
        })
            .done(function (data) {
                if (data == 'true') {
                    window.location.href = '/cajas/index';
                } else {
                    alert(data);
                }
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            });
    }else{
        alert('Mesa no abierta');
    }
});

//fincerrarmesa


    $('#btn_juntarmesa').on('click', function(event) {
        event.preventDefault();

        if ($('#infomozo').attr('data-idpedido') != 0) {

            $(".windowsjuntarmesa").data("kendoWindow").open();
        }else{
            alert('Envía un pedido para poder juntar mesas');
        }
    });

//cliente
$(".windowsselecionacliente").kendoWindow({
  				actions: ["Close"],
  				visible: false,
  				modal: true,
  				title: 'Seleciona Cliente',
  				resizable: false,
  				draggable: false,
  				animation: false,
  				width: '400px',
  				position: { top: 20 , left: 20}
});

$(".windowsregistrarcliente").kendoWindow({
  				actions: ["Close"],
  				visible: false,
  				modal: true,
  				title: 'Registrar Cliente',
  				resizable: false,
  				draggable: false,
  				animation: false,
  				width: '400px',
  				position: { top: 20 , left: 100}
});

var dataSourcepersonas = new kendo.data.DataSource({transport: {
		                                              read: "/prueba"
		                                            },
		                                              serverFiltering: true
		                                            });
$("#buscar_cliente").kendoAutoComplete({
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
                    newcliente['id'] = filtro[i]['id'];
		            $('#input_nombrec').val(filtro[i]['nombres']);
		            $('#input_documento').val(filtro[i]['dni']);
		            $('#input_addres').val(filtro[i]['direccion']);
            	}
            };
            $('#infomesa').data('cliente',newcliente);
            console.log( $('#infomesa').data('cliente'));
          }
});

$('#btn_nuevocliente').on('click', function(event) {
	event.preventDefault();
	$(".windowsregistrarcliente").data("kendoWindow").open();
	$("#cont_cliperona input").val('');
	$("#cont_cliempresa input").val('');
	previewpersona();
	previewempresa();
});

var template = kendo.template($("#template").html());
var templateem = kendo.template($('#template_cliem').html());

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
	$('#infomesa').data('rclitipo', 1);
	$('#cont_cliperona').css('display', 'block');
	$('#cont_cliempresa').css('display', 'none');
});

$('#btn_rempresa').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	$('#infomesa').data('rclitipo', 2);
	$('#cont_cliperona').css('display', 'none');
	$('#cont_cliempresa').css('display', 'block');
});

$('.registrarcliente').on('click',function(event) {
	event.preventDefault();
	/* Act on the event */
	
	if($('#infomesa').data('rclitipo') == 1){
		var flag = $('#frm_clipersona input').filter(function(index) {
		return $(this).val() == '';
		});

		if (flag.length>0) { return false};

		var newdatos = {
				        nombres: $("#input_nombres").val(),
				        apPaterno: $("#input_apPaterno").val(),
				        apMaterno: $("#input_apMaterno").val(),
				        dni: $('#input_dni').val(),
				        direccion: $('#input_direccion').val(),
				        cliente: 'Cliente'
				    	};
	}else if ($('#infomesa').data('rclitipo') == 2) {
		var flag = $('#frm_cliempresa input').filter(function(index) {
		return $(this).val() == '';
		});

		if (flag.length>0) { return false};
		var newdatos = {
				        nombres: $("#input_rs").val(),
				        ruc: $('#input_ruc').val(),
				        direccion: $('#input_direccionem').val(),
				        cliente: 'Empresa cliente'
				    	};
	}

	$.ajax({
		url: '/registrarcliente',
		type: 'POST',
		dataType: 'json',
		data: {datos: newdatos, rtipo: $('#infomesa').data('rclitipo')},
	})
	.done(function(data) {
			var newcliente = {};
            newcliente['nombres'] = data[0]['nombres'];
            newcliente['direccion'] = data[0]['direccion'];
            newcliente['dni'] = data[0]['dni'];
            newcliente['id'] = data[0]['id'];
            $('#input_nombrec').val(data[0]['nombres']);
            $('#input_documento').val(data[0]['dni']);
            $('#input_addres').val(data[0]['direccion']);
		$('#infomesa').data('cliente',newcliente);
		$(".windowsregistrarcliente").data("kendoWindow").close();
		$(".windowsregistrarcliente input").val('');
		previewpersona();
		previewempresa();
		popupNotification.show('Operacion Completada', "success");
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
});
//fincliente


//cancelar orden
$(".windowseliminarproductos").kendoWindow({
  				actions: ["Close"],
  				visible: false,
  				modal: true,
  				title: 'Ingrese codido para cancelar orden',
  				resizable: false,
  				draggable: false,
  				animation: false,
  				width: '350px',
  				position: { top: 20 , left: 20}
});

$('#productosenviados').on('dblclick', '.list-group-item', function(event) {
	event.preventDefault();
	var iddetalle = $(this).attr('data-iddetped');
	$(".windowseliminarproductos").data("kendoWindow").open();
	$("#infomesa").data('cancelarorden', iddetalle);
	$("#infomesa").data('objetoeliminar', $(this));
});

$('#btn_aceptarcodigo').on('click', function(event) {
	event.preventDefault();
	$.ajax({
		url: '/postcancelarorden',
		type: 'POST',
		dataType: 'json',
		data: {codigo: $('#codigo').val() , iddetalle: $("#infomesa").data('cancelarorden'),
				usuarioautoriza: $('#idautorizado').val(), motivo: $('#input_motivo').val()},
	})
	.done(function(data) {
		if(data['response'] == 'true'){
			if (data['tipo'] == 1) {
				//eliminar adicionales si es que hubieran
				if (data['itemsAdc']) {
					//alert('entro');
					for(var i in data['itemsAdc']){
						$('.list-group-item').filter("[data-iddetped='" + data['itemsAdc'][i]['iddetallep'] + "']").remove();
					}
				};
				socket.emit('NotificarPedidos', data['items'], 'area_1');
			}else if(data['tipo'] == 2){
				for (var i in  data['items']) {
					socket.emit('NotificarPedidos', data['items'][i], 'area_1');
				};
			}
			$("#infomesa").data('objetoeliminar').remove();
			CalcularPrecioTotal();
			alert('Operacion Completada Correctamente');
			$(".windowseliminarproductos").data("kendoWindow").close();
		}else if(data['response'] == 'redirect'){
			if (data['tipo'] == 1) {
				socket.emit('NotificarPedidos', data['items'], 'area_1');
			}else if(data['tipo'] == 2){
				for (var i in  data['items']) {
					socket.emit('NotificarPedidos', data['items'][i], 'area_1');
				};
			}
			window.location.href = '/cajas';
		}else{
			if (data['status'] == false) {
				alert('Operacion no completada. '+data['msg']);
			};
			
			$(".windowseliminarproductos").data("kendoWindow").close();
		}
		$("#infomesa").data('cancelarorden', '');
		$('#codigo').val('');
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
});

$('#btn_cancelarcodigo').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	$(".windowseliminarproductos").data("kendoWindow").close();
	$('#codigo').val('');
});
//fincancelar orden

//movermesa
$(".windowsmovermesa").kendoWindow({
  				actions: ["Close"],
  				visible: false,
  				modal: true,
  				title: 'Selecciona una mesa libre...',
  				resizable: false,
  				draggable: false,
  				animation: false,
  				width: '250px',
  				position: { top: 20 , left: 20}
});

//movermesa
    $(".windowsjuntarmesa").kendoWindow({
        actions: ["Close"],
        visible: false,
        modal: true,
        title: 'Junta mesa con:',
        resizable: false,
        draggable: false,
        animation: false,
        width: '250px',
        position: { top: 20 , left: 20}
    });

$('#btn_movermesa').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	$(".windowsmovermesa").data("kendoWindow").open();
});

$('#btn_cancelarmesa').on('click', function(event) {
	event.preventDefault();
	$(".windowsmovermesa").data("kendoWindow").close();
});
    $('#btn_cancelarjuntarmesa').on('click', function(event) {
        event.preventDefault();
        $(".windowsjuntarmesa").data("kendoWindow").close();
    });

$('#btn_aceptarmesa').on('click', function(event) {
	event.preventDefault();
	if ($('#infomozo').attr('data-idpedido') > 0) {
		var newidmesa = $('#selectmesa').find('option:selected').val();
		$.ajax({
		url: '/movermesa',
		type: 'POST',
		dataType: 'json',
		data: {idmesa: $('#selectmesa').val(), idpedido: $('#infomozo').attr('data-idpedido'),
				idmesaupdate: $('#infomesa').attr('data-id')},
		})
		.done(function(data) {
			if(data == 'true'){
				window.location.href = '/cajas';
			}else{
				alert('Operacion no completada');
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	}else{
        alert('Mesa no abierta');
    }
});

//movermesa

    $('#btn_aceptajuntarmesa').on('click', function(event) {
        event.preventDefault();
        if ($('#infomozo').attr('data-idpedido') > 0) {
            var newidmesa = $('#selectjuntarmesa').find('option:selected').val();
            //alert(newidmesa);
            $.ajax({
                url: '/juntarmesa',
                type: 'POST',
                dataType: 'json',
                data: {idmesa: $('#selectjuntarmesa').val(), idpedido: $('#infomozo').attr('data-idpedido'),
                    idmesaupdate: $('#infomesa').attr('data-id')}
            })
                .done(function(data) {
                    if(data['status'] == true){
                        alert('Completado. '+data['msg']);
                        window.location.href = '/cajas/index';

                    }else{
                        if(data['status'] == false){
                            alert('Operacion no completada. '+data['msg']);
                        }
                    }
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
        }else{
            alert('Mesa no abierta');
        }
    });

//para introducir cant 
var previous;
var previous2;

$('body').on('focus', '.kendoNumr', function(event) {

	previous = $(this).val();
	//alert('foucs');
});
$('body').on('focus', '.kendoNumr2', function(event) {

	previous2 = $(this).val();
	//alert('foucs');
});

$('body').on('blur', '.kendoNumr', function(event) {
	if (isNumber($(this).val()) && parseFloat($(this).val()) > 0 ) {
		$(this).val(parseFloat($(this).val()).toFixed(0));
			if ($(this).val() == 0) { $(this).val(previous); };
			var prev = $(this).parent().prev().children().attr('data-iddatasour');
			console.log(prev);
			var dataItem = dataSourceprof.get(prev);
			var newcantidad = parseFloat($(this).val()).toFixed(0);
			var newprecio = dataItem.precio*newcantidad;
			dataSourceprof.pushUpdate({ id: prev, cantidad: newcantidad, preciot: parseFloat(newprecio).toFixed(2) });
			CalcularPrecioTotal();
	}else{
		$(this).val(previous);

	}; 

});

$('body').on('blur', '.kendoNumr2', function(event) {
	if (isNumber($(this).val()) && parseFloat($(this).val()) > 0 ) {
		$(this).val(parseFloat($(this).val()).toFixed(0));
			if ($(this).val() == 0) { $(this).val(previous2); };
			var prev = $(this).parent().prev().children().attr('data-iddatasour');
			console.log(prev);
			var dataItem = dataSourcecombi.get(prev);
			var newcantidad = parseFloat($(this).val()).toFixed(0);
			var newprecio = dataItem.precio*newcantidad;
				dataSourcecombi.pushUpdate({ id: prev, cantidad: newcantidad, preciot: parseFloat(newprecio).toFixed(2) });
				CalcularPrecioTotal();
	}else{
		$(this).val(previous2);

	}; 

});


function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}
//fin para intro cant

var wnd = $(".modalwindowprecuenta").data("kendoWindow");
	
		$(document).keypress(function(){
			if(!wnd.element.is(":hidden"))
			{
						if ( event.which == 13 ) {
											event.preventDefault();
											/* Act on the event */
											precuenta(2, 0);
											$('.modalwindowprecuenta').data("kendoWindow").close();
										}
							}
		});



})


