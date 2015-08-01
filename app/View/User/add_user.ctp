<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */

//print_r($_SESSION['role_short_array']);
?>

<form name="add_user_form" id="add_user_form" class="cmxform">
    <div class='tableWrapper'>
        <div class='tableHeader' style="border: 0px !important;">
            <ul class='tableActions'>
                <li>
                    <label> First Name </label>       
                </li> 
                <li>
                    <input type="hidden" required name="data[User][id]" id="data[User][id]"  value="<?php echo isset($User) ? $User['User']['id'] : ""; ?>" />      

                    <input type="text" class="ca" required name="data[User][fname]" id="data[User][fname]" value="<?php echo isset($User) ? $User['User']['fname'] : ""; ?>" />      
                </li>
            </ul>  
            <ul class='tableActions'>
                <li>
                    <label>  Last  Name </label> 
                </li>
                <li>
                    <input type="text" class="ca" required name="data[User][lname]" id="data[User][lname]" value="<?php echo isset($User) ? $User['User']['lname'] : ""; ?>" />      
                </li>
            </ul>
            <ul class='tableActions'>
                <li>
                    <label>  Email </label> 
                </li>
                <li>
                </li>
                <li>

                    <input type="email" class="ca" required <?php if (isset($User)) {echo "readonly=readonly";}  ?> 
                   name="data[User][user_email]" id="data[User][user_email]" value="<?php echo isset($User) ? $User['User']['user_email'] : ""; ?>" />      


                </li>


            </ul>
<!--
            <ul class='tableActions'>
                <li>
                    <label>  Date Of Birth </label> 
                </li>
                <li>
                </li>
                <li>
                    <input type="text" required name="data[User][dob]" id="data[User][dob]" value="<?php echo isset($User) ? $User['User']['dob'] : ""; ?>" />      
                </li>


            </ul>
-->

            <?php
            
                    $user_roles = $this->Session->read('role_short_array');

            if (isset($user_roles) && (in_array('SADM',$user_roles) || in_array('ADM',$user_roles))) 
                {
                ?>
                <ul class='tableActions'>
                    <li>
                        <label>  Site </label> 
                    </li>
                    <li>
                    </li>
                    <li>
                        <select class="ca" required name="data[User][site_id]" id="data[User][site_id]">
                                    <?php foreach ($sites as $val) { ?>
                                <option value="<?php echo $val['Site']['id'] ?>"
                                <?php if (isset($User) && $User['User']['site_id'] == $val['Site']['id']) { ?>
                                            selected="selected"
        <?php } ?>>
        <?php echo $val['Site']['site_name'] ?>
                                </option>
    <?php } ?>

                        </select>
                    </li>


                </ul>
<?php } ?>
            <ul class='tableActions'>
                <li>
                </li>
                <li>
                </li>
                <li>

                </li>


            </ul>


            <ul class='tableActions'>
                <li>
                    <label>  </label> 
                </li>
                <li>
                </li>
                <li>
                    <input type="hidden" required name="add_user" id="add_user"  value="1" />      

             <!-- <input type="button" name="close_dialog" id="close_dialog" value="Close" /> -->

                </li>


            </ul>



            <div class='clear'></div>
            <div class='corner left'></div>
            <div class='corner right'></div>
        </div>

    </div>
    <input type="hidden"  name="save_eve" id="save_eve" value="save" />      

</form>


