/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */




var SocketClient = function(server_ip, server_port) {
    
    var client =this ;    
    this.socket=null;
    this.url=null;
    this.connection_options=null;
    
    this.connect=function(func){
        
        var url="http://"+server_ip+":"+server_port;     
        var options={
            'reconnection':false,
            'reconnectionDelay': 1000,
            'reconnectionDelayMax': 5000,
            'max reconnection attempts':999999999,
            'reconnection delay':50
        }
        client.url=url;
        client.connection_options=options;    
        client.socket = io(client.url,client.connection_options);
        client.setup_events(func);
    };
    
    this.setup_events=function(func){
      
        client.socket.on('connect',function(){
            console.log("i have connected");
        });
      
        client.socket.on('disconnect',function(){
            console.log("i have disconnected");
        });
        
        client.socket.on('reconnecting',function(){
            console.log("i have reconnected");
        });
        
        
        client.socket.on('msg', function (data) {
            console.log(data);
        }); 
        
        func();
    };
    
    this.send=function(msg){
        
        if( !this.socket ) {
            console.log("WebSocket Not Initialized For This SocketClient");
            return;
        }else{
            client.socket.emit('msg',msg);
        //

        }
    }

}

$(document).ready(function(){
    
    var print_client = new SocketClient("localhost", "8085");
    var setup_function=function(){};
    print_client.connect(setup_function);
    print_client.send("testing server");
    console.log(print_client.socket);
    setTimeout(function() {                   
        print_client.socket.emit("disconnect","test");
    }, 5000);
})