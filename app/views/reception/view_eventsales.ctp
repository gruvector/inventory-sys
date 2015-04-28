<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div class='tableWrapper'>
    <div class='tableHeader'>
        <ul class='tableActions'>
            <!--  <li>
                  <input type="text" name="oaSearch" id="oaSearch" title="Search Event">
              </li>
            -->
            <li class='inactive activeIfSelected'>

        </ul>
        <div class='clear'></div>
        <div class='corner left'></div>
        <div class='corner right'></div>
    </div>
    <br>

    <table cellspacing='0' summary='' id="table_info">


    </table>
    <input type="hidden" name="eventsales_list_url" id="eventsales_list_url" value="<?php echo $html->url(array('controller' => 'Reception', 'action' => 'view_eventsaleslist')); ?>" />


</div>


<?php echo $html->script('view_sales.js'); ?>



