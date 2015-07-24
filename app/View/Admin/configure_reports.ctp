
<div class='tableWrapper'>
    <div class='tableHeader'>
        <ul class='tableActions'>
            <li>
                <a name="add_report" id="add_report" title="Add New Report"  href="<?php echo $this->Html->url(array('controller' => 'Admin', 'action' => 'configure_reports_add')); ?>" class='inlineIcon iconAdvertiserAdd'>Add New Report</a>
            </li>
            <li class='inactive activeIfSelected'></li>

            <li>
                <input type="text" name="search_report" id="search_report" placeholder="Search By Report Name"/>
            </li> 

           
        </ul>


        <div id="dialog_date_input" name="dialog_date_input"></div>
        <div id="dialog_role_input" name="dialog_role_report"></div>

        <div class='clear'></div>
        <div class='corner left'></div>
        <div class='corner right'></div>
    </div>


    <div name="table_info" id="table_info">

    </div>

    <input type="hidden" name="report_list_url" id="report_list_url" value="<?php echo $this->Html->url(array('controller' => 'Admin', 'action' => 'configure_reports_list')); ?>" />
    <input type="hidden" name="report_add_url" id="report_add_url" value="<?php echo $this->Html->url(array('controller' => 'Admin', 'action' => 'configure_reports_add')); ?>" />
    <input type="hidden" name="report_roles_url" id="report_roles_url" value="<?php echo $this->Html->url(array('controller' => 'Admin', 'action' => 'configure_reports_roles')); ?>" />
    <input type="hidden" name="report_roles_save" id="report_roles_save" value="<?php echo $this->Html->url(array('controller' => 'Admin', 'action' => 'save_reports_roles')); ?>" />

</div>

<?php echo $this->Html->script('view_reports.js'); ?>

