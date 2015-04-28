
<div class='tableWrapper'>
    <div class='tableHeader'>
        <ul class='tableActions'>
            <li>
                <a name="add_role" id="add_role" title="Add New Role"  href="<?php echo $html->url(array('controller' => 'Admin', 'action' => 'add_role')); ?>" class='inlineIcon iconAdvertiserAdd'>Add New Role</a>
            </li>
            <li class='inactive activeIfSelected'>

            <li>
                <input type="text" name="search_role" id="search_role" placeholder="Search By Name"/>
            </li>

            </li>
        </ul>



        <div class='clear'></div>
        <div class='corner left'></div>
        <div class='corner right'></div>
    </div>


    <div name="table_info" id="table_info">

    </div>

    <input type="hidden" name="role_list_url" id="role_list_url" value="<?php echo $html->url(array('controller' => 'Admin', 'action' => 'role_list')); ?>" />
    <input type="hidden" name="add_role_url" id="add_role_url" value="<?php echo $html->url(array('controller' => 'Admin', 'action' => 'add_role')); ?>" />

</div>

<?php echo $html->script('view_roles.js'); ?>

