<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */
//print_r($categories);
?>

<form name="add_batch_form" id="add_batch_form" class="cmxform">
    <div class='tableWrapper'>
        <div class='tableHeader' style="border: 0px !important;">
            <ul class='tableActions'>
                <li>
                    <label>  Name </label>       
                </li> 
                <li>
                    <input type="hidden" required name="data[Batch][id]" id="data[Batch][id]"  value="<?php echo isset($batch) ? $batch['Batch']['id'] : ""; ?>" />      

                    <input type="text" required name="data[Batch][batch_name]" id="data[Batch][batch_name]" value="<?php echo isset($batch) ? $batch['Batch']['batch_name'] : ""; ?>" />      
                </li>
            </ul>  

            <ul class='tableActions'>
                <li>
                    <label>  Event </label> 
                </li>
                <li>

                    <select required name="data[Batch][batch_event_id]" id="data[Batch][batch_event_id]" >
                        <?php foreach ($events as $val) { ?>
                            <option
                                <?php if (isset($batch) && $batch['Batch']['batch_event_id'] == $val['Event']['id']) { ?>  selected="selected"  <?php } ?> 
                                value="<?php echo $val['Event']['id'] ?>"><?php echo $val['Event']['event_name'] ?> </option>

                        <?php } ?>
                    </select>


                </li>
            </ul>

            <ul class='tableActions'>
                <li>
                    <label>  Number Of Tickets </label>       
                </li> 
                <li>
                    <input required type="number" min="1" name="data[Batch][batch_ticket_number]" id="data[Batch][batch_ticket_number]"
                           value="<?php echo isset($batch) ? $batch['Batch']['batch_ticket_number'] : ""; ?>">


                </li>
            </ul>  



            <ul class='tableActions'>
                <li>
                    <label> Redeem </label> 
                </li>

                <li>
                    Yes  <input type="radio" required name="data[Batch][batch_status_email]" id="data[Batch][batch_status_email]" value="1" <?php if (isset($batch) && $batch['Batch']['batch_status_email'] == "1") { ?> checked <?php } ?>/>      
                    No  <input type="radio" required name="data[Batch][batch_status_email]" id="data[Batch][batch_status_email]" value="0"  <?php if (isset($batch) && $batch['Batch']['batch_status_email'] == "0") { ?> checked <?php } ?> />      

                </li>


            </ul>


            <ul class='tableActions'>
                <li>
                    <label> Download </label> 
                </li>

                <li>
                    Yes  <input type="radio" required name="data[Batch][batch_allow_download]" id="data[Batch][batch_allow_download]" value="1" <?php if (isset($batch) && $batch['Batch']['batch_allow_download'] == "1") { ?> checked <?php } ?>/>      
                    No  <input type="radio" required name="data[Batch][batch_allow_download]" id="data[Batch][batch_allow_download]" value="0" <?php if (isset($batch) && $batch['Batch']['batch_allow_download'] == "0") { ?> checked <?php } ?>/>      

                </li>


            </ul>

            <ul class='tableActions'>
                <li>
                    <label> Ticket Type </label> 
                </li>

                <li>
                    <select name="data[Batch][ticketype]" id="data[Batch][ticketype]" >
                        <option 
                        <?php if (isset($batch) && $batch['Batch']['ticketype'] == "") { ?>
                                selected="selected"
                            <?php } ?>


                            value="">None </option>
                            <?php foreach ($tt as $val) { ?>
                            <option 
                            <?php if (isset($batch) && $batch['Batch']['ticketype'] == $val['TicketType']['id']) { ?>
                                    selected="selected"
                                <?php } ?>
                                value="<?php echo $val['TicketType']['id'] ?>"><?php echo $val['TicketType']['type_name'] ?> </option>
                            <?php } ?>
                    </select>

                </li>


            </ul>








            <ul class='tableActions'>
                <li>
                    <label> Category </label> 
                </li>

                <li>
                    <select name="data[Batch][batch_category]" id="data[Batch][batch_category]" >
                        <option 
                        <?php if (isset($batch) && $batch['Batch']['batch_category'] == "") { ?>
                                selected="selected"
                            <?php } ?>


                            value="">None </option>
                            <?php foreach ($categories as $val) { ?>
                            <option 
                            <?php if (isset($batch) && $batch['Batch']['batch_category'] == $val['Category']['id']) { ?>
                                    selected="selected"
                                <?php } ?>
                                value="<?php echo $val['Category']['id'] ?>"><?php echo $val['Category']['long_name'] ?> </option>
                            <?php } ?>
                    </select>

                </li>


            </ul>

            <ul class='tableActions'>
                <li>
                    <label> Delivery Medium </label> 
                </li>

                <li>
                    Email  <input type="radio" required name="data[Batch][medium_del]" id="data[Batch][medium_del]" value="email" <?php if (isset($batch) && $batch['Batch']['medium_del'] == "email") { ?> checked <?php } ?>/>      
                    Text  <input type="radio" required name="data[Batch][medium_del]" id="data[Batch][medium_del]" value="text" <?php if (isset($batch) && $batch['Batch']['medium_del'] == "text") { ?> checked <?php } ?>/>      
                    Both  <input type="radio" required name="data[Batch][medium_del]" id="data[Batch][medium_del]" value="both" <?php if (isset($batch) && $batch['Batch']['medium_del'] == "both") { ?> checked <?php } ?>/>      

                </li>


            </ul>


            <ul class='tableActions'>



            </ul>






            <div class='clear'></div>
            <div class='corner left'></div>
            <div class='corner right'></div>
        </div>

    </div>
    <input type="hidden"  name="save_batch" id="save_batch" value="save" />      

</form>


