/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var ticketPlay={
    client:null,
    
    init:function(){
        var _this=this;
        
        this.connectToServer();
        this.scan_configure_action();
        
    },
   
    scan_configure_action:function(){
        var _this=this;
        cardSwipe.setSwipeCallback(function(ticket_data){
            _this.client.send({
                data_send:{
                    ticket_data: ticket_data
                },
                type:"verify"
            },function(){
                alert("information has been sent to server");
  
            });
            
        });
  
    },
    connectToServer:function(){
        var _this=this;
        var client = new SocketClient('localhost','8081');
        
        client.onMessage( function(data) {
            console.log("verification message received"+data);
            if(data.type=='response'&& data.data_ret.tc_verify=='true')
            {
                alert("ticket has been verified");
            }
            if(data.type=='response'&& data.data_ret.tc_verify=='false')
            {
                alert("yawa u be fraudster !!!!");
            }
   
        })
        
        client.onConnect(function(){
            $("#verify_div").removeClass("yellow-b");
            $("#verify_div").removeClass("red-b");
            $("#verify_div").addClass("green-b");
            $("#message_div").html("Connected ")
            $("#status_socket,#status_socket a").css("visibility","hidden");
            $("#status_socket,#status_socket a").hide();
            
        });
        
        client.onConnecting(function(){
            //$("#status_socket a").html("connecting...");
            $("#verify_div").removeClass("green-b");
            $("#verify_div").removeClass("red-b");
            $("#verify_div").addClass("yellow-b");
            $("#message_div").html("Connecting ...")

            $("#status_socket,#status_socket a").css("visibility","visible");
            $("#status_socket,#status_socket a").css("background-colour","black");
            $("#status_socket,#status_socket a").show();
        });

        client.connecting_func();

        this.client = client;
        this.client.connect();
         
    },
    
    verify_ticket:function(){
    
    }
    
}


$(document).ready(function(){
    
    ticketPlay.init();
});