$(document).ready(function(){

    cat.init();
})


var cat = {
  
    load_url:$("#cat_list_url").val(),

    save_prod:"false",
    
    cnt_prod:0,

    load_cat:function(page_link){
      
        var val = $("#search_cat").val();

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
        
        _this.load_cat(_this.load_url);
        
        $("span.pglink a").live('click',function(e) {
            e.preventDefault();
            var link=$(this).attr('href');
            _this.load_cat(link);  
        });
       
        $("#search_cat").keyup(function(e) {
            if(e.which==13){
                _this.load_cat(_this.load_url); 
                
            }
        });  
        
        $("#search_butt").live('click',function(e) {
            _this.load_cat(_this.load_url); 
        });
        
    
        $("#add_cat,.edit_cat").live('click',function(e) {
            e.preventDefault();
            
            if($(this).hasClass('edit_cat')){
                var title="Add Category";
                var data="id="+$(this).closest("tr").attr("id")+"&edit_cat=true";
            }else{
                var data="";
                var title="Edit Role";
            }
            
            
            var title="Edit Category";
            var $dialog = $("<div></div>")
            .load($("#add_cat").attr('href'),data,function(rdata){
                cat.save_prod="true";
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
                        cat.save_prod="false";

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
        $("#add_cat_form.cmxform input[type=text],#add_cat_form.cmxform textarea,#add_cat_form.cmxform input[type=email]").each(function(){
            if($(this).val()=="")
            {
                $(this).css("border","solid #F44 2px");              
                _this.cnt_prod++;
            }
            else{
               
                $(this).css("border","solid grey 1px");       
            
            } 
        });
        
        // alert(cat.save_prod+"--"+"--"+_this.cnt_prod);
        if(_this.cnt_prod==0 && cat.save_prod=="true")
        {
            _this.save_data(diag_ref);
            
        }
        else{
            settings.show_message("Please Enter Fields");
        }
       
    },
    
    save_data:function(dail_ref){
        var _this=this;
        var formurl=$("#add_cat_url").val();
        var formdata=$("#add_cat_form.cmxform").serialize()+"&save_cat=true";      
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
                    $(dail_ref).dialog( "close" );
                    $(dail_ref).dialog('destroy').remove();
                    _this.load_cat(_this.load_url); 
                    settings.show_message("Data Saved Succesfully");
                    settings.enable_okbutt_mgdialg();
                    cat.save_prod="false";
                }
            },
            error:function(data){
                settings.show_message("Error<br>"+"Please Try Again");
                settings.enable_okbutt_mgdialg();
            }
        })
      
      
      
      
      
    }
    
}
