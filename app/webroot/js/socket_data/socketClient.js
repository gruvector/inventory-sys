
// CONFIGURATION FOR THE COMMUNICATION SERVER
var node_server_ip = '';

// DEV ENVIRONMENT
if( window.location.host == "localhost" ) {
    node_server_ip = "localhost"; //"topgolf.infonaligy.com"; // localhost
} 

// INTEGRATION SERVER ENVIRONMENT AND ANY OTHER ENVIRONMENT
else {
    node_server_ip = window.location.host;
}

var SocketClient = function(server_ip, server_port) {
    
    var client = this;
    
    this.socket=null;
    this.reconnecting = false;
    this.reconnectionAttempts = 0;
    this.reconnectListeners = [];
    this.disconnectListeners = [];
    this.cdata=null;
    this.disconnect_func=null;
    this.connect_func=null;
    this.connecting_func=null;
    this.reconnecting_fun=null;
    this.url=null;
    this.conn_options=null;
    // set to try to reconnect every 2.5 secs
    
    this.connect = function(func) {        
        server_ip = (!server_ip || server_ip == null) ? window.location.host : server_ip; 
        server_port = (!server_port) ? 8081 : server_port; 
      
        var url="ws://"+server_ip+":"+server_port;
     
      
        console.log("connecting to url --- " + url);
        
        var options={
            'reconnect':true,
            'rememberTransport': false,
            'transports': ['websocket'],
            'max reconnection attempts':999999999,
            'reconnection delay':500
        };
        client.url=url;
        client.conn_options=options;
        client.socket = io.connect(client.url,client.conn_options); 

        client.setup_connection('startup',func);
     
     
    };
      
      
    //this is used for setting up the socket connection
    //regardless of where it began
    this.setup_connection=function(type,func){
   
        console.log("CONNECTING TO SERVER", type, this);
        var setup_timer = null;
        setup_timer = setInterval(function() {
            if(client.socket.socket.connected) {  
                clearInterval(setup_timer);
                if(type=='startup'){
                    client.setup_events(func,function(){   
                        
                        if( client.connect_func ) {
                            client.connect_func();
                        }
                    });
                }
               
            }
            
            else  {
                client.socket.socket.connect();      
            }
 
        },1*5000);
         
    } ; 
      
      
    this.setup_events=function(func,callback){
         
        
        //this part is for when messages are received when the connection is made
        client.socket.on('connect',(client.connect_func!=null) ? client.connect_func : function(data){});        
           
        client.socket.on('reconnect',(client.connect_func!=null) ? client.connect_func : function(data){});        

        client.socket.on('connecting',(client.connecting_func!=null) ? client.connecting_func : function(data){});        
         
        client.socket.on('reconnecting',(client.connecting_func!=null) ? client.connecting_func : function(data){});        
           
        client.socket.on('message',(client.cdata!=null) ? client.cdata : function(data){});
            
        client.socket.on('disconnect',(client.disconnect_func!=null) ? client.disconnect_func : function(data){});
         
        client.socket.on('reconnect_failed',function(){
            client.socket.on('reconnect_failed',client.setup_connection('recon'));
        });

        //Below added to monitor socket connection activity ;)
        client.socket.on('reconnecting', console.log('reconnecting', this));
        client.socket.on('disconnect', console.log('disonnect', this));
        client.socket.on('connect', console.log('connect', this));
        client.socket.on('connecting', console.log('connecting', this));
       
       
        if(func){
            func();
        }
        if(callback)
            callback();
    }
 
    this.onConnecting = function(func) {
        if( func ) {
            client.connecting_func =func;
        }
    };
    
    this.onConnect = function(func) {
        if( func ) {
            client.connect_func = func;
        }
    };

    this.onMessage = function(func) {
        if( func ) {
            client.cdata = func;
        }
    };
   
    this.onDisconnect = function(func) {
        if( func ) {
            client.disconnect_func=func;
        }
    };
    
    this.disconnect = function() {
        this.socket.disconnect();
    };

    this.send = function(msg, func) {
        if( !this.socket ) {
            console.log("WebSocket Not Initialized For This SocketClient");
            return;
        }
    
        if( typeof msg == "object" ) {
            client.socket.json.send(msg, func);
        }
        
        else if( typeof msg == "string" ) {
            client.socket.send(msg, func);
        }
    };
};
