var express = require('express');
var http = require('http');
var path = require('path');
var io = require('socket.io');
var connections = 0;
var usuarios = {};
var areas = {};
var app = express();
var server = http.createServer(app);
io = io.listen(server);

// all environments
app.set('port', process.env.PORT || 3000);

io.sockets.on('connection', socketconection);

function socketconection(cliente){
	cliente.on('loginuser',function(usuario, area, id){
        if(!areas[area]){
            areas[area] = area;
        }
        if(!usuarios[usuario]){
            usuarios[usuario] = {nombre: usuario, area: area, id: id};
        }
    cliente.usuario = usuario;
    cliente.area = area;
    cliente.join(area);
    cliente.join(usuario);
    });

    cliente.on('NotificarPedidos', function(data, area){
            io.sockets.in(area).emit("NotificacionPedidos", data);
            io.sockets.emit('ActulizarestadoAll', data);
            io.sockets.emit('ActualizarControlpedidos');
    });

    cliente.on('Enviaracocina', function(mesa, pedido, cocinas, usuario){
        totalcocinas = cocinas.length;
        for (i=0;i< totalcocinas;i++) {
            io.sockets.in(cocinas[i]['cocina']).emit('Recibirpedidos',cocinas, mesa, pedido);
        }
            io.sockets.emit('ActulizarPedidosMesa', pedido,usuario);
            io.sockets.emit('ActualizarControlpedidos');
    });

    cliente.on('CerrarMesa', function(idmesa, area){
        io.sockets.in(area).emit('CerrarMesa',idmesa);
    });

    cliente.on('AbrirMesa', function(idmesa, area){
        io.sockets.in(area).emit('AbrirMesa',idmesa);
    });
}

server.listen(app.get('port'), function(){
  console.log('Express server listening on port ' + app.get('port'));
});