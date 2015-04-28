<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div class='tableWrapper' style='width:100% !important;'>
    <div class='tableHeader'>
        <ul class='tableActions'>
            <li>
                <a name="add_batch" id="add_batch" title="Add New Batch"  href="<?php echo $html->url(array('controller' => 'Reception', 'action' => 'add_batch')); ?>" class='inlineIcon iconWebsiteAdd'>Add New Batch</a>
            </li>
            <li>
                <input type="text" name="search_batch" id="search_batch" placeholder="Search By Batch or Event Name "/>
            </li>
        </ul>



        <div class='clear'></div>
        <div class='corner left'></div>
        <div class='corner right'></div>
    </div>


    <div name="table_info" id="table_info">

    </div>

    <input type="hidden" name="batch_list_url" id="batch_list_url" value="<?php echo $html->url(array('controller' => 'Reception', 'action' => 'batch_list')); ?>" />
    <input type="hidden" name="add_batch_url" id="add_batch_url" value="<?php echo $html->url(array('controller' => 'Reception', 'action' => 'add_batch')); ?>" />
    <input type="hidden" name="del_batch_url" id="del_batch_url" value="<?php echo $html->url(array('controller' => 'Reception', 'action' => 'del_batch')); ?>" />



</div>

<?php echo $html->script('view_batches.js'); ?>


