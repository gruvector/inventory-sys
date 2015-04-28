/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){

    customer.init();
})


var customer = {
    
    load_url:$("#cust_list_url").val(),

    load_cust:function(page_link){
        
        var val = $("#search_cust").val();

        
        $.ajax({
            url: page_link,
            dataType:'html',
            data: val!="" ? "filter="+val : "filter=null",
            success:function(data) {
                //  console.log(data);
                //  alert("data has been loaded");
                $("#table_info").html(data);
            },
            error:function(data){
          
            }
        }) 
        
    }, 
    init:function(){
        var _this=this;
        _this.load_cust(_this.load_url);
        
        $("a.pglink").live('click',function(e) {
            e.preventDefault();
            var link=$(this).attr('href');
            _this.load_cust(link);  
        });
       
        $("#search_cust").keyup(function(e) {
            if(e.which==13){
                _this.load_cust(_this.load_url);
                
            }
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
                })
            .dialog({
                autoOpen: false,
                title:title,
                width: 500,
                height: 300,
                position:"center",
                modal:false,
                buttons: {
                    "Save": function() {
                        _this.checkfields();
                    },
                    "Cancel": function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
            $dialog.dialog('open');
     
        });
        
        
        
        
    },
    checkfields:function(){
       
        var counter=0;
        var _this=this;
        $("#add_customer_form.cmxform input[type=text],#add_customer_form.cmxform  textarea,#add_customer_form.cmxform input[type=email]").each(function(){
            if($(this).val()=="")
            {
                $(this).css("border","solid #F44 2px");              
                counter++;
            }
            else{
               
                $(this).css("border","solid grey 1px");       
            
            } 
        });
        if(counter==0)
        {
            _this.save_data();
        }
       
    }, 
    
    delete_customer:function(data){
        
        var _this=this;
        var formurl=$("#cust_del_url").val();
        $.ajax({
            url: formurl,
            data:data,
            type: 'GET',
            dataType:'json',
            success:function(data) {
               
                if(data.status=="1")          
                {
                    $(".ui-dialog-content").dialog("close");
                    _this.load_cust(_this.load_url);

                }
            },
            error:function(data){
          
            }
        })
        
    },
    save_data:function(){
        var _this=this;
        var formurl=$("#cust_add_url").val();
        var formdata=$("#add_customer_form.cmxform").serialize()+"&save_cust=true";      
        $.ajax({
            url: formurl,
            data:formdata,
            type: 'GET',
            dataType:'json',
            success:function(data) {
               
                if(data.status=="1")          
                {
                    $(".ui-dialog-content").dialog("close");
                    _this.load_cust(_this.load_url);

                }
            },
            error:function(data){
          
            }
        })
     
    }
    
}