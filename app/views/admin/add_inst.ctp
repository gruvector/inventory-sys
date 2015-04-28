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


<form name="add_institution_form" id="add_institution_form" class="cmxform">
    <div class='tableWrapper'>
        <div class='tableHeader' style="border: 0px !important;">
            <ul class='tableActions'>
                <li>
                    <label> Short Name </label>       
                </li> 
                <li>
                    <input type="hidden" required name="data[Institution][id]" id="data[Institution][id]"  value="<?php echo isset($institutions) ? $institutions['Institution']['id'] : ""; ?>" />      

                    <input type="text" required name="data[Institution][inst_short_name]" id="data[Institution][inst_short_name]" value="<?php echo isset($institutions) ? $institutions['Institution']['inst_short_name'] : ""; ?>" />      
                </li>
            </ul>  
               <ul class='tableActions'>
                <li>
                    <label> Long Name </label>       
                </li> 
                <li>

                    <input type="text" required name="data[Institution][inst_long_name]" id="data[Institution][inst_long_name]" value="<?php echo isset($institutions) ? $institutions['Institution']['inst_long_name'] : ""; ?>" />      
                </li>
            </ul> 
            <ul class='tableActions'>
                <li>
                    <label>  City  </label> 
                </li>
                <li>
                    <input type="text" required name="data[Institution][city]" id="data[Institution][city]" value="<?php echo isset($institutions) ? $institutions['Institution']['city'] : ""; ?>" />      
                </li>
            </ul>
            <ul class='tableActions'>
                <li>
                    <label>  Phone</label> 
                </li>
                <li>
                </li>
                <li>
                    <input type="text"  name="data[Institution][phone]" id="data[Institution][phone]" value="<?php echo isset($institutions) ? $institutions['Institution']['phone'] : ""; ?>" />      
                </li>


            </ul>
            <ul class='tableActions'>
                <li>
                    <label>  Fax </label> 
                </li>
                <li>
                </li>
                <li>
                    <input type="text" required name="data[Institution][fax]" id="data[Institution][fax]" value="<?php echo isset($institutions) ? $institutions['Institution']['fax'] : ""; ?>" />      
                </li>


            </ul>
            <ul class='tableActions'>
                <li>
                    <label>Email</label> 
                </li>
                <li>
                </li>
                <li>
                    <input type="email" required name="data[Institution][email]" id="data[Institution][email]" value="<?php echo isset($institutions) ? $institutions['Institution']['email'] : ""; ?>" />      
                </li>


            </ul>

             <ul class='tableActions'>
                <li>
                    <label>Address</label> 
                </li>
                <li>
                </li>
                <li>
                    <textarea  required  
                              name="data[Institution][address]" id="data[Institution][address]" ><?php echo isset($institutions) ? $institutions['Institution']['address'] : ""; ?></textarea>
                </li>


            </ul>
            
            <ul class='tableActions' style="margin-top:30px;">
                <li>
                    <label>Description</label> 
                </li>
                <li>
                </li>
                <li>
                    <textarea  required  
                              name="data[Institution][description]" id="data[Institution][description]" ><?php echo isset($institutions) ? $institutions['Institution']['description'] : ""; ?></textarea>
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

</form>


