/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var settings={
    
    change_inst:function(site_id,inst_id){
        
        var _this=this;
        var formurl=$("#change_inst_url").val();
        var formdata="site_id="+site_id+"&inst_id="+inst_id;     
        $.ajax({
            url: formurl,
            data:formdata,
            type: 'GET',
            dataType:'json',
            success:function(data) {
               
                if(data.status=="true")          
                {
                    $(".ui-dialog-content").dialog("close");
                    window.location.href=$("#dashboard").val();
                //this is so that the settings can be loaded when editing user data
                 
                }
            },
            error:function(data){
          
            }
        })
    },
    
    setup_ajax:function(){
		
        $(document).bind("ajaxSend",function(){
            $(".ui-dialog-buttonpane button:contains('Save')").attr("disabled",true).addClass("ui-state-disabled")

        }).bind("ajaxSuccess",function(){
            $(".ui-dialog-buttonpane button:contains('Save')").attr("disabled",false).removeClass("ui-state-disabled")

        }).bind("ajaxError",function(){
            $(".ui-dialog-buttonpane button:contains('Save')").attr("disabled",false).removeClass("ui-state-disabled")

             
        });
    },
	
    init:function(){
        _this=this;

/**
 *global ajax behaviour for the whole application
        $(document).bind("ajaxSend",function(){
            $(".ui-dialog-buttonpane button:contains('Save')").attr("disabled",true).addClass("ui-state-disabled");

        }).bind("ajaxSuccess",function(){
            $(".ui-dialog-buttonpane button:contains('Save')").attr("disabled",false).removeClass("ui-state-disabled");

        }).bind("ajaxError",function(){
            $(".ui-dialog-buttonpane button:contains('Save')").attr("disabled",false).removeClass("ui-state-disabled");

             
        });
**/
        $(".change_inst").live('click',function(e){
            e.preventDefault();
            var title="Change Site"
            var $dialog = $("<div></div>")
            .load($(this).attr('href'),function(rdata){
                
                })
            .dialog({
                autoOpen: false,
                title:title,
                width: 500,
                height: 400,
                position:"center",
                modal:false,
                buttons: {
                    "Save": function() {
                        
                        //alert()
                        
                        
                      
                        $(".site_select").each(function(index,val){
                            var site_id;
                            var inst_id;
                            if($(this).is(":checked")){
                                    
                                if($('#csite').val()==$(this).attr("site_id")) 
                                {
                                    alert("This Site Is Already The Default Site\n\Change Default Site Or Press Close To Exit") ;
                                    return false;
                                }
                                else{
                                    if(confirm("You Are About To Change Your Active Institution And Site\n\Do You Want To Continue ?"))
                                    {
                                        site_id=$(this).attr("site_id");
                                        inst_id=$(this).attr("inst_id");
                                        _this.change_inst(site_id, inst_id); 
                                    }
                                }
                                return false;
                            }
     
                        })
                        
                    },
                    "Close": function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
            $dialog.dialog('open');
            
        })
        
        $(".stn").live('click',function(e) {
            //  var _this=this;

            e.preventDefault();
            var data="";
            var title="Edit "+$(this).attr("name");
            data="id="+$(this).attr("id")+"&edit_user="+"true";
                
            _this.edit_user_status=true;
            
            var $dialog = $("<div></div>")
            .load($(this).attr('href'),data,function(rdata){
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
                        settings.checkfields();
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
        $("#add_user_form.cmxform input[type=text]").each(function(){
            if($(this).val()=="")
            {
                $(this).css("border","solid #F44 2px");              
                counter++;
            }
            else{
               
                $(this).css("border","solid black 1px");       
            
            } 
        });
        if(counter==0)
        {
            _this.save_data();
        }
      
      
    },
  
    save_data:function(settings){
        var _this=this;
        var formurl=$("#add_user_url").val();
        var formdata=$("#add_user_form.cmxform").serialize();      
        $.ajax({
            url: formurl,
            data:formdata,
            type: 'GET',
            dataType:'json',
            success:function(data) {
               
                
                if(data.status=="true")          
                {
                    
                    alert("New User "+data.name+" created."+
                        "Password Is "+data.new_pass);
                    $(".ui-dialog-content").dialog("close");
                    //this is so that the settings can be loaded when editing user data
                
                    _this.edit_user_status==false;
                    _this.load_users(_this.load_url);
                    
                  
                }
                else if (data.status=="false" && data.message_code=="UAE")
                {
                   
                    alert(data.message);  
                    $("#add_user_form.cmxform input[type=email]").css("border","solid #F44 2px");              

                }
                else{
                    $(".ui-dialog-content").dialog("close");
                    _this.load_users(_this.load_url);
     
                }
        
            },
            error:function(data){
          
            }
        })
      
    
    }
}

$(document).ready(function(){
    
    settings.init();  

})