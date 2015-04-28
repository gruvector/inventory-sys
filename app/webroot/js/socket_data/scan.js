// JavaScript Document
var cardSwipe = {

    timer: null,
    processing:false,
    swipeCallback: function() {},
    init: function() {
        var _this=this;
      
        /*
        el.setAttribute('type', 'text');
        el.setAttribute('name', 'ticket-scan');
        el.setAttribute('id', 'ticket-scan');
        el.setAttribute('style','opacity:0; position: absolute; top: 50%;');
        */
               
        $("#verify_ticket").keyup(function(event) {
            var value = $(this).val();
            if(event.keyCode=='13')
            {

                try{
                    if(!_this.processing)      
                    {  
                        cardSwipe.processing=true;
                        _this.processTxtString($(this),value );
                    }   
                }
                catch(err){
                    return null;
                }
            }else
            {
            //console.log(event.keyCode);
            }
                          

           
        }) ;
  
        _this.startFocusTimer();

    }, //Initialization
       
    /**
     * Call this function when the text field focus changes
     */
    processTxtString: function($this ,value) { //With % 
        this.swipeCallback(value);
        $this.val("");
            
    // console.log(value);
        
    },
    
    
    /**
     * Call this function to begin the field focus process
     */
    startFocusTimer: function() {
        var _this=this;
        clearInterval(_this.timer);
        _this.timer = setInterval(function() {
            $("#verify_ticket").focus();
        }, 1000);
    },
    
    /**
     * Call to stop the auto focus process
     */
    stopFocusTimer: function() {
        var _this=this;
        clearInterval(_this.timer);
    // alert('Timer Stopped');        
    },
    
    // set the function to call after the swipe card has validate correctly
    setSwipeCallback: function(callback) {
        this.swipeCallback = callback;
    }
	
   

  
}
	

// prepare the form when the DOM is ready
$(document).ready(function() {
    cardSwipe.init();
});
