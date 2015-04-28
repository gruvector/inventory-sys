<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<form name="add_event" id="add_event" class="cmxform">
<div class='tableWrapper '>
    <div class='tableHeader'>
        <ul class='tableActions'>
            <li>
                <label>  Name </label>       
            </li> 
             <li>
           <input type="text" name="data[Event][event_name]" id="data[Event][event_name]" />      
            </li>
             </ul>  
               <ul class='tableActions'>
             <li>
                 <label>  Event Location </label> 
            </li>
             <li>
           <input type="text" name="data[Event][event_location]" id="data[Event][event_location]" />      
            </li>
        </ul>
          <ul class='tableActions'>
            <li>
              <label>  Event Start </label> 
            </li>
            <li>
            </li>
          <li>
           <input type="text" name="data[Event][event_start]" id="data[Event][event_start]" />      
            </li>
            
           
        </ul>
          <ul class='tableActions'>
            <li>
                <label>  Event End </label> 
            </li>
            <li>
            </li>
          <li>
           <input type="text" name="data[Event][event_end]" id="data[Event][event_end]" />      
            </li>
            
           
        </ul>
        
         <ul class='tableActions'>
            <li>
             </li>
            <li>
            </li>
          <li>
          
            </li>
            
           
        </ul>

        
        
        
        
         <ul class='tableActions'>
            <li>
                 <label>  </label> 
            </li>
            <li>
            </li>
          <li>
             <input type="reset" name="reset_event" id="reset_event">
              <input type="submit" name="submit_event" id="submit_event"> 
            </li>
            
           
        </ul>

                

        <div class='clear'></div>
        <div class='corner left'></div>
        <div class='corner right'></div>
    </div>
 
</div>

</form>



  
                <script type='text/javascript'>
                <!--
                
                $('#deleteSelection').click(function(event) {
					event.preventDefault();
					
					if (!$(this).parents('li').hasClass('inactive')) {
						var ids = [];
						$(this).parents('.tableWrapper').find('.toggleSelection input:checked').each(function() {
							ids.push(this.value);
						});
						
						if (!tablePreferences.warningBeforeDelete || confirm("Do you really want to delete the selected websites?")) {
							window.location = 'affiliate-delete.php?affiliateid=' + ids.join(',');
						}
					}
                });
                
               
                </script>