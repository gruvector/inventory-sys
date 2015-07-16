

<table cellspacing='0' summary=''>
    <thead>
        <tr>

            <th class="sortup">
                Receipt Type(#)
            </th>
            <th class="sortup">
                Date
            </th>
            <th class="sortup">
                Amount Paid
            </th>
            <th class="sortup">
                User
            </th>
            <th ></th>   <th ></th>
        </tr>
    </thead>



    <tbody>
        <?php
        $row_color = 0;
        $total_quantity = 0;
        $total_amount = 0;
        foreach ($transactions as $val) {

            // $total_quantity = $total_quantity + $val['Receipt']['total_items'];
            $total_amount = $total_amount + $val['Receipt']['amount_paid']
            ?>

            <tr id="<?php echo $val['Sale']['id'] ?>" class='<?php echo ($row_color % 2 == 0) ? "even" : "odd"; ?>'
                data-receipt="<?php echo $val['Receipt']['id']; ?>">

                <td>
                    <?php
                    if ($val['Receipt']['paid_status'] == "part_pay") {
                        echo "Part Payment";
                    } else if ($val['Receipt']['paid_status'] == "refund") {
                        echo "Refund";
                    } else if ($val['Receipt']['paid_status'] == "full_pay") {
                        echo "Full Payment";
                    } else if ($val['Receipt']['paid_status'] == "pending") {
                        echo "Pending";
                    } else if ($val['Receipt']['paid_status'] == "excess") {
                        echo "Excess";
                    } else {
                        echo "Other";
                    }
                  
                    echo "(#".$val['Receipt']['id'].")";
  ?>
                </td>
                <td>
    <?php echo date('D, d M Y H:i:s', strtotime($val['Receipt']['transaction_timestamp'])); ?>

                </td>
                <td style="font-weight: bolder">
    <?php echo $val['Receipt']['amount_paid']; ?>
                </td>
                <td>
    <?php
    echo $val['User']['fname'] . " ";
    $val['User']['lname'];
    ?>

                </td>
                <td>

                    <a href='#' class='inlineIcon preferences iconActivate get_details_trans'>View Details</a>

                </td>
                <td></td>
            </tr>
    <?php
    $row_color++;
}
?>
<!--style="background-color: yellow;color: blue;font-size:5em!important;" >-->
        <tr class ="ui-widget-header" >
            <td>TOTAL</td> <td></td> <td><?php echo $total_amount; ?></td>
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
