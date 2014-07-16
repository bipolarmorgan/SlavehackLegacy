var express = require('express');
var app = express();
var server = app.listen(3000);
var io = require('socket.io').listen(server);
var firstConnect = true;

app.use(express.static(__dirname + '/'));

io.sockets.on('connection', function (socket) {
	if(firstConnect){
		socket.emit('login');
		firstConnect = false;
	} else {
		socket.emit('persist');
	}
});