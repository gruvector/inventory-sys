<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.



 */
?>


<div class='tableWrapper'>
    <div class='tableHeader'>
        <ul class='tableActions'>
            <li>
                <a name="add_prod" type="prod" id="add_prod" title="Add New Product"  href="<?php echo $html->url(array('controller' => 'Customer', 'action' => 'add_product')); ?>" class='inlineIcon iconWebsiteAdd'>New Product</a>
            </li>

            <li>
                <a name="add_sales" type="add_sales" id="add_sales" title="New Sales"  href="<?php echo $html->url(array('controller' => 'Customer', 'action' => 'add_sales')); ?>" class='inlineIcon iconWebsiteAdd tran_type'>New Sales</a>
            </li>
            <!--
            <li>
                <a name="add_order" type="order" id="add_order" title="New Order"  href="<?php echo $html->url(array('controller' => 'Customer', 'action' => 'add_sales')); ?>" class='inlineIcon iconWebsiteAdd tran_type'>New Order</a>
            </li>
            -->
            <li>
                <a name="add_recv" type="add_recv"  id="add_recv" title="New Receivables"  href="<?php echo $html->url(array('controller' => 'Customer', 'action' => 'add_sales')); ?>" class='inlineIcon iconWebsiteAdd tran_type'>New Receivables</a>
            </li>

            <li>
                <a name="add_inv" type="add_inv" id="add_inv" title="New Invoice"  href="<?php echo $html->url(array('controller' => 'Customer', 'action' => 'add_sales')); ?>" class='inlineIcon iconWebsiteAdd tran_type'>New Invoices</a>
            </li>	
            <li>
                <a name="add_recpt" type="add_recpt"  id="add_recpt" title="Receipt Management"  href="<?php echo $html->url(array('controller' => 'Customer', 'action' => 'add_recpt')); ?>" class='inlineIcon iconWebsiteAdd'>Receipts</a>
            </li>
            <!--
            <li>
                <a name="add_revr" type="add_revr" id="add_sales" title="Reversal"  href="<?php // echo $html->url(array('controller' => 'Customer', 'action' => 'add_revr')); ?>" class='inlineIcon iconWebsiteAdd'>Reversal</a>
            </li>
            -->
            <li>
                <input type="text" name="search_prod" id="search_prod" placeholder="Search By Name"/>
            </li>
        </ul>



        <div class='clear'></div>
        <div class='corner left'></div>
        <div class='corner right'></div>
    </div>


    <div name="table_info" id="table_info">

    </div>

    <div name="dialog-message" id="dialog-message" title="Message">
        <p class="messsage">
        </p>
    </div>
    <div name="dialog-confirm" id="dialog-confirm" title="Confirmation">
        <p class="messsage">
        </p>
    </div>
    <input type="hidden" name="product_list_url" id="product_list_url" value="<?php echo $html->url(array('controller' => 'Customer', 'action' => 'product_list')); ?>" />
    <input type="hidden" name="product_add_url" id="product_add_url" value="<?php echo $html->url(array('controller' => 'Customer', 'action' => 'add_product')); ?>" />
    <input type="hidden" name="product_del_url" id="product_del_url" value="<?php echo $html->url(array('controller' => 'Customer', 'action' => 'del_product')); ?>" />
    <input type="hidden" name="stock_edit_url" id="stock_edit_url" value="<?php echo $html->url(array('controller' => 'Customer', 'action' => 'edit_stock')); ?>" />
    <input type="hidden" name="stock_edit_url" id="stock_edit_url" value="<?php echo $html->url(array('controller' => 'Customer', 'action' => 'edit_stock')); ?>" />
    <input type="hidden" name="product_batch_add_url" id="product_batch_add_url" value="<?php echo $html->url(array('controller' => 'Customer', 'action' => 'batch_transaction')); ?>" />

</div>

<?php echo $html->script('view_product.js'); ?>


