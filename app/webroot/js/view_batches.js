
var view_batch={
    
    load_url:$("#batch_list_url").val(),

    load_batches:function(page_link){
        
        var val = $("#search_batch").val();
 
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
  
    init:function() 
    {
        var self=this;
        view_batch.load_batches(view_batch.load_url);
                
        $("a.pglink").live('click',function(e) {
            e.preventDefault();
            var link=$(this).attr('href');
            self.load_batches(link);  
        });
       
        $("#search_batch").keyup(function(e) {
            if(e.which==13){
                self.load_batches(view_batch.load_url); 
                
            }
        })           
                
                
        $("#add_batch").click(function(e) {
            e.preventDefault();
            var $dialog = $("<div></div>")
            .load($(this).attr('href'))
            .dialog({
                autoOpen: false,
                title: $(this).attr('title'),
                width: 500,
                height: 300,
                position:"center",
                modal:false,
                buttons: {
                    "Save": function() {
                        add_batch.checkfields();
                    },
                    "Close": function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
            $dialog.dialog('open');
     
        });      
                
    }
    

    
}

$(document).ready(function() {
    console.log("page has been loaded");
    view_batch.init();
    add_batch.init();
})


var add_batch={
    
    init:function(){
        
        $("#add_batch_form").live("submit",function(e){
            e.preventDefault() ;
            add_batch.checkfields();    
            return false;
        })     ; 
        
        $(".del_batch").live('click',function(event){
            event.preventDefault();
            if(confirm("Are You Sure You Want To Delete Batch ?")){
                var formurl=$("#del_batch_url").val();   
                var data="id="+$(this).closest("tr").attr("id")
                $.ajax({
                    url: formurl,
                    dataType:'json',
                    data:data,
                    type : 'GET',    
                    success:function(data) {
                        //  console.log(data);       
                        view_batch.load_batches(view_batch.load_url);
                        
                    },
                    error:function(data){
          
                    }
                })
            }
            else{
                     
            }
               
        })
       
       
       
        $(".edit_batch").live('click',function(event){
            
            event.preventDefault();
            var data="?id="+$(this).closest("tr").attr("id")+"&edit_url=true";
            var url=$("#add_batch_url").val()+data;
  
            var $dialog = $("<div></div>")
            .load(url)
            .dialog({
                autoOpen: false,
                title: "Edit Batch",
                width: 500,
                height: 300,
                position:"center",
                modal:false,
                buttons: {
                    "Save": function() {
                        add_batch.checkfields();
                    },
                    "Close": function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
               
            $dialog.dialog('open');
        }) 
     
    },
   
    checkfields:function(){
        var _this=this;
        var counter=0;
        $("#add_batch_form.cmxform input[type=text]").each(function(){
            if($(this).val()=="")
            {
                $(this).css("border","solid #F44 2px");              
                counter++;
            }
            else{
               
                $(this).css("border","white");       
            
            } 
        });
      
        if(counter==0)
        {
            _this.save_data();
        }
      
     
    },
   
    save_data:function(){
        
        var formurl=$("#add_batch_url").val();
        var formdata=$("#add_batch_form.cmxform").serialize();
        $.ajax({
            url: formurl,
            data:formdata,
            type: 'GET',
            dataType:'json',
            success:function(data) {
               
                console.log(data);
                if(data.status=="1")          
                {
                    $(".ui-dialog-content").dialog("close");
                    view_batch.load_batches(view_batch.load_url);

                }

            },
            error:function(data){
          
            }
        })
    }
  
    
    
    
}