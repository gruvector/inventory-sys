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


<form name="change_pass_form" id="change_pass_form" class="cmxform">


    <div class='tableWrapper'>
        <div class='tableHeader' style="border: 0px !important;">

            <ul class='tableActions'>
                <li>
                    <label> Old Password </label> 
                </li>
                <li>
                </li>
                <li>
                    <input type="password" class="date_field" required name="old_password" id="old_password" value="" />  

                </li>


            </ul>
            <ul class='tableActions'>
                <li>
                    <label> New  Password </label> 
                </li>
                <li>
                </li>
                <li>
                    <input type="password" class="" required name="new_password" id="new_password" value="" />      
                </li>


            </ul>            <ul class='tableActions'>
                <li>
                    <label> Repeat New Password </label> 
                </li>
                <li>
                </li>
                <li>
                    <input type="password" class="" required name="repeat_new_password" id="repeat_new_password" value="" />      
                    <span id="repeat_password_error" name="repeat_password_error"></span>

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



            </ul>



            <div class='clear'></div>
            <div class='corner left'></div>
            <div class='corner right'></div>
        </div>

    </div>

</form>


