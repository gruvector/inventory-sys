
<div class='tableWrapper'>
    <div class='tableHeader'>
        <ul class='tableActions'>

            <li class='inactive activeIfSelected'>

            <li>
                <input type="text" class="ca" style="width: 200px;" maxlength="25" name="search_trans" id="search_trans" placeholder="Search By Product"/>
            </li>

             <li>
            <select name="search_trans_second" id="search_trans_second">
        <option value="">Select Tran Type</option>
        <option value="add_sales">Sales</option>
        <option value="add_inv">Invoice</option>
        <option value="add_recv">Receivables</option>
        <option value="add_revr">Reversals</option>
            <select>
            </li>
             <li>
                <input type="text" class="ca" style="width: 200px;" maxlength="25" name="search_trans_third" id="search_trans_third" placeholder="Search By Date"/>
            </li>
            <li>
                <input type="text" class="ca" style="width: 100px;" maxlength="25" name="search_trans_fourth" id="search_trans_fourth" placeholder="Search By Name"/>
                        <li>
                            <input type="button" name="search_butt" id="search_butt" value="Search"/>
                        </li>            
</li>
            </li>
        </ul>



        <div class='clear'></div>
        <div class='corner left'></div>
        <div class='corner right'></div>
    </div>


    <div name="table_info" id="table_info">

    </div>

    <input type="hidden" name="transaction_list_url" id="transaction_list_url" value="<?php echo $this->Html->url(array('controller' => 'Customer', 'action' => 'transaction_history')); ?>" />

</div>

<?php echo $this->Html->script('view_trans.js'); ?>

