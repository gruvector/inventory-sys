<table cellspacing='0' summary=''>
    <thead>
        <tr>

            <th class="sortup">
                Event
            </th>
            <th class="sortup">
                Name
            </th>
            <th  >
                Cost
            </th>
            <th  >
                Ticket Code
            </th>
            <th class='last alignRight'>

            </th>
        </tr>
    </thead>



    <tbody>
        <?php
        // print_r($tickettypes[0]['Event']);

        $row_color = 0;
        foreach ($tickettypes as $val) {
            ?>

            <tr id="<?php echo $val['TicketType']['id'] ?>" class='<?php echo ($row_color % 2 == 0) ? "even" : "odd"; ?>'>


                <td>
                    <?php echo $val['Event']['event_name']; ?>

                </td>
                <td>
                    <?php echo $val['TicketType']['type_name']; ?>

                </td>

                <td>
                    <?php echo doubleval($val['TicketType']['ticket_cost']); ?>
                </td>
                <td>
                    <?php
                    echo ($val['TicketType']['ticket_code']);
                    
                    ?>
                </td>



                <td>
                    <ul class='rowActions'>
                        <li>
                            <a href='#' class='inlineIcon preferences edit_tt'>Edit</a>
                        </li>
                        <li>
                            <a href='#' class='inlineIcon preferences iconDelete del_TicketType'></a>
                        </li> 

                    </ul>
                </td>
                <td></td> <td></td> <td></td>
            </tr>
            <?php
            $row_color++;
        }
        ?>

</table>

<div id="page_div">
    <?php
    echo $this->Paginator->first('< first ', array('class' => 'pglink'), null, array('class' => 'pglink'));
    echo $this->Paginator->prev('<< previous ', array('class' => 'pglink'), null, array('class' => 'pglink'));
    echo $this->Paginator->next('next >> ', array('class' => 'pglink'), null, array('class' => 'pglink'));
    echo $this->Paginator->last('last > ', array('class' => 'pglink'), null, array('class' => 'pglink'));
    ?>
</div>