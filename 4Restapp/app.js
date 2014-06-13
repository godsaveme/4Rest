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

var mysql =  require('mysql');
var mysqlconect =  mysql.createConnection({
    host : '127.0.0.1',
    user : 'root',
    password: 'root',
    database: 'db_4rest'
    });

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
            io.sockets.emit('Recibirpedidos',cocinas, mesa, pedido);
            io.sockets.emit('ActulizarPedidosMesa', pedido,usuario);
            io.sockets.emit('ActualizarControlpedidos');
    });

    cliente.on('CerrarMesa', function(idmesa, area){
        io.sockets.in(area).emit('CerrarMesa',idmesa);
    });

    cliente.on('AbrirMesa', function(idmesa, area){
        io.sockets.in(area).emit('AbrirMesa',idmesa);
    });

    cliente.on('TiemposCocina', function(idarea, usuario){
        mysqlconect.query(
            "SELECT max(TIMESTAMPDIFF(MINUTE , FechaInicio, NOW())) AS TiempoEspera FROM detallepedido WHERE cast(FechaInicio AS DATE) BETWEEN cast(NOW() AS DATE) AND cast(NOW() AS DATE) AND estado = ? AND idarea = ?",
             ['I',idarea], function selectUsuario(err, results, fields) {
                if (err) {
                    console.log("Error: " + err.message);
                    throw err;
                }
            io.sockets.in(usuario).emit("NotificacionDemora", results);
                console.log(results);
        });
    });

    cliente.on('TiemposMozos', function(idrestaurante){
        mysqlconect.query(
            "SELECT max(TIMESTAMPDIFF(MINUTE , fechaDespacho, NOW())) AS TiempoEspera FROM detallepedido INNER JOIN pedido ON pedido.id = detallepedido.pedido_id INNER JOIN usuario ON usuario.id = pedido.usuario_id WHERE usuario.id_restaurante = ? AND cast(detallepedido.FechaInicio AS DATE) BETWEEN  cast(now() AS DATE) AND cast(now() AS DATE) AND detallepedido.estado = ?",
             [idrestaurante,'E'], function selectUsuario(err, results, fields) {
                if (err) {
                    console.log("Error: " + err.message);
                    throw err;
                }
            io.sockets.emit("NotificacionDemoraMozos", results);
                console.log(results);
        });
    });
}

server.listen(app.get('port'), function(){
  console.log('Express server listening on port ' + app.get('port'));
});