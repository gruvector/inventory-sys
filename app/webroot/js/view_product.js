/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){

    product.init();
})



//this is the Sale object
function Sale(){
	
//below three attributes are properties of a  current sale	
	this.total_transaction=0;
	this.amount_paid=0;
	this.amount_balance_due=0;
	this.sale_items=[];	 	


//this is for resetting sales items
this.resetSale=function(){
	this.sale_items=[];
	this.amount_paid=0;
	this.amount_balance_due=0;
	this.total_transaction=0;
	
}
//this is for adding an item to the sales list
this.addItem=function(Item){
	
	this.total_transaction=this.total_transaction+(Item.getUnitPrice*Item.quant_sale);	
	this.sale_items.push(item);
};

//this is for removing an item from a sale 
this.removeItem=function(itemId){
	for (var i=0;i<this.sale_items.length();i++){
    if(this.sale_items[i].id==itemId)
    {
	   this.total_transaction=this.total_transaction-(this.sale_items[i].getUnitPrice*Item.quant_sale);	
	   this.sale_items.splice(i,1);
	   break;

	}
	}
	return "not_found";
	
}

//this is for getting an item from the sales list 
this.getItem=function(itemId){
	for (var i=0;i<this.sale_items.length();i++){
   if(this.sale_items[i].id==itemId)
   {return this.sale_items[i];
	   break;

	}
	}
	return "not_found";
};	 


}


//this is an object for an item which will be bought
function Item(id,unit_price,stock_avail){

this.id	=id;
this.unit_price=unit_price;
this.stock_avail=stock_avail;
this.quant_sale=stock_avail;

//for  getting unit_price
this.getUnitPrice=function(){
	return this.unit_price;
};
//for getting stock available
this.getStockAvail=function(){
	return this.unit_price;
}
	
//this is for setting the quantity which will be sold for this transaction
//shouldent be more than the stock available
this.setQuant=function(quant_sale){
	if(quant_sale < 0 || quant_sale > this.stock_avail || parseInt(quant_sale)==""){
	
	alert("Please Enter Correct Quantity."+
	"Quantity Should Be More Than 0 And Less Than Or Equal To Quantity Available");
	return;
	}
	else{
    this.quant_sale=quant_sale;			
	}
};

	
}







