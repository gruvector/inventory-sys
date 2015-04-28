/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){

    sites.init();
})


var sites = {
  
    load_url:$("#site_list_url").val(),

    
    load_sites:function(page_link){
      
        var val = $("#search_site").val();

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
            url: $("#status_site_change").val(),
            data:dt,
            type: 'GET',
            dataType:'json',
            success:function(data) {
                sites.load_sites(_this.load_url);

            }
        })
    },
    init:function(){
        var _this= this ; 
        sites.load_sites(_this.load_url);
        
        $("a.pglink").live('click',function(e) {
            e.preventDefault();
            var link=$(this).attr('href');
            _this.load_sites(link);  
        });
       
        $("#search_site").keyup(function(e) {
            if(e.which==13){
                _this.load_sites(_this.load_url); 
                
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
          
        
        $("#add_site,.edit_site").live('click',function(e) {
            e.preventDefault();
            
            if($(this).hasClass('edit_site')){
                var data="id="+$(this).closest("tr").attr("id")+"&edit_site=true";
            }else{
                var data="";
            }
            
            
            var title="Edit Site";
            var $dialog = $("<div></div>")
            .load($("#add_site").attr('href'),data,function(rdata){
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
        $("#add_site_form.cmxform input[type=text],#add_site_form.cmxform  textarea,#add_site_form.cmxform input[type=email]").each(function(){
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
        var formurl=$("#add_site_url").val();
        var formdata=$("#add_site_form.cmxform").serialize()+"&save_site=true";      
        $.ajax({
            url: formurl,
            data:formdata,
            type: 'GET',
            dataType:'json',
            success:function(data) {
               
                if(data.status=="1")          
                {
                    $(".ui-dialog-content").dialog("close");
                    sites.load_sites(sites.load_url);

                }
            },
            error:function(data){
          
            }
        })
      
      
      
      
      
    }

    
}