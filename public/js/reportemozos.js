var datareportemozos = new kendo.data.DataSource({
                              data: [ ],
                              schema: {
                                model: {
                                        id: "mozoid",
                                        fields: {
                                            mozoid:{type: "number" },
                                            mozo:{type: "string"},
                                            mfactu:{type: "number" },
                                            promt:{type: "number" },
                                            peds:{type: "number" },
                                            pedsa:{type: "number" },
                                            cprods:{type: "number" },
                                            panul:{type: "number" },
                                            ctickets:{type: "number" },
                                            tanul:{type: "number" },
                                            tprom:{type: "date" },
                                            tmin:{type: "date" },
                                            tmax:{type: "date" }
                                            }
                                        }
                              },
                          });

$(function(){


var start = $("#fecha_inicio").kendoDatePicker({
                        format: "yyyy-MM-dd",
                        change: startChange
                    }).data("kendoDatePicker");

var end = $("#fecha_fin").kendoDatePicker({
    format: "yyyy-MM-dd",
    change: endChange
}).data("kendoDatePicker");

function startChange() {
    var startDate = start.value(),
    endDate = end.value();

    if (startDate) {
        startDate = new Date(startDate);
        startDate.setDate(startDate.getDate());
        end.min(startDate);
    } else if (endDate) {
        start.max(new Date(endDate));
    } else {
        endDate = new Date();
        start.max(endDate);
        end.min(endDate);
    }
}

function endChange() {
    var endDate = end.value(),
    startDate = start.value();

    if (endDate) {
        endDate = new Date(endDate);
        endDate.setDate(endDate.getDate());
        start.max(endDate);
    } else if (startDate) {
        end.min(new Date(startDate));
    } else {
        endDate = new Date();
        start.max(endDate);
        end.min(endDate);
    }
}



var viewModel_reportemozos = kendo.observable({
    ventatotal:function(){
        var venta = 0;
        var data = datareportemozos.data();
        for (var i = data.length - 1; i >= 0; i--) {
            venta += parseFloat(data[i]['mfactu']);
        };
        return venta.toFixed(2);
    },
    totalatenciones:function(){
        var suma = 0;
        var data = datareportemozos.data();
        for (var i = data.length - 1; i >= 0; i--) {
            if(data[i]['peds'] != '-'){
                suma += parseFloat(data[i]['peds']);
            }
        };
        return suma;
    },
    totalproductos:function(){
        var suma = 0;
        var data = datareportemozos.data();
        for (var i = data.length - 1; i >= 0; i--) {
            if(data[i]['cprods'] != '-'){
                suma += parseFloat(data[i]['cprods']);
            }
        };
        return suma;
    },
    totaltickets:function(){
        var suma = 0;
        var data = datareportemozos.data();
        for (var i = data.length - 1; i >= 0; i--) {
            if(data[i]['ctickets'] != '-'){
                suma += parseFloat(data[i]['ctickets']);
            }
        };
        return suma;

    },
    pedidosanulados:function(){
        var suma = 0;
        var data = datareportemozos.data();
        for (var i = data.length - 1; i >= 0; i--) {
            if(data[i]['pedsa'] != '-'){
                suma += parseFloat(data[i]['pedsa']);
            }
        };
        return suma;

    },
    productosanulados:function(){
        var suma = 0;
        var data = datareportemozos.data();
        for (var i = data.length - 1; i >= 0; i--) {
            if(data[i]['panul'] != '-'){
                suma += parseFloat(data[i]['panul']);
            }
        };
        return suma;
    },
    ticketsanulados:function(){
        var suma = 0;
        var data = datareportemozos.data();
        for (var i = data.length - 1; i >= 0; i--) {
            if(data[i]['tanul'] != '-'){
                suma += parseFloat(data[i]['tanul']);
            }
        };
        return suma;
    },
    fechainicio: function(){
        var data = datareportemozos.data();
        var fechainicio = $('#textf_inicio').text();
        if (data.length > 0) {
            fechainicio = data[0].fechai;
        }else{
            fechainicio = '0000-00-00';
        }
        return fechainicio;
    },
    fechafin: function(){
        var data = datareportemozos.data();
        var fechainicio = $('#textf_inicio').text();
        if (data.length > 0) {
            fechainicio = data[0].fechafin;
        }else{
            fechainicio = '0000-00-00';
        }
        return fechainicio;
    },
    datosreporte: datareportemozos
});

kendo.bind($("#reporte_mozos"), viewModel_reportemozos);

$('#btn_enviarfechas').on('click',function(event) {
    event.preventDefault();
    /* Act on the event */
    reportemozos();
});

reportemozos();

function reportemozos(){
    $.ajax({
        url: '/reporteventasmozos',
        type: 'POST',
        dataType: 'json',
        data: {fechainicio: $('#fecha_inicio').val(), 
        fechafin: $('#fecha_fin').val(), 
        idrestaurante: $('#restauranteinfo').attr('data-id')}
    })
    .done(function(data) {
        datareportemozos.data([]);
        datareportemozos.data(data);
        $('#textf_inicio').text($('#fecha_inicio').val());
        $('#textf_fin').text($('#fecha_fin').val());
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
}




function fechafin(){
    var fechafin = $('#fecha_fin').text();
    return fechafin;
}


$('#btn_rotacionpro').on('click', function(event){
    event.preventDefault();
    window.location.href = "/reportes/reporteproductos/"+$('#restauranteinfo').attr('data-id')
                            +"?tipoc=4&fechainicio="+$('#fecha_inicio').val()+"&fechafin="+$('#fecha_fin').val();
});

})

function ventatotalpor(){
        var venta = 0;
        var data = datareportemozos.data();
        for (var i = data.length - 1; i >= 0; i--) {
            venta += parseFloat(data[i]['mfactu']);
        };
        return venta.toFixed(2);
}