/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



$(document).ready(function(){

    add_user.init();
})




var add_user={
    
    edit_user_status:false,
    start_diag:$("#role_div"),

    load_url:$("#user_list").val(),

    
    load_users:function(page_link){
      
        var val = $("#search_user").val();

        $.ajax({
            url: page_link,
            dataType:'html',
            data: val!="" ? "filter="+val : "filter=null",
            beforeSend:function(){
                settings.perfrom_message_close_action=function(){};
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
    
    setup_edit:function(id,type,dt){
        var _this=this;

        $.ajax({
            url: $("#user_status_change").val(),
            data:dt,
            type: 'GET',
            dataType:'json',
            beforeSend:function(){
                settings.disable_okbutt_mgdialg() ;
                settings.show_message("Updating...");

            },
            success:function(data) {
                
                if (type=="reset_pass"){
                                        
                    settings.show_message("New User Password Is "+data.new_pass);
                    settings.perfrom_message_close_action=function(){
                        _this.load_users(_this.load_url);
   
                    }
                    settings.enable_okbutt_mgdialg();                   



                }
                else{
                    settings.close_message_diag();
                    settings.enable_okbutt_mgdialg();                   
                    _this.load_users(_this.load_url);
  
                    
                }

            },
            error:function(data){
                settings.show_message("Error<br>"+"Please Try Again");
                settings.enable_okbutt_mgdialg();  
            }
        })
    },
    
    
    configure_dialog:function(){
        var _this=this;

        var std =  _this.start_diag;

        std.dialog({
            autoOpen: false,
            title: "",
            width: 500,
            height: 300,
            position:"center",
            modal:false,
            dialogClass:'transparent',
            open: function(event, ui) {
            //    $("#add_eve.cmxform input[type=text]:first").focus();
            },
         
            buttons: {
                "Cancel": function() {
                    $(".date_field").val("");
                    $(std).html("");
                    $( this ).dialog( "close" );
                },
                "Save": function() {
                    add_roles.save_roles_user($( this ));
                }
              
            }
        });
        std.dialog('close');
        
        
    },
    
    
    
    init:function() 
    {
        var _this=this;

         
        _this.load_users(_this.load_url);
        _this.configure_dialog();
                
        $("span.pglink a").live('click',function(e) {
            e.preventDefault();
   
            var link=$(this).attr('href');
            _this.load_users(link);  
        });
       
        $("#search_user").keyup(function(e) {
            if(e.which==13){
                _this.load_users(_this.load_url); 
                
            }
        })    
             
        $("#search_butt").live('click',function(){
                
            _this.load_users(_this.load_url); 
                
        }); 
        
      
        $(".unlock").live('click',function(){
            var id=$(this).closest("tr").attr("id");
            var dt="id="+id+"&type=unlock";
            _this.setup_edit(id,"unlock",dt);
 
        })
        $(".lock").live('click',function(){
            var id=$(this).closest("tr").attr("id");
            var dt="id="+id+"&type=lock";
            _this.setup_edit(id,"lock",dt);
        })
        $(".reset_pass").live('click',function(){
            var id=$(this).closest("tr").attr("id");
            var dt="id="+id+"&type=reset_pass";
            _this.setup_edit(id,"reset_pass",dt);

        })

      
        $(".add_role").live('click',function(){
            
            var id=$(this).closest("tr").attr("id");
            var name=$(this).closest("tr").attr("name");
            //var name =$.trim($(this).closest("tr").find("td.name_info").text());
           
            add_roles.init(id, name);
            
        })      
      
        $("#add_user,.edit_user").live('click',function(e) {
            e.preventDefault();
            var data="";
            var title="Edit "+$(this).closest("tr").attr("name");
            if($(this).hasClass("edit_user"))
            {
                data="id="+$(this).closest("tr").attr("id")+"&edit_user="+"true";
                
                _this.edit_user_status=true;
            }
            
            var $dialog = $("<div></div>")
            .load($("#add_user").attr('href'),data,function(rdata){
                })
            .dialog({
                autoOpen: false,
                title:$(_this).hasClass("edit_user")? title : $(this).attr('title'),
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
                        _this.checkfields($(this));
                    }
                  
                }
            });
            $dialog.dialog('open');
     
        });
       
         
      
        $("#add_user_form.cmxform").live('submit',(function(){
            // _this=this;
            _this.checkfields();
            return false;
        }));
        
        //        $("#submit_event").live('click',(function(){
        //               
        //            add_user.checkfields();
        //            return false;
        //        }));
        
        $("#add_user_form.cmxform input[type=text]").blur(function(){
        
            if($(this).val()=="")
            {
                $(this).css("border","solid #F44 2px");              
            }else{
                $(this).css("background-color","white");              
      
            }
        
        });
        
    },
  
   
    checkfields:function(diag_ref){

        var _this=this;
        
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
            _this.save_data(diag_ref);
        }
        else{
  
            settings.show_message("Please Enter Fields");
        }
      
      
    },
  
    save_data:function(diag_ref){
        var _this=this;
        var formurl=$("#add_user_url").val();
        var formdata=$("#add_user_form.cmxform").serialize();      
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
               
                if(data.status=="true")          
                {

                    
                    settings.show_message("New User "+data.name+" created."+"<br>Password Is "+data.new_pass);
                    settings.perfrom_message_close_action=function(){
                     
                        $(diag_ref).dialog( "close" );
                        $(diag_ref).dialog('destroy').remove();
                        //this is so that the settings can be loaded when editing user data                
                        _this.edit_user_status==false;
                        _this.load_users(_this.load_url);
   
                    }
                    settings.enable_okbutt_mgdialg(); 
                  
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
                    $(diag_ref).dialog( "close" );
                    $(diag_ref).dialog('destroy').remove();
                    _this.load_users(_this.load_url);
     
                }
            },
            error:function(data){
                settings.show_message("Error<br>"+"Please Try Again");
                settings.enable_okbutt_mgdialg();
            }
        })
      
      
      
      
      
    }
  
}


