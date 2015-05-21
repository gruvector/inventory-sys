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
            success:function(data) {
                //  console.log(data);
                //  alert("data has been loaded");
                $("#table_info").html(data);
            },
            error:function(data){
          
            }
        }) 
        
    }, 
    //this is for setting up the initial function
    init:function(){
        
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
                
        
        $("a.pglink").live('click',function(e) {
            e.preventDefault();
            var link=$(this).attr('href');
            transaction.load_prod(link);  
        });
       
        $("#search_butt").click(function(e) {
            e.preventDefault();
            var counter=0;
            var old_val;
            $(".ca").each(function(){
                console.log("vall--"+$(this).val()+"\n");
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