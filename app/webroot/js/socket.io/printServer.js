/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var app_print = require('http').createServer();
var io_print = require('/usr/local/lib/node_modules/socket.io')(app_print);
var exec = require('child_process').exec;
var printer_lpr_options="LPT1";
var printer_socket_ref=null;

console.log("-----starting print Server-----");

io_print.on('connection', function (socket) {
    
    printer_socket_ref =socket;
    console.log("client has connected");
    

    
    
    socket.on('msg', function (data) {
 
        doPrint(data.payload);
    });
    
    socket.on('disconnect', function (data) {
        printer_socket_ref=null;
    });
    
});

app_print.listen(8083);


//this is used for performing the basics of the printing
function doPrint(json_rsp) {
     
    var print_string = format_print(json_rsp);
    console.log(print_string);
    exec("echo \""+print_string+"\" | > "+printer_lpr_options,print_callback);
    //>print /d:LPT1 "test"

}
//this is used for formatting the message for the printer
function format_print(json_rsp){
    
    var receipt_string="";
    var amount_string="";
    receipt_string= receipt_string  +
    "-------------------------------------\n" +
    "<site_name>\n" +
    "<site_address>\n" +
    "<site_city>\n" +
    "<site_phone>\n" +
    "<site_email>\n\n" +
    "RECEIPT NO   : <receipt_num>\n"+
    "RECEIPT TYPE : <refund_stat>\n"+
    "SERVED BY    : <staff_name>\n" +
    "DATE         : <date_trans>\n" +
    "---------------------------------------\n" +
    "Payment Breakdown\n\n" +
    "<product> <price> <number> <sub>\n"+
    "<receipt_payments>\n" +
    "Total Quantity  <total_quant>\n" +
    "Net Cost        <net_cost>\n" +
    "Vat(<vat>)      <vat_transaction>\n" +
    "Total           <total_transaction>\n" +
    "Paid            <total_paid>\n" +
    "Due             <total_due>\n" +    
    "---------------------------------------\n" +
    "---------------------------------------\n" +
    "THANK YOU FOR YOUR BUSINESS.!\n\n" ;

    
    for(var index in json_rsp.ProductTransaction)
    {
        var replace_string='<product> <price> <quantity> <sub_total>';
        replace_string=replace_string.replace('<product>',pad(json_rsp.ProductTransaction[index].Product.product_name.substring(0,8),8,' '));
        replace_string=replace_string.replace('<price>',pad(formatCurrency(json_rsp.ProductTransaction[index].price),8,' '));
        replace_string=replace_string.replace('<quantity>',pad(json_rsp.ProductTransaction[index].quantity,4,' '));
        replace_string=replace_string.replace('<sub_total>',pad(formatCurrency(json_rsp.ProductTransaction[index].price*json_rsp.ProductTransaction[index].quantity),5,' '));
        amount_string=amount_string+pad(replace_string,25,'')+"\n";  
    }

    receipt_string=receipt_string.replace('<product>',pad('Product',8,' '));
    receipt_string=receipt_string.replace('<price>',pad('Price',8,' '));
    receipt_string=receipt_string.replace('<number>',pad('Numbr',5,' '));
    receipt_string=receipt_string.replace('<sub>',pad('Subtl',5,' '));
    receipt_string=receipt_string.replace('<site_name>',pad(json_rsp.User.Site.site_name,25,' '));
    receipt_string=receipt_string.replace('<site_address>',pad(json_rsp.User.Site.address,25,' '));
    receipt_string=receipt_string.replace('<site_city>',pad(json_rsp.User.Site.city,25,' '));
    receipt_string=receipt_string.replace('<site_phone>',pad(json_rsp.User.Site.phone,25,' '));
    receipt_string=receipt_string.replace('<site_email>',pad(json_rsp.User.Site.email,25,' '));
    receipt_string=receipt_string.replace('<receipt_num>',json_rsp.Receipt.id);
    receipt_string=receipt_string.replace('<refund_stat>',json_rsp.Receipt.paid_status);
    receipt_string=receipt_string.replace('<staff_name>',json_rsp.User.fname);
    receipt_string=receipt_string.replace('<date_trans>',json_rsp.Receipt.transaction_timestamp);
    receipt_string=receipt_string.replace('<refund_stat>',json_rsp.Receipt.paid_status);
    receipt_string=receipt_string.replace('<receipt_payments>',amount_string);
    
    receipt_string=receipt_string.replace('<total_quant>',' '+pad(json_rsp.Sale.total_items,10,' '));
    receipt_string=receipt_string.replace('<net_cost>',pad(formatCurrency(json_rsp.Sale.total_bvat),10,' '));
    receipt_string=receipt_string.replace('<vat_transaction>',' '+pad(formatCurrency(json_rsp.Sale.vat_transaction),10,''));
    receipt_string=receipt_string.replace('<vat>',pad(json_rsp.Sale.vat_per+"%",4,' '));
    receipt_string=receipt_string.replace('<total_transaction>',pad(formatCurrency(json_rsp.Sale.total_transaction),10,''));
    receipt_string=receipt_string.replace('<total_paid>',pad(formatCurrency(json_rsp.Receipt.amount_paid),10,''));
    receipt_string=receipt_string.replace('<total_due>',pad(formatCurrency(json_rsp.Receipt.balance_due),10,''));

    //console.log("\n\n\n\n");    
    // console.log(receipt_string);   
    return receipt_string;
     
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
                payload: 'Error Printing Receipt.<br>Please Try Again.',
				type:'eror'
            });  
        }
    }
    else{
        console.log("Successful Print");
        if(printer_socket_ref!=null){
            printer_socket_ref.emit('msg', {
                payload: 'Print Successful',
				type:'success'
				
            });
        }else
        {
	   console.log("socket disconnected. couldent send message back");
	   }
    }
//client._onDisconnect();
}



function formatCurrency(num) {
    num = num.toString().replace(/\|\,/g,'');
    if(isNaN(num)) num = "0";
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num*100+0.50000000001);
    cents = num%100;
    num = Math.floor(num/100).toString();
    if(cents<10)
        cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
        num = num.substring(0,num.length-(4*i+3))+','+num.substring(num.length-(4*i+3));
    return (((sign)?'':'-') + '\\' + num + '.' + cents);
}


function pad(value,width,padchar) {
    var count=width-value.length ;
    for(var i=1;i<=count;i++)
    {
        value=value+padchar;
    }

    return value;
}