var add_roles={
    id:0,
    reset_pass_status: false,
    picklist_status:false,
    name:"",
    init :function(id,name){
        var _this=this;
        
        
        _this.id=id;
        _this.name=name;
        //console.log("id--"+this.id+"--name"+this.name);
        _this.show_role_dialog(_this.id,"Edit Roles For "+_this.name);
    },
    
    create_picklist:function(){
        var _this=this;
        var el = document.createElement("select");
        el.setAttribute('type', 'text');
        el.setAttribute('name', 'user_roles');
        el.setAttribute('id', 'user_roles');
        el.setAttribute('multiple','multiple');
        $('#role_div').css("visibility","visible");

        $('#role_div').append(el);
        $("#user_roles").pickList();
        $("#user_roles").pickList("insert", {
            value:    5,
            label:    "Football",
            selected: false
        });
        console.log($("#user_roles"));
    },
    destroy_picklist:function(){
        $("#user_roles").pickList().remove();
        $('#user_roles').remove();
  
        
    },
    show_role_dialog:function(id,title){
        var _this=this;
        // var $dialog = $("<div></div>")
        add_user.start_diag.dialog('open')
        .load($("#edit_roles").val()+"/"+id,function(){
            //    if(_this.picklist_status==false){ 
            $("#user_roles").pickList({
                afterBuild: function() { 
                    _this.picklist_status=true;
                }
            });
        //   }
        });
           

    },
    save_roles_user:function(diag_ref){
        var _this=this;      
        var roles = $.map( $('#user_roles option:selected'),
            function(e) {
                return $(e).val();
            } );
        //   console.log(roles);
        var data="roles="+roles+"&id="+this.id;     
        $.ajax({
            url: $("#save_roles").val(),
            data: data,
            type:'GET',
            dataType: 'json',
            beforeSend:function(){
                settings.disable_okbutt_mgdialg() ;
                settings.show_message("Saving...")
            },
            success: function(data){
                
                $(diag_ref).dialog( "close" );
                settings.show_message("Data Saved Succesfully");
                settings.enable_okbutt_mgdialg();

            // $("#user_roles").pickList("destroy");
            // window.location.href=$("#view_users_url").val();
            //_this.load_users(_this.load_url);
                
            },
            error:function(data){
                settings.show_message("Error<br>"+"Please Try Again");
                settings.enable_okbutt_mgdialg();
            }
         
        })

    },
    remove_role:function(){}
    
    
}
