$(document).ready(function(){

    roles.init();
})


var roles = {
  
    load_url:$("#role_list_url").val(),

    
    load_roles:function(page_link){
      
        var val = $("#search_role").val();

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
        
        _this.load_roles(_this.load_url);
        
        $("a.pglink").live('click',function(e) {
            e.preventDefault();
            var link=$(this).attr('href');
            _this.load_roles(link);  
        });
       
        $("#search_role").keyup(function(e) {
            if(e.which==13){
                _this.load_roles(_this.load_url); 
                
            }
        });  
    
        $("#add_role,.edit_role").live('click',function(e) {
            e.preventDefault();
            
            if($(this).hasClass('edit_role')){
              var title="Add Role";
                var data="id="+$(this).closest("tr").attr("id")+"&edit_role=true";
            }else{
                var data="";
                var title="Edit Role";
            }
            
            
            var title="Edit Role";
            var $dialog = $("<div></div>")
            .load($("#add_role").attr('href'),data,function(rdata){
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
        $("#add_role_form.cmxform input[type=text],#add_role_form.cmxform  textarea,#add_role_form.cmxform input[type=email]").each(function(){
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
        var formurl=$("#add_role_url").val();
        var formdata=$("#add_role_form.cmxform").serialize()+"&save_role=true";      
        $.ajax({
            url: formurl,
            data:formdata,
            type: 'GET',
            dataType:'json',
            success:function(data) {
               
                if(data.status=="1")          
                {
                    $(".ui-dialog-content").dialog("close");
                    _this.load_roles(_this.load_url); 

                }
            },
            error:function(data){
          
            }
        })
      
      
      
      
      
    }
    
}