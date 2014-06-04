function ON_READY() {

  $('#precio').kendoNumericTextBox({
      format: "c",
      decimals: 3
  });

    $('#costo').kendoNumericTextBox({
      format: "c",
      decimals: 3
  });

    $('#stockMax').kendoNumericTextBox({


  });

    $('#stockMin').kendoNumericTextBox({

  });
        $('#stock').kendoNumericTextBox({

  });

        $('#FechaInicio').kendoDatePicker({
          format: "dd/MM/yy"
        });

                $('#FechaTermino').kendoDatePicker({
          format: "dd/MM/yy"
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
      event.preventDefault();
      var jqxhr = $.post( path, function(data) {
        if (data != 'true') {
  //window.location = "/restaurantes/";
  alert('No se puede eliminar. Consulte al administrador del sistema.');
  window.location = route;
}else{
  window.location = route;
};
});


    }
    else
    {
      event.preventDefault();
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