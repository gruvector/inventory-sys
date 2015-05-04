/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){

    product.init();
    transaction=new Transaction();
})


//this object  is to be used to represent a generic sale/receivable/invoice
//there must be a type 
//this is the Transaction object
function Transaction(){
	
    //below three attributes are properties of a  current transaction	
    //not all attributes of a transaction will be used depending on the transaction type
    this.total_transaction=0;
    this.amount_paid=0;
    this.amount_balance_due=0;
    this.transaction_items=[];
    this.transaction_type="def";//can be either sale/receivable/invoice	



    //this is for resetting transaction  items
    this.resetSale=function(){
        this.transaction_items=[];
        this.amount_paid=0;
        this.amount_balance_due=0;
        this.total_transaction=0;
	
    };
    //this is for adding an item to the transaction list
    this.addItem=function(Item){
	
        this.total_transaction=this.total_transaction+(Item.getUnitPrice*Item.quant_sale);	
        this.transaction_items.push(item);
    };

    //this is for removing an item from a transaction 
    this.removeItem=function(itemId){
        for (var i=0;i<this.transaction_items.length;i++){
            if(this.transaction_items[i].id==itemId)
            {
                this.total_transaction=this.total_transaction-(this.transaction_items[i].getUnitPrice*this.transaction_items[i].quant_sale);	
                this.transaction_items.splice(i,1);
                break;

            }
        }
        return "not_found";
	
    };

    //this is for getting an item from the sales list 
    this.getItem=function(itemId){
        for (var i=0;i<this.transaction_items.length;i++){
            if(this.transaction_items[i].id==itemId)
            {
                return this.transaction_items[i];
                break;

            }
        }
        return "not_found";
    };	 


}


//this is an object for an item which will be bought
function Item(id,unit_price,stock_avail,name){

    this.id=id;
    this.unit_price=unit_price;
    this.quant_sale=0;
    this.stock_avail=stock_avail;
    this.expiry_date_item="Nan";//this is for when an item may possiblly have an expiry date
    this.item_batch="Nan";//has to be calculated on the client side 
    this.name=name;
    this.cost=this.unit_price*this.quant_sale;
    this.new_stock=this.stock_avail-this.quant_sale;

    //for  getting unit_price
    this.getUnitPrice=function(){
        return this.unit_price;
    };
    //for getting stock available
    this.getStockAvail=function(){
        return this.stock_avail-this.quant_sale;
    };
    //for getting new cost of transaction for that particular item for the transaction
    this.getCost=function(){
        return this.unit_price*this.quant_sale;
    };
    
    //this is  for gettng the new stock available for that particular item for the transaction
    this.getNewStock=function(){
        return this.stock_avail-this.quant_sale;
    };
    //this is for setting the quantity which will be sold for this transaction
    //shouldent be more than the stock available
    this.setQuant=function(quant_sale){
        if(quant_sale < 0 || quant_sale > this.stock_avail || parseInt(quant_sale)==""){
	
            //alert("Please Enter Correct Quantity."+"Quantity Should Be More Than 0 And Less Than Or Equal To Quantity Available");
            return "false";
        }
        else{
            this.quant_sale=quant_sale;			
        }
    };

	
}




//this is the main product object which is responsible for handling all product stuff
//this includes a lot of stuff i will talk about later . when the time is right 


