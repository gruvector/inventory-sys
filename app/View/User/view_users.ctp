<style>
    .tableWrapper{
        width:100% !important;
    }
</style>
<div class='tableWrapper'>
    <div class='tableHeader'>
        <ul class='tableActions'>
            <li>
                <a name="add_user" id="add_user" title="Add New User"  href="<?php echo $this->Html->url(array('controller' => 'User', 'action' => 'add_user')); ?>" class='inlineIcon iconAdvertiserAdd'>Add New Staff</a>
            </li>

            <li>
                <input type="text" name="search_user" id="search_user" placeholder="Search By Name or Email"/>
            </li>
    <li>
                <input type="button" name="search_butt" id="search_butt" value="Search"/>
            </li>
           
        </ul>



        <div class='clear'></div>
        <div class='corner left'></div>
        <div class='corner right'></div>
    </div>
    <div name="role_div" id="role_div">

    </div>

    <div name="table_info" id="table_info">

    </div>

    <input type="hidden" name="users_list_url" id="user_list_url" value="<?php echo $this->Html->url(array('controller' => 'User', 'action' => 'batch_list')); ?>" />
    <input type="hidden" name="add_user_url" id="add_user_url" value="<?php echo $this->Html->url(array('controller' => 'User', 'action' => 'add_user')); ?>" />
    <input type="hidden" name="del_user_url" id="del_user_url" value="<?php echo $this->Html->url(array('controller' => 'User', 'action' => 'add_user')); ?>" />
    <input type="hidden" name="edit_roles" id="edit_roles" value="<?php echo $this->Html->url(array('controller' => 'User', 'action' => 'edit_roles')); ?>" />
    <input type="hidden" name="save_roles" id="save_roles" value="<?php echo $this->Html->url(array('controller' => 'User', 'action' => 'save_roles')); ?>" />
    <input type="hidden" name="user_list" id="user_list" value="<?php echo $this->Html->url(array('controller' => 'User', 'action' => 'user_list')); ?>" />
    <input type="hidden" name="user_status_change" id="user_status_change" value="<?php echo $this->Html->url(array('controller' => 'User', 'action' => 'edit_status')); ?>" />


</div>

<?php echo $this->Html->script('view_users.js'); ?>

