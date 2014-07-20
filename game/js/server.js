var express = require('express');
var app = express();
var server = app.listen(3000);
var io = require('socket.io').listen(server);
var players = [];

app.use(express.static(__dirname + '/'));

io.sockets.on('connection', function (socket) {

	socket.on('currConn', function (data) {
		var ply = new Object();
		ply.id = data.name;
		ply.socket = socket.id;
		players.push(ply);
		console.log(ply.id + " has connected.");
		console.log(players);
		socket.emit("log");
	});

	socket.on('disconnect', function () {
		var len = 0;

		for(var i=0, len=players.length; i<len; ++i){
			var p = players[i];

			if(p.socket == socket.id){
				console.log(p.id + " has disconnected.");
				players.splice(i, 1);
				break;
			}
		}
	});

	socket.on('message', function (data, id_player) {
		var len = 0;

		for(var i=0, len=ply.length; i<len; ++i){
			var p = players[i];

			if(p.socket == socket.id){
				io.sockets.socket(p.socket).emit('correct', data);
				break;
			}
		}
	});
});