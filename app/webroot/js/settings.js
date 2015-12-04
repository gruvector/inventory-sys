/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var settings={
    message_diag:("#setting_dialog-message"),
    confirm_diag:("#setting_dialog-confirm"),
    
    configure_message_dialog:function(){
        _this=this;
        var diag = $(_this.message_diag);
        
        diag.dialog({
            modal: true,
            buttons: {
                Ok: function() {
                    _this.perfrom_message_close_action();
                    $( this ).dialog( "close" );
                }
            }
        });
    
        diag.dialog('close');
    },
    
    configure_confirmation:function(){
     
        _this=this;
       
        var diag = $(_this.confirm_diag);
        
        diag.dialog({
            modal: true,
            buttons: {
                "Cancel":function(){
                    $( this ).dialog( "close" ); 
                },
                "Ok": function() {
                    _this.confirmation_action() ;
                    $( this ).dialog( "close" ); 

                }
           
              
            }
        });
    
        diag.dialog('close');
     
    },
    
    confirmation_action:function(){
		
		
		},
    show_confirmation:function(message){
        _this=this;
        $(_this.confirm_diag).dialog('close');
        //   $("#dialog-confirm").attr("title",message);
        $("#setting_dialog-confirm p.messsage").html(message);
        $(_this.confirm_diag).dialog('open');

    },
  
  
    show_message:function(message){
        _this=this;
        $(_this.message_diag).dialog('close');
        $("#setting_dialog-message p.messsage").html(message);
        $(_this.message_diag).dialog('open');

    },
   
    perfrom_message_close_action:function(){
       
    },
    close_message_diag:function(){
        _this=this;
        $(_this.message_diag).dialog('close');
    },
   
   
    disable_okbutt_mgdialg:function(){
    
        $(".ui-dialog-buttonpane button:contains('Ok')").attr("disabled", true).addClass("ui-state-disabled"); 

    },
   
    enable_okbutt_mgdialg:function(){
    
        $(".ui-dialog-buttonpane button:contains('Ok')").attr("disabled", false).removeClass("ui-state-disabled"); 

    },
   
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
	
    configure_stock_notif:function(){
        $(".notif_div").hide();
        formurl=$("#stock_notif_url").val();
        $.ajax({
            url: formurl,
            type: 'GET',
            dataType:'html',
            beforeSend:function(){
                $(".notif_div").hide();
            // $("#LI_77").html("");
            },
            success:function(data) {
                $("#LI_77").html(data);
                $(".notif_div").hide();
            },
            error:function(data){
                
            }
        })
    //checks to see stock notfications every 10 seconds



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
                
           

        _this.configure_stock_notif();
//        setInterval(function() { 
//            settings.configure_stock_notif();
//        }, 10000);
        
        _this.configure_message_dialog();
        _this.configure_confirmation();
        
        
        $("#A_128").live('click',function(e){
                
            settings.disable_okbutt_mgdialg();    
            settings.show_message("Logging Out");
        })
        
        
        $("#A_116").live('click',function(e){
            $("#UL_120").toggle(); 
            $("#UL_81").hide(); 
        });
        
        $("#A_78").live('click',function(e){
            $("#UL_120").hide(); 
            $("#UL_81").toggle(); 
        });
        
        ///have to fix this stuff up really well and some fancy stuff to it 
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
					  "Close": function() {
                        $( this ).dialog( "close" );
                    },
                    "Save": function() {
                        
                        //alert()
                        
                        
                      
                        $(".site_select").each(function(index,val){
                            var site_id;
                            var inst_id;
                            if($(this).is(":checked")){
                                    
                                if($('#csite').val()==$(this).attr("site_id")) 
                                {
                                    settings.show_message("This Site Is Already The Default Site\n\Change Default Site Or Press Close To Exit") ;
                                    return false;
                                }
                                else{
									/**
									setting.configure_confirmation=function(){
										site_id=$(this).attr("site_id");
                                        inst_id=$(this).attr("inst_id");
                                        settings.change_inst(site_id, inst_id); 
										};
										* **/
										
										settings.show_confirmation("You Are About To Change Sites.\nDO You Want To Continue ?");
                                   
                                }
                                return false;
                            }
     
                        })
                        
                    },
                  
                }
            });
            $dialog.dialog('open');
            
        })
        
        $(".stn").live('click',function(e) {
            //  var _this=this;

            e.preventDefault();
            var data="";
            var title="Edit "+$(this).attr("name");
            data="id="+$(this).data("id")+"&edit_user="+"true";
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
                    "Cancel": function() {
                        $( this ).dialog( "close" );
                        $(this).dialog('destroy').remove();

                    },
                    "Save": function() {
                        settings.checkfields($(this));
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
        else{
            settings.show_message("Please Enter Fields");
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
                    settings.show_message("Data Saved Succesfully");

                    _this.load_users(_this.load_url);
                  
                }
                else if (data.status=="false" && data.message_code=="UAE")
                {
                    settings.show_message(data.message);
                    settings.enable_okbutt_mgdialg();

                    $("#add_user_form.cmxform input[type=email]").css("border","solid #F44 2px");              

                }
             else if (data.status=="false" && data.message_code=="error"){
   settings.show_message(data.message);
     settings.enable_okbutt_mgdialg();
}
                
                else{
                    $(".ui-dialog-content").dialog("close");
                //  _this.load_users(_this.load_url);
     
                }
        
            },
            error:function(data){
                settings.show_message("Error<br>"+"Please Try Again");
                settings.enable_okbutt_mgdialg();
            }
        })
      
    
    }
}

$(document).ready(function(){
    
    settings.init();  

})
