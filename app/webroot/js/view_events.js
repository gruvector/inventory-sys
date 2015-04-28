/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 *  have to work on the delete buttons and the check boxes and how they work
 *  have to add a cancel button to the save button
 *  have to add a date picker and 
 *  ---then pagination
 */


var view_event={
    
    load_url:$("#event_list_url").val(),
    start_diag:$("#dialog_date_input"),
    title_status : "",
    load_events:function(page_link){
        
        var val = $("#search_event").val();
        var archive_status=  $("#event_archive_status").is(":checked")  ? "&event_archive_status=true" :"&event_archive_status=false";

      
        $.ajax({
            url: page_link,
            dataType:'html',
            data: val!="" ? "filter="+val+archive_status : "filter=null"+archive_status,
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
        var std =  self.start_diag;
        self.load_events(self.load_url);
        std.dialog({
            autoOpen: false,
            title: view_event.title_status,
            width: 500,
            height: 300,
            position:"center",
            modal:false,
            open: function(event, ui) {
            //    $("#add_eve.cmxform input[type=text]:first").focus();
            },
         
            buttons: {
                "Save": function() {
                    add_event.checkfields();
                },
                "Close": function() {
                    $(".date_field").val("");
                    $(std).html("");
                    $( this ).dialog( "close" );
                }
            }
        });
        std.dialog('close');
      
        
        $("a.pglink").live('click',function(e) {
            e.preventDefault();
            var link=$(this).attr('href');
            self.load_events(link);  
        });
       
        $("#search_event").keyup(function(e) {
            if(e.which==13){
                self.load_events(self.load_url); 
                
            }
        }) ;
        
        $("#search_button").click(function(e) { 
            self.load_events(self.load_url); 
                
        })
        
             
             

        $("#add_event").live('click',function(e) {
            e.preventDefault();
            view_event.title_status='Add New Event';
            std.dialog('open')
            .load($(this).attr('href'),function(data){
                $("#add_eve.cmxform").find('input:text')[0].focus();

                //  alert("page loaded");
                //  console.log(std.contents().find("input[type=text]:first"));
                //   std.contents().find("input[type=text]:first").focus();  
                $( "#event_start" ).datetimepicker({
                    'dateFormat': 'yy-mm-dd',
                    'timeFormat': 'hh:mm:ss',
                    changeMonth: true,
                    changeYear: true
                });
                
                $( "#event_end" ).datetimepicker({
                    'dateFormat': 'yy-mm-dd',
                    'timeFormat': 'hh:mm:ss',
                    changeMonth: true,
                    changeYear: true
                });
             
          
            })
        

        });
            
            
        $(".del_event").live('click',function(event){
            event.preventDefault();
            if(confirm("Are You Sure You Want To Archive Event ?")){
                var formurl=$("#del_url").val();   
                var data="id="+$(this).closest("tr").attr("id")
                $.ajax({
                    url: formurl,
                    dataType:'json',
                    data:data,
                    type : 'GET',    
                    success:function(data) {
                        //  console.log(data);       
                        view_event.load_events(view_event.load_url);
                        
                    },
                    error:function(data){
          
                    }
                })
            }
            else{
                     
            }
               
        })
            
        $(".edit_event").live('click',function(event){
            
            event.preventDefault();
            var data="?id="+$(this).closest("tr").attr("id")+"&edit_url=true";
            var url=$("#save_url").val()+data;  
            view_event.title_status='Edit Event';

            std.dialog('open')
            .load(url,function(data){
               
                $( "#event_start" ).datetimepicker({
                    'dateFormat': 'yy-mm-dd',
                    'timeFormat': 'hh:mm:ss',
                    changeMonth: true,
                    changeYear: true
                });
                
                $( "#event_end" ).datetimepicker({
                    'dateFormat': 'yy-mm-dd',
                    'timeFormat': 'hh:mm:ss',
                    changeMonth: true,
                    changeYear: true
                });
             
          
            })
                      
         
  

       
        })          
                
        //this is for enabling on key up events for validation
        $("#add_eve.cmxform input[type=text],textarea").live('keyup',function(event) {
            //  add_event.checkfields();
            //  console.log($("#add_eve.cmxform").find('input:text')[0].val());

            })
      
    }
}



$(document).ready(function(){

    view_event.init();
    add_event.init();

})




var add_event={
    
    init:function() 
    {
      
        var _this=this;
       
        $("#add_eve.cmxform").live('submit',(function(){
                 
            add_event.checkfields();
            return false;
        }));
        
        $("#submit_event").live('click',(function(){
               
            add_event.checkfields();
            return false;
        }));
        
        $("#add_eve.cmxform input[type=text]").blur(function(){
        
            if($(this).val()=="")
            {
                $(this).css("border","solid #F44 2px");              
            }else{
                $(this).css("border","solid black 1px");       
      
            }
        
        })
        
    },
  
   
    checkfields:function(){
        var _this=this;
        var counter=0;
        $("#add_eve.cmxform input[type=text]").each(function(){
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
        var formurl=$("#save_url").val();
        var formdata=$("#add_eve.cmxform").serialize();      
        $.ajax({
            url: formurl,
            data:formdata,
            type: 'GET',
            dataType:'json',
            success:function(data) {
               
                if(data.status=="1")          
                {
                    $(".ui-dialog-content").dialog("close");
                    view_event.load_events(view_event.load_url);

                }
            },
            error:function(data){
          
            }
        })
      
      
      
      
      
    }
  
}