var product={
    current_stock:0,
    
    load_url:$("#product_list_url").val(),
    
    load_prod:function(page_link){
        
        var val = $("#search_prod").val();

        
        $.ajax({
            url: page_link,
            dataType:'html',
            data: val!="" ? "filter="+val : "filter=null",
            success:function(data) {
                //  console.log(data);
                //  alert("data has been loaded");
                $("#table_info").html(data);
            },
            error:function(data){
          
            }
        }) 
        
    }, 
    //this is the main init function
    check_stock:function(){
        
        if(isNaN($(".astock").val())==false){
            var old_stock=parseInt($(".ostock").val(),10);
            var added_stock=parseInt($(".astock").val(),10); 
            var new_stock=0;
            
            
            if(($(".ttype").val()=="sale" || $(".ttype").val()=="removal")&& added_stock!="" )     
            {    
                new_stock=old_stock-added_stock;
                $(".nstock").val(new_stock) ;  
            }
            else if (($(".ttype").val()=="restock")&& added_stock!=""){
                new_stock=old_stock+added_stock;
                $(".nstock").val(new_stock); 
   
            }
            else if( added_stock==""){
                $(".nstock").val("");   
 
            }
        }
        else if(isNaN($(".astock").val())==true){
            $(".nstock").val("unknown") 
        }
        
        $("#add_stock_form.cmxform input[type=text]").each(function(){
            if($(this).val()=="")
            {
                $(this).css("border","solid #F44 2px");              
            }
            else{
               
                $(this).css("border","solid grey 1px");       
            
            } 
        });
        
        
        

    },
    
	init_chosen:function(){
		
		$("#search_item").change(function(){
			alert("change has been called"+ $(this).val());
    			
		})
		
		      $("#search_item").chosen();
			  /*
		 var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:false},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    };
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
	**/
	},
    
    init:function(){
        var _this=this;
        product.load_prod(product.load_url);

        
        $("a.pglink").live('click',function(e) {
            e.preventDefault();
            var link=$(this).attr('href');
            product.load_prod(link);  
        });
       
        $("#search_prod").keyup(function(e) {
            if(e.which==13){
                product.load_prod(_this.load_url);
                
            }
        }); 
       
        $(".astock").live('keyup',function(e) {
            //  alert("checking");
            //   return;

            e.preventDefault(); 
            product.check_stock();
           /// alert("old stock is --"+ $(".ostock").val()+"\n"+"added stock is "+$(".astock").val());

        });
        
        $(".ttype").live('change',function(e) {
            //  alert("checking");
            e.preventDefault(); 

            product.check_stock();
        });
        
        $("#add_product_form").live('submit',function(event){
            
            event.preventDefault(); 
            //alert("test");          
          /**
            if(isNaN($(".stock_available").val())==true){
                $(".stock_available").css("border","solid #F44 2px");
            }
            else {
                $(".stock_available").css("border","solid grey 1px");    
  
            }
            if(isNaN($(".cost_price").val())==true){
                $(".cost_price").css("border","solid #F44 2px");
            }
            else {
                $(".cost_price").css("border","solid grey 1px");    
  
            }
            if(isNaN($(".selling_price").val())==true){
                $(".selling_price").css("border","solid #F44 2px");
            }
            else {
                $(".selling_price").css("border","solid grey 1px");    
  
            }
            
            if(isNaN($(".quantity_crate").val())==true){
                $(".quantity_crate").css("border","solid #F44 2px");
            }
            else {
                $(".quantity_crate").css("border","solid grey 1px");    
  
            }
            **/
            //  stock_available,selling_price,cost_price
            product.checkfields();
            
        });
        
        
        //this is used for editing stock
        $(".edit_stock").live('click',function(e){
            e.preventDefault();
            var data="id="+$(this).closest("tr").attr("id")+"&edit_stock=true";  
            var title="Edit Stock";
            $("body").find("#edit_stock_product").remove();
            var $dialog = $("<div id='edit_stock_product' ></div>")
            .load($("#stock_edit_url").val(),data,function(rdata){
                })
            .dialog({
                autoOpen: false,
                title:title,
                width: 500,
                height: 400,
                position:"center",
                modal:false,
                buttons: {
                    "Save": function() {
                        var counter=0;
                        var _this=this;
                        $("#add_stock_form.cmxform input[type=text]").each(function(){
                            if($(this).val()=="")
                            {
                                $(this).css("border","solid #F44 2px");              
                                counter++;
                            }
                            else{
               
                                $(this).css("border","solid grey 1px");       
            
                            } 
                        });
                        if(counter==0)
                        {
                            product.save_stock();
                        }                     
                    },
                    "Cancel": function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
            $dialog.dialog('open');
        });
        
        
		
		
		//this is for adding or editing 
	$("#add_sales,#add_recv").live('click',function(e) {
		        e.preventDefault();
				var title ="";
               if($(this).attr("id")=="add_sales"){
	           title="New Sales";
			   }	     
			 else if($(this).attr("id")=="add_recv"){
			   title="New Receivables";

			 }
		
			 
            var $dialog = $("<div></div>")
            .load($(this).attr('href'),function(rdata){
		     product.init_chosen();

                })
            .dialog({
                autoOpen: false,
                title:title,
                width: 700,
                height: 400,
                position:"center",
                modal:false,
                buttons: {
                    "Save": function() {
						     //$( this ).dialog( "close" );
                    },
                    "Cancel": function() {
						     $( this ).dialog( "close" );
							 $(this).dialog('destroy').remove()

                    }
                }
            });	
			  $dialog.dialog('open');

	});

		
		
        
		
		//this is for adding or editing products
        $("#add_prod,.edit_prod").live('click',function(e) {
            e.preventDefault();
            
            if($(this).hasClass('edit_prod')){
                var data="id="+$(this).closest("tr").attr("id")+"&edit_prod=true";
            }else{
                var data="";
            }
            
            
            var title="Add/Edit Product";
            var $dialog = $("<div></div>")
            .load($("#add_prod").attr('href'),data,function(rdata){
                })
            .dialog({
                autoOpen: false,
                title:title,
                width: 500,
                height: 300,
                position:"center",
                modal:false,
                buttons: {
                    "Save": function() {
                        $("#add_product_form").submit();    
                    },
                    "Cancel": function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
            $dialog.dialog('open');
     
        });     
        
     
    } ,
    checkfields:function()
    {
           
        var counter=0;
        var _this=this;
        $("#add_product_form.cmxform input[type=text],#add_product_form.cmxform  textarea,#add_product_form.cmxform input[type=email]").each(function(){
            if($(this).val()=="")
            {
                $(this).css("border","solid #F44 2px");              
                counter++;
            }
            else{
               
                $(this).css("border","solid grey 1px");       
            
            } 
        });
        
        /** $(".check").each(function(){
            if(isNaN($(this).val())==true){
                $(this).css("border","solid #F44 2px");
                counter++;
            }
            else {
                $(this).css("border","solid grey 1px");    
  
            }
        })**/
        
        if(counter==0)
        {
            product.save_data();
        }
       
    },
    save_data:function(){
        
        var _this=this;
        var formurl=$("#product_add_url").val();
        var formdata=$("#add_product_form.cmxform").serialize()+"&save_prod=true";      
        $.ajax({
            url: formurl,
            data:formdata,
            type: 'GET',
            dataType:'json',
            success:function(data) {
               
                if(data.status=="1")          
                {
                    $(".ui-dialog-content").dialog("close");
                    product.load_prod(product.load_url);
                    

                }
            },
            error:function(data){
          
            }
        })
        
    },
    
    
    save_stock:function(){
        
        var _this=this;
        var formurl=$("#stock_edit_url").val();
        var formdata=$("#add_stock_form.cmxform").serialize()+"&save_stock=true";      
        $.ajax({
            url: formurl,
            data:formdata,
            type: 'GET',
            dataType:'json',
            success:function(data) {
               
                if(data.status=="1")          
                {
                    $(".ui-dialog-content").dialog("close");
                    // $(".ui-dialog-content").dialog("destroy");

                    product.load_prod(product.load_url);
                   

                }
            },
            error:function(data){
          
            }
        })
        
    }

}