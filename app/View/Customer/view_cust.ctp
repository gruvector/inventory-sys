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
                <a name="add_cust" id="add_cust" title="Add New Customer"  href="<?php echo $this->Html->url(array('controller' => 'Customer', 'action' => 'add_customer')); ?>" class='inlineIcon iconWebsiteAdd'>Add New Supplier</a>
            </li>
            <li>
                <input type="text" name="search_cust" id="search_cust" placeholder="Search By Email,Cell,Name"/>
            </li>
            <li>
                <input type="button" name="search_butt" id="search_butt" value="Search"/>
            </li>

        </ul>



        <div class='clear'></div>
        <div class='corner left'></div>
        <div class='corner right'></div>
    </div>


    <div name="table_info" id="table_info">

    </div>

    <input type="hidden" name="cust_list_url" id="cust_list_url" value="<?php echo $this->Html->url(array('controller' => 'Customer', 'action' => 'customer_list')); ?>" />
    <input type="hidden" name="cust_add_url" id="cust_add_url" value="<?php echo $this->Html->url(array('controller' => 'Customer', 'action' => 'add_customer')); ?>" />
    <input type="hidden" name="cust_del_url" id="cust_del_url" value="<?php echo $this->Html->url(array('controller' => 'Customer', 'action' => 'del_customer')); ?>" />

</div>

<?php echo $this->Html->script('view_cust.js'); ?>


