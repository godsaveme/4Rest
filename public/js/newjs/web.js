var host = window.location.host;
function ON_READY() {
    $('#id_restaurante').change(function(){
      console.log('change');
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

    $('#login').keyup(function(event) {
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
      
     });

        $('#login').change(function(event) {
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

                    //var form_resto = $('#form_resto').serializeArray();
                    //form_resto.push({name: 'wordlist', value: JSON.stringify(ds.data())})
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

    $('#costo').kendoNumericTextBox({
      format: "c",
      decimals: 3
  });

        $('#porcion').kendoNumericTextBox({
      format: "#.00 porciones"
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
      pageSize: 10
    },
    height: 525,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      refresh: true,
      pageSizes: true
    },
  });



  $("#gridRest").kendoGrid({
    dataSource: {
      pageSize: 10
    },
    height: 525,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      refresh: true,
      pageSizes: true
    },
  });

  $("#gridSalones").kendoGrid({
    dataSource: {
      pageSize: 10
    },
    height: 525,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      refresh: true,
      pageSizes: true
    },
  });

  $("#gridFam").kendoGrid({
    dataSource: {
      pageSize: 10
    },
    height: 525,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      refresh: true,
      pageSizes: true
    },
  });
  $("#gridProd").kendoGrid({
    dataSource: {
      pageSize: 10
    },
    height: 525,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      refresh: true,
      pageSizes: true
    },
  });


  $("#gridInsum").kendoGrid({
    dataSource: {
      pageSize: 10
    },
    height: 525,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      refresh: true,
      pageSizes: true
    },
  });

    $("#gridTipoComb").kendoGrid({
    dataSource: {
      pageSize: 10
    },
    height: 525,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      refresh: true,
      pageSizes: true
    },
  });

    
    $("#gridComb").kendoGrid({
    dataSource: {
      pageSize: 10
    },
                            
    height: 525,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      refresh: true,
      pageSizes: true
    },
  });

        $("#gridPersonas").kendoGrid({
    dataSource: {
      pageSize: 10
    },
                            
    height: 525,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      refresh: true,
      pageSizes: true
    },
  });

        
    $("#gridUsuarios").kendoGrid({
    dataSource: {
      pageSize: 10
    },
                            
    height: 525,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      refresh: true,
      pageSizes: true
    },
  });

        $("#gridNotas").kendoGrid({
    dataSource: {
      pageSize: 10
    },
                            
    height: 525,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
      refresh: true,
      pageSizes: true
    },
  });

                $("#gridSabores").kendoGrid({
    dataSource: {
      pageSize: 10
    },
                            
    height: 525,
    sortable: true,
    selectable: true,
    scrollable: true,
    sortable: true,
    filterable: true,
    resizable: true,
    pageable: {
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


/*  setTimeout(function(){
    kendo.ui.progress($('body'), false);
  },700);*/


  $("#loading").hide();
  $("#cntnrGrid").css({'opacity':1});
  $("#cntnr1").css({'opacity':1});
  $("#cntnr2").css({'opacity':1});
  //$("#gridRest").css({'opacity':1});
  //$("#gridSalones").css({'opacity':1});
  //$("#gridFam").css({'opacity':1});
  //$("#gridProd").css({'opacity':1});
// hide loading overlay
    //
  }

  function onDestroy(path,route)
  {
    var r=confirm("¿Realmente desea eliminar?");
    if (r==true)
    {
          //event.preventDefault();
          
          var jqxhr = $.post( path);

                jqxhr.done(function(data) {
                  if (data) {
                      alert('Item eliminado. Actualizando...');	
                      window.location = route;
                    }else{
			//window.location = "/restaurantes/";
                      alert('No se puede eliminar. Consulte con el administrador del sistema.');
                      //window.location = route;
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