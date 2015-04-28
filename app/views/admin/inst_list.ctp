<table cellspacing='0' summary=''>
    <thead>
        <tr>

            <th class="sortup">
                Short  Name
            </th>
            <th class="sortup">
                Long  Name
            </th>
            <th class="sortup">
                Email
            </th>
            <th  >
                Phone
            </th>
            <th  >
                Fax
            </th>
            <th> City</th>
            <th> Status</th>


            <th > </th>
            <th  >

            </th>
            <th class='last alignRight'>

            </th>
        </tr>
    </thead>



    <tbody>
        <?php
        $row_color = 0;
        foreach ($insts as $val) {
            ?>

            <tr 
                id="<?php echo $val['Institution']['id'] ?>" 
                class='<?php echo ($row_color % 2 == 0) ? "even" : "odd"; ?>'>


                <td>
                    <?php echo $val['Institution']['inst_short_name']; ?>

                </td>
                <td>
                    <?php echo $val['Institution']['inst_short_name']; ?>

                </td>
                <td>
                    <?php echo $val['Institution']['email']; ?>

                </td>

                <td>
                    <?php echo $val['Institution']['phone']; ?>
                </td>
                <td>
                    <?php
                    echo $val['Institution']['fax'];
                    ?>
                </td>

                <td>

                    <?php echo $val['Institution']['city']; ?>

                </td>

                <td>

                    <?php echo ($val['Institution']['inst_lock'] == "1") ? "Active" : "Locked"; ?>

                </td>

                <td>
                    <ul class='rowActions'>
                        <li>
                            <a href='#' class='inlineIcon preferences edit_inst'>Edit</a>
                        </li>
                        <li>
                            <?php if ($val['Institution']['inst_lock'] == "0") { ?>

                                <a href='#' class='inlineIcon preferences iconopen unlock'>UnLock</a>
                            <?php } else if ($val['Institution']['inst_lock'] == "1") { ?>
                                <a href='#' class='inlineIcon preferences iconlock lock'>Lock</a>

                            <?php } ?>                        </li> 

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