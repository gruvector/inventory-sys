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

//print_r($vat);
?>

<style>
    <!--
    #search_item,#reverse_reason {
        border: 1px solid #bfbfbf;
        border-radius: 2px;
        box-sizing: border-box;
        color: #444;
        font: inherit;
        margin: 0;
        min-height: 2em;
        padding: 3px;
        padding-bottom: 4px;
        margin-left: 20px;
        width: 350px;
        font-size: 2em;
        font-family: sans-serif;
        height: 40px;
    }-->
    .ul_chz{
        text-align:center;
        margin-left: 120px !important;
        margin-bottom: 5px !important ;
    }
    .chzn-container{
        340px !important;
    }
</style>

<form name="add_sales_form" id="add_sales_form" class="cmxform" action="<?php echo $this->Html->url(array('controller' => 'Customer', 'action' => 'add_sales')); ?>">
    <input type ='hidden'  id="vat_deduction" name="vat_deduction"
           data-sname="<?php echo $vat['Taxe']['vat_short_name']; ?>" 
           data-tvalue="<?php echo $vat['Taxe']['vat_value']; ?>" 

           />
    <div class='tableWrapper' style="width: 100% !important;">
        <div class='tableHeader' style="border: 0px !important;">


            <ul class="tableActions ul_chz">
                <li>

                    <select placeholder="Please Select An Item" name="search_item" id="search_item" data-placeholder="Search  Item/s ..." style="display:none;" class="chosen-select"  tabindex="-1"> 
                        <option></option> 
                        <?php foreach ($products as $cat_prod) { ?>
                            <option
                                data-stock="<?php echo $cat_prod['Product']['stock_available']; ?>"
                                data-unit_price="<?php echo $cat_prod['Product']['selling_price']; ?>"
                                data-name="<?php echo $cat_prod['Product']['product_name']; ?>"
                                value="<?php echo $cat_prod['Product']['id']; ?>"><?php echo $cat_prod['Product']['product_name'] . " (" . $cat_prod['Product']['stock_available'] . ")"; ?></option>
                            <?php } ?>
                    </select>


                </li>
            </ul>

            <ul class='tableActions'>

            </ul>

            <ul class="tableActions ul_chz sp_ul">
                <li >
                    <select placeholder="Please Select Supplier" id="supplier" name="supplier" data-placeholder="Please Select Supplier ..." style="display:none;" class="chosen-select"  tabindex="-1">         
                        <option></option>  
                        <option value="0">Other</option>
                        <?php foreach ($suppliers as $val) { ?>
                            <option value="<?php echo $val['Supplier']['id']; ?>"><?php echo $val['Supplier']['fname'] . " (" . $val['Category']['long_name'] . ")"; ?></option>
                        <?php } ?>
                    </select>
                </li>

            </ul>


            <ul class="tableActions ul_chz rs_ul">
                <li>
                    <select placeholder="Please Select Reason" id="reverse_reason" name="reverse_reason" data-placeholder="Please Select Reason ..." style="display:none;" class="chosen-select"  tabindex="-1">         
                        <option></option>  
                        <option value="">Other</option>                   
                        <?php foreach ($reverse as $key => $val) { ?>
                            <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                        <?php } ?>
                    </select>
                </li>

            </ul>


            <ul class='tableActions' style="width: 100%;">


                <div name="sales_info" id="sales_info" style="width: 100%;">
                    <table cellspacing="0" summary="">

                        <thead>
                        <th class="sortup">
                            Item
                        </th>
                        <th class="sortup">
                            Current Stock
                        </th>
                        <th >
                            Unit/Price
                        </th>
                        <th >
                            Quantity 
                        <th >Cost </th>
                        <th >New Stock </th>

                        <th ></th>
                        <th class="sortup"></th>
                        </thead>
                        <tbody>                 
                        </tbody>
                    </table>
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


