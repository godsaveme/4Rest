var host = window.location.hostname;
function ON_READY() {
//recetas
    $('#form_receta').submit(function(event) {
      event.preventDefault();
      var insumos = {};
      var preproductos = {};
      var dsinsumos= ds.data();
      var dspro = dsprods.data();
      var producto_id = $('#producto_id').val();
      for (var i = 0; i < dsinsumos.length; i++) {
        var newdata = {};
        newdata['cantidad'] = dsinsumos[i].cantidad;
        newdata['insumo_id'] = dsinsumos[i].id;
        newdata['precio'] = dsinsumos[i].costo;
        newdata['producto_id'] = producto_id;
        insumos[i] = newdata; 
      }

      for (var i = 0; i < dspro.length; i++) {
        var newdata = {};
        newdata['cantidad'] = dspro[i].cantidad;
        newdata['preproducto_id'] = dspro[i].id;
        newdata['producto_id'] = producto_id;
        preproductos[i] = newdata;
      };
        $.ajax({
          url: '/recetas/create',
          type: 'POST',
          dataType: 'json',
          data: {producto_id: producto_id, insumos: insumos, costo: $('#costop').text(), preproductos: preproductos},
        })
        .done(function(data) {
          if (data.estado){
            alert('Operación agregada correctamente');
           $(location).attr('href', data.route);
          }else{
            alert('Operación no agregada. Error: ' + data.msg);
           $(location).attr('href', data.route);
          }
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
    });

//fin recetas
    $('#id_restaurante').change(function(){
         $.ajax({
                type: 'POST',
                url: '/buscarareasp',
                dataType: "json",
                data:{parametro:$('#id_restaurante').val()},
                beforeSend: function(){
                },
                success: function (data) {
                  
                  console.log(data.length);

                  var areas = '<option value="0">Seleccione..</option>';    
                  if (data.length > 0) {

                    $('#id_tipoareapro').removeAttr('disabled');
                      for(datos in data){
                          areas += '<option value="'+data[datos].id+'">';
                          areas += data[datos].nombre;
                          areas += '</option>';

                          $('#id_tipoareapro').html(areas);
                      }
                    } else{    
                      $('#id_tipoareapro').html(areas);
                      $('#id_tipoareapro').attr('disabled','disabled');
                    };
                }
        });
       });

    //console.log($('#id_restaurante').val());
//if(typeof(ds) != "undefined"){ 
    if($('#id_restaurante').val()){

      console.log('val');
        $.ajax({
                type: 'POST',
                url: '/buscarareasp',
                dataType: "json",
                data:{parametro:$('#id_restaurante').val()},
                beforeSend: function(){
                },
                success: function (data) {
                  var areas = '<option value="0">Seleccione..</option>';        
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

    $('#login').blur(function(event) {
      if ($(this).val().length > 3) {
          $.ajax({
            url: '/compr_login',
            type: 'POST',
            dataType: 'json',
            data: {login: $(this).val()},
          })
          .done(function(data) {
            if (data) {
              $('.check_1').css({display: 'none'});
              $('.check_2').css({display: 'block'});
            }else{
              $('.check_1').css({display: 'block'});
              $('.check_2').css({display: 'none'});
            };
          })
          .fail(function() {

          })
          .always(function() {

          });
      };
     });

        $('#login').keyup(function(event) {
          if ($(this).val().length > 3) {
          $.ajax({
            url: '/compr_login',
            type: 'POST',
            dataType: 'json',
            data: {login: $(this).val()},
          })
          .done(function(data) {
            if (data) {
              $('.check_1').css({display: 'none'});
              $('.check_2').css({display: 'block'});
            }else{
              $('.check_1').css({display: 'block'});
              $('.check_2').css({display: 'none'});
            };
          })
          .fail(function() {

          })
          .always(function() {

          });
      }else{
        $('.check_1').css({display: 'none'});
              $('.check_2').css({display: 'none'});
      };
     });

        $('#rpt_pass').blur(function(event) {
              if ($(this).val().length > 5) {
                     
                    if (  $('#password').val() !== $(this).val()  ) {
                      
                      $('.check_-').css({display: 'block'});
                      $('.check_-2').css({display: 'none'});
                    }else{
                      
                      $('.check_-').css({display: 'none'});
                      $('.check_-2').css({display: 'block'});
                    };


              }else{
                $('.check_-').css({display: 'none'});
                      $('.check_-2').css({display: 'none'});
              }
        });
        $('#rpt_pass').keyup(function(event) {
              if ($(this).val().length > 5) {
                     
                    if (  $('#password').val() !== $(this).val()  ) {
                      
                      $('.check_-').css({display: 'block'});
                      $('.check_-2').css({display: 'none'});
                    }else{
                      
                      $('.check_-').css({display: 'none'});
                      $('.check_-2').css({display: 'block'});
                    };


              }else{
                $('.check_-').css({display: 'none'});
                      $('.check_-2').css({display: 'none'});
              }
        });

        $('body').on('click','#resetPasswd',function(){
            var $response = $.post('/resetPasswd', { id_login : $(this).data('id-login') } );

            $response.done(function(data){
                $('#newPasswd').val(data);
            });
        });
        /*agregar combi*/
          $('body').on('click', 'input[name^="foobar"]', function(event) {
            
            var checkboxes = $(this).prop('checked');

            if (!checkboxes) {
              $('#tdia').prop('checked', false );
            };

            if (checkboxes) {
              var c_x = 0;
              $('input[name^="foobar"]').each(function(index, el) {
                if ($(this).prop('checked')) {
                  c_x++;
                };
              });
            };

            if (c_x == 7) {
              $('#tdia').prop('checked', true );
            };

          });

          $('body').on('click', '#tdia', function(event) {
            var tdiamarcado = $(this).prop('checked');
            if (tdiamarcado) {
                    $('#lun2').prop('checked', true);
                   $('#mar3').prop('checked', true);
                    $('#mie4').prop('checked', true);
                     $('#jue5').prop('checked', true);
                    $('#vie6').prop('checked', true);
                    $('#sab7').prop('checked', true);
                      $('#dom1').prop('checked', true);
            }else{
                    $('#lun2').prop('checked', false);
                  $('#mar3').prop('checked', false);
                 $('#mie4').prop('checked', false);
                 $('#jue5').prop('checked', false);
                   $('#vie6').prop('checked', false);
                   $('#sab7').prop('checked', false);
                   $('#dom1').prop('checked', false);
            };
          });
          //
          if($('#lun2').prop('checked') &&  $('#mar3').prop('checked') &&  $('#mie4').prop('checked') &&  $('#jue5').prop('checked') && $('#vie6').prop('checked') &&  $('#sab7').prop('checked') && $('#dom1').prop('checked')){
            $('#tdia').prop('checked', true );
          }                    

        /*fin agregar combi*/

        /*FORM PARA ENVIAR*/
              //if(typeof(ds) != "undefined"){ alert("si existe"); }
              //else{ alert("no existe"); }

          var validator = $("#form_resto").kendoValidator().data("kendoValidator");

          $('#form_resto').submit(function(event) {
            if (validator.validate()) {
              event.preventDefault();
              $(this).find(':submit').attr('disabled','disabled');

              var $form = $(this),
                $arrForm = $form.serializeArray();

              if(typeof(ds) != "undefined"){ 
                    $arrForm.push({name: 'wordlist', value: JSON.stringify(ds.data())});
                    if (ds.total() > 0) {
                    var $action = $(this).attr('action');
                    var $response = $.post($action, $arrForm);
                    $response.done(function( data ) {
                                if (data.estado){
                                  alert('Operación agregada correctamente');
                                $(location).attr('href', data.route);
                              }else{
                                alert('Operación no agregada. Error. ');
                              }
                            });
                  }else{
                    alert('Se requiere por lo menos agregar un item a la cesta');
                    $(this).find(':submit').removeAttr('disabled');
                  };

              }else{ 

                  var $action = $(this).attr('action');

                  var $response = $.post($action, $arrForm);

                  $response.done(function( data ) {
                            if (data.estado){
                                alert('Operación agregada correctamente');
                              $(location).attr('href', data.route);
                            }else{
                              alert('Operación no agregada. Error: ' + data.msg);
                              $(location).attr('href', data.route);
                            }
                          });

              }

            }

          });


        /*FIN FORM PARA ENVIAR*/



  $('#precio').kendoNumericTextBox({
      format: "c",
      decimals: 3
  });
//$(document).ready(function(){
    $('#cantdef').kendoNumericTextBox({
        format: "#",
        decimals: 0
    });
//})


    $('#costo').kendoNumericTextBox({
      format: "c",
      decimals: 3
  });

    $('#ultimocosto').kendoNumericTextBox({
      format: "c",
      decimals: 3
  });

        $('#porcion').kendoNumericTextBox({
      format: "#.00"
  });

    $('#importetotal').kendoNumericTextBox({
        format: "c",
        decimals: 3
    });
    $('#igv').kendoNumericTextBox({
        format: "c",
        decimals: 3
    });
    $('#subtotal').kendoNumericTextBox({
        format: "c",
        decimals: 3
    });

    $('#stockMax').kendoNumericTextBox({


  });

    $('#stockMin').kendoNumericTextBox({

  });
        $('#stock').kendoNumericTextBox({

  });


  $('#precio').removeClass('');

  var validator = $("#form_resto").kendoValidator().data("kendoValidator");

  var window = $('#window');
  if (!window.data("kendoWindow")) {
    window.kendoWindow({
      width: "500px",
      resizable: true,
      visible: false,
      modal: true,
      title: "®4Rest. Sistema de Gestión Gastronómico.",
      actions: [
      "Pin",
      "Close"
      ]
    }).data("kendoWindow").center();
  }

  $("#gridMesas").kendoGrid({
    dataSource: {
      pagesize: 15
    },
    height: 800,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      pageSize: 15,
      refresh: true,
      pageSizes: true
    },
  });



  $("#gridRest").kendoGrid({
    dataSource: {
      pagesize: 15
    },
    height: 800,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      pageSize: 15,
      refresh: true,
      pageSizes: true
    },
  });

  $("#gridSalones").kendoGrid({
    dataSource: {
      pagesize: 15
    },
    height: 800,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      pageSize: 15,
      refresh: true,
      pageSizes: true
    },
  });

  $("#gridFam").kendoGrid({
    dataSource: {
      pagesize: 15
    },
    height: 800,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      pageSize: 15,
      refresh: true,
      pageSizes: true
    },
  });
  if ( $("#ProdTemplate").length ) {
  $("#gridProd").kendoGrid({
    dataSource: {
                            type: "json",
                            transport: {
                                read: "/getProducts"
                            },
                            schema: {
                                model: {
                                    id: "id"
                                }
                            },
                            pageSize: 15,
                            /*serverPaging: true,
                            serverFiltering: true,
                            serverSorting: true*/
                        },

    columns: [
                            {  field: "nombreProd",title: "Nombre" },
                            {  field: "precio", title: "Precio" },
                            {  field: "costo", title: "Costo" },
                            {  field: "nombreFam", title: "Familia" },
                            {  field: "estado", title: "Habilitado" },
                            {  title: "Editar" },
                            {  title: "Eliminar"  }
                        ],
    rowTemplate: kendo.template($("#ProdTemplate").html()),
    height: 800,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: {mode:"row"},
    resizable: true,
    pageable: {
      pageSize: 15,
      refresh: true,
      pageSizes: true
    },
  }); };

  if ( $("#InsumoTemplate").length ) {
  $("#gridInsum").kendoGrid({
    dataSource: {
                            type: "json",
                            transport: {
                                read: "/getInsumos"
                            },
                            schema: {
                                model: {
                                    id: "id",
                                    fields: {
                                        nombre: { type: "string" },
                                        descripcion: { type: "string" },                                        
                                        ultimocosto: { type: "string" },
                                        unidadmedida: { type: "string" }
                                    }
                                }
                            },
                            pageSize: 15,
                            /*serverPaging: true,
                            serverFiltering: true,
                            serverSorting: true*/
                        },

    columns: [
                            {  field: "nombre", title: "Nombre" },
                            {  field: "descripcion", title: "Descripcion" },
                            {  field: "ultimocosto", title: "Costo"},
                            {  field: "unidadmedida", title: "Unidad de Medida" },
                            {  title: "Editar" },
                            {  title: "Eliminar"  }
                        ],
    rowTemplate: kendo.template($("#InsumoTemplate").html()),
    height: 800,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      pageSize: 15,
      refresh: true,
      pageSizes: true
    },
  });  };

    $("#gridTipoComb").kendoGrid({
    dataSource: {
      pagesize: 15
    },
    height: 800,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      pageSize: 15,
      refresh: true,
      pageSizes: true
    },
  });

    
    $("#gridComb").kendoGrid({
    dataSource: {
      pagesize: 15
    },
                            
    height: 800,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      pageSize: 15,
      refresh: true,
      pageSizes: true
    },
  });

        $("#gridPersonas").kendoGrid({
    dataSource: {
      pagesize: 15
    },                            
    height: 800,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      pageSize: 15,
      refresh: true,
      pageSizes: true
    },
  });
