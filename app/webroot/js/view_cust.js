/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){

    customer.init();
})


var customer = {
    
    load_url:$("#cust_list_url").val(),
    
    save_prod:"true",
    
    cnt_prod:parseInt(0, 10),

    load_cust:function(page_link){
        
        var val = $("#search_cust").val();

        
        $.ajax({
            url: page_link,
            dataType:'html',
            data: val!="" ? "filter="+val : "filter=null",
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
    init:function(){
        var _this=this;
        _this.load_cust(_this.load_url);
        
        $("span.pglink a").live('click',function(e) {
            e.preventDefault();
            var link=$(this).attr('href');
            _this.load_cust(link);  
        });
       
        $("#search_cust").keyup(function(e) {
            if(e.which==13){
                _this.load_cust(_this.load_url);
                
            }
        }); 
        
           $("#search_butt").live('click',function(){
                
                _this.load_cust(_this.load_url);
                
        }); 
        
        $(".del_cust").live('click',function(e) {
             
            if(confirm("Do You Want To Delete This Customer ?")){
                var data="id="+$(this).closest("tr").attr("id");
                _this.delete_customer(data);
            }else{
                
            }
          
        })
        
        
    
        
        
        $("#add_cust,.edit_cust").live('click',function(e) {
            e.preventDefault();
            
            if($(this).hasClass('edit_cust')){
                var data="id="+$(this).closest("tr").attr("id")+"&edit_cust=true";
            }else{
                var data="";
            }
            
            
            var title="Add/Edit Supplier";
            var $dialog = $("<div></div>")
            .load($("#add_cust").attr('href'),data,function(rdata){
                customer.save_prod="true";

            })
            .dialog({
                autoOpen: false,
                title:title,
                width: 500,
                height: 300,
                position:"center",
                modal:false,
                buttons: {
                    "Cancel": function() {
                        $(this).dialog( "close" );
                        $(this).dialog('destroy').remove();
                        customer.save_prod="false";

                    },
                    "Save": function() {
                        _this.checkfields($(this));
                    }
                
                }
            });
            $dialog.dialog('open');
     
        });
        
        
        
        
    },
    checkfields:function(diag_ref){
       
          
        var _this=this;
        _this.cnt_prod=0;
        $("#add_customer_form.cmxform input[type=text],#add_customer_form.cmxform  textarea,#add_customer_form.cmxform input[type=email]").each(function(){
            if($(this).val()=="")
            {
                $(this).css("border","solid #F44 2px");              
                _this.cnt_prod++;
            }
            else{
               
                $(this).css("border","solid grey 1px");       
            
            } 
        });
        //alert(_this.cnt_prod+"--"+customer.save_prod);
        if(_this.cnt_prod==0 && customer.save_prod=="true")
        {
            _this.save_data(diag_ref);
        }
        else{
            settings.show_message("Please Enter Fields");
        }
       
    }, 
    

    save_data:function(dail_ref){
        var _this=this;
        var formurl=$("#cust_add_url").val();
        var formdata=$("#add_customer_form.cmxform").serialize()+"&save_cust=true";      
        $.ajax({
            url: formurl,
            data:formdata,
            type: 'GET',
            dataType:'json',
            beforeSend:function(){
                settings.disable_okbutt_mgdialg() ;
                settings.show_message("Saving...")
            },
            success:function(data) {
               
                if(data.status=="1")          
                {
                    _this.load_cust(_this.load_url);

                    $(dail_ref).dialog( "close" );
                    $(dail_ref).dialog('destroy').remove();
                    _this.load_cat(_this.load_url); 
                    settings.show_message("Data Saved Succesfully");
                    settings.enable_okbutt_mgdialg();
                    customer.save_prod="false";

                }
            },
            error:function(data){
          
            }
        })
     
    }
    
}
