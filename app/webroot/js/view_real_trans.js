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
    select_row :0,
    
    load_url:$("#transaction_real_list_url").val(),
    
    load_prod:function(page_link){

        var val = $("#search_trans_type").val();
        var sval = $("#search_trans_date").val();
        var tval = $("#search_trans_quant").val();
        var fval =$("#search_trans_amount").val();
        var uval=$("#search_trans_user").val();
        filter=(val!="")? "search_trans_type="+val :"search_trans_type=null";
        sfilter=(sval!="")? "search_trans_date="+sval : "search_trans_date=null";
        tfilter=(tval!="")? "search_trans_quan="+tval : "search_trans_quan=null";
        ufilter=(fval!="")? "search_trans_amount="+fval : "search_trans_amount=null";
        rfilter=(uval!="")? "search_trans_user="+uval : "search_trans_user=null";

        

        get_filter=filter+"&"+sfilter+"&"+tfilter+"&"+ufilter+"&"+rfilter;
        

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
    display_data:function(){
      
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
                
        
        $("a.pglink").live('click',function(e) {
            e.preventDefault();
            var link=$(this).attr('href');
            _this.load_prod(link);  
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
                },
                error:function(data){
                    settings.show_message("Error<br>"+"Please Try Again");
                    settings.enable_okbutt_mgdialg();
                }
            })
           
        });
       
        $("#search_butt").live('click',function(e) {
            e.preventDefault();
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