var express = require('express');
var app = express();
var server = app.listen(3000);
var io = require('socket.io').listen(server);
var players = [];

app.use(express.static(__dirname + '/'));

io.sockets.on('connection', function (socket) {

  socket.on('action', function (data) {
    console.log('here we are in action event and data is: ');
    console.log(data);
  });
});