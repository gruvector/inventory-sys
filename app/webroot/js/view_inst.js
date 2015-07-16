$(document).ready(function(){

    inst.init();
})


var inst = {
  
    load_url:$("#inst_list_url").val(),

    
    load_inst:function(page_link){
      
        var val = $("#search_inst").val();

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
            url: $("#status_inst_change").val(),
            data:dt,
            type: 'GET',
            dataType:'json',
            success:function(data) {
                    _this.load_inst(_this.load_url); 

            }
        })
    },
    init:function(){
        var _this=this;
        
        _this.load_inst(_this.load_url);
    
    
        $("a.pglink").live('click',function(e) {
            e.preventDefault();
            var link=$(this).attr('href');
            _this.load_inst(link);  
        });
       
        $("#search_inst").keyup(function(e) {
            if(e.which==13){
                _this.load_inst(_this.load_url); 
                
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
    
    
        $("#add_inst,.edit_inst").live('click',function(e) {
            e.preventDefault();
            
            if($(this).hasClass('edit_inst')){
                var title="Edit Institution";
                var data="id="+$(this).closest("tr").attr("id")+"&edit_inst=true";
            }else{
                var data="";
                var title="Add Institution";
            }
            
            
            var $dialog = $("<div></div>")
            .load($("#add_inst").attr('href'),data,function(rdata){
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
        var _this=this;
        var counter=0;
        $("#add_institution_form.cmxform input[type=text],#add_institution_form.cmxform  textarea,#add_institution_form.cmxform input[type=email]").each(function(){
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
        var formurl=$("#add_inst_url").val();
        var formdata=$("#add_institution_form.cmxform").serialize()+"&save_inst=true";    
        $.ajax({
            url: formurl,
            data:formdata,
            type: 'GET',
            dataType:'json',
            success:function(data) {
               
                if(data.status=="1")          
                {
                    $(".ui-dialog-content").dialog("close");
                    _this.load_inst(_this.load_url); 

                }
            },
            error:function(data){
          
            }
        })
      
      
      
      
      
    }
    
    

}