if ($("#UserTemplate").length) {
    $("#gridUsuarios").kendoGrid({
    dataSource: {
                            type: "json",
                            transport: {
                                read: "/getUsers"
                            },
                            schema: {
                                model: {
                                    id: "id",
                                    fields: {
                                        nombres: { type: "string" },
                                        login: { type: "string" },
                                        nombre: { type: "string" },
                                        estado: { type: "string" }
                                    }
                                }
                            },
                            pageSize: 15,
                            /*serverPaging: true,
                            serverFiltering: true,
                            serverSorting: true*/
                        },

    columns: [
                            {  field: "nombres", title: "Nombres" },
                            {  field: "login", title: "Login" },
                            {  field: "nombre", title: "Perfil" },
                            {  field: "estado", title: "Activo" },
                            {  title: "Editar" },
                            {  title: "Eliminar"  }
                        ],
    rowTemplate: kendo.template($("#UserTemplate").html()),
                            
    height: 800,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      pageSize: 15,
      refresh: true,
      pageSizes: true
    },
  }); };
if ($("#NotasTemplate").length) {
        $("#gridNotas").kendoGrid({
    dataSource: {
                            type: "json",
                            transport: {
                                read: "/getNotas"
                            },
                            schema: {
                                model: {
                                    id: "id",
                                    fields: {
                                        descripcion: { type: "string" }
                                    }
                                }
                            },
                            pageSize: 15,
                            /*serverPaging: true,
                            serverFiltering: true,
                            serverSorting: true*/
                        },

    columns: [
                            {  field: "descripcion", title: "Nota" },
                            {  title: "Editar" },
                            {  title: "Eliminar"  }
                        ],
    rowTemplate: kendo.template($("#NotasTemplate").html()),
                            
    height: 800,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      pageSize: 15,
      refresh: true,
      pageSizes: true
    },
  }); };

  $("#gridSabores").kendoGrid({
    dataSource: {
      pagesize: 15
    },
                            
    height: 800,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      pageSize: 15,
      refresh: true,
      pageSizes: true
    },
  });

  $('#gridRece').kendoGrid({
    dataSource: {
      pagesize: 15
    },
                            
    height: 800,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      pageSize: 15,
      refresh: true,
      pageSizes: true
    },
  });

  $('#btn_generarqr').on('click',function(event) {
    event.preventDefault();
    /* Act on the event */
    $.ajax({
      url: '/codigoqrmesas',
      type: 'POST',
      dataType: 'json',
      data: {tipo: 1},
    })
    .done(function(data) {
      var urldescarga = 'http://'+host+'/imagesqr/'+data['urlnombre'];
      $('#imagencodigoqr').html(data['imagen']);
      $('#input_codigo').val(data['codigo']);
      $('#btn_imagenqr').attr({
        href: urldescarga,
        download: data['urlnombre']
      });
      $('#btn_imagenqr').css('display', 'block');

    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
    
  });  
};

$(document).ready(ON_READY);
$(window).load(ON_LOAD);

function ON_LOAD(){
  $("#loading").hide();
  $("#cntnrGrid").css({'opacity':1});
  $("#cntnr1").css({'opacity':1});
  $("#cntnr2").css({'opacity':1});
  }

  function onDestroy(path,route)
  {
    var r=confirm("¿Realmente desea eliminar?");
    if (r==true)
    {          
          var jqxhr = $.post( path);

                jqxhr.done(function(data) {
                  if (data) {
                      alert('Item eliminado. Actualizando...');	
                      window.location = route;
                    }else{
                      alert('No se puede eliminar. Consulte con el administrador del sistema.');
                    };
              });



      return false;
    }
    else
    {

      //event.preventDefault();
      return false;
    }

  }





  function openCollapse(){
    event.preventDefault();
    $('#collapseOne1').collapse('show');
    $('#collapseOne2').collapse('show');
    $('#collapseOne3').collapse('show');
    $('#collapseOne4').collapse('show');
  }
  function hideCollapse(){
    event.preventDefault();
    $('#collapseOne1').collapse('hide');
    $('#collapseOne2').collapse('hide');
    $('#collapseOne3').collapse('hide');
    $('#collapseOne4').collapse('hide');
  }

  function show4Rest(){
    event.preventDefault();
    $('#window').data("kendoWindow").open();
  }


$(document).ready(function(){

    $("body").on('change','#pais',function(){
        $.ajax({
            url: '/personas/getdpto/'+$(this).val(),
            type: 'POST',
            dataType: 'json'
            //data: {pais: $(this).val()}
        })
            .done(function(data) {

                if(data == 1){
                    //alert('hi');
                    //$(this).parent().append('<input class="form-control" placeholder="Ingrese Lugar de Proce." required="required" validationmessage="Requerido" name="OtroX" type="text" value="" id="OtroX" >');
                    $('#departamento').empty();
                    $('#departamento').append('<option value="0">Seleccione Dpto</option>');
                    $('#provincia').empty();
                    $('#provincia').append('<option value="0">Seleccione Prov</option>');
                    $('#distrito').empty();
                    $('#distrito').append('<option value="0">Seleccione Dist</option>');
                }else{

                    if(data == false){
                        $('#departamento').empty();
                        $('#departamento').append('<option value="0">Seleccione Dpto</option>');
                        $('#provincia').empty();
                        $('#provincia').append('<option value="0">Seleccione Prov</option>');
                        $('#distrito').empty();
                        $('#distrito').append('<option value="0">Seleccione Dist</option>');
                    }else{
                        $('#departamento').empty();
                        $('#departamento').append(data);
                        $('#provincia').empty();
                        $('#provincia').append('<option value="0">Seleccione Prov</option>');
                        $('#distrito').empty();
                        $('#distrito').append('<option value="0">Seleccione Dist</option>');
                    }

                }


            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    });

    $("body").on('change','#departamento',function(){
        $.ajax({
            url: '/personas/getprov/'+$(this).val(),
            type: 'POST',
            dataType: 'json'
            //data: {pais: $(this).val()}
        })
            .done(function(data) {
                $('#provincia').empty();
                $('#provincia').append(data);
                $('#distrito').empty();
                $('#distrito').append('<option value="0">Seleccione Dist</option>');
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    });

    $("body").on('change','#provincia',function(){
        $.ajax({
            url: '/personas/getdist/'+$('#departamento').val()+'/'+$(this).val(),
            type: 'POST',
            dataType: 'json'
            //data: {pais: $(this).val()}
        })
            .done(function(data) {
                $('#distrito').empty();
                $('#distrito').append(data);
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    });

});