/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var Login={


    init:function(){
        $("#login").click(function(event){
            Login.checkLogin();
          event.preventDefault();
        })
    },

    checkLogin:function()
    {
        if($("#username").val()=='' || $("#password").val()=='')
        {
         $("span.install").css("color","red !important").html("Please Enter Correct Username And Password To Login");
         return false;
        }  
        
        $("#login_form").submit();
        
        
        
       
        
        /**
         *
        var formurl=$("#verify_cred_url").val();
        var formdata="username="+$("#username").val()+"&password="+$("#password").val();
        $.ajax({
            url: formurl,
            data:formdata,
            type: 'GET',
            dataType:'json',
            beforeSend:function (){
                $("span.install").css({ color: "black"}).html("Verifying Credentials...");
                
            },
            success:function(data) {
                console.log(data.status);
                if(data.status){
                    $("span.install").css("color","black !important").html("Credentials Verified.Redirecting...");
                    setTimeout(function(){
                        window.location.href = $("#dashboard_url").val();
                    },100*5);
                   
                }
                else if(!data.status){
                 
      $("span.install").css("color","red !important").html(" Please Enter Correct username and password to log in");
      
                }
            },
            error:function(data){
                $("span.install").html("There was an error while Verifying Credentials.Please Try Again");
          
            }
        })
        
        **/
        
        
        
        
    }
}

$(document).ready(function() {
    console.log("page has been loaded");
    Login.init();

})