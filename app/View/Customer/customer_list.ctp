<table cellspacing='0' summary=''>
 <thead>
            <tr>
              <th class="sortup">
                  Name
                </th>
                <th class="sortup">
                    Email
                </th>
                <th class="sortup">
                    Cell
                </th>
                <th>
               Category
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
            foreach ($Suppliers as $val) { ?>

                <tr id="<?php echo $val['Supplier']['id'] ?>" class='<?php echo ($row_color % 2 == 0) ? "even" : "odd"; ?>'>
               

<td>
                        <?php echo $val['Supplier']['fname']; ?>

                    </td>
                    <td>
                        <?php echo $val['Supplier']['email']; ?>

                    </td>
                    <td>
                        <?php echo $val['Supplier']['cell_number']; ?>

                    </td>
               
                    <td>
                        <?php echo $val['Category']['long_name']; ?>
                    </td>
             



                    <td>
                        <ul class='rowActions'>
                            <li>
                                <a href='#' class='inlineIcon preferences edit_cust'>Edit</a>
                            </li>


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
