<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */
?>
<style>
    div.tableWrapper li {
        width: 150px !important;
    }   
</style>


<form name="change_site_form" id="add_role_form" class="cmxform">

    <input type="hidden" name="change_inst_url" id="change_inst_url" value="<?php echo $html->url(array('controller' => 'Admin', 'action' => 'change_inst_config')); ?>" />
    <input type="hidden" name="dashboard" id="dashboard" value="<?php echo $html->url(array('controller' => 'Reception', 'action' => 'view_events')); ?>" />
    <input type="hidden" name="csite" id="csite" value="<?php echo $site_id; ?>" />

    <div class='tableWrapper'>
        <div class='tableHeader' style="border: 0px !important;">

            <?php foreach ($insts as $inst_val) { ?>

                <ul class='tableActions' style ="margin:5px;font-weight:bolder;font-size:15px !important;">
                    <li style="width:100% !important;">
                        <?php echo $inst_val['Institution']['inst_long_name']; ?></li> 
                </ul>
                <?php foreach ($inst_val['Site'] as $val) { ?>
                    <ul class='tableActions'  style ="margin:10px !important;">
                        <li style="width:100% !important;" id="<?php echo $val['id']; ?>">
                            <input <?php if ($val['id'] == $site_id) { ?>checked="checked" <?php } ?>
                                                                         inst_id="<?php echo $inst_val['Institution']['id'] ?>" site_id="<?php echo $val['id']; ?>" class="site_select" name="site_s" id="site_s" type="radio">
                            <?php echo $val['site_name']; ?></li>        

                    </ul>

                    <?php
                }
            }
            ?>

            <ul class='tableActions'>
                <li>
                    <label>  </label> 
                </li>
                <li>
                </li>



            </ul>



            <div class='clear'></div>
            <div class='corner left'></div>
            <div class='corner right'></div>
        </div>

    </div>

</form>


