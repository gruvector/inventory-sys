/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var app_print = require('http').createServer();
var io_print = require('socket.io')(app_print);
var exec = require('child_process').exec;
var printer_lpr_options=" > LPT1";
var printer_socket_ref=null;

console.log("-----starting print Server-----");

io_print.on('connection', function (socket) {
    
    printer_socket_ref =socket;
    console.log("client has connected");
    
    //    socket.emit('msg', {
    //        payload: 'data'
    //    });
    
    
    socket.on('msg', function (data) {
        console.log(data);
    //  return;
    ///var msg_json=JSON.parse(data.payload);
    //  doPrint(msg_json);
    });
    
    socket.on('disconnect', function (data) {
        printer_socket_ref=null;
    });
    
});

app_print.listen(8085);


//this is used for performing the basics of the printing
function doPrint(json_rsp) {
     
    var print_string = format_print(msg,msg.type);
    exec("echo \""+print_string+"\" | "+printer_lpr_options,print_callback);


}
//this is used for formatting the message for the printer
function format_print(msg,msg_type){
     
}

//code that will be executed after the shell command is run
function print_callback(error, stdout, stderr) {
    var result={
        status:null
    };
    //console.log(error+"--"+stdout+"--"+stderr);
    if (error !== null) {
        console.log(error);
        if(printer_socket_ref!=null){
            printer_socket_ref.emit('msg', {
                payload: 'Print Failed.<br>Please Try Again'
            });  
        }
    }
    else{
        console.log("Successful Print");
        if(printer_socket_ref!=null){
            printer_socket_ref.emit('msg', {
                payload: 'Print Successful'
            });
        }
   

    }
//client._onDisconnect();
}