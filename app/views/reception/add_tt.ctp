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


<form name="add_tt_form" id="add_tt_form" class="cmxform">
    <input type='hidden' name="data[TicketType][site_id]" value="<?php echo isset($site_id) ? $site_id : ""; ?>" id="data[TicketType][site_id]" />
    <div class='tableWrapper'>
        <div class='tableHeader' style="border: 0px !important;">
            <ul class='tableActions'>
                <li>
                    <label>  Name </label>       
                </li> 
                <li>
                    <input type="hidden" required name="data[TicketType][id]" id="data[TicketType][id]"  value="<?php echo isset($TicketTypes) ? $TicketTypes['TicketType']['id'] : ""; ?>" />      

                    <input type="text" required name="data[TicketType][type_name]" id="data[TicketType][type_name]" value="<?php echo isset($TicketTypes) ? $TicketTypes['TicketType']['type_name'] : ""; ?>" />      
                </li>
            </ul>  
            <ul class='tableActions'>
                <li>
                    <label>  Cost  </label> 
                </li>
                <li>
                    <input type="text" required name="data[TicketType][ticket_cost]" id="data[TicketType][ticket_cost]" value="<?php echo isset($TicketTypes) ? $TicketTypes['TicketType']['ticket_cost'] : ""; ?>" />      
                </li>
            </ul>

            <ul class='tableActions'>
                <li>
                    <label>  Event </label> 
                </li>
                <li>

                    <select required name="data[TicketType][event_id]" id="data[TicketType][event_id]" >
                        <?php foreach ($events as $val) { ?>
                            <option
                                <?php if (isset($TicketTypes) && $TicketTypes['TicketType']['event_id'] == $val['Event']['id']) { ?>  selected="selected"  <?php } ?> 
                                value="<?php echo $val['Event']['id'] ?>"><?php echo $val['Event']['event_name'] ?> </option>

                        <?php } ?>
                    </select>


                </li>
            </ul>


            <ul class='tableActions'>
                <li>
                    <label style="font-weight:bold;">Ticket Code</label> 
                </li>
                <li>
                </li>

                <li>
                    <input type="text" required name="data[TicketType][ticket_code]" id="data[TicketType][ticket_code]"  value='<?php echo isset($TicketTypes) ? $TicketTypes['TicketType']['ticket_code'] : ""; ?>'/>
                </li>


            </ul>            

            <ul class='tableActions'>
                <li>
                    <label style="font-weight:bold;">Click To Buy Code</label> 
                </li>
                <li>
                </li>

                <li>
                    <input type="text" style="width:180%;" length="30" required name="data[TicketType][click_to_buy_link]" id="data[TicketType][click_to_buy_link]"  value='<?php echo isset($TicketTypes) ? $TicketTypes['TicketType']['click_to_buy_link'] : ""; ?>'/>
                </li>


            </ul>



            <ul class='tableActions'>
                <li>
                    <label style="font-weight:bold;">TICKET HTML</label> 
                </li>
                <li>
                </li>
                <li>
                    <textarea style="height: 250px;width: 250px;margin-top: 5px;"  required  
                              name="data[TicketType][type_html]" id="data[TicketType][type_html]" ><?php echo isset($TicketTypes) ? $TicketTypes['TicketType']['type_html'] : ""; ?></textarea>
                </li>

            </ul>




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



            </ul>



            <div class='clear'></div>
            <div class='corner left'></div>
            <div class='corner right'></div>
        </div>

    </div>

</form>


