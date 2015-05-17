<table cellspacing='0' summary=''>
    <thead>
        <tr>

            <th class="sortup">
               Name
            </th>
            <th class="sortup">
              Stock
            </th>
 <th class="sortup">
              Quant/Batch
            </th>
 <th class="sortup">
              Batch/Avl
            </th>
 <th class="sortup">
             Rmd
            </th>
            <th> Category </th>

            <th > Cost Pr</th>
            <th  >
Selling Pr
            </th>
            <th class='last alignRight'>

            </th><th></th><th></th><th></th>
        </tr>
    </thead>


    <tbody>
        <?php
        $row_color = 0;
        foreach ($prods as $val) {
            ?>

            <tr id="<?php echo $val['Product']['id'] ?>" class='<?php echo ($row_color % 2 == 0) ? "even" : "odd"; ?>'>


                <td>
                    <?php echo $val['Product']['product_name']; ?>

                </td>
                <td>
                    <?php echo $val['Product']['stock_available']; ?>

                </td>
<td>
                    <?php echo $val['Product']['quantity_crate']; ?>

                </td>
<td>
                    <?php  echo ($val['Product']['stock_available']==0)? 0 :floor($val['Product']['stock_available']/$val['Product']['quantity_crate']); ?>

                </td>

      <td>
 <?php echo $val['Product']['stock_available']%$val['Product']['quantity_crate']; ?>
</td>

  <td>
                    <?php echo $categories[$val['Product']['category_product']]; ?>

                </td>
                <td>
                    <?php echo $val['Product']['cost_price']; ?>

                </td>
  <td>
                    <?php echo $val['Product']['selling_price']; ?>

                </td>


                <td>
                    <ul class='rowActions'>
               

<?php
  if (isset($_SESSION['role_short_array']) && (
                            in_array('SADM', $_SESSION['role_short_array']) ||
                            in_array('ADM', $_SESSION['role_short_array'])

                            )
                    ) {

?>

         <li>

                            <a href='#' class='inlineIcon preferences edit_prod'>Edit</a>

                       
 </li>
<?php
}

?>


                          <li>
                           <!-- <a href='#' class='inlineIcon preferences edit_stock'>Add/Remove Stock</a>-->
                           <!-- <a href='#' class='inlineIcon preferences edit_stock'>Make Sales</a>-->

                        </li>

                    </ul>
                </td>
                <td></td> <td></td> <td></td>
            </tr>
            <?php
            $row_color++;
        }
        ?>
        <?php /** if($row_color==0) { ?>
          <tr id="page_div" style="font-weight:bolder !important;"><td></td> <td></td> <td>No Data</td></tr>
          <?php } * */ ?>
    </tbody>
</table>

<div id="page_div">
    <?php
    echo $this->Paginator->first('< first ', array('class' => 'pglink'), null, array('class' => 'pglink'));
    echo $this->Paginator->prev('<< previous ', array('class' => 'pglink'), null, array('class' => 'pglink'));
    echo $this->Paginator->next('next >> ', array('class' => 'pglink'), null, array('class' => 'pglink'));
    echo $this->Paginator->last('last > ', array('class' => 'pglink'), null, array('class' => 'pglink'));
    ?>
</div>
