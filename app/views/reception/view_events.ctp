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
                <a class='inlineIcon iconWebsiteAdd' id="add_event" title="Add New Event" name="add_event" href="<?php echo $html->url(array('controller' => 'Reception', 'action' => 'add_event')); ?>">Add New Event</a>
            </li>
            <li>
                <input type="text" name="search_event" id="search_event" placeholder="Search By Event Name or Location"/>
                <div id="dialog_date_input" name="dialog_date_input"></div>
            </li>
            <li>
                <input type="checkbox" name="event_archive_status" id="event_archive_status"/>
               <label> View Archived Events</label>
            </li>
            <li >
             <input type="button" style="width:80px;height: 25px" name="search_button" id="search_button" value="Search"  />
            </li>
        </ul>
        <input type="hidden" name="save_url" id="save_url" value="<?php echo $html->url(array('controller' => 'Reception', 'action' => 'add_event')); ?>" />
        <input type="hidden" name="event_list_url" id="event_list_url" value="<?php echo $html->url(array('controller' => 'Reception', 'action' => 'event_list')); ?>" />
        <input type="hidden" name="del_url" id="del_url" value="<?php echo $html->url(array('controller' => 'Reception', 'action' => 'del_event')); ?>" />




        <div class='clear'></div>
        <div class='corner left'></div>
        <div class='corner right'></div>
    </div>
    <div name="table_info" id="table_info">

    </div>



</div>

<?php echo $html->script('view_events.js'); ?>





<script type='text/javascript'>
    <!--
                
    $('#deleteSelection').click(function(event) {
        event.preventDefault();
					
        if (!$(this).parents('li').hasClass('inactive')) {
            var ids = [];
            $(this).parents('.tableWrapper').find('.toggleSelection input:checked').each(function() {
                ids.push(this.value);
            });
						
            if (!tablePreferences.warningBeforeDelete || confirm("Do you really want to delete the selected websites?")) {
                window.location = 'affiliate-delete.php?affiliateid=' + ids.join(',');
            }
        }
    });
                
               
</script>