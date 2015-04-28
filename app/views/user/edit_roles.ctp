<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//print_r($roles);
//print_r($user_roles);
?>
<style type="text/css">
    #role_div {
        margin: 10px !important;
    }
</style>


<div id="role_div" name="role_div">

    <select id="user_roles" name="user_roles" multiple="multiple">
        <?php foreach ($roles as $val) { ?>
            <option value="<?php echo $val['Role']['id'] ?>"
            <?php
            if (in_array($val['Role']['id'], $user_roles)) {
                ?>
                        selected="selected"
                    <?php } ?>
                    >
                        <?php echo $val['Role']['role_long_name'] ?>
            </option>

        <?php } ?>
    </select>

</div>
<ul  id="roles_sys" name="roles_sys" style="visibility: hidden;" >
    <?php foreach ($roles as $val) { ?>
        <li value="<?php echo$val['Role']['id'] ?>"><?php echo$val['Role']['role_long_name'] ?></li>
    <?php } ?>
</ul>
<ul  id="roles_sys_user" name="roles_sys_user"style="visibility: hidden;" >
    <?php foreach ($roles as $val) { ?>
        <li value="<?php echo $val ?>"></li>
    <?php } ?>
</ul>

