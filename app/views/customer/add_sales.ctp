<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 


<style>
    div.tableWrapper li {
        width: 150px !important;
    }   
</style>
 */
 
 ?>
 
 <style>
 <!--
 #search_item {
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
}-->
.search_ul{

}
 </style>
 
<form name="add_sales_form" id="add_sales_form" class="cmxform" action="<?php echo $html->url(array('controller' => 'Customer', 'action' => 'add_sales')); ?>">
    <div class='tableWrapper' style="width: 100% !important;">
        <div class='tableHeader' style="border: 0px !important;">
            
          
            <ul class="tableActions search_ul" style="margin-bottom: 15px;">
                <li>
                    <label> </label> 
                </li>
                <li>
				   <li>
          
				<select name="search_item" id="search_item" data-placeholder="Search Sales Item/s ..." style="display:none;" class="chosen-select"  tabindex="-1">
	<option value=""><option>
			  <?php foreach($products as $cat_prod) { ?>
             <option
			 stock="<?php echo $cat_prod['Product']['stock_available']; ?>"
			 unit_price="<?php echo $cat_prod['Product']['selling_price']; ?>"
			 value="<?php echo $cat_prod['Product']['id']; ?>"><?php echo $cat_prod['Product']['product_name']; ?></option>
			  <?php  } ?>
          </select>
				
				
            </li>
                </li>
            </ul>
       
            <ul class='tableActions'>
          
            </ul>
         
            <ul class='tableActions ' style="width: 100%;">

			
			<div name="sales_info" id="sales_info" style="width: 100%;">
            <table cellspacing="0" summary="">

            <thead>
           <th class="sortup">
                Item
            </th>
			<th class="sortup">
                Current Stock
            </th>
			<th >
                Unit/Price
            </th>
			<th >
              Quantity 
            <th >Cost </th>
			<th >New Stock </th>
				
			<th ></th>
				<th class="sortup"></th>
			</thead>
			<tbody>
			<tr><td>Riceadsfdsfd</td><td>50</td><td>4</td><td><input type="number" value="7" required /></td><td>28</td><td>22</td><td></td>
			<td>
			<a href="#" class="inlineIcon preferences iconDelete remove_item">Remove</a>
			</td>
			</tbody/>
			</table>
            </ul>


            <ul class='tableActions'>
                <li>
                    <label>  </label> 
                </li>
                <li>
                </li>



            </ul>



            <div class='clear'></div>
            <div class='corner left'></div>
            <div class='corner right'></div>
        </div>

    </div>

</form>


