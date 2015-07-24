<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 
 * have to add specialized styles for the parameters side
 */
?>
<style>
    div.tableWrapper li{width: 150px !important;}
    ul.tableActions{    margin-bottom: 10px !important;}
    textarea{width: 300px!important;height:120px!important;}
    .undert{margin-top:70px;}
    #add_report_form a{color:blue !important;}
    #add_report_form a:hover{color:blue;}
    .add_param_ul{width:420px !important;}
</style>


<form name="add_report_form" id="add_report_form" class="cmxform">
    <div class='tableWrapper'>
        <div class='tableHeader' style="border: 0px !important;">
            <ul class='tableActions'>
                <li>
                    <label> Report Name </label>       
                </li> 
                <li>
                    <input type="hidden" required name="data[Report][id]" id="data[Report][id]"  value="<?php echo isset($reports) ? $reports['Report']['id'] : ""; ?>" />      

                    <input type="text" maxlength="25" required name="data[Report][title]" id="data[Report][title]" value="<?php echo isset($reports) ? $reports['Report']['title'] : ""; ?>" />      
                </li>
            </ul>  

            <ul class='tableActions'>
                <li>
                    <label>  Category  </label> 
                </li>
                <li>
                    <select id="data[Report][category]" name="data[Report][report_category_id]">
                        <?php foreach ($report_category as $val) { ?>
                            <option 
                                <?php if (isset($reports) && $reports['Report']['report_category_id'] == $val['ReportCategory']['id']) { ?>  selected="selected"  <?php } ?> 
                                value="<?php echo $val['ReportCategory']['id']; //            ?>"><?php echo $val['ReportCategory']['name']; //            ?></option>     
                            <?php } ?>
                    </select>
                </li>
            </ul>

            <ul class='tableActions'>
                <li>
                    <label>Report Query</label> 
                </li>
                <li>
                </li>
                <li>
                    <textarea   required  name="data[Report][params]" id="data[Report][params]" ><?php echo isset($reports) ? $reports['Report']['params'] : ""; ?></textarea>
                </li>


            </ul>

            
            
            <ul class='tableActions' style="margin-top:100px;">
                <li>
                    <label>Report Params</label> 
                </li>
                <li>
                </li>
                <li id="add_new_param">
                    <a id="add_new_rep" href="#">Add Param</a>
                </li>
            </ul>
            <ul class='tableActions add_param_ul'>
                <?php
                if (isset($reports['ReportParameter'])) {
                    foreach ($reports['ReportParameter'] as $val) {
                        ?>
                        <span>
                            <li style="width:auto !important">
                                <select name="data[Report][param][name][]" id="data[Report][param][name][]">
                                    <option <?php if ($val['type']=='text') { ?>selected="selected"  <?php } ?> value="text">text</option>
                                    <option <?php if ($val['type']=='number') { ?>selected="selected"  <?php } ?> value="number">number</option>
                                    <option <?php if ($val['type']=='timestamp') { ?>selected="selected"  <?php } ?> value="timestamp">timestamp</option>
                                </select></li>
                            <li style="width:auto !important">
                            <input name="data[Report][param][label][]" id="data[Report][param][label][]" type="text" style="width:auto !important" placeholder="Label Name" enabled="enabled" value="<?php if(isset($val['label'])){echo $val['label'] ; }?>"/></li>
                            <li style="width:auto !important"><input name="data[Report][param][val_name][]" id="data[Report][param][val_name][]" type="text" style="width:auto !important" placeholder="Model.column" value="<?php if(isset($val['name'])){echo $val['name'] ; }?>"></li>
                            <li  style="width:auto !important"><a class="remove_param" style="width:auto !important" href="#">Remove</a></li>
                        </span>
                        <?php
                    }
                }
                ?>
            </ul>
          



            <div class='clear'></div>
            <div class='corner left'></div>
            <div class='corner right'></div>
        </div>

    </div>

</form>


