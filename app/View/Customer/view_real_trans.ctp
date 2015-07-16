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
#pay_info table{
width:100%;
margin:10px;
border-spacing: 10px;
border-collapse: separate;
}
</style>


<div class='tableWrapper'>
    <div class='tableHeader'>
        <ul class='tableActions'>

            <li class='inactive activeIfSelected'>

            <li>
            <select name="search_trans_type" id="search_trans_type">
        <option value="">Select Tran Type</option>
        <option value="add_sales">Sales</option>
        <option value="add_inv">Invoice</option>
        <option value="add_recv">Receivables</option>
        <option value="add_revr">Reversals</option>
            <select>
            </li>
             <li>
                <input type="text" style="width: 105px;" maxlength="5" name="search_trans_date" id="search_trans_date" placeholder="Search By Date"/>
            </li>
             <li>
                <input class="ca" type="number" min="0" step="1"  style="width: 90px;" maxlength="5" name="search_trans_quant" id="search_trans_quant" placeholder="<=Quantity"/>
            </li>
            <li>
                <input class="ca" type="number" min="0" step="0.001" style="width: 105px;" maxlength="5" name="search_trans_amount" id="search_trans_amount" placeholder="<=Amount"/>
            </li>
            <li>
                <input class="ca" type="number" min="1"  style="width: 105px;" maxlength="5" name="search_sale_number" id="search_sale_number" placeholder="Sale #"/>
            </li>
  <li>
                <input class="ca" type="text" style="width: 105px;" maxlength="10" name="search_trans_user" id="search_trans_user" placeholder="Search By User"/>
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


 <div name="pay_info" id="pay_info">
                    <table width="100%" cellspacing="2" style summary="">

                        <thead>
                        <tr>
    <th class=""></th>
    <th class=""></th>
    <th class="title_action"></th>
    <th class=""></th>
    <th class=""></th>
    <th class=""></th>
    <th class=""></th>
    <th class=""></th>
                        </tr></thead>
                        <tbody>
<tr class="total_rtotal_tr">
<td></td>
<td></td>
<td style="font-weight: bold;">Total Transaction Amount</td>
<td class="rtotal_sale"></td>
<td ></td>
<td></td>
<td></td>
<td class="rtotal_transaction"></td>
</tr>
<tr class="total_rtotal_tr">
<td></td>
<td></td>
<td style="font-weight: bold;">Total Amount Paid(Total Amount Paid+Current Trans)</td>
<td class="rtotal_sale"></td>
<td ></td>
<td></td>
<td></td>
<td class="total_amount_paid"></td>
</tr>
<tr class="rtotal_amt_tr">
<td></td>
<td></td>
<td style="font-weight: bold;">Amount(Current Trans.)</td>
<td><input type="number" step="0.00001" min="0" class="amount_paid_in" value="0"></td>
<td class="amount_paid"></td>
<td>Amount Due </td>
<td></td>
<td class="amount_due_for_sale"></td>
</tr>
</tbody>
            </table>
    </div>

    <input type="hidden" name="transaction_real_list_url" id="transaction_real_list_url" value="<?php echo $this->Html->url(array('controller' => 'Customer', 'action' => 'real_transaction_history')); ?>" />
    <input type="hidden" name="transaction_sub_list_url" id="transaction_sub_list_url" value="<?php echo $this->Html->url(array('controller' => 'Customer', 'action' => 'get_sales_info_list')); ?>" />
    <input type="hidden" name="transaction_print_list_url" id="transaction_print_list_url" value="<?php echo $this->Html->url(array('controller' => 'Customer', 'action' => 'get_print_info_list')); ?>" />
    <input type="hidden" name="transaction_rec_url" id="transaction_rec_url" value="<?php echo $this->Html->url(array('controller' => 'Customer', 'action' => 'save_receipt')); ?>" />

</div>

<?php echo $this->Html->script('view_real_trans.js'); ?>

