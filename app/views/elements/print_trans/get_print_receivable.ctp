<div id="invoice"> 
    <div id="invoice-header"> <img alt="Mainlogo_large" class="logo screen" src="../img/core/sbman-letterhead.png" /> 
        <!-- hCard microformat --> 
        <div class="vcard" id="company-address"> 
            <div class="fn org"><strong><?php echo $rsite_info['site_name']; ?></strong></div> 
            <div class="adr"> 
                <div class="street-address"><br/> 
                    <?php echo $rsite_info['address']; ?>
                    <br />
                </div>
                <!--street-address-->
                <div class = "locality"><?php echo $rsite_info['city'];
                    ?></div> 
                <div id="company-postcode"><span class="region">Region</span> <span class="postal-code">00233</span></div> 
            </div> 
            <!-- adr --> 
            <div class="email">Email: <?php echo $rsite_info['email']; ?></div> 
            <div id="sales-tax-reg-number">Phone: <?php echo $rsite_info['phone']; ?></div> 
        </div> 
        <!-- company-address vcard --> 
    </div> 
    <!-- #invoice-header --> 
    <div id="invoice-info"> 
        <h2>Receivable# <strong><?php echo strtoupper(htmlspecialchars($data['Sale']['id'])); ?></strong></h2> 
        <h3><?php echo date('D, d M Y H:i:s', strtotime($data['Sale']['transaction_timestamp'])); ?></h3> 
       <!-- <p id="payment-terms">Payment Terms: 30 days--></p> 
        <p id="payment-due"><!--Payment due by 21 March 2008</p>--> 
        <p id="payment-total">&#8373;<?php echo htmlspecialchars($data['Sale']['total_transaction']); ?></p>
    </div> 
    <!-- #invoice-info --> 
    <div class="vcard" id="client-details"> 
        <div class="fn">John Doe</div> 
        <div class="org">Client Company</div> 
        <div class="adr"> 
            <div class="street-address"> Client Street Address<br/> 
                Street Address 2<br /> 
                Street Address 3<br /> 
            </div> 
            <!-- street-address --> 
            <div class="locality">LOCALITY</div> 
            <div id="client-postcode"><span class="region">Region</span> <span class="postal-code">MV2 8SX</span></div> 
            <div id="your-tax-number">SALES TAX: 193528491</div>
        </div> 
        <!-- adr --> 
    </div> 
    <!-- #client-details vcard --> 
    <table id="invoice-amount"> 
        <thead> 
            <tr id="header_row"> 
                <th class="quantity_th">Quantity</th> 
                <th class="left details_th">Details</th> 
                <th class="unitprice_th">Unit Price </th> 
                <th class="salestax_th"></th> 
                <th class="subtotal_th">Subtotal </th> 
            </tr> 
        </thead> 
        <tfoot>
            <!--
            <tr id="discount_tr"> 
                <td colspan="2">&nbsp;</td> 
                <td colspan="2" class="item_r">10% Discount</td> 
                <td class="item_r">&#163;250.00</td> 
            </tr> 
            -->
            <tr id="total_tr"> 
                <td colspan="2">&nbsp;</td> 
                <td colspan="2" class="total" id="total_currency"><span class="currency"> </span> Total</td> 
                <td class="total">&#8373;<?php echo htmlspecialchars($data['Sale']['total_transaction']); ?></td> 
            </tr> 
        </tfoot> 
        <tbody> 
            <?php 
                 $i=0;
            foreach ($data['ProductTransaction'] as $val) {         
                ?>
                <tr class='<?php echo ($i % 2 == 0) ? "item" : "item odd"; ?>'>
                    <td class="item_l"><?php echo htmlspecialchars($val['quantity']); ?></td> 
                    <td class="item_l"><?php echo htmlspecialchars($val['Product']['product_name']); ?> </td> 
                    <td class="item_r"><?php echo htmlspecialchars($val['price']); ?></td> 
                    <td class="item_r"></td> 
                    <td class="item_r"><?php echo htmlspecialchars($val['price'] * $val['quantity']); ?></td> 
                </tr> 
            <?php
            $i++;
            
            } ?>

        </tbody> 
    </table> 
    <!-- invoice-amount -->
    <div id="invoice-other"> 
        <h2></h2> 
        <div id="company-reg-number"><strong>Company Registration Number:</strong>1212121</div>  
       <div id="contract-number"><strong>Contract/PO:</strong> PO 87227643</div>
    </div> 
  
  <div id="payment-details">
        <h2>Payment Details</h2> 
         <div id="payment-reference"><strong>Payment Reference:</strong>
        <?php  $receipt_id = isset($rec_id) ? $data['Receipt'][0]['id'] : "";
                    echo htmlspecialchars("RC# ".$receipt_id);
        ?>
                    </div>
      <!--
        <div id="bank_name">Bank Name</div> 
        <div id="sort-code"><strong>Bank/Sort Code:</strong> 32-75-97</div> 
        <div id="account-number"><strong>Account Number:</strong> 28270761</div> 
        <div id="iban"><strong>IBAN:</strong> 973547</div> 
        <div id="bic"><strong>BIC:</strong> 220197</div> 
    --> 
    </div> 
    <div id="comments">  <!-- comments Payment should be made by bank transfer or cheque made payable to John Smith.--></div> 
  
</div> 
