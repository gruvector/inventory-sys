<style>
.tableWrapper{
width:60% !important;}
</style>


<div class='tableWrapper'>
    <div class='tableHeader'>
        <ul class='tableActions'>

            <li class='inactive activeIfSelected'>

            <li>
            <select name="search_trans_type" id="search_trans_type">
        <option value=""></option>
        <option value="add_sales">Sales</option>
        <option value="add_inv">Invoice</option>
        <option value="add_recv">Receivables</option>
        <option value="add_revr">Reversals</option>
            <select>
            </li>
             <li>
                <input type="text" style="width: 100px;" maxlength="5" name="search_trans_date" id="search_trans_date" placeholder="Search By Date"/>
            </li>
             <li>
                <input class="ca" type="number" min="0" step="1"  style="width: 100px;" maxlength="5" name="search_trans_quant" id="search_trans_quant" placeholder="Search By <=Quantity"/>
            </li>
            <li>
                <input class="ca" type="number" min="0" step="0.001" style="width: 100px;" maxlength="5" name="search_trans_amount" id="search_trans_amount" placeholder="Search By <=Amount"/>
            </li>
  <li>
                <input type="text" style="width: 100px;" maxlength="10" name="search_trans_user" id="search_trans_user" placeholder="Search By User"/>
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

    <input type="hidden" name="transaction_real_list_url" id="transaction_real_list_url" value="<?php echo $html->url(array('controller' => 'Customer', 'action' => 'real_transaction_history')); ?>" />

</div>

<?php echo $html->script('view_real_trans.js'); ?>

