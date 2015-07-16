<div id="invoice"> 
    <div id="invoice-header"><!-- <img alt="Mainlogo_large" class="logo screen" src="../img/core/sbman-letterhead.png" /> -->
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
        <p id="payment-due">Attendant: <?php echo $data['User']['fname']." ".$data['User']['lname']; ?></p>
        <p id="payment-total">&#8373;<?php echo htmlspecialchars($data['Sale']['total_transaction']); ?></p>
    </div> 
    <!-- #invoice-info --> 
    <div class="vcard" id="client-details"> 
        <div class="fn"></div> 
        <div class="org"></div> 
        <div class="adr"> 
            <div class="street-address"><br/> 
                <br /> 
               <br /> 
            </div> 
            <!-- street-address --> 
            <div class="locality"></div> 
            <div id="client-postcode"><span class="region"></span> <span class="postal-code"></span></div> 
            <div id="your-tax-number"></div>
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
      <tr id="discount_tr"> 
                <td colspan="2">&nbsp;</td> 
                <td colspan="2" class="total" id="total_currency"><span class="currency"> </span>Quantity</td> 
                <td class="total"><?php echo htmlspecialchars($data['Sale']['total_items']); ?></td> 
            </tr> 
            <tr id="total_tr"> 
                <td colspan="2">&nbsp;</td> 
                <td colspan="2" class="total" id="total_currency"><span class="currency"> </span>Total</td> 
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
   
  

    <div id="comments">  <!-- comments Payment should be made by bank transfer or cheque made payable to John Smith.--></div> 
  
</div> 
