/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var verify={
     
    ver_url:$("#verification_url").val(),
    //this code is for the functions which must run when the code is inited
    init:function(){
        _this=this;
        _this.scan_configure_action();
      
    },
    scan_configure_action:function(){
        var _this=this;
        cardSwipe.setSwipeCallback(function(ticket_data){
            _this.verify_code(ticket_data);
        });
  
    },
    //this is the code which does the actual code verificaiton for the ticket
    verify_code:function(ticket_data){
        console.log(ticket_data);
        var formurl=verify.ver_url;
        var fdata='ticket_data='+ticket_data;     
        $.ajax({
            url: formurl,
            data:fdata,
            type: 'POST',
            dataType:'json',
            success:function(data) {
                console.log(data);
                cardSwipe.processing=false;
            },
            error:function(data){
          
            }
        })
    }
    
}



$(document).ready(function() {
    console.log("page has been loaded");
    verify.init();
})
