<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */
?>
<!--
<style>
    div.tableWrapper li {
        width: 150px !important;
    }   
</style>
-->
<form name="add_stock_form" id="add_stock_form" class="cmxform">
    <div class='tableWrapper'>
        <div class='tableHeader' style="border: 0px !important;">

            <ul class='tableActions'>
                <li>
                    <label>  Name  </label> 
                </li>
                <li>
                    <label><?php echo $product['Product']['product_name']; ?></label>
                </li>
            </ul>
            <ul class='tableActions'>
                <li>
                    <label>  Current Stock  </label> 
                </li>
                <li>
                    <label><?php echo $product['Product']['stock_available']; ?></label>
                </li>
            </ul>
            <ul class='tableActions'>
                <li>
                    <label> Number Per Crate </label> 
                </li>
                <li>
                    <label><?php echo $product['Product']['quantity_crate']; ?></label>
                </li>
            </ul>
            <ul class='tableActions'>
                <li>
                    <label>  Crates Available  </label> 
                </li>
                <li>
                    <label>
                        <?php echo ($product['Product']['stock_available'] == 0) ? 0 : floor($product['Product']['stock_available'] / $product['Product']['quantity_crate']); ?>

                    </label>
                </li>
            </ul>
            <ul class='tableActions'>
                <li>
                    <label>  Remainder  </label> 
                </li>
                <li>
                    <label>
                        <?php echo $product['Product']['stock_available'] % $product['Product']['quantity_crate']; ?>
                    </label>
                </li>
            </ul>
            <input type="hidden" required name="data[ProductTransaction][product_id]" id="data[ProductTransaction][product_id]"  value="<?php echo $product['Product']['id']; ?>" />      
            <input type="hidden"  required name="data[Product][id]" id="data[Product][id]" value="<?php echo $product['Product']['id']; ?>"  />      

            <ul class='tableActions'>
                <li>
                    <label>  Transaction  Type </label> 
                </li>
                <li>

                    <select required class='ttype' name="data[ProductTransaction][transaction_type]" id="data[ProductTransaction][transaction_type]" >
                        <option value=''> Please Choose Transaction </option>
                        <option value='sale'> Sale</option>
                        <option value='restock'> Restock</option>
                        <option value ='removal'> Broken/Lost/Stolen</option>

                    </select>


                </li>
            </ul>

            <ul class='tableActions'>
                <li>
                    <label>  Quantity  </label> 
                </li>
                <li>
                    <input type="hidden"   class="ostock" value="<?php echo $product['Product']['stock_available']; ?>"/>
                    <input type="hidden"   required name="data[Product][selling_price]" id="data[Product][selling_price]" value="<?php echo $product['Product']['selling_price']; ?>"  />      

                    <input type="text"  style="width:170px" class='astock' required name="data[ProductTransaction][quantity]" id="data[ProductTransaction][quantity]"  />      
                </li>
            </ul>
            <ul class='tableActions'>
                <li>
                    <label style="color: red">  New Stock  </label> 
                </li>
                <li>
                    <input type="text"  readonly style="width:170px" class='nstock' required name="data[Product][stock_available]" id="data[Product][stock_available]"  />      
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


