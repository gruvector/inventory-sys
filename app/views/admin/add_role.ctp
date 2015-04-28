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


<form name="add_role_form" id="add_role_form" class="cmxform">
    <div class='tableWrapper'>
        <div class='tableHeader' style="border: 0px !important;">
            <ul class='tableActions'>
                <li>
                    <label>  Name </label>       
                </li> 
                <li>
                    <input type="hidden" required name="data[Role][id]" id="data[Role][id]"  value="<?php echo isset($roles) ? $roles['Role']['id'] : ""; ?>" />      

                    <input type="text" required name="data[Role][role_long_name]" id="data[Role][role_long_name]" value="<?php echo isset($roles) ? $roles['Role']['role_long_name'] : ""; ?>" />      
                </li>
            </ul>  
            <ul class='tableActions'>
                <li>
                    <label>  Code  </label> 
                </li>
                <li>
                    <input type="text" required name="data[Role][role_short_name]" id="data[Role][role_short_name]" value="<?php echo isset($roles) ? $roles['Role']['role_short_name'] : ""; ?>" />      
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


