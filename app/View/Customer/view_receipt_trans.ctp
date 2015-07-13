<style>
    .tableWrapper{
        width:100% !important;
    }
    .tableHeader{
        margin-bottom:10px !important;
    }

    #summary_info{
        float:right;
        width:49% !important;
    }

    #table_info{
        float:left;
        width:49% !important;
    }
    .sep{
        margin-top:5px !important;
    }

    #summary_info table{

    }
    .mbold{
        font-weight: bold;
    }
</style>


<div class='tableWrapper'>
    <div class='tableHeader'>
        <ul class='tableActions'>



            <li>
                <select name="search_rec_type" id="search_rec_type">
                    <option value="">Select Receipt  Type</option>
                    <option value="part_pay">Part Payment</option>
                    <option value="full_pay">Full Payment</option>
                    <option value="refund">Refund</option>
                    <option value="pending">Pending</option>
                    <option value="excess">Excess</option>
                    <option value="other">Other</option>

                    <select>
                        </li>
                        <li>
                            <input type="text" style="width: 105px;" maxlength="5" name="search_trans_date" id="search_trans_date" placeholder="Search By Date"/>
                        </li>
                        <li>
                            <input type="number" class="ca" min="1" style="width: 105px;" maxlength="5" name="search_rec_ref" id="search_rec_ref" placeholder="Receipt #"/>
                        </li>  
                        <li>
                            <input type="number" class="ca" min="1" style="width: 105px;" maxlength="5" name="search_sale_ref" id="search_sale_ref" placeholder="Sale #"/>

                        </li>   
                        <li>
                            <input class="ca" type="number" min="0" step="0.001" style="width: 105px;" maxlength="5" name="search_trans_amount" id="search_trans_amount" placeholder="<=Amount Paid"/>
                        </li>
                        <li>
                            <input type="text" class="ca" style="width: 105px;" maxlength="10" name="search_trans_user" id="search_trans_user" placeholder="Search By User"/>
                        </li>
                        <li>
                            <input type="button" name="search_butt" id="search_butt" value="Search"/>
                        </li>
                        </li>
                        </ul>
                        <ul></ul>


                        <div class='clear'></div>
                        <div class='corner left'></div>
                        <div class='corner right'></div>
                        </div>


                        <div name="table_info" id="table_info">

                        </div>
                        <div name="summary_info" id="summary_info">

                        </div>

                        <input type="hidden" name="transaction_real_list_url" id="transaction_real_list_url" value="<?php echo $this->Html->url(array('controller' => 'Customer', 'action' => 'receipt_history')); ?>" />
                        <input type="hidden" name="transaction_sub_list_url" id="transaction_sub_list_url" value="<?php echo $this->Html->url(array('controller' => 'Customer', 'action' => 'get_sales_info_list')); ?>" />
                        <input type="hidden" name="transaction_print_list_url" id="transaction_print_list_url" value="<?php echo $this->Html->url(array('controller' => 'Customer', 'action' => 'get_print_info_list')); ?>" />
                        <input type="hidden" name="transaction_print_node_url" id="transaction_print_node_url" value="<?php echo $this->Html->url(array('controller' => 'Customer', 'action' => 'get_receipt_print_json')); ?>" />

                        </div>

                        <?php 
                                echo $this->Html->script('view_receipt_trans.js');
 ?>

