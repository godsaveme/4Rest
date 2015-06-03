$(document).ready(function(){

var dataSourcelistagastos = new kendo.data.DataSource({
                                                transport: {
                                                   read: "/listadegastos"
                                                },
                                                dataType: "json"
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
            if (data[i]['tipo_estado']  == 1) sum += parseFloat(data[i]['importetotal']);
        };
        return sum.toFixed(2);
    },
    listagastos: dataSourcelistagastos
});

kendo.bind($("#listadegastosmodel"), viewModel_listagastos);

$('body').on('click', '.btn_imprimicopiatick', function(event) {
    event.preventDefault();
    var r=confirm("¿Realmente desea imprimir una copia?");
     if(r==true){
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
     }else{
        return false;
     }
});

$('body').on('click', '.btn_anular', function(event) {
    event.preventDefault();
    /* Act on the event */
    var r=confirm("¿Realmente desea anular el Ticket?");
    if(r==true){
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
                alert('El ticket no se puede anular');
            }
        })
        .fail(function(data) {
            console.log(data);
        })
        .always(function() {
            console.log("complete");
        });
    }else{
        return false;
    }
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

    $('body').on('click', '.ChangeState', function(event) {
        event.preventDefault();
        /* Act on the event */
        $.ajax({
            url: '/changestate',
            type: 'POST',
            dataType: 'json',
            data: {id: $(this).attr('data-id')}
        })
            .done(function(data) {
                if(data == true){
                    window.location.href = '/cajas/listargastos';
                }else{

                }
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });

    });
    
})