var product={
    current_stock:0,
    item_table:("#sales_info tbody"),
    
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
    
    //this is for initializing the chosen jquery variable
    
    
    init_chosen:function(){
			
        
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
    
    //this is for adding an item to the  transaction object
    //if the item does not exist an exception is returned
    add_model:function(itemId,unit_price,stock_avail,name){
        _this=this;
        var result=transaction.getItem(itemId);
        if(result=='not_found')
        {
            item= new Item(itemId,unit_price,stock_avail,name);
            transaction.addItem(item) ;  
            return item ;
        }
        else{          
            return "error_duplicate";
        }
  
  
  
    }, 
    //this is for editing the  model
    edit_model:function(itemId){
       
    },
 
    error_model:function(message){
        _this=this;  
        // alert(message);
        switch(message) {
            case "error_duplicate":
                alert ("Item Aready Exists In Sale List.Please Edit Below");
                break;
            default:
                alert(message);
        }
      
      
    },
    
    //this is for updating the interface
    add_interface:function(item){
        
        
        _this=this;
        var new_item= _this.build_item(item);
        $(product.item_table).append(new_item);
    },
    
    //this is for building an item object 
    build_item:function(item){
        _this=this;

        //this is the main table row which will hold each item
        var tr_all=document.createElement("tr");
        $(tr_all).attr("data-id",item.id);
     
        //this will hold the item name
        var td_item=document.createElement("td");
        $(td_item).attr("class","item_name");
        $(td_item).html(item.name);
       
        //this will hold the stock available for that item
        var td_cstock=document.createElement("td");
        $(td_cstock).attr("class","item_stock_avail");
        $(td_cstock).html(item.stock_avail);
       
        //this will hold the unit price for that item
        var td_unit_price=document.createElement("td");
        $(td_unit_price).attr("class","unit_price");
        $(td_unit_price).html(item.unit_price);
        
        //this will hold the quantity for sale for that item 
        //thid defaults to the item quantity avaialable for the item
        var td_quant_id=document.createElement("td");
        var td_quant_sale=document.createElement("input");
        $(td_quant_sale).attr("type","number");
        $(td_quant_sale).attr("class","item_for_sale quant_sale");
        $(td_quant_sale).val(item.quant_sale);
        $(td_quant_id).append(td_quant_sale);
        
        
        //this will hold the cost for the transaction
        var td_cost=document.createElement("td");
        $(td_cost).attr("class","cost");
        $(td_cost).html(item.unit_price*item.quant_sale);
        
        //this will hold the new stock for the transaction
        var td_new_stock=document.createElement("td");
        $(td_new_stock).attr("class","new_stock");
        $(td_new_stock).html(item.new_stock);
        
        var empty_td=document.createElement("td");
        
        var remove_td=document.createElement("td");
        var remove_link=document.createElement("a");
        $(remove_link).attr("class","inlineIcon preferences iconDelete remove_item");
        $(remove_link).attr("href","#");
        $(remove_link).html("Remove");
        $(remove_td).append(remove_link);
        
        
        $(tr_all).append(td_item).append(td_cstock)
        .append(td_unit_price).append(td_quant_id)
        .append(td_cost).append(td_new_stock)
        .append(empty_td).append(remove_td);
        return tr_all ;
    },   
    
    //this is for editing the interface 
    //edit of the interface results in the model data being edited first 
    //item is an input parameter
    edit_interface:function(item){
        _this=this;   
        
        var tr_table =  $(product.item_table).find("tr[data-id="+item.id+"]");
        //$(tr_table).find(".item_stock_avail").html(item.getStockAvail());
        $(tr_table).find(".cost").html(item.getCost());
        $(tr_table).find(".new_stock").html(item.getNewStock());

    },
    
    
    //this is for errors which may be associated with interface functionality
    error_interface:function(message){
        
        switch(message) {
            case "error_stock":
                alert ("Stock/Item Has Issue .Please Check Item/Stock Value");
                break;
            default:
                alert(message);
        }
        
    },
    
  
   
    init:function(){
        var _this=this;
        _this.load_prod(product.load_url);

        $("#search_item").live('change',function(){
            
            var stock      = parseInt($('option:selected', this).data('stock'));
            var unit_price = parseFloat($('option:selected', this).data('unit_price'));
            var name =$('option:selected', this).data('name');
            var itemId =$('option:selected', this).val(); 

            if (stock==0){
                _this.error_interface(" Stock Of "+name+" Is "+stock+" Please Restock ");

            //   alert(" Stock is "+stock+" Please Restock ");
            }
            else if( stock=="" || itemId=="" || unit_price==""){
                _this.error_interface("error_stock");
            //alert ("Stock/Item is Unknown .Please Check Item/Stock Value");

            } 
            else{
                //alert(stock+"--"+unit_price+"--"+itemId) ;
                var item=_this.add_model(itemId,unit_price,stock,name);  
                if (item=="error_duplicate"){
                    _this.error_model("error_duplicate");             
                }else{
                    _this.add_interface(item);

                }
            }
   
        // var stock = parseInt($('#search_item option:selected').data('stock'));
    			
        });
        
        //this is where all the fun modification will begin 
        //will have a ripple effect on the model and the interface 
        $(".item_for_sale").live('keyup',function(){
            
            var itemId=$(this).closest("tr").data('id');
            var item= transaction.getItem(itemId);
            if(item=="not_found")
            {
                _this.error_model("Item Not Found");
            }else{     
                var return_msg=item.setQuant($(this).val());
                if(return_msg=="false"){  
                    _this.error_model("Stock You Want To Sell Isnt Avaialable");

                //  console.log(transaction.getItem(itemId));
                }else
                {
                    _this.edit_interface(item);
    
                }
            }
        })
        
        
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
                transaction.transaction_type="sale"

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
                        transaction.transaction_type="def";
                        transaction.resetSale();
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

        /*   
         *            below is for building the item interface 
         *                     
         *                                       <tr>
	   <td>Item</td>
	   <td>Current Stock</td>
	   <td>Unit Price</td>
	   <td><input type="number" value="7" required />Quantity</td>
	   <td>Cost</td>
	   <td>New Stock</td>
	   <td></td>
      <td><a href="#" class="inlineIcon preferences iconDelete remove_item">Remove</a></td>
      </tr>
                item= new Item(itemId,unit_price,stock_avail,name);
     *
     *  */   