<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style>
    .instructions{
        font-weight: bold;
        background-color: rgba(0, 0, 0, 0.34);
    }
    #verify_ticket{
        border: 1px solid #bfbfbf;
        border-radius: 2px;
        box-sizing: border-box;
        color: #444;
        font: inherit;
        margin: 0;
        min-height: 2em;
        padding: 3px;
        padding-bottom: 4px;
        margin-left: 20px;
        width: 350px;
        font-size: 2em;
        font-family: sans-serif;
        height: 40px;
    }
    div.tableWrapper .tableHeader{
        border: none;
    }
    div.corner.left{
        background-image: none !important;
    }
</style>

<div class='tableWrapper'>
    <div class='tableHeader'>
        <ul class='tableActions'>
         
                <input type="text" name="verify_ticket" id="verify_ticket" placeholder="Scan/Enter Reference Number"/>
            </li>
        </ul>



        <div class='clear'></div>
        <div class='corner left'></div>
        <div class='corner right'></div>
    </div>


    <div name="table_info" id="table_info">

    </div>

    <input type="hidden" name="verification_url" id="verification_url" value="<?php echo $html->url(array('controller' => 'Ticket', 'action' => 'verify_ticket')); ?>" />

</div>

<?php
echo $html->script('verification.js');
echo $html->script('socket_data/scan.js');
?>


