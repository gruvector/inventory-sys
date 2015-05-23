<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//print_r($data['ProductTransaction']);
//exit();
?>

<table cellspacing="0" summary="">

    <thead>
        <tr>
            <th class="sortup">
                Item
            </th>
            <th> Quantity </th>
            <th> Price </th>
            <th>Cost </th>
        </tr></thead>
    <tbody>
        <?php foreach ($data['ProductTransaction'] as $val) { ?>
            <tr data-id="39">
                <td class="item_name"><?php echo htmlspecialchars($val['Product']['product_name']); ?></td>
                <td><?php echo htmlspecialchars($val['quantity']); ?></td>
                <td class="cost"><?php echo htmlspecialchars($val['price']); ?></td>
                <td class="cost"><?php echo htmlspecialchars($val['price'] * $val['quantity']); ?></td>
            <?php } ?>
        </tr>   
        <tr class="sep" >
            <td></td>  <td></td>  <td></td><td></td>
        </tr>
        <tr class="total_trans_tr">
            <td>SUB TOTAL</td>
            <td><?php echo htmlspecialchars($data['Sale']['total_items']); ?></td>
            <td ></td>
            <td class=" mbold total_trans_for_sale"><?php echo htmlspecialchars($data['Sale']['total_bvat']); ?></td>
            
        </tr>
        <tr class="total_vat_tr">
            <td>VAT 2.5 %</td>
            <td></td>
            <td ></td>
            <td class=" mbold vat_transaction"><?php echo htmlspecialchars($data['Sale']['vat_transaction']); ?></td>
        </tr>
        <tr class="total_rtotal_tr">
            <td>TOTAL</td>
            <td></td>
            <td ></td>
            <td  class="mbold rtotal_sale"><?php echo htmlspecialchars($data['Sale']['total_transaction']); ?></td>
        </tr>
        <tr class="rtotal_amt_tr">
            <td>TOTAL AMOUNT PAID</td>
            <td></td>
            <td ></td>
            <td class="mbold"><?php echo htmlspecialchars($data['Sale']['total_amount_paid']); ?></td>
        </tr>
        <tr>
            <td>TOTAL AMOUNT DUE</td>
            <td></td>
            <td></td>
            <td class=" mbold amount_due_for_sale"><?php echo htmlspecialchars($data['Sale']['total_balance_due']); ?></td>
        </tr>
    </tbody>
</table>