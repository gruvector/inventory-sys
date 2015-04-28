<thead>
    <tr>

        <th >
            Name
        </th>
        <th >
            Location
        </th>
        <th >
            Start Time
        </th>
        <th  >
            End Time
        </th>
        <th> Total  Number </th>

        <th > Number Redeemed </th>
        <th  >
            Number Verified
        </th>

    </tr>
</thead>



<tbody>
    <?php
    $row_color = 0;
    foreach ($sales as $val) {
        ?>

        <tr id="<?php echo $val['Ticket']['ticket_event_id'] ?>" class='<?php echo ($row_color % 2 == 0) ? "even" : "odd"; ?>'>
            <td >
                <?php echo $evdata[$val['Ticket']['ticket_event_id']]['event_name'] ?>
            </td>
            <td>
                <?php echo $evdata[$val['Ticket']['ticket_event_id']]['event_location'] ?>

            </td>
            <td>
                <?php echo $evdata[$val['Ticket']['ticket_event_id']]['event_start'] ?>

            </td>

            <td>
                <?php echo $evdata[$val['Ticket']['ticket_event_id']]['event_end'] ?>

            </td>

            <td>
                <?php echo $val[0]['ticketcount']; ?>
            </td>
            <td>
                <?php echo $val[0]['ticket_redeem']; ?>

            </td>
            <td>
                <?php echo $val[0]['ticket_verified']; ?>
            </td>
         <!--   <td>      
                <?php echo $val[0]['ticket_unverified']; ?>

            </td>
          -->
        </tr>
        <?php
        $row_color++;
    }
    ?>



</tbody>




