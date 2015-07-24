<?php
//echo $this->Html->css('app/columns.css');
//echo $this->Html->css('app/jobsheet.css');


?>





<style>
     
           

    #print_wrapper, #print_wrapper td, #print_wrapper p {
        font-size: 10pt !important;
    }


     
     
    .pane-footer {
        font-size: 11px;
        background-color: #f1f1f1;
        padding: 5px;
        border-top: solid #bbb 1px;
    }
    
    .pane-footer ul {
        display: inline-block;
        overflow: hidden;
        vertical-align: middle;
    }
    
    .pane-footer li {
        display: inline-block;
        padding: 3px 6px;
        background-color: #ccc;
        margin-right: 2px;
    }
    
    .pane-footer li:hover {
        background-color: #999;
        color: #fff;
        cursor: pointer;
    }
        #rp_table{
       width: 50% !important;
       
        
    }
  
    #rp_table th,   #rp_table tbody tr {
      text-align: left;
    }
  
      .header{
      text-align: left;
      font-weight: bolder;
      font-size: 15px !important;
      background-color: white !important;
     
    
    }
    .report_options{
   text-align: left;
    }
    .norec{
     text-align: center;
     font-weight: bold;
     font-size: 10px;
     width: 100%;
     margin: 20px;
    }
</style>

<div class="columns">

    <div class="column report_header" id="users_column">
        <div class="header"><?php echo $title; ?></div>
        <div class="subheader" style="position: relative;">
        </div>
        <input type="hidden" name="add_new_url" id="add_new_url" value="<?php echo $this->Html->url(array("controller"=>"reports","action"=>"admin_add")); ?>" />
    </div>
    
    
       </div> 

   <br/><br/>
        <?php 
     // print_r($columns);
        
        if (count($results) > 0) {  ?>
<table border="0" cellpadding="5" cellspacing="0" class="fullwidth" id="rp_table">
   
   
    <thead>
    <tr>
       <?php  foreach($columns as $val){ ?>
            <th  style="padding-left: 2px;">
             
             <?php echo strtoupper($val); ?>
           
            </th>
          <?php } ?>
        </tr>
    </thead>

    <tbody>
        <?php 
        foreach($results as $val ){ ?>
        <tr>
        <?php   foreach ($val as $key => $keyval) {  
            foreach($keyval as $rval) {
            ?>
        <td>  <?php echo $rval; ?> </td>
            <?php }
            
            } ?>
        </tr>
        <?php  }   ?>
    </tbody>
</table>
<?php  }else{ ?>
    <div class="norec"> NO RESULTS WERE RETURNED BY QUERY  </div>
    <?php  } ?>