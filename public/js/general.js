/*    var socket = io.connect('http://192.168.1.15:3000');*/
/*    $(document).on('ready',iniciar);

    function iniciar(){
      centartexto();
      socket.on("mensaje", recibirmensaje);
      if($('#usuario').length){
        socket.emit('loginuser',$('#usuario').text(), $('#area').text()+'_'+$('#area').attr('data-ida'), $('#usuario').attr('user_id'));
      }
      $('#for').on('submit',function(event){
         event.preventDefault();
         socket.emit('Privado',$('input[name=texo]').val(), $('input[name=usuario]').val());
      });
    }*/

    function recibirmensaje(data){
      $('#mensajes').append(data+'</br>');;
    }

    function mostrardiv(elemento){
    $(elemento).css("display", "none");
    }
    function ocultardiv(elemento){
    $(elemento).css("display", "none");
    } 
    var i = 0;
    var j = 0;
    var y = 0;
    var k = 0;
    var m = 0;
    $(function() {
      
      if($(this).val()==2){
        $('input[name=provedor]').val('');
        $('input[name=provedor]').prop("disabled", true );
        $('input[name=proveedor_id]').val('');
      }else{
        $('input[name=provedor]').prop("disabled", false);
      }
      $("#departamento option").filter(function() {
        return $(this).text() == $('#departamento').attr('select-departamento'); 
      }).prop('selected', true);

      if($('#departamento').val()){
        $.ajax({
                type: 'POST',
                url: '/provincias',
                dataType: "json",
                data:{parametro:$('#departamento').val()},
                beforeSend: function(){
                },
                success: function (data) {
                  var provincias = '<option value="">Provincia</option>';        
                    for(datos in data){
                        provincias += '<option value="'+data[datos].provincia+'">';
                        provincias += data[datos].provincia;
                        provincias += '</option>';
                    }
                    $('#provincia').html(provincias);
                    $("#provincia option").filter(function() {
                    return $(this).text() == $('#provincia').attr('select-provincia'); 
                    }).prop('selected', true);
                    $.ajax({
                type: 'POST',
                url: '/distritos',
                dataType: "json",
                data:{parametro:$('#provincia').val()},
                beforeSend: function(){
                },
                success: function (data) {
                  var distritos = '<option value="">Distrito</option>';        
                    for(datos in data){
                        distritos += '<option value="'+data[datos].distrito+'">';
                        distritos += data[datos].distrito;
                        distritos += '</option>';
                    }
                    $('#distrito').html(distritos);
                    $("#distrito option").filter(function() {
                    return $(this).text() == $('#distrito').attr('select-distrito'); 
                    }).prop('selected', true);
                }
        });
                }
        });
      }
      
      $('#departamento').change(function(){
         $.ajax({
                type: 'POST',
                url: '/provincias',
                dataType: "json",
                data:{parametro:$('#departamento').val()},
                beforeSend: function(){
                },
                success: function (data) {
                  var provincias = '<option value="">Provincia</option>';        
                    for(datos in data){
                        provincias += '<option value="'+data[datos].provincia+'">';
                        provincias += data[datos].provincia;
                        provincias += '</option>';
                    }
                    $('#provincia').html(provincias);
                }
        });
       });

      $('#provincia').change(function(){
         $.ajax({
                type: 'POST',
                url: '/distritos',
                dataType: "json",
                data:{parametro:$('#provincia').val()},
                beforeSend: function(){
                },
                success: function (data) {
                  var distritos = '<option value="">Distrito</option>';        
                    for(datos in data){
                        distritos += '<option value="'+data[datos].distrito+'">';
                        distritos += data[datos].distrito;
                        distritos += '</option>';
                    }
                    $('#distrito').html(distritos);
                }
        });
       });
        if($('#selector_adicional').val() == 1){
          $('#b_pro_adi').css('display', 'block');
        }else{
          $('#b_pro_adi').css('display', 'none');
        }
      $('#selector_adicional').change(function(){
        if($('#selector_adicional').val() == 1){
          $('#b_pro_adi').css('display', 'block');
        }else{
          $('#b_pro_adi').css('display', 'none');
        }
      });
          $("#b_ingre").autocomplete({
            source: function( request, response ) {
                    $.ajax({
                        type: "POST",
                        url: "buscar",
                        dataType: "json",
                        data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 12,
                        name_startsWith: request.term,
                        parametro: $("#b_ingre").val()
                                            },
                        success: function(data) {
                             response( $.map( data, function( item ) {
                        return {
                        label: item.nombre,
                        value: item.nombre,
                        id:item.id,
                        unidad: item.unidadMedida
                        }
                        }));
                        resaltar($("#b_ingre").val(), '.ui-autocomplete');
                                  }
                                });
                              },
                         minLength: 3,
                          select: function( event, ui ) {
                              j = 0;
                              y = 0;
                              fc= $('#containgre').val();
                            for (j=0; j <= fc;j++) { 
                              if($('#ingre_'+j).val() == ui.item.id){
                                y = 1;
                              }
                            }
                            if(y == 0){
                              //$('#ingr_sel').append('<div id="ingr_sel_'+i+'">\n<div class="row">\n<input type="hidden" id="ingre_'+i+'" name ="ingre_'+i+'" value= "'+ui.item.id+'"/>\n<div class="large-5 columns">'+ui.item.value+'</div>\n<div class="large-2 columns"><input type="text" value="" name="ingre_cant_'+i+'"></div>\n<div class="large-2 columns">'+ui.item.unidad+'</div>\n<div class="large-3 columns"><a href="javascript:void(0);" onclick="remover(\'ingr_sel_'+i+'\')">&times;</a></div>\n</div>\n</div>');
                              $('#lista_insumos').append('<li class="bullet-item" id="ingr_sel_'+i+'">\n<input type="hidden" id="ingre_'+i+'" name ="ingre_'+i+'" value= "'+ui.item.id+'"/>\n<div class="row">\n<div class="small-6 medium-6 large-6 columns">'+ui.item.value+'</div>\n<div class="small-2 medium-2 large-2 columns"><input type="text" value="" name="ingre_cant_'+i+'"></div>\n<div class="small-3 medium-3 large-3 columns">'+ui.item.unidad+'</div>\n<div class="small-1 medium-1 large-1 columns"><a href="javascript:void(0);" onclick="remover(\'ingr_sel_'+i+'\')">Quitar</a></div>\n</div>\n</li>');
                              nombre = ui.item.value;
                              $('#containgre').val(i);
                              i = i + 1;
                            }else{
                              j = 0;
                              y = 0;
                              alert('Ya agregaste este ingrediente');
                            }
                          }
        });
          $("#b_pro").autocomplete({
            source: function( request, response ) {
                    $.ajax({
                        type: "POST",
                        url: "buscarpro",
                        dataType: "json",
                        data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 12,
                        name_startsWith: request.term,
                        parametro: $("#b_pro").val()
                                            },
                        success: function(data) {
                             response( $.map( data, function( item ) {
                        return {
                        label: item.nombre,
                        value: item.nombre,
                        id:item.id,
                        unidad: item.unidadMedida
                        }
                        }));
                        resaltar($("#b_pro").val(), '.ui-autocomplete');
                                  }
                                });
                              },
                         minLength: 3,
                          select: function( event, ui ) {
                              j = 0;
                              y = 0;
                              fc= $('#containgre').val();
                            for (j=0; j <= fc;j++) { 
                              if($('#pro_'+j).val() == ui.item.id){
                                y = 1;
                              }
                            }
                            if(y == 0){
                              $('#lista_productos').append('<li class="bullet-item" id="pro_sel_'+k+'">\n<input type="hidden" id="pro_'+k+'" name ="pro_'+k+'" value= "'+ui.item.id+'"/>\n<div class="row">\n<div class="small-6 medium-6 large-6 columns">'+ui.item.value+'</div>\n<div class="small-2 medium-2 large-2 columns"><input type="text" value="" name="pro_cant_'+k+'"></div>\n<div class="small-3 medium-3 large-3 columns">'+ui.item.unidad+'</div>\n<div class="small-1 medium-1 large-1 columns"><a href="javascript:void(0);" onclick="remover(\'pro_sel_'+k+'\')">Quitar</a></div>\n</div>\n</li>');
                              nombre = ui.item.value;
                              $('#containgre').val(k);
                              k = k + 1;
                            }else{
                              alert('Ya agregaste este Producto');
                              j = 0;
                              y = 0;
                            }
                          }
        });
        $("#b_produc").autocomplete({
            source: function( request, response ) {
                    $.ajax({
                        type: "POST",
                        url: "http://localhost/productos/buscarpro",
                        dataType: "json",
                        data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 12,
                        name_startsWith: request.term,
                        parametro: $("#b_produc").val()
                                            },
                        success: function(data) {
                             response( $.map( data, function( item ) {
                        return {
                        label: item.nombre,
                        value: item.nombre,
                        id:item.id,
                        unidad: item.unidadMedida
                        }
                        }));
                        resaltar($("#b_produc").val(), '.ui-autocomplete');
                                  }
                                });
                              },
                         minLength: 3,
                          select: function( event, ui ) {
                              j = 0;
                              y = 0;
                              fc= $('#containgre').val();
                            for (j=0; j <= fc;j++) { 
                              if($('#pro_'+j).val() == ui.item.id){
                                y = 1;
                              }
                            }
                            if(y == 0){
                              //$('#lista_proc').append('<div id="pro_sel_'+k+'">\n<div class="row">\n<input type="hidden" id="pro_'+k+'" name ="pro_'+k+'" value= "'+ui.item.id+'"/>\n<div class="large-5 columns">'+ui.item.value+'</div>\n<div class="large-2 columns"><input type="text" value="" name="pro_cant_'+k+'"></div>\n<div class="large-2 columns">'+ui.item.unidad+'</div>\n<div class="large-3 columns"><a href="javascript:void(0);" onclick="remover(\'pro_sel_'+k+'\')">&times;</a></div>\n</div>\n</div>');
                              $('#lista_productosc').append('<li class="bullet-item" id="pro_sel_'+k+'">\n<input type="hidden" id="pro_'+k+'" name ="pro_'+k+'" value= "'+ui.item.id+'"/>\n<div class="row">\n<div class="small-4 medium-4 large-4 columns">'+ui.item.value+'\n</div>\n<div class="small-2 medium-2 large-2 columns">\n<input type="text" name="procant_'+k+'" placeholder= "Cantidad.."/>\n</div>\n<div class="small-3 medium-3 large-3 columns"><input type="text" name="pro_pre_'+k+'" placeholder="S/. 0.00" /></div><div class="small-3 medium-3 large-3 columns"> \n<a href="javascript:void(0);" onclick="remover(\'pro_sel_'+k+'\')">Quitar</a>\n</div>\n</div>\n</li>');
                              nombre = ui.item.value;
                              $('#containgre').val(k);
                              $('#flag_pro').val(1);
                              k = k + 1;
                            }else{
                              alert('Ya agregaste este ingrediente');
                              j = 0;
                              y = 0;
                            }
                          }
        });
        $("#b_proadi").autocomplete({
            source: function( request, response ) {
                    $.ajax({
                        type: "POST",
                        url: "buscarproadi",
                        dataType: "json",
                        data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 12,
                        name_startsWith: request.term,
                        parametro: $("#b_proadi").val()
                                            },
                        success: function(data) {
                             response( $.map( data, function( item ) {
                        return {
                        label: item.nombre,
                        value: item.nombre,
                        id:item.id,
                        unidad: item.unidadMedida
                        }
                        }));
                        resaltar($("#b_proadi").val(), '.ui-autocomplete');
                                  }
                                });
                              },
                         minLength: 3,
                          select: function( event, ui ) {
                              j = 0;
                              y = 0;
                              fc= $('#contaadic').val();
                            for (j=0; j <= fc;j++) { 
                              if($('#proadi_'+j).val() == ui.item.id){
                                y = 1;
                              }
                            }
                            if(y == 0){
                              $('#lista_adiconales').append('<li class="bullet-item" id="pro_adi_'+m+'">\n<input type="hidden" id="proadi_'+m+'" name ="proadi_'+m+'" value= "'+ui.item.id+'"/>\n<div class="row">\n<div class="small-6 medium-6 large-6 columns">'+ui.item.value+'\n</div>\n<div class="small-6 medium-6 large-6 columns"> \n<a href="javascript:void(0);" onclick="remover(\'pro_adi_'+m+'\')">Quitar</a>\n</div>\n</div>\n</li>');
                              nombre = ui.item.value;
                              $('#contaadic').val(k);
                              m = m + 1;
                            }else{
                              alert('Ya agregaste este adicinal');
                              j = 0;
                              y = 0;
                            }
                          }
        });
        
    if($('#selector_').val()== 2){
        $('#nombre_').css('display', 'none');
        $('#dni_').css('display','block');
      }else{
        $('#nombre_').css('display', 'block');
        $('#dni_').css('display','none');
      }
    $('#selector_').change(function(){
      if($('#selector_').val()== 2){
        $('#nombre_').css('display', 'none');
        $('#dni_').css('display','block');
      }else{
        $('#nombre_').css('display', 'block');
        $('#dni_').css('display','none');
      }
    });
    $('#FechaInicio').datepicker({ minDate: -1, dateFormat: 'yy-mm-dd'});
    $('#FechaTermino').datepicker({ minDate: -1, dateFormat: 'yy-mm-dd'});

    if($('#id_restaurante').val()){
        $.ajax({
                type: 'POST',
                url: '/buscarareasp',
                dataType: "json",
                data:{parametro:$('input[name=id_restaurante]').val()},
                beforeSend: function(){
                },
                success: function (data) {
                  var areas = '<option value="">Seleccionar..</option>';        
                    for(datos in data){
                        areas += '<option value="'+data[datos].id+'">';
                        areas += data[datos].nombre;
                        areas += '</option>';
                    }
                    $('#id_tipoareapro').html(areas);
                    $('#id_tipoareapro option').filter(function(){
                    return $(this).val() == $('#id_tipoareapro').attr('select-areap');
                    }).prop('selected', true);
                }
        });
    }
    });//fin ready function
    $("#nombre_").autocomplete({
            source: function( request, response ) {
                    $.ajax({
                        type: "POST",
                        url: "/bpernom",
                        dataType: "json",
                        data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 12,
                        name_startsWith: request.term,
                        parametro: $("#nombre_").val()
                                            },
                        success: function(data) {
                             response( $.map( data, function( item ) {
                        return {
                        label: item.nombre,
                        value: item.nombres+' '+item.apPaterno+' '+item.apMaterno,
                        id:item.id,
                        }
                        }));
                        resaltar($("#nombre_").val(), '.ui-autocomplete');
                                  }
                                });
                              },
                         minLength: 3,
                          select: function( event, ui ) {
                            $('#persona_id').val(ui.item.id);
                          }
        });
        $("#dni_").autocomplete({
            source: function( request, response ) {
                    $.ajax({
                        type: "POST",
                        url: "/bperdni",
                        dataType: "json",
                        data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 12,
                        name_startsWith: request.term,
                        parametro: $("#dni_").val()
                                            },
                        success: function(data) {
                             response( $.map( data, function( item ) {
                        return {
                        label: item.nombre,
                        value: item.nombres+' '+item.apPaterno+' '+item.apMaterno,
                        id:item.id,
                        }
                        }));
                        resaltar($("#dni_").val(), '.ui-autocomplete');
                                  }
                                });
                              },
                         minLength: 3,
                          select: function( event, ui ) {
                            $('#persona_id').val(ui.item.id);
                          }
        });
    
    $('#id_restaurante').change(function(){
         $.ajax({
                type: 'POST',
                url: '/buscarareasp',
                dataType: "json",
                data:{parametro:$('#id_restaurante').val()},
                beforeSend: function(){
                },
                success: function (data) {
                  var areas = '<option value="">Seleccionar..</option>';        
                    for(datos in data){
                        areas += '<option value="'+data[datos].id+'">';
                        areas += data[datos].nombre;
                        areas += '</option>';
                    }
                    $('#id_tipoareapro').html(areas);
                }
        });
       });
    $('#HoraInicio').timeEntry({show24Hours: true,showSeconds: true});
    $('#HoraTermino').timeEntry({show24Hours: true,showSeconds: true});
    function resaltar(texto, contenedor){
        $(contenedor).highlight(texto);
    }
    function remover(div){
        $("#"+div).remove();
    }

    function select_ingre(a) {
      //alert('hola');
      if(a == 1){
        $('#s_ins').attr('class','button tiny radius success');
        $('#s_pro').attr('class','button tiny radius secondary disabled');
        $('#sel_pro_ins').val(1);
        $('#ingr_sel').css('display','block');
        $('#pro_sel').css('display','none');
        $('#b_ins_').css('display','block');
        $('#b_pro_').css('display','none');
        //$('#s_pro').attr('onclick','');
      }else if (a == 2){
        $('#s_ins').attr('class','button tiny radius secondary disable');
        //$('#s_ins').attr('onclick','');
        $('#s_pro').attr('class','button tiny radius success');
        $('#sel_pro_ins').val(2);
        $('#pro_sel').css('display','block');
        $('#ingr_sel').css('display','none');
        $('#b_ins_').css('display','none');
        $('#b_pro_').css('display','block');
      }
    }

    $('.seleccciona').on( "click",function(){
      var check = $(this).val();
      if($(this).is(':checked')) { 
      $('input[type=checkbox]').each(function( i ) {
          $(this).filter(function() {
          return check == $(this).attr('data-checkch'); 
          }).prop('checked', true);
        }); 
          } else {  
              $('input[type=checkbox]').each(function( i ) {
          $(this).filter(function() {
          return check == $(this).attr('data-checkch'); 
          }).prop('checked', false);
        });
          }
    });

    $("input[name=insumo]").autocomplete({
            source: function( request, response ) {
                    $.ajax({
                        type: "POST",
                        url: "/buscarinsumos",
                        dataType: "json",
                        data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 12,
                        name_startsWith: request.term,
                        parametro: $("input[name=insumo]").val()
                                            },
                        success: function(data) {
                             response( $.map( data, function( item ) {
                        return {
                        label: item.nombre,
                        value: item.nombre,
                        id:item.id,
                        unidad: item.unidadMedida,
                        precio: item.costo
                        }
                        }));
                        resaltar($("input[name=insumo]").val(), '.ui-autocomplete');
                                  }
                                });
                              },
                         minLength: 3,
                          select: function( event, ui ) {
                              j = 0;
                              y = 0;
                              fc= $('input[name=contador]').val();
                            for (j=0; j <= fc;j++) {
                              if($('input[name=pe_id_insu_'+j+']').val() == ui.item.id){
                                y = 1;
                              }
                            }
                            if(y == 0){
                              $('#lista_pe_insumos').append('<li class="bullet-item removido" id="ingr_sel_'+i+'"> <div class="row"> <div class="small-2 medium-2 large-2 columns"> <input type="hidden" value="'+ui.item.id+'" name="pe_id_insu_'+i+'"> '+ui.item.value+' </div> <div class="small-2 medium-2 large-2 columns">'+ui.item.unidad+'</div> <div class="small-1 medium-1 large-1 columns insumo_cantidad"><input type="text" value="1" name="pe_cantinsu_'+i+'" placeholder="000"></div> <div class="small-2 medium-2 large-2 columns"><input class="insumo_preciouni" type="text" value="'+ui.item.precio+'" name="pe_preuins_'+i+'" placeholder="0.00"></div> <div class="small-2 medium-2 large-2 columns"><input type="text" value="'+ui.item.precio+'" name="pe_pret_'+i+'" placeholder="0.00" class="insumo_preciototal"></div> <div class="small-2 medium-2 large-2 columns insumo_descuento"><input type="text" value="0.00" name="pe_des'+i+'" placeholder="0.00"></div> <div class="small-1 medium-1 large-1 columns"><a href="javascript:void(0)" class="removedor"> <i class="fi-x"></i> </a></div> </div> </li>');
                              nombre = ui.item.value;
                              $('input[name=contador]').val(i);
                              i = i + 1;
                              importetotal();
                              descuentotal();
                            }else{
                              j = 0;
                              y = 0;
                              alert('Ya agregaste este ingrediente');
                            }
                          }
    });

    $('body').on( 'click','.insumo_cantidad',function(){
      preciounitario= $(this).siblings('div').find('input[class=insumo_preciouni]').val();
      total=preciounitario;
      objeto =  $(this).siblings('div').find('input[class=insumo_preciototal]');
      $('.insumo_cantidad input').on('change',function(){
        cantidad= $(this).val();
        total = parseInt(cantidad)*parseFloat(preciounitario);
        objeto.val(total.toFixed(2));
        importetotal();
      });
    });

    $('body').on( 'click','.insumo_descuento',function(){
      preciototal= $(this).siblings('div').find('input[class=insumo_preciototal]').val();
      objeto = $(this).siblings('div').find('input[class=insumo_preciototal]');
      objeto2 = $(this).siblings('div').find('input[class=insumo_preciouni]');
      cantidad=  $(this).siblings('.insumo_cantidad').find('input').val();
      $('.insumo_descuento input').on( 'change',function(){
        des_total= $('input[name=descuentofinal]').val();
        descuento = $(this).val();
        resta = parseFloat(preciototal)-parseFloat(descuento);
        preciofinal = resta/parseInt(cantidad);
        objeto.val(resta.toFixed(2));
        objeto2.val(preciofinal.toFixed(2));
        descuentotal();
        $(this).val(parseFloat(descuento).toFixed(2));
      });
    });

    $('body').on('mouseenter','.removido',function(){
      objeto = $(this);
      $('.removedor').on('click',function(){
        objeto.remove();
        importetotal();
        descuentotal();
      });
    });

    function importetotal(){
      itotal = 0;
      $('input[class=insumo_preciototal]').filter(function() {
        itotal = parseFloat(itotal) + parseFloat($(this).val());
      });
      $('input[name=importeFinal]').val(itotal.toFixed(2));
    }

    function descuentotal(){
      itotaldes = 0;
      $('.insumo_descuento input').filter(function() {
        itotaldes = parseFloat(itotaldes) + parseFloat($(this).val());
      });
      $('input[name=descuentofinal]').val(itotaldes.toFixed(2));
    }

    $('select[name=tipo_orden]').on('change',function(){
      if($(this).val()==2){
        $('input[name=provedor]').val('');
        $('input[name=provedor]').prop("disabled", true );
        $('input[name=proveedor_id]').val('');
      }else{
        $('input[name=provedor]').prop("disabled", false);
      }
    });

    $("input[name=provedor]").autocomplete({
            source: function( request, response ) {
                    $.ajax({
                        type: "POST",
                        url: "/buscar_provedores",
                        dataType: "json",
                        data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 12,
                        name_startsWith: request.term,
                        parametro: $("input[name=provedor]").val()
                                            },
                        success: function(data) {
                             response( $.map( data, function( item ) {
                        return {
                        label: item.razonSocial,
                        value: item.razonSocial,
                        id:item.id
                        }
                        }));
                        resaltar($("input[name=provedor]").val(), '.ui-autocomplete');
                                  }
                                });
                              },
                        minLength: 3,
                        select: function( event, ui ) {
                          $('input[name=provedor]').prop("disabled", true );
                          $('input[name=proveedor_id]').val(ui.item.id);
                        }
    });

