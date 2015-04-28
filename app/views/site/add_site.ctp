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


<form name="add_site_form" id="add_site_form" class="cmxform">
    <div class='tableWrapper'>
        <div class='tableHeader' style="border: 0px !important;">
            <ul class='tableActions'>
                <li>
                    <label>  Name </label>       
                </li> 
                <li>
                    <input type="hidden" required name="data[Site][id]" id="data[Site][id]"  value="<?php echo isset($sites) ? $sites['Site']['id'] : ""; ?>" />      

                    <input type="text" required name="data[Site][site_name]" id="data[Site][site_name]" value="<?php echo isset($sites) ? $sites['Site']['site_name'] : ""; ?>" />      
                </li>
            </ul>  
            <ul class='tableActions'>
                <li>
                    <label>  City  </label> 
                </li>
                <li>
                    <input type="text" required name="data[Site][city]" id="data[Site][city]" value="<?php echo isset($sites) ? $sites['Site']['city'] : ""; ?>" />      
                </li>
            </ul>
            <ul class='tableActions'>
                <li>
                    <label>  Phone</label> 
                </li>
                <li>
                </li>
                <li>
                    <input type="text"  name="data[Site][phone]" id="data[Site][phone]" value="<?php echo isset($sites) ? $sites['Site']['phone'] : ""; ?>" />      
                </li>


            </ul>
            <ul class='tableActions'>
                <li>
                    <label>  Fax </label> 
                </li>
                <li>
                </li>
                <li>
                    <input type="text" required name="data[Site][fax]" id="data[Site][fax]" value="<?php echo isset($sites) ? $sites['Site']['fax'] : ""; ?>" />      
                </li>


            </ul>
            <ul class='tableActions'>
                <li>
                    <label>Email</label> 
                </li>
                <li>
                </li>
                <li>
                    <input type="email" required name="data[Site][email]" id="data[Site][email]" value="<?php echo isset($sites) ? $sites['Site']['email'] : ""; ?>" />      
                </li>


            </ul>

            <ul class='tableActions'>
                <li>
                    <label>Desecription</label> 
                </li>
                <li>
                </li>
                <li>
                    <textarea  required  
                              name="data[Site][site_desc]" id="data[Site][site_desc]" ><?php echo isset($sites) ? $sites['Site']['site_desc'] : ""; ?></textarea>
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


