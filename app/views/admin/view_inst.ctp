
<div class='tableWrapper'>
    <div class='tableHeader'>
        <ul class='tableActions'>
            <li>
                <a name="add_inst" id="add_inst" title="Add New Institution"  href="<?php echo $html->url(array('controller' => 'Admin', 'action' => 'add_inst')); ?>" class='inlineIcon iconAdvertiserAdd'>Add New Institution</a>
            </li>
            <li class='inactive activeIfSelected'>

            <li>
                <input type="text" name="search_inst" id="search_inst" placeholder="Search By Name,Phone,Email"/>
            </li>

            </li>
        </ul>



        <div class='clear'></div>
        <div class='corner left'></div>
        <div class='corner right'></div>
    </div>


    <div name="table_info" id="table_info">

    </div>

    <input type="hidden" name="inst_list_url" id="inst_list_url" value="<?php echo $html->url(array('controller' => 'Admin', 'action' => 'inst_list')); ?>" />
    <input type="hidden" name="add_inst_url" id="add_inst_url" value="<?php echo $html->url(array('controller' => 'Admin', 'action' => 'add_inst')); ?>" />
    <input type="hidden" name="status_inst_change" id="status_inst_change" value="<?php echo $html->url(array('controller' => 'Admin', 'action' => 'inst_status_change')); ?>" />

</div>

<?php echo $html->script('view_inst.js'); ?>

