/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */
$(document).ready(function(){

    transaction.init();
})


var transaction={
    current_stock:0,
    
    load_url:$("#transaction_list_url").val(),
    
    load_prod:function(page_link){
        var data_filter;
        var val = $("#search_trans").val();
        var sval = $("#search_trans_second").val();
        var tval = $("#search_trans_third").val();
        var fval =$("#search_trans_fourth").val();
        filter=(val!="")? "filter="+val :"filter=null";
        sfilter=(sval!="")? "sfilter="+sval : "sfilter=null";
        tfilter=(tval!="")? "tfilter="+tval : "tfilter=null";
        ufilter=(fval!="")? "ufilter="+fval : "ufilter=null";

        get_filter=filter+"&"+sfilter+"&"+tfilter+"&"+ufilter;
        //  alert(tfilter);
        
        $.ajax({
            url: page_link,
            dataType:'html',
            data: get_filter,
            beforeSend:function(){
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
        
        var _this=this;
        transaction.load_prod(transaction.load_url);
        
        $( "#search_trans_third" ).datepicker({
            'dateFormat': 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
                
        
        $("span.pglink a").live('click',function(e) {
            e.preventDefault();
            var link=$(this).attr('href');
            transaction.load_prod(link);  
        });
       
        $("#search_trans,#search_trans_second,#search_trans_third,#search_trans_fourth").keyup(function(e) {
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
