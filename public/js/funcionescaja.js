var dataSourcelistagastos = new kendo.data.DataSource({
                                                transport: {
                                                   read: "/listadegastos"
                                                },
                                                dataType: "jsonp"
                                            });
var dataSourcelistaventas = new kendo.data.DataSource({
                                                transport: {
                                                   read: "/listadeventas"
                                                },
                                                dataType: "jsonp"
                                            });

var viewModel_listagastos = kendo.observable({
    total: function() {
    	var total = dataSourcelistagastos.data();
        return total.length;
    },
    totalPrice: function() {
        var sum = 0;
        var data = dataSourcelistagastos.data();
        for (var i = data.length - 1; i >= 0; i--) {
        	sum += parseFloat(data[i]['importetotal']);
        };
        return sum.toFixed(2);
    },
    listagastos: dataSourcelistagastos
});

kendo.bind($("#listadegastosmodel"), viewModel_listagastos);

var viewModel_listaventas = kendo.observable({
    total: function() {
    	var total = dataSourcelistaventas.data();
        return total.length;
    },
    totalPrice: function() {
        var sum = 0;
        var data = dataSourcelistaventas.data();
        for (var i = data.length - 1; i >= 0; i--) {
        	sum += parseFloat(data[i]['importe']);
        };
        return sum.toFixed(2);
    },
    listagastos: dataSourcelistaventas
});

kendo.bind($("#listadeventas"), viewModel_listaventas);

$('body').on('click', '.btn_imprimicopiatick', function(event) {
    event.preventDefault();
    $.ajax({
        url: '/copiaticket',
        type: 'POST',
        dataType: 'jsonp',
        data: {idtick: $(this).attr('data-idtick')},
    })
    .done(function(data) {
        if(data == 'true'){
            alert('Operación completada');
        }else{
            alert('Operación no completada');
        }
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
});

$('body').on('click', '.btn_anular', function(event) {
    event.preventDefault();
    /* Act on the event */
    $.ajax({
        url: '/anularticket',
        type: 'POST',
        dataType: 'json',
        data: {idtick: $(this).attr('data-idtick')},
    })
    .done(function(data) {
        if(data == 'true'){
            alert('Operación completada');
        }else{
            alert('Operación no completada');
        }
    })
    .fail(function(data) {
        console.log(data);
    })
    .always(function() {
        console.log("complete");
    });
});

$('body').on('click', '.btn_generarticket', function(event) {
    event.preventDefault();
    /* Act on the event */
    $.ajax({
        url: '/generarticket',
        type: 'POST',
        dataType: 'jsonp',
        data: {idtick: $(this).attr('data-idtick')},
    })
    .done(function(data) {
        if(data == 'true'){
            alert('Operación completada');
        }else{
            alert('Operación no completada');
        }
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });

});