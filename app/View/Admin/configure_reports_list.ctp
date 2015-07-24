<?php //print_r($reports);print_r($categories);         ?>
<table cellspacing='0' summary=''>
    <thead>
        <tr>

            <th class="sortup">
                Report Name
            </th>
            <th class="sortup">
                Category
            </th>
            <th class="sortup" style="text-align:center;">
                Edit
            </th>
            <th style="text-align:center;">
                Roles
            </th>
           <!-- <th  >
                View Report
            </th>
            -->
            <th > </th>
            <th>

            </th>
            <th class='last alignRight'>
            </th>
            <th>

            </th>

        </tr>
    </thead>



    <tbody>
        <?php
        $row_color = 0;
        foreach ($reports as $val) {
            ?>

            <tr 
                id="<?php echo $val['Report']['id'] ?>" 
                class='<?php echo ($row_color % 2 == 0) ? "even" : "odd"; ?>'>


                <td>
                    <?php echo $val['Report']['title']; ?>

                </td>
                <td>
                    <?php echo $categories[$val['Report']['report_category_id']]; ?>

                </td>
                <td>
                    <ul class='rowActions'>  <li>
                            <a href='#' class='inlineIcon preferences edit_report'>Edit</a>
                        </li>
                    </ul>
                </td>

                <td>
                    <ul class='rowActions'>
                        <li>
                            <a href='#' class='inlineIcon preferences iconAdvertiser add_role'>Roles</a>
                        </li>
                    </ul>
                </td>
               <!--
                <td>
                    <a href="#" class="view_reports">View Report</a>
                </td>
               -->
                <td>


                </td>

                <td>

                    <?php //echo ($val['Institution']['inst_lock'] == "1") ? "Active" : "Locked"; ?>

                </td>

                <td>

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