/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var app_print = require('http').createServer();
var io_print = require('socket.io')(app_print);

console.log("-----starting print Server-----");

io_print.on('connection', function (socket) {
    
    console.log("client has connected");
    socket.emit('msg', {
        my: 'data'
    });
    
    socket.on('msg', function (data) {
        console.log(data);
    });
    
    socket.on('disconnect', function (data) {
        console.log("client has disconnected");
    });
    
});

app_print.listen(8085);