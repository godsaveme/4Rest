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

var viewModel_reportemozos = kendo.observable({
    datosreporte: datareportemozos
});

kendo.bind($("#reporte_mozos"), viewModel_reportemozos);

$('#btn_enviarfechas').on('click',function(event) {
    event.preventDefault();
    /* Act on the event */
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
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
    
});