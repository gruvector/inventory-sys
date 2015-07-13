

<table cellspacing='0' summary=''>
    <thead>
        <tr>

            <th class="sortup">
                Product
            </th>
            <th class="sortup">
                Quantity
            </th>
            <th class="sortup">
                Unit/Price
            </th>
            <th class="sortup">
                Value
            </th>
            <th class="sortup">
                Type
            </th>
            <th> Date/Time </th>

            <th >User</th>

            <th class='last alignRight'>

            </th>
            <th></th><th></th><th></th><th></th>

        </tr>
    </thead>



    <tbody>
        <?php
        //print_r($transactions[0]);
        $row_color = 0;
        $total_quantity = 0;
        $total_cost = 0;
        foreach ($transactions as $val) {
            $quantity = $val['ProductTransaction']['quantity'];
            $total_quantity = $total_quantity + $val['ProductTransaction']['quantity'];
            $total_cost = $total_cost + ($val['ProductTransaction']['price'] * $val['ProductTransaction']['quantity']);


            ?>

            <tr id="<?php echo $val['ProductTransaction']['id'] ?>" class='<?php echo ($row_color % 2 == 0) ? "even" : "odd"; ?>'>


                <td>
                    <?php echo $val['Product']['product_name']; ?>

                </td>
                <td>
                    <?php echo $val['ProductTransaction']['quantity']; ?>

                </td>
                <td>
                    <?php echo $val['ProductTransaction']['price'];?>

                </td>
                <td style="font-weight: bolder">
   <?php echo $val['ProductTransaction']['price'] * $val['ProductTransaction']['quantity'];
///(($val['ProductTransaction']['transaction_type'] == 'sale') ? 1: -1); 
?>
          
                </td>
                <td>
                <?php 

  if($val['ProductTransaction']['transaction_type']=="add_sales"){
echo "Sale"; 
}
 else if($val['ProductTransaction']['transaction_type']=="add_inv"){
echo "Invoice"; 
}
 else if($val['ProductTransaction']['transaction_type']=="add_recv"){
echo "Receivable"; 
}
 else if($val['ProductTransaction']['transaction_type']=="add_revr"){
echo "Reversal"; 
}
?>
                </td>
                <td>
                    <?php echo date('D, d M Y H:i:s', strtotime($val['ProductTransaction']['transaction_timestamp'])); ?>

                </td>

                <td>
                    <?php
                    echo $val['User']['fname'] . " ";
                    $val['User']['lname']
                    ?>
                </td>
                <td>
                    <ul class='rowActions'>


                    </ul>
                </td>
                <td></td> <td></td> <td></td> <td></td>
            </tr>
            <?php
            $row_color++;
        }
        ?>
        <tr class ="ui-widget-header" >
            <td>TOTAL</td> <td><?php echo $total_quantity; ?></td> <td></td>
            <td><?php echo $total_cost; ?></td> <td></td> <td></td>
            <td></td> <td></td> <td></td>
            <td></td> <td></td> <td></td>
        </tr>


        <?php /** if($row_color==0) { ?>
          <tr id="page_div" style="font-weight:bolder !important;"><td></td> <td></td> <td>No Data</td></tr>
          <?php } * */ ?>
    </tbody>
</table>

<div id="page_div">
    <?php
    echo $this->Paginator->first('< first ', array('class' => 'pglink'), null, array('class' => 'pglink'));
    echo $this->Paginator->prev('<< previous ', array('class' => 'pglink'), null, array('class' => 'pglink'));
    echo $this->Paginator->next('next >> ', array('class' => 'pglink'), null, array('class' => 'pglink'));
    echo $this->Paginator->last('last > ', array('class' => 'pglink'), null, array('class' => 'pglink'));
    ?>
</div>
