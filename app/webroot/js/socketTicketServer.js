
// FOLDER CONTAINING APPLICATION SOFTWARE ON SERVER
var app_folder = "mticket";

//>>>>>>> .r713
//var app_folder = "venus";
var socketio_path='../../../node_modules/socket.io/lib/socket.io';
var ticket_port = 8081;

var DATABASE_NAME = 'mticket';

// LIBRARIES REQUIRED FOR SOCKET SERVER OPERATION
var http = require('http');
var util = require('util');
var poolModule = require('generic-pool');
var DBpool = poolModule.Pool({
    name     : 'mysql',
    create   : function(callback) {
        var Client = require('mysql').Client;
        var c = new Client();
        c.user     = 'mticket';
        c.password = 'mticket';
        c.database = DATABASE_NAME;
        c.connect();

        // parameter order: err, resource
        callback(null, c);
    },
    destroy  : function(client) {
        client.end();
    },
    max      : 10,
    // optional. if you set this, make sure to drain()
    //min      : 2, 
    // specifies how long a resource can stay idle in pool before being removed
    idleTimeoutMillis : 60000,
    priorityRange : 10,
    // if true, logs via console.log - can also be a function
    log : false
});

// ************************************************************************
process.argv.forEach(function(val, index) {
    if( process.argv[index] == "-f" && process.argv[index + 1] != "" ) {
        app_folder = process.argv[index + 1];
    }
    
    if( process.argv[index] == "-db" && process.argv[index + 1] != "" ) {
        DATABASE_NAME = process.argv[index + 1];
    }
});

console.log("Running TRS with Ticket Web App Folder '" + app_folder + "'");
//*************************************************************************

// BALL READER ENGINE OPTIONS
var RELOAD_INTERVAL = 1000 * 60 * 30; // 30 mins
var reload_timer = null; // timer to fire data reload for TicketticketEngine
var ticketEngine = null;
var buffer_string = "";
var loading_data = false;

var get_opts = {
    host: 'localhost',
    port: '80',
    path: '/' + app_folder + '/Ticket/load_available_tickets'
};

var responsefunc = function(res){
    buffer_string = "";
    
    res.on('data', function(data) {
        loading = true;
         
        try {
            buffer_string = buffer_string + data;
        } catch(e) {
            dumpError(e);
            console.log("Error getting data for TicketticketEngine");
        }
    });

    res.on('end', function() {
        var rdata = null;

        try {
            
            //console.log(buffer_string); // keep commented out, seems to take a lot of memory to render to screen (atleast in windows)
            //console.log("reader data"+buffer_string+"end");
            rdata = JSON.parse(buffer_string);
            console.log(rdata);
            
            if( ticketEngine == null ) {
                console.log("Ticket Data Loaded. Creating Engine and Starting Servers....");
                console.log("******************************************************");

                ticketEngine = new TicketticketEngine(rdata);
                ticketEngine.createGameClientServer();

                
                console.log("\n******************************************************");
                console.log("TICKET SERVER READY");
            }
            
            else {
                ticketEngine.data = rdata;
                console.log("INFO TICKET Engine Data Reloaded At " + new Date() );
            }
            
            console.log("******************************************************\n");
            
            loading = false;
            
        } catch(e) {  
            dumpError(e);
            console.log("Failed To Load Ticket ticketEngine");
        } finally {
            buffer_string = null;
            rdata = null;
        }
    });
};

console.log("STARTING UP TICKET SERVER....");
console.log("LOADING TICKET DATA....");

// fetch the data from the server and configure the ball engine
var req = http.get(get_opts,responsefunc);

// set timer to reload engine data every so often, incase IPs change in the database
reload_timer = setInterval(function() {
    if (!loading) req = http.get(get_opts, responsefunc);
}, RELOAD_INTERVAL);

var cleaningTimer = setInterval(function() { 
    console.log("going to run housekeeping"); 
    if(ticketEngine) { 
        ticketEngine.housekeeping();
        console.log("hosekeeping"); 
    } 
}, 90000); // every 90 seconds houskeeping

////////////////////////////////
// GAME PLAY SOCKETS AND VARIABLES
/////////////////////////////////
var game_clients_location_map = {};

/***************************************************************************************
 * BALL READER ENGINE
 * 
 * THIS ENGINE HANDLES THE INTERNAL PROCESSING OF THE VARIOUS BALL READ REQUESTS 
 * AND USES THE DATA TO COMMUNICATE WITH OR UPDATE GAME PLAY CLIENTS. THIS OBJECT ALSO
 * FUNCTIONS AS A CACHE TO REDUCE ROUND TRIPS TO THE DATABASE SERVER TO QUERY FOR DATA
 * ON EVERY BALL READ
 */
function TicketticketEngine(data) {
    this.data = data;
}

