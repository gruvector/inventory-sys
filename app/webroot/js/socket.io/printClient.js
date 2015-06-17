/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */




var PrintClient = function(server_ip, server_port) {
    
    var client =this ;    
    this.socket=null;
    this.url=null;
    this.connection_options=null;
    
    this.connect=function(func){
        
        var url="http://"+server_ip+":"+server_port;     
        var options={
            'reconnection':true,
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
        
        
        client.socket.on('reconnecting',function(){
            console.log("i have reconnected");
        });
        
        client.socket.on('connect',client.onConnect); 

        client.socket.on('disconnect',client.onDisConnect); 
        
        client.socket.on('msg',client.onMessage); 
       
        if( func ) {
            func();
        }

    };
    
    this.onMessage = function(data) {
    };
    this.onDisConnect = function() {
       
    };

    this.onConnect = function() {
       
    };

      
    this.send=function(msg,func_disc){
        
        if(!this.socket.connected ) {          
            if( func_disc ) {
                func_disc();
            } 
        }else{
            client.socket.emit('msg',{
                payload:msg
            });

        }
    }

}
