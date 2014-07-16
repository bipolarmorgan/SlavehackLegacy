var io = require('socket.io'),
	express = require('express');

var app = express(),
	server = require('http').createServer(app),
	io = io.listen(server);

server.listen(8080, function(){
  console.log('listening on *:8080');
});

app.get('/', function(req, res){
  res.send('<h1>Hello world</h1>');
});