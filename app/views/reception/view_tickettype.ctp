<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div class='tableWrapper'>
    <div class='tableHeader'>
        <ul class='tableActions'>
            <li>
                <a name="add_tt" id="add_tt" title="Add New Type"  href="<?php echo $html->url(array('controller' => 'Reception', 'action' => 'add_tt')); ?>" class='inlineIcon iconWebsiteAdd'>Add New Event Ticket</a>
            </li>
            <li>
                <input type="text" name="search_tt" id="search_tt" placeholder="Search By Event,Type "/>
            </li>
        </ul>



        <div class='clear'></div>
        <div class='corner left'></div>
        <div class='corner right'></div>
    </div>


    <div name="table_info" id="table_info">

    </div>

    <input type="hidden" name="tt_list_url" id="tt_list_url" value="<?php echo $html->url(array('controller' => 'Reception', 'action' => 'tt_list')); ?>" />
    <input type="hidden" name="tt_add_url" id="tt_add_url" value="<?php echo $html->url(array('controller' => 'Reception', 'action' => 'add_tt')); ?>" />



</div>

<?php echo $html->script('view_types.js'); ?>


