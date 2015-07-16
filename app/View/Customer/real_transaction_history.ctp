

<table cellspacing='0' summary=''>
    <thead>
        <tr>

            <th class="sortup">
                Transaction Type
            </th>
            <th class="sortup">
                Date
            </th>
            <th class="sortup">
                Quantity
            </th>
            <th class="sortup">
                Amount
            </th>
            <th class="sortup">
                User
            </th>
            <th ></th>
        </tr>
    </thead>



    <tbody>
        <?php
        $row_color = 0;
        $total_quantity = 0;
        $total_amount=0;
        foreach ($transactions as $val) {

 $total_quantity=$total_quantity+$val['Sale']['total_items'];
 $total_amount=$total_amount+$val['Sale']['total_transaction']

            ?>

            <tr id="<?php echo $val['Sale']['id'] ?>" class='<?php echo ($row_color % 2 == 0) ? "even" : "odd"; ?>'>


                <td>
                    <?php 

  if($val['Sale']['transaction_type']=="add_sales"){
echo "Sale"; 
}
 else if($val['Sale']['transaction_type']=="add_inv"){
echo "Invoice"; 
}
 else if($val['Sale']['transaction_type']=="add_recv"){
echo "Receivable"; 
}
 else if($val['Sale']['transaction_type']=="add_revr"){
echo "Reversal"; 
}
                    echo "(#".$val['Sale']['id'].")";

?>

                </td>
                <td>
                    <?php echo date('D, d M Y H:i:s', strtotime($val['Sale']['transaction_timestamp'])); ?>

                </td>
                <td>
                    <?php echo $val['Sale']['total_items'];?>

                </td>
                <td style="font-weight: bolder">
  <?php echo $val['Sale']['total_transaction'];?>
                </td>
                <td>
                 <?php    echo $val['User']['fname'] . " ";$val['User']['lname'] ;?>

                </td>
                <td>
               
                            <a href='#' class='inlineIcon preferences iconActivate get_details_trans'>View Details</a>
                      
                </td>
            </tr>
            <?php
            $row_color++;
        }
        ?>
        <tr class ="ui-widget-header" >
            <td>TOTAL</td> <td></td> <td><?php echo $total_quantity; ?></td>
            <td><?php echo $total_amount; ?></td> <td></td> <td></td>
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
