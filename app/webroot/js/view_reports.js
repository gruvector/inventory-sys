$(document).ready(function(){

    report.init();
})


var report = {
  
    load_url:$("#report_list_url").val(),
    start_diag:$("#dialog_date_input"),
    roles_diag:$("#dialog_role_input"),
    id:"",
    title_status : "",


    
    load_report:function(page_link){
      
        var val = $("#search_report").val();

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
    setup_edit:function(id,type,dt){
        var _this=this;

        $.ajax({
            url: $("#status_report_change").val(),
            data:dt,
            type: 'GET',
            dataType:'json',
            success:function(data) {
                _this.load_report(_this.load_url); 

            }
        })
    },
    configure_dialog:function(){
        var _this=this;

        var std =  _this.start_diag;

        std.dialog({
            autoOpen: false,
            title: report.title_status,
            width: 520,
            height: 500,
            position:"center",
            modal:false,
            dialogClass:'transparent',
            open: function(event, ui) {
            //    $("#add_eve.cmxform input[type=text]:first").focus();
            },
         
            buttons: {
                "Save": function() {
                    report.checkfields();
                },
                "Close": function() {
                    $(".date_field").val("");
                    $(std).html("");
                    $( this ).dialog( "close" );
                }
            }
        });
        std.dialog('close');
        
        
    },
    
    //this is for configuring the roles dialog
    configure_roles_dialog:function(){
        var _this=this;

        var std =  _this.roles_diag;

        std.dialog({
            autoOpen: false,
            title: report.title_status,
            width: 520,
            height: 500,
            position:"center",
            modal:false,
            dialogClass:'transparent',
            open: function(event, ui) {
            //    $("#add_eve.cmxform input[type=text]:first").focus();
            },
         
            buttons: {
                "Save": function() {
                    _this.save_roles_user();
                },
                "Close": function() {
                    //      $(".date_field").val("");
                    $("#add_roles_form.cmxform").html("");
                    $( this ).dialog( "close" );
                }
            }
        });
        std.dialog('close');
        
        
    },
    
    
    
    
    //this is used for configuring the 
    configure_params:function(){
        
        $("#add_new_rep").live('click',function(e) {
            
            //this first span element will encapsulate all  other elements
            var span_all =  document.createElement('span') ;

            //parameter type label
            var type_li =  document.createElement('li') ;
            $(type_li).attr('style',"width:auto !important");
            var select_type= document.createElement('select');
            $(select_type).attr("name","data[Report][param][name][]");
            $(select_type).attr("id","data[Report][param][name][]");

            var option1_select = document.createElement('option');
            $(option1_select).html('text');
            $(option1_select).val('text');
            var option2_select = document.createElement('option');
            $(option2_select).html('number');
            $(option2_select).val('number'); 
            var option3_select = document.createElement('option');
            $(option3_select).html('timestamp');
            $(option3_select).val('timestamp');
            $(select_type).append(option1_select).append(option2_select).append(option3_select);
            $(type_li).append(select_type);

            //label for parameter will be here 
            var label_li =  document.createElement('li') ;
            $(label_li).attr('style',"width:auto !important");
            var  input_label=document.createElement('input');
            $(input_label).attr("name","data[Report][param][label][]");
            $(input_label).attr("id","data[Report][param][label][]");
            $(input_label).attr('type','text');
            $(input_label).attr('style',"width:auto !important");
            $(input_label).attr('placeholder','Label Name');
            $(input_label).attr('enabled','enabled');

            $(label_li).append(input_label);

            //id for name will be put here 
            var name_li =  document.createElement('li') ;
            $(name_li).attr('style',"width:auto !important");
            var  name_li_id=document.createElement('input');
            $(name_li_id).attr("name","data[Report][param][val_name][]");
            $(name_li_id).attr("id","data[Report][param][val_name][]");
            $(name_li_id).attr('type','text');
            $(name_li_id).attr('style',"width:auto !important");
            $(name_li_id).attr('placeholder','Model.column');
            $(name_li).append(name_li_id);
            
            //remove tag for that line of param will also be placed here
            var remove_li =  document.createElement('li') ;
            $(remove_li).attr('style',"width:auto !important");
            var  remove_li_tg=document.createElement('a');
            $(remove_li_tg).attr('class','remove_param');
            /** $(remove_li_tg).live('click',function(e) {
                if(confirm("Do You Want To Remove Parameter")){
                    
                    $(this).closest('span').remove();
                    
                }
            });**/
            $(remove_li_tg).attr('style',"width:auto !important");
            $(remove_li_tg).attr('href','#');
            $(remove_li_tg).html("Remove");
            $(remove_li).append(remove_li_tg);
            
            
            //paraters are appended here
            $(span_all).append(type_li).append(label_li).append(name_li).append(remove_li);
            $('.add_param_ul').append(span_all);
 
        });
      
        //this is used for removeing all params
        $('#remove_all_param').live('click',function(e) {
            if(confirm("Do You Want To Remove All Params ?")){
                    
                $(".add_param_ul").children('span').remove();
                    
            }
        });
      
      
    },
    init:function(){
        var _this=this;
        _this.load_report(_this.load_url);
        _this.configure_dialog();
        _this.configure_roles_dialog();
        _this.configure_params();
        //
        
        $("a.remove_param").live('click',function(e) {
            if(confirm("Do You Want To Remove Parameter")){
                    
                $(this).closest('span').remove();
                    
            }
        });
        $("a.pglink").live('click',function(e) {
            e.preventDefault();
            var link=$(this).attr('href');
            _this.load_report(link);  
        });
       
        $("#search_report").keyup(function(e) {
            if(e.which==13){
                _this.load_report(_this.load_url); 
                
            }
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
    
    
        $("#add_report,.edit_report").live('click',function(e) {
            e.preventDefault();
            var report_url=$("#report_add_url").val();
            if($(this).hasClass('edit_report')){
                _this.title_status="Edit Report";
                var data="?id="+$(this).closest("tr").attr("id")+"&edit_report=true";
                report_url=report_url+data;
            }else{
                var data="";
                _this.title_status="Add Report";
            }
            
            $("#add_report_form.cmxform").html("");
            _this.start_diag.dialog('open')
            .load(report_url,function(data_ret){

                //  alert("page loaded");
                //  console.log(std.contents().find("input[type=text]:first"));
                /*   std.contents().find("input[type=text]:first").focus();  
                $( "#event_start" ).datetimepicker({
                    'dateFormat': 'yy-mm-dd',
                    'timeFormat': 'hh:mm:ss',
                    changeMonth: true,
                    changeYear: true
                });
                 **/
              
             
          
                })
     
        });
        
        $(".add_role").live('click',function(e) {
            e.preventDefault();
            var report_url=$("#report_roles_url").val();
            var data="?id="+$(this).closest("tr").attr("id")+"&roles_report=true";
            _this.id=$(this).closest("tr").attr("id");
            report_url=report_url+data;
            _this.roles_diag.dialog('open')
            .load(report_url,function(data_ret){
                $("#user_roles").pickList({
                    afterBuild: function() { 
                        _this.picklist_status=true;
                    }
                });
              
            });
            
            
        });
        
       
    },
    checkfields:function(){
        var _this=this;
        var counter=0;
        $("#add_report_form.cmxform input[type=text],#add_report_form.cmxform  textarea,#add_report_form.cmxform input[type=email]").each(function(){
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
    
    save_data:function(){
        var _this=this;
        var formurl=$("#report_add_url").val();
        var formdata=$("#add_report_form.cmxform").serialize()+"&save_report=true";    
        $.ajax({
            url: formurl,
            data:formdata,
            type: 'POST',
            dataType:'json',
            
            success:function(data) {
               
                if(data.status=="1")          
                {
                    $(".ui-dialog-content").dialog("close");
                    $(".ui-dialog-content #add_report_form.cmxform")[0].reset();
                    _this.load_report(_this.load_url); 

                }
            },
            error:function(data){
          
            }
        })
    },
    save_roles_user:function(){
        var _this=this;      
        var roles = $.map( $('#user_roles option:selected'),
            function(e) {
                return $(e).val();
            } );
        console.log(roles);
        var data="roles="+roles+"&id="+this.id;     
        $.ajax({
            url: $("#report_roles_save").val(),
            data: data,
            success: function(data){
                $(".ui-dialog-content").dialog("close");
                _this.load_report(_this.load_url);

            //   $("#user_roles").pickList("destroy");
            // window.location.href=$("#view_users_url").val();
                
            },
            type:'GET',
            dataType: 'json'
        })

    }
    
    

}