<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<table cellspacing='0' summary=''>

    <thead>
        <tr>

            <th class="sortup">
                Name
            </th>
            <th class="sortup">
                Email
            </th>
            <th  >
                Site
            </th>
            <th>  </th>
            <th> Status </th>
            <!--<th>  </th>-->

            <th>  </th>
            <th>  </th>



            <th class='last alignRight'>

            </th>
            <th>  </th>
            <th>  </th>
            <th>  </th>

        </tr>
    </thead>



    <tbody>
        <?php
        $row_color = 0;
        foreach ($users as $val) {
            ?>

            <tr id="<?php echo $val['User']['id'] ?>"
                name="<?php echo $val['User']['fname'] . " " . $val['User']['lname']; ?>"
                class='<?php echo ($row_color % 2 == 0) ? "even" : "odd"; ?>'>

                <td class="name_info">
                    <?php echo $val['User']['fname'] . " " . $val['User']['lname']; ?>

                </td>
                <td>
                    <?php echo $val['User']['user_email']; ?>

                </td>

                <td>
                    <?php echo $val['Site']['site_name']; ?>
                </td>
                <td>

                </td>
                <td>
                    <?php echo ($val['User']['lock_status'] <= 3) ? "Active" : "Locked"; ?>
                </td>
                <td></td  > <td></td  > <td></td  >



                <td>
                    <ul class='rowActions'>
                        <li>
                            <a href='#' class='inlineIcon preferences edit_user'>Edit</a>
                        </li>
                        <li>
                            <a href='#' class='inlineIcon preferences iconAdvertiser add_role'>Roles</a>
                        </li> 
                        <!--
                          <li>
                              <a href='#' class='inlineIcon preferences icon-logs view_logs'>Logs</a>
                          </li> 
                        -->
                        <li>
                            <a href='#' class='inlineIcon preferences iconActivate reset_pass'>Reset Pass</a>
                        </li>
                        <li>
                            <?php if ($val['User']['lock_status'] >= 3) { ?>

                                <a href='#' class='inlineIcon preferences iconopen unlock'>UnLock</a>
                            <?php } else if ($val['User']['lock_status'] < 3) { ?>
                                <a href='#' class='inlineIcon preferences iconlock lock'>Lock</a>

                            <?php } ?>
                        </li>
                    </ul>
                </td>
                <td></td> <td></td> <td></td>
            </tr>
            <?php
            $row_color++;
        }
        ?>


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

