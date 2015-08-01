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

<form name="add_customer_form" id="add_customer_form" class="cmxform">
    <div class='tableWrapper'>
        <div class='tableHeader' style="border: 0px !important;">

            <ul class='tableActions'>
                <li>
                    <label>  Name  </label> 
                </li>
                <li>
                    <input type="text" style="width:170px" required name="data[Supplier][fname]" id="data[Supplier][fname]" value="<?php echo isset($Supplier) ? $Supplier['Supplier']['fname'] : ""; ?>" />      
                </li>
            </ul>

            <ul class='tableActions'>
                <li>
                    <label>  Email </label>       
                </li> 
                <li>
                    <input type="hidden" required name="data[Supplier][id]" id="data[Supplier][id]"  value="<?php echo isset($Supplier) ? $Supplier['Supplier']['id'] : ""; ?>" />      

                    <input type="text" style="width:170px" required name="data[Supplier][email]" id="data[Supplier][email]" value="<?php echo isset($Supplier) ? $Supplier['Supplier']['email'] : ""; ?>" />      
                </li>
            </ul>  
            <ul class='tableActions'>
                <li>
                    <label>  Cell  </label> 
                </li>
                <li>
                    <input type="text" style="width:170px" required name="data[Supplier][cell_number]" id="data[Supplier][cell_number]" value="<?php echo isset($Supplier) ? $Supplier['Supplier']['cell_number'] : ""; ?>" />      
                </li>
            </ul>

            <ul class='tableActions'>
                <li>
                    <label>  Category </label> 
                </li>
                <li>

                    <select required name="data[Supplier][cat_id]" id="data[Supplier][cat_id]" >
<?php foreach ($categories as $val) { ?>
                            <option
                            <?php if (isset($Supplier) && $Supplier['Supplier']['cat_id'] == $val['Category']['id']) { ?>  selected="selected"  <?php } ?> 
                                value="<?php echo $val['Category']['id'] ?>"><?php echo $val['Category']['long_name'] ?> </option>

                            <?php } ?>
                    </select>


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


