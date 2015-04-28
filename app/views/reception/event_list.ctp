<table cellspacing='0' summary=''>
 <thead>
            <tr>
             
                <th class="sortup">
                    Name
                </th>
                <th class="sortup">
                    Location
                </th>


                <th  >
                    Start Time
                </th>
                <th  >
                    End  Time
                </th>

                <th>  </th>

                <th > </th>
                <th  >

                </th>
                <th class='last alignRight'>

                </th>
            </tr>
        </thead>



        <tbody>
            <?php $row_color = 0;
            foreach ($events as $val) { ?>

                <tr id="<?php echo $val['Event']['id'] ?>" class='<?php echo ($row_color % 2 == 0) ? "even" : "odd"; ?>'>
               

                    <td>
                        <?php echo $val['Event']['event_name']; ?>

                    </td>
                    <td>
                        <?php echo $val['Event']['event_location']; ?>

                    </td>
                    <td>
                        <?php echo date('F jS, Y H:i', strtotime($val['Event']['event_start'])); ?>
                    </td>
                    <td>
                        <?php echo date('F jS, Y H:i', strtotime($val['Event']['event_end'])); ?>
                    </td>


                    <td>
                        <ul class='rowActions'>
                            <li>
                                <a href='#' class='inlineIcon preferences edit_event'>Edit</a>
                            </li>
                             <li>
                            <?php if($val['Event']['event_archive_status']=='true'){ ?>
                             Archived                         
                            <?php }else if($val['Event']['event_archive_status']=='false'){ ?>
                           <a href='#' class='inlineIcon preferences iconDelete del_event'>Archive</a>

<?php } ?>
 </li> 
 <!--
<li>
                                <a href='#' class='inlineIcon preferences iconDelete dwl'>Dwld</a>
                            </li> 
-->

                        </ul>
                    </td>
                    <td></td> <td></td> <td></td>
                </tr>
                <?php $row_color++;
            } ?>
             <?php /** if($row_color==0) { ?>
           <tr id="page_div" style="font-weight:bolder !important;"><td></td> <td></td> <td>No Data</td></tr>
             <?php } **/ ?>
        </tbody>
</table>

<div id="page_div">
<?php 

echo $this->Paginator->first('< first ',array('class'=>'pglink'),null,array('class'=>'pglink'));
echo $this->Paginator->prev('<< previous ',array('class'=>'pglink'),null,array('class'=>'pglink'));
echo $this->Paginator->next('next >> ',array('class'=>'pglink'),null,array('class'=>'pglink'));
echo $this->Paginator->last('last > ',array('class'=>'pglink'),null,array('class'=>'pglink'));
?>
</div>
