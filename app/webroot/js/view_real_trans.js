/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */
$(document).ready(function(){
	
	
    transaction.init();
	
    printc = new PrintClient("localhost", "8083");
	
    //callbacks are being used for various printing functionality
      printc.onMessage=function(data){
        console.log(data);
		if(data.type=="success"){
		
		settings.perfrom_message_close_action=function(){
			
			 setTimeout(function() {                   
		transaction.load_prod(transaction.load_url);
                }, 1000);
			
		settings.perfrom_message_close_action=function(){};
		}
		}
        settings.show_message(data.payload);      
        settings.enable_okbutt_mgdialg();      
    };
               

			   
    printc.onDisConnect=function(){
//        settings.show_message("Printer Disconnected");      
  //      settings.enable_okbutt_mgdialg();                
    };
    printc.onConnect=function(){
        console.log("Printer connected");
    };

    printc.connect();
    

})


var transaction={
    current_stock:0,
    select_row :0,
    sale_id:0,
    total_amount:0,
    total_paid:0,
    total_due:0,
    total_pay_new:0,
    total_due_new:0,
    amount_paid:0,
    pay_info:$("#pay_info"),
    tran_type:"other",
    
    load_url:$("#transaction_real_list_url").val(),
    
    load_prod:function(page_link){

        var val = $("#search_trans_type").val();
        var sval = $("#search_trans_date").val();
        var tval = $("#search_trans_quant").val();
        var fval =$("#search_trans_amount").val();
        var uval=$("#search_trans_user").val();
        var sale_num=$("#search_sale_number").val();
        filter=(val!="")? "search_trans_type="+val :"search_trans_type=null";
        sfilter=(sval!="")? "search_trans_date="+sval : "search_trans_date=null";
        tfilter=(tval!="")? "search_trans_quan="+tval : "search_trans_quan=null";
        ufilter=(fval!="")? "search_trans_amount="+fval : "search_trans_amount=null";
        rfilter=(uval!="")? "search_trans_user="+uval : "search_trans_user=null";
        salefilter=(sale_num!="")? "sale_num="+sale_num : "sale_num=null";
        

        get_filter=filter+"&"+sfilter+"&"+tfilter+"&"+ufilter+"&"+rfilter+"&"+salefilter;
        

        $.ajax({
            url: page_link,
            dataType:'html',
            data: get_filter,
            beforeSend:function(){
                $("#summary_info").html("");
                settings.disable_okbutt_mgdialg() ;
                settings.show_message("Retrieving Details...");

            },
            success:function(data) {
                //  console.log(data);
                //  alert("data has been loaded");
                settings.close_message_diag();
                settings.enable_okbutt_mgdialg();
                $("#table_info").html(data);
            },
            error:function(data){
                settings.show_message("Error<br>"+"Please Try Again");
                settings.enable_okbutt_mgdialg();
            }
        }) 
        
    }, 
    
    
    //this is used for displaying the data which will arrive
    configure_payment:function(){
        _this=this;
       
        var diag = $(_this.pay_info);
        
        diag.dialog({
            modal: false,
            width: 656,
            height: 322,
            title:"New Payment",
            buttons: {
                "Cancel":function(){

                    transaction.total_pay_new=0;
                    transaction.total_due_new=0;
                    transaction.amount_paid=0;                    
                    $( this ).dialog( "close" ); 
                },
                "Save": function() {
            
            
                    if(transaction.amount_paid==0){
                        settings.show_message("Please Amount Should Be Greater Than Zero.");
                    }else{
                        transaction.save_payment( $( this ));    
                    }
                // $( this ).dialog( "close" ); 

                }
           
              
            }
        });
    
        diag.dialog('close');
    },
    
    save_payment:function(diag_ref){
        _this=this;
            
        var formurl=$("#transaction_rec_url").val();
  
        var sale_id ="sale_id="+transaction.sale_id;
        var total_amount="total_amount="+transaction.total_amount;
        var total_paid="total_paid="+transaction.total_paid;
        var total_due="total_due="+transaction.total_due;
        var total_pay_new="total_pay_new="+transaction.total_pay_new;
        var total_due_new="total_due_new="+transaction.total_due_new;
        var amount_paid="amount_paid="+transaction.amount_paid;
        var tran_type="tran_type="+transaction.tran_type;       
        data_send=sale_id+"&"+total_amount+"&"+total_paid+"&"+total_due+"&"+total_pay_new+"&"+total_due_new+"&"+amount_paid+"&"+tran_type;
        formdata=data_send;
        
        $.ajax({
            url: formurl,
            data:formdata,
            type: 'POST',
            dataType:'json',
            beforeSend:function(){
                settings.disable_okbutt_mgdialg() ;
                settings.show_message("Saving...");
            },
            success:function(data) {
                
                console.log(data);
                transaction.total_pay_new=0;
                transaction.total_due_new=0;
                transaction.amount_paid=0; 
                $(diag_ref).dialog( "close" );
                //transaction.load_prod(transaction.load_url);              
                // settings.show_message("Data Retrieved .Printing...");  
                // settings.enable_okbutt_mgdialg();
                   
              settings.show_message("Data Saved .Printing...");  
                    settings.enable_okbutt_mgdialg();
                   
                    printc.send(data.rec_data,function(){
						 setTimeout(function() { 	
					    settings.disable_okbutt_mgdialg() ;
                        settings.show_message("Error Printing Receipt.<br>Please Try Printing Later.");  
						setTimeout(function() { 
						transaction.load_prod(transaction.load_url);						
                        }, 1500);	
						}, 1500);	
                    });    
               // transaction.load_prod(transaction.load_url);
       
            },
            error:function(data){
                settings.show_message("Error<br>"+data.message);
                settings.enable_okbutt_mgdialg();
            }
        })    
        
    }
    ,
    
    round_value:function(num){
        
        //   return num;
        return  Math.round(num * 100) / 100
    },
    
    
    check_fields:function(){
        
        var counter=0;
        $(".ca").each(function(){
            if(!(document.getElementById($(this).attr("id")).checkValidity())){
                $(this).css("border","solid #F44 2px"); 
                counter++;
            }else
            {
                $(this).css("border","solid grey 1px");       

            }
        });
            
            
            
        if(counter==0)
        {
            transaction.load_prod(transaction.load_url);
        }
         
    },
    //this is for setting up the initial function
    init:function(){
        var  _this=this;
        
        transaction.configure_payment();
        transaction.load_prod(transaction.load_url);
        
        $( "#search_trans_date" ).datepicker({
            'dateFormat': 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        }).keyup(function(e) {
            if(e.keyCode == 8 || e.keyCode == 46) {
                $.datepicker._clearDate(this);
            }
        });
                
        
        $("span.pglink a").live('click',function(e) {
            e.preventDefault();
            var link=$(this).attr('href');
            transaction.load_prod(link);  
        });
       
       
        $(".get_details_trans").live('click',function(e){
            e.preventDefault();
            var id= $(this).closest("tr").attr("id");
            
            var url= $("#transaction_sub_list_url").val();
            data="id="+id;
            $.ajax({
                url: url,
                data:data,
                type: 'GET',
                dataType:'html',
                beforeSend:function(){
                    $("#summary_info").html("");
                    settings.disable_okbutt_mgdialg() ;
                    settings.show_message("Retrieving Details...");

                },
                success:function(data) {
                    settings.close_message_diag();
                    settings.enable_okbutt_mgdialg();
                    //  alert("data has been loaded");
                    $("#summary_info").html(data);
                    transaction.sale_id=id;
                    transaction.total_amount=parseFloat($("#total_trans").val());
                    transaction.total_due=parseFloat($("#total_due").val());
                    transaction.total_paid=parseFloat($("#total_paid").val());
                    transaction.amount_paid=parseFloat($(".amount_paid_in").val());
                },
                error:function(data){
                    settings.show_message("Error<br>"+"Please Try Again");
                    settings.enable_okbutt_mgdialg();
                }
            })
           
        });
       
       
        $(".amount_paid_in").live('keyup',function(e){
            e.preventDefault();
            var  amount_paid =$(this).val();
            if(amount_paid < 0 || amount_paid == 0 || ! (event.target.validity.valid)  /**parseFloat(amount_paid)!==parseFloat(amount_paid)**/){
                settings.show_message("Amount Is Invalid");
                $(this).val(transaction.amount_paid);
            }
            else{
                amount_paid=parseFloat($(this).val());
                if(transaction.tran_type=="refund"){
                    amount_paid=amount_paid *-1;
                }
                
                transaction.total_pay_new=transaction.round_value(transaction.total_paid+parseFloat(amount_paid));
                transaction.total_due_new=transaction.round_value(transaction.total_amount-transaction.total_pay_new);
                transaction.amount_paid=amount_paid;
                //$(".amount_paid_in").val(transaction.amount_paid);
                $("#pay_info .amount_due_for_sale").html(transaction.total_due_new);
                $("#pay_info .total_amount_paid").html(transaction.total_pay_new);

              
              
            }
        });
       
        //this is for printing the refunds
        $("#refund").live('click',function(e) {
            
            $("#pay_info .title_action").html("New Refund");
            $("#pay_info .rtotal_transaction").html(transaction.total_amount);
            $("#pay_info .total_amount_paid").html(transaction.total_paid);

            $("#pay_info .amount_due_for_sale").html(transaction.total_due);
            $("#pay_info .amount_paid_in").val(0);
            transaction.tran_type="refund";
            $(_this.pay_info).dialog('open');
        });
        //this is for printing the part_payments
        $("#pay_part").live('click',function(e) {
            $("#pay_info .title_action").html("New Part Payment");
            $("#pay_info .rtotal_transaction").html(transaction.total_amount);
            $("#pay_info .total_amount_paid").html(transaction.total_paid);
            $("#pay_info .amount_due_for_sale").html(transaction.total_due);
            $("#pay_info .amount_paid_in").val(0);
            transaction.tran_type="part_pay";
            $(_this.pay_info).dialog('open');

        });
        $("#print_stuff").live('click',function(e) {
            
            
            var  parameters="?id="+transaction.sale_id+"&print=true";
            real_trans=$("#transaction_print_list_url").val()+parameters;
            window.open(real_trans);
  
        });
       
        $(".ca").keyup(function(e) {
            e.preventDefault();
            if(e.which==13){
                transaction.check_fields();  
            }
        }); 
       
        $("#search_butt").live('click',function(e) {
            e.preventDefault();
            
            transaction.check_fields();
         
        }); 
     
    /**
        $("#search_trans_second").keyup(function(e) {
            if(e.which==13){
                transaction.load_prod(transaction.load_url);
                
            }
        }); 
        $("#search_trans_third").keyup(function(e) {
            if(e.which==13){
                transaction.load_prod(transaction.load_url);
                
            }
        }); 
         **/
        
        
    }
    
}