TicketticketEngine.prototype = {
    

 
    
    createGameClientServer: function() {
        // CREATE THE SOCKET SERVER TO HANDLE GAME PLAY CLIENTS
        var _this=this;
        var socket_cl = require(socketio_path).listen(ticket_port);
        socket_cl.set("log level", 1);

        // LISTEN FOR GAME PLAY CLIENT CONNECTIONS AND CONFIGURE THEM


        socket_cl.on('connection',function(client) {
    
            if (client) {
        
                var index_client=client.id;
                console.log("Client Index " + client.id );
        
                game_clients_location_map[ index_client ] = client;
                
                client.on('message',function(data){
                    
                    console.log(data);
                    if(data.type=='verify'){
                        
                        console.log("message has been sent"+data.data_send.ticket_data);
                        _this.verify_ticket(data.data_send.ticket_data,index_client);

                    }
                    
                })
                
                client.on('disconnect', function () {    
                    console.log(' Client Disconnected.');
                    
                    delete game_clients_location_map[ index_client ];
                });
                    
                
                
            } else {
                console.log("Client request without request object, unable to proceed.");
            }
        });
    },
    
    verify_ticket:function(ticket_node_val,client_index){
        var _this=this;
        var tickets=this.data.ticket_redeemable;
        var status=false;
        for (var i=0;i<tickets.length;i++ ){
            if (tickets[i].Ticket.ticket_value==ticket_node_val)
            {
                console.log("ticket has been verified");
                this.remove_ticket_verify(i,tickets[i].Ticket.id,client_index);
                status=true;
                break;
            }
        }
        if(status==false){
            game_clients_location_map[client_index].json.send({
                type:'response',
                data_ret:{
                    tc_verify:'false'
                }
            });  
        }
    },
    
    remove_ticket_verify:function(ticket_index,ticket_id,client_index){
        var _this=this; 
        var tickets=this.data.ticket_redeemable;
            
        game_clients_location_map[client_index].json.send({
            type:'response',
            data_ret:{
                tc_verify:'true'
            }
        },function(){
            //this will send do hte necessary updates to the db afer the message has been
            //sent ot the client about a successfull verification
            tickets.splice(ticket_index, 1)   ;
            _this.query("UPDATE tickets SET ticket_verified_status ='1' where id=?",[ticket_id],function(){ 
                });
   
        });   
       

        
    },
    verify_send:function(){
        
    },
    housekeeping:function(){
        
    },
    
    query: function(query_str, params, callback, priority) {
        // default priority is 5
        if(typeof(priority)==='undefined') priority = 5;
        // acquire connection - callback function is called once a resource becomes availablea
        DBpool.acquire(function(err, client) {
            if (err) {
                dumpError(err);
            } else {
                client.query(query_str, params, function(err, results) {
                    DBpool.release(client); // return object back to pool
                    if(callback != null) {
                        callback(err, results);
                    }
                });
            }
        }, priority); 
    },
   
 
    
  
    
    
    
       
    /**
     * Main Function which will process requests for ticket verification
     */
    processBallInput: function(ip_address, input) {
        // a local reference to the game client
        var game_client = null; 
        
    },
    
    formatAsMySQLDate: function(date) {
        if( !date ) {
            return "0000-00-00";
        }

        var month = date.getMonth() + 1;
        var day = date.getDate();

        if( month < 10 ) {
            month = "0" + month;
        }
        
        if( day < 10 ) {
            day = "0" + day;
        }
        
        return date.getFullYear() + "-" + month + "-" + day;
    },
    
    formatAsMySQLDateTime: function(date) {
        if( !date ) {
            return '0000-00-00';
        }
        
        return this.formatAsMySQLDate(date) + " " + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
    },
    
    formatAsMySQLDateTimeToMin: function(date) {
        if( !date ) {
            return '0000-00-00';
        }
        
        return this.formatAsMySQLDate(date) + " " + date.getHours() + ":" + date.getMinutes();
    }
    
    
   
    
    

    
}



///////////////////////////////////////
// Monitoring and debugging information
///////////////////////////////////////
setInterval(function() {

    console.log("******************** Debugging info *******************************");
    var dTemp = new Date();
    console.log(dTemp + ":" + dTemp.getMilliseconds());    
    console.log(util.inspect(process.memoryUsage()));
    // returns factory.name for this pool
    console.log(DBpool.getName());
    console.log("Pool size: " + DBpool.getPoolSize()); // returns number of resources in the pool regardless of whether they are free or in use
    console.log("Available: " + DBpool.availableObjectsCount()); // returns number of unused resources in the pool
    console.log("Waiting: " + DBpool.waitingClientsCount()); // returns number of callers waiting to acquire a resource

    if (game_clients_location_map) console.log("Game clients location map length: " + Object.keys(game_clients_location_map).length );
    console.log("*******************************************************************");
}, 60000);

function dumpError(err) {
    console.log('ERROR found, dumping: *******************************************************');
    if (typeof err === 'object') {
        if (err.message) {
            console.log('\nMessage: ' + err.message)
        }
        if (err.stack) {
            console.log('\nStacktrace:')
            console.log('====================')
            console.log(err.stack);
        }
    } else {
        console.log('dumpError :: argument is not an object');
    }
}
