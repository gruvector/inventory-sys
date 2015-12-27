<style>
    .tableWrapper{
        width:100% !important;
     }

</style>

<div class='tableWrapper'>
    <div class='tableHeader'>
        <ul class='tableActions'>
            <li>
                <a name="add_site" id="add_site" title="Add New Site"  href="<?php echo $this->Html->url(array('controller' => 'Site', 'action' => 'add_site')); ?>" class='inlineIcon iconAdvertiserAdd'>Add New Site</a>
            </li>
            <li class='inactive activeIfSelected'>
            </li>
            <li>
                <input type="text" maxlength="25" name="search_site" id="search_site" placeholder="Search By Name,Address,City,Email"/>
            </li>

            <li>
                <input type="button" name="search_butt" id="search_butt" value="Search"/>
            </li>
        </ul>



        <div class='clear'></div>
        <div class='corner left'></div>
        <div class='corner right'></div>
    </div>


    <div name="table_info" id="table_info">

    </div>

    <input type="hidden" name="site_list_url" id="site_list_url" value="<?php echo $this->Html->url(array('controller' => 'Site', 'action' => 'site_list')); ?>" />
    <input type="hidden" name="add_site_url" id="add_site_url" value="<?php echo $this->Html->url(array('controller' => 'Site', 'action' => 'add_site')); ?>" />
    <input type="hidden" name="status_site_change" id="status_site_change" value="<?php echo $this->Html->url(array('controller' => 'Site', 'action' => 'change_status')); ?>" />

</div>

<?php echo $this->Html->script('view_sites.js'); ?>

