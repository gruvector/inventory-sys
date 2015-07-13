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
        //settings.show_message("Printer Disconnected");      
       // settings.enable_okbutt_mgdialg();                
    };
    printc.onConnect=function(){
        console.log("Printer connected");
    };

    printc.connect();
    

})

  
var transaction={
    current_stock:0,
    select_row :0,
    rec_id:0,
    sale_id:0,
    
    load_url:$("#transaction_real_list_url").val(),
    
    load_prod:function(page_link){
	
        var val = $("#search_rec_type").val();
        var sval = $("#search_trans_date").val();
        var fval =$("#search_trans_amount").val();
        var uval=$("#search_trans_user").val();
        var vval =$("#search_rec_ref").val();
        var wval =$("#search_sale_ref").val();
        filter=(val!="")? "search_trans_type="+val :"search_trans_type=null";
        sfilter=(sval!="")? "search_trans_date="+sval : "search_trans_date=null";
        ufilter=(fval!="")? "search_trans_amount="+fval : "search_trans_amount=null";
        rfilter=(uval!="")? "search_trans_user="+uval : "search_trans_user=null";
        vfilter=(vval!="")? "search_rec_ref="+vval : "search_rec_ref=null";
        wfilter=(wval!="")? "search_sale_ref="+wval : "search_sale_ref=null";


        

        get_filter=filter+"&"+sfilter+"&"+ufilter+"&"+rfilter+"&"+vfilter+"&"+wfilter;
        

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
        _this=this;
        
        _this.load_prod(_this.load_url);
        
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
            var rec_id=$(this).closest("tr").data("receipt");

            var url= $("#transaction_sub_list_url").val();
            data="id="+id+"&rec_id="+rec_id;
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
                    transaction.rec_id=rec_id;
                    transaction.sale_id=id;

                    $("#summary_info").html(data);
                },
                error:function(data){
                    settings.show_message("Error<br>"+"Please Try Again");
                    settings.enable_okbutt_mgdialg();
                }
            })
           
        });
       
        //this is for general printing of stuff
        $("#print_stuff").live('click',function(e) {
            
            //            var  parameters="?id="+transaction.sale_id+"&print=true"+"&rec_id="+transaction.rec_id;
            //            real_trans=$("#transaction_print_list_url").val()+parameters;
            //            window.open(real_trans);
            //            
            url=$("#transaction_print_node_url").val()+"/"+transaction.rec_id;

            $.ajax({
                url: url,
                type: 'GET',
                dataType:'json',
                beforeSend:function(){
                    settings.disable_okbutt_mgdialg() ;
                    settings.show_message("Retrieving Details For Printing...");

                },
                success:function(data) {
                    settings.show_message("Data Retrieved .Printing...");  
                    settings.enable_okbutt_mgdialg();
                   
                    printc.send(data.rec_data,function(){
						 setTimeout(function() {   
                        settings.show_message("Error Printing Receipt.<br>Please Try Again.");      
                        settings.enable_okbutt_mgdialg();	
		}, 1500);	
                    });  
					
                    console.log(data.rec_data);

                },
                error:function(data){
                    settings.show_message("Error<br>"+"Please Try Again");
                    settings.enable_okbutt_mgdialg();
                }
            })
            
            
  
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