function centartexto(){
  $(".prueba").each(function(){
        oimagen_mesa = $(this).find('.imagen_mesa');
        $(this).find('.posionar').each(function(){
          $('#'+$(this).attr('id')).position({
          my: "center middle",
          at: "center middle",
          of: oimagen_mesa
          });
        });
    });
}
/*
$('.pro_pe').on('click', function(){
  producto = $(this).attr('data-npro');
  precio = $(this).attr('data-precio');
  var orden = '<li class="bullet-item" data-type ="f" data-precio="'+precio+'" data-procan="1" data-npro= "'+producto+'">';
  orden +=  producto + ' x 1  S/.'+precio;
  orden += '</li>';
  valor = $(".pricing-table li").filter(function() {
        return $(this).attr('data-npro') == producto;
  }).attr('data-procan');
  if(valor){
    precio = parseFloat(precio)*(parseInt(valor) + 1);
    $(".pricing-table li").filter(function() {
        return $(this).attr('data-npro') == producto;
  }).attr('data-procan',parseInt(valor) + 1).text(producto+' x ' + (parseInt(valor) + 1) +' S/.'+precio.toFixed(2)).attr('data-precio',precio.toFixed(2));
  }else{
    $('.cestapedidos').prepend(orden);
  }
});

$('body').on('click','.bullet-item',function(){
  valor = $(this).attr('data-procan');
  resta = parseInt(valor) - 1;
  precio = parseFloat($(this).attr('data-precio'))/parseInt(valor);
  precio2 = parseFloat(precio)*parseInt(resta);
  if(resta == 0){
    $(this).remove();
  }else{
    $(this).attr('data-procan', resta);
    $(this).attr('data-precio', precio2.toFixed(2));
    $(this).text($(this).attr('data-npro') + ' x ' + resta.toFixed(2) + ' S/.'+ precio2);
  }
});

$('.enviapedido').on('click', function(){
  var pedidos={};
  var i = 0;
  $('.cestapedidos li').each(function(){
    pedidos[i] = {};
    i++;
  });
  $.ajax({
                type: 'POST',
                url: '/pedidos/ordenar',
                dataType: "json",
                data:{parametro:$('#departamento').val()},
                beforeSend: function(){
                },
                success: function (data) {
                  var provincias = '<option value="">Provincia</option>';        
                    for(datos in data){
                        provincias += '<option value="'+data[datos].provincia+'">';
                        provincias += data[datos].provincia;
                        provincias += '</option>';
                    }
                    $('#provincia').html(provincias);
                }
        });
});
*/