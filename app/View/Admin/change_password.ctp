<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */
?>


<style>
   .check_pass_error
 {
        margin-top:40px;
        text-align: center;
		margin-left: 10px;
		font-family: Tahoma,Verdana,Arial,sans-serif;
		width:100% !important;
		colour:red !important;
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
                    <input type="password"  class="" required name="password_old" id="password_old" value="" />  

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


            </ul>           
             <ul class='tableActions'>
                <li>
                    <label> Repeat New Password </label> 
                </li>
                <li>
                </li>
                <li>
                    <input type="password" class="" required name="repeat_password" id="repeat_password" value="" />      
                </li>
                <li>

                </li>

					
            </ul>



            <ul class='tableActions' style="width:100% !important;">
                <li>
 <label class="check_pass_error">this is for viewing erros with passwords</label>		
                </li>
             </ul>
             

            <div class='clear'></div>
            <div class='corner left'></div>
            <div class='corner right'></div>
        </div>

    </div>

</form>


