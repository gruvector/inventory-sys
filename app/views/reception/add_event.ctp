<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */
?>
<style>
    div.tableWrapper li {
        width: 150px !important;
    }   
</style>


<form name="add_eve" id="add_eve" class="cmxform">
    <div class='tableWrapper'>
        <div class='tableHeader' style="border: 0px !important;">
            <ul class='tableActions'>
                <li>
                    <label>  Name </label>       
                </li> 
                <li>
                    <input type="hidden" required name="data[Event][id]" id="data[Event][id]"  value="<?php echo isset($event) ? $event['Event']['id'] : ""; ?>" />      

                    <input type="text" required name="data[Event][event_name]" id="data[Event][event_name]" value="<?php echo isset($event) ? $event['Event']['event_name'] : ""; ?>" />      
                </li>
            </ul>  
            <ul class='tableActions'>
                <li>
                    <label>  Event Location </label> 
                </li>
                <li>
                    <input type="text" required name="data[Event][event_location]" id="data[Event][event_location]" value="<?php echo isset($event) ? $event['Event']['event_location'] : ""; ?>" />      
                </li>
            </ul>
            <ul class='tableActions'>
                <li>
                    <label>  Event Start </label> 
                </li>
                <li>
                </li>
                <li>
                    <input type="text" class="date_field"  name="event_start" id="event_start" value="<?php  echo isset($event) ? $event['Event']['event_start'] : "";   ?>" />      
                </li>


            </ul>
            <ul class='tableActions'>
                <li>
                    <label>  Event End </label> 
                </li>
                <li>
                </li>
                <li>
                    <input type="text" class="date_field" required name="event_end" id="event_end" value="<?php echo isset($event) ? $event['Event']['event_end'] : "";  ?>" />      
                </li>


            </ul>

               <ul class='tableActions'>
                <li>
                    <label>Event Description</label> 
                </li>
                <li>
                </li>
                <li>
                    <input type="text" required name="data[Event][event_description]" id="data[Event][event_description]" value="<?php echo isset($event) ? $event['Event']['event_description'] : ""; ?>" />      
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



            </ul>



            <div class='clear'></div>
            <div class='corner left'></div>
            <div class='corner right'></div>
        </div>

    </div>
    <input type="hidden"  name="save_eve" id="save_eve" value="save" />      

</form>


