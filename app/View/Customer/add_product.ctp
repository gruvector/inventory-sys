<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 


  <style>
  div.tableWrapper li {
  width: 150px !important;
  }
  </style>
 */
?>

<?php //print_r($categories); ?>
<form name="add_product_form" id="add_product_form" class="cmxform" action="<?php echo $this->Html->url(array('controller' => 'Customer', 'action' => 'add_product')); ?>">
    <div class='tableWrapper'>
        <div class='tableHeader' style="border: 0px !important;">
            <ul class='tableActions'>
                <li>
                    <label>   Name </label>       
                </li> 
                <li>
                    <input type="hidden" required name="data[Product][id]" id="data[Product][id]"  value="<?php echo isset($product) ? $product['Product']['id'] : ""; ?>" />      

                    <input type="text" class="check" required name="data[Product][product_name]" id="data[Product][product_name]" value="<?php echo isset($product) ? $product['Product']['product_name'] : ""; ?>" />      
                </li>
            </ul>  
            <!--
            <ul class='tableActions'>
                <li>
                    <label> Stock Available  </label> 
                </li>
                <li>
                  <input type='text'  class="stock_available check" required name="data[Product][stock_available]" id="data[Product][stock_available]" value="<?php echo isset($product) ? $product['Product']['stock_available'] : "0"; ?>" />   
                </li>
            </ul>
            -->  
            <ul class='tableActions'>
                <li>
                    <label> Quantity/Batch </label> 
                </li>
                <li>
                    <input type='number' min="1" step="1" max="10000000" class="quantity_crate check" required name="data[Product][quantity_crate]" id="quantity_crate"  data-orig="1" value="<?php echo isset($product) ? $product['Product']['quantity_crate'] : 1; ?>" />      
                </li>
            </ul>
            <ul class='tableActions'>
                <li>
                    <label> Category </label> 
                </li>
                <li>
                    <select name="data[Product][category_product]" id="data[Product][category_product]">
                        <?php foreach ($categories as $key => $vals) { ?>
                            <option <?php if (isset($product) && $product['Product']['category_product'] == $key) { ?>selected <?php } ?> value="<?php echo $key ?>"><?php echo $vals; ?></option>   
                        <?php } ?>
                    </select>
                </li>
            </ul>
            <ul class='tableActions'>
                <li>
                    <label> Cost Price </label> 
                </li>
                <li>
                    <input type='number' min="0" step="0.00001" max="10000000" class="cost_price check" required name="data[Product][cost_price]" id="cost_price" data-orig="0.00" value="<?php echo isset($product) ? $product['Product']['cost_price'] : "0.00"; ?>" />      
                </li>
            </ul>



            <ul class='tableActions'>
                <li>
                    <label> Selling Price </label> 
                </li>
                <li>
                    <input  type='number' min="0" step="0.00001" max="10000000" class='selling_price check'  required name="data[Product][selling_price]" id="selling_price" data-orig="0.00" value="<?php echo isset($product) ? $product['Product']['selling_price'] : "0.00"; ?>" />      
                </li>
            </ul>


            <ul class='tableActions'>
                <li>
                    <label> Minimum Stock  </label> 
                </li>
                <li>
                    <input  type='number' min="1" step="1" max="10000000" class='min_stock_notif check'  required name="data[Product][min_stock_notif]" id="min_stock_notif" data-orig="0.00" value="<?php echo isset($product) ? $product['Product']['min_stock_notif'] : "1"; ?>" />      
                </li>
            </ul>

            <ul class='tableActions'>
                <li>
                    <label> Maximum Stock  </label> 
                </li>
                <li>
                    <input  type='number' min="1" step="1" max="10000000" class='max_stock_notif check'  required name="data[Product][max_stock_notif]" id="min_stock_notif" data-orig="0.00" value="<?php echo isset($product) ? $product['Product']['max_stock_notif'] : "10000"; ?>" />      
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


