
<div class='tableWrapper'>
    <div class='tableHeader'>
        <ul class='tableActions'>
            <li>
                <a name="add_cat" id="add_cat" title="Add New Category"  href="<?php echo $this->Html->url(array('controller' => 'Customer', 'action' => 'add_cat')); ?>" class='inlineIcon iconAdvertiserAdd'>Add New Category</a>
            </li>
            <li class='inactive activeIfSelected'>
            </li>
            <li>
                <input type="text" name="search_cat" id="search_cat" placeholder="Search By Name"/>
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

    <input type="hidden" name="cat_list_url" id="cat_list_url" value="<?php echo $this->Html->url(array('controller' => 'Customer', 'action' => 'cat_list')); ?>" />
    <input type="hidden" name="add_cat_url" id="add_cat_url" value="<?php echo $this->Html->url(array('controller' => 'Customer', 'action' => 'add_cat')); ?>" />

</div>

<?php echo $this->Html->script('view_cat.js'); ?>

