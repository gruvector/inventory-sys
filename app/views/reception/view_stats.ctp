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
                <a href='' class='inlineIcon iconWebsiteAdd'>Add New Region</a>
            </li>
            <li class='inactive activeIfSelected'>
                <a id='deleteSelection' href='#' class='inlineIcon iconDelete'>Delete</a>
                
              
                
            </li>
        </ul>

                

        <div class='clear'></div>
        <div class='corner left'></div>
        <div class='corner right'></div>
    </div>


    <table cellspacing='0' summary=''>
        <thead>
            <tr>
              <th class='first toggleAll'>
                    <input type='checkbox' />
                </th>
                <th class="sortup">
                    Short Name
                </th>
                  <th  >
                 Long Name
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
   
          
             
           </tbody>

    </table>
</div>





  
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
                
                //-->
                </script>