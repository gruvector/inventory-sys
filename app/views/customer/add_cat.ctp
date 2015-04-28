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


<form name="add_cat_form" id="add_cat_form" class="cmxform">
    <div class='tableWrapper'>
        <div class='tableHeader' style="border: 0px !important;">
            <ul class='tableActions'>
                <li>
                    <label>  Short Name </label>       
                </li> 
                <li>
                    <input type="hidden" required name="data[Category][id]" id="data[Category][id]"  value="<?php echo isset($cat) ? $cat['Category']['id'] : ""; ?>" />      

                    <input type="text" required name="data[Category][short_name]" id="data[Category][short_name]" value="<?php echo isset($cat) ? $cat['Category']['short_name'] : ""; ?>" />      
                </li>
            </ul>  
            <ul class='tableActions'>
                <li>
                    <label>  Long Name  </label> 
                </li>
                <li>
                    <input type="text" required name="data[Category][long_name]" id="data[Category][long_name]" value="<?php echo isset($cat) ? $cat['Category']['long_name'] : ""; ?>" />      
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


