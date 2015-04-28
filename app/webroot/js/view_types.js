/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){

    types_event.init();
})


var types_event = {
    
    load_url:$("#tt_list_url").val(),

    
    load_tt:function(page_link){
        
        var val = $("#search_tt").val();

        
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
        var _this= this ; 
        _this.load_tt(_this.load_url);
        
        $("a.pglink").live('click',function(e) {
            e.preventDefault();
            var link=$(this).attr('href');
            _this.load_tt(link);  
        });
       
        $("#search_tt").keyup(function(e) {
            if(e.which==13){
                _this.load_tt(_this.load_url);
                
            }
        }); 
        
        
        $("#add_tt,.edit_tt").live('click',function(e) {
            e.preventDefault();
            
            if($(this).hasClass('edit_tt')){
                var data="id="+$(this).closest("tr").attr("id")+"&edit_tt=true";
            }else{
                var data="";
            }
            
            
            var title="Edit Ticket Type";
            var $dialog = $("<div></div>")
            .load($("#add_tt").attr('href'),data,function(rdata){
                })
            .dialog({
                autoOpen: false,
                title:title,
                width: 500,
                height: 500,
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
        $("#add_tt_form.cmxform input[type=text],#add_tt_form.cmxform  textarea,#add_tt_form.cmxform input[type=email]").each(function(){
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
        var formurl=$("#tt_add_url").val();
        var formdata=$("#add_tt_form.cmxform").serialize()+"&save_tt=true";      
        $.ajax({
            url: formurl,
            data:formdata,
            type: 'GET',
            dataType:'json',
            success:function(data) {
               
                if(data.status=="1")          
                {
                    $(".ui-dialog-content").dialog("close");
                _this.load_tt(_this.load_url);

                }
            },
            error:function(data){
          
            }
        })
     
    }
}