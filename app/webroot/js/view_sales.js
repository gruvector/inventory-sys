/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



var view_sales={
    
    
    load_sales:function(){
      
        var formurl=$("#eventsales_list_url").val();   
        $.ajax({
            url: formurl,
            dataType:'html',
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
        view_sales.load_sales();

        setInterval(function() {
            view_sales.load_sales();
        }, 1000  * 1 * 5);
        
    }
}

$(document).ready(function() {
    console.log("page has been loaded");
    view_sales.init();
})