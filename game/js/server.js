var express = require('express');
var app = express();
var server = app.listen(3000);
var io = require('socket.io').listen(server);

app.use(express.static(__dirname + '/'));

io.sockets.on('connection', function (socket) {

	socket.on('chat message', function (data) {
		io.emit('chat message', { name: data.name, msg: data.msg});
	});
});