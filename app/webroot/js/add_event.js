/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.

have to do the add/edit for the ajax for those pages
have to remove those ugly things at the edit page
have to make the main pages in such a way that i can load stuff by  using  ajax
same for all the other pages.

 */

var add_event={
    
    init:function() 
    {
      
      
        $("#add_event").submit(function(){
                 
            add_event.checkfields();
            return false;
        });
        
        $("#submit_event").click(function(){
               
            add_event.checkfields();
            return false;
        });
        
        $("#add_event.cmxform input[type=text]").blur(function(){
        
            if($(this).val()=="")
            {
                // border: solid #F44 2px !important;
                $(this).css("border","solid #F44 2px");              
            }else{
                $(this).css("background-color","white");              
      
            }
        
        })
        
    },
  
    load_events:function(){
        
        
    },
    checkfields:function(){
        var counter=0;
        $("#add_event.cmxform input[type=text]").each(function(){
      
            if($(this).val()=="")
            {
                $(this).css("border","solid #F44 2px");              
            }
            else{
               
                $(this).css("border","solid black 1px");       
            
            } 
            counter++;
        })
      
        if(counter==0)
        {
            add_event.save_data();
        }
      
      
    },
  
    save_data:function(){
      
        var formurl=$("#save_url").val();
        var formdata=$("#add_event").serialize();      
        $.ajax({
            url: formurl,
            data:formdata,
            type: 'GET',
            dataType:'json',
            success:function(data) {
               
                console.log(data);
                $dialog.dialog('close');

            },
            error:function(data){
          
            }
        })
      
      
      
      
      
    }
  
}



$(document).ready(function(){

    add_event.init();
})


