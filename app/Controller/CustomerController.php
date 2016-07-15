<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class CustomerController extends AppController {

    public $name = 'Customer';
    public $helpers = array('Html','Form','Session');
    public $components = array('RequestHandler', 'Session');
    public $uses = array("ReverseReason", "Invoice", "Sale", "Receipt", "Taxe", "Supplier", "Category", 'Site', 'Product', 'ProductTransaction');
    public $layout = 'dashboard';

    //var $transaction_timestamp = ;

    public function beforeFilter() {
        parent::beforeFilter();
    }

    //this is for viewing customers
    public function view_cust() {
        $layout_title = "View Suppliers";
        $this->set
                (compact('layout_title'));
    }

    //this is for viewing categoriee
    public function view_cat() {
        $layout_title = "View Category";
        $this->set
                (compact('layout_title'));
    }

    //this is for viewing customer list
    public function customer_list($paginate_link = null) {

        $this->autoLayout = false;

        $filter = isset($_GET['filter']) && $_GET['filter'] != "null" ? $_GET['filter'] : "";

        $conditions_array = array(
            'Supplier.inst_id' => $this->Session->read('inst_id'),
            'Supplier.site_id' => $this->Session->read('site_id'),

            'OR' => array(
                'Supplier.email LIKE' => "%" . $filter . "%",
                'Supplier.cell_number LIKE' => "%" . $filter . "%",
                'Supplier.fname LIKE' => "%" . $filter . "%",
                'Site.site_name LIKE' => "%" . $filter . "%",
                'Category.long_name LIKE' => "%" . $filter . "%"
                ));

        if ($paginate_link != null) {

            $page_array = explode($paginate_link, ":");
            $this->paginate = array(
                'Supplier' => array(
                    'conditions' => $conditions_array,
                    'contain' => array('Category', 'Site'),
                    'order' => array('Supplier.id' => 'desc'),
                    'page' => $page_array[1],
                    'limit' => 10));


            $Suppliers = $this->paginate('Supplier');
        } else {
            $this->paginate = array(
                'Supplier' => array(
                    'conditions' => $conditions_array,
                    'contain' => array('Category', 'Site'),
                    'order' => array('Supplier.id' => 'desc'),
                    'limit' => 10));
            $Suppliers = $this->paginate('Supplier');
        }


        $this->set(compact('Suppliers'));
    }

    //this is for adding customer
    public function add_customer() {
        $this->autoLayout = false;

        if (isset($_GET['save_cust'])) {
            $cust_data = $_GET['data']['Supplier'];
            $cust_data['inst_id'] = $this->Session->read('inst_id'); 
            $cust_data['site_id'] = $this->Session->read('site_id'); 

            $this->Supplier->save($cust_data);
            echo json_encode(array("status" => "1"));
            exit();
        } else if (isset($_GET['edit_cust'])) {
            $id = $_GET['id'];
            $categories = $this->Category->find("all", array('recursive' => '-1', "all", 'conditions' => array('Category.inst_id' => $this->Session->read('inst_id')), "fields" => array("id", "long_name")));
            $sites = $this->Site->find("all", array('recursive' => '-1', 'conditions' => array('Site.site_inst_id' => $this->Session->read('inst_id'))));
            $Supplier = $this->Supplier->find('first', array('conditions' => array('Supplier.id' => $id)));
            $this->set(compact('categories', 'sites', 'Supplier'));
        } else {
            $categories = $this->Category->find("all", array("all", 'conditions' => array('Category.inst_id' => $this->Session->read('inst_id')), "fields" => array("id", "long_name")));
            $sites = $this->Site->find("all", array('recursive' => '-1', 'conditions' => array('Site.site_inst_id' => $this->Session->read('inst_id'))));

            $this->set(compact('categories', 'sites'));
        }
    }

    //this is for adding sales 
    //products are divided up into categories for easier selection
    public function add_sales() {

        $this->autoLayout = false;
        $inst_id = $this->Session->read('inst_id');
        $site_id = $this->Session->read('site_id');

        if (isset($_GET['perform_sales'])) {
            
        } else {
            $products = $this->Product->find('all', array('recursive' => '-1',
            'conditions' => array('Product.archive_status' => '0','Product.inst_id'=>$inst_id,'Product.site_id'=>$site_id),
            'fields' => array('selling_price', 'id', 'product_name', 'category_product', 'stock_available')));
            $vat = $this->Taxe->find('first', array('recursive', 'conditions' => array('Taxe.inst_id'=>$inst_id,'Taxe.site_id'=>$site_id,'Taxe.vat_category' => 'sales')));
            $reverse = $this->ReverseReason->find('list', array('fields' => array('id', 'reason')));
            $suppliers = $this->Supplier->find('all',
             array('recursive' => '-1',
             'conditions' => array('Supplier.inst_id'=>$inst_id,'Supplier.site_id'=>$site_id)));
            $this->set(compact('categ', 'suppliers', 'reverse', 'categories', 'products', 'vat'));
        }
    }

    //this is for adding new receivables
    public function add_recv() {

        $this->autoLayout = false;
        $inst_id = $this->Session->read('inst_id');
        $site_id = $this->Session->read('site_id');

        if (isset($_GET['perform_recv'])) {
            
        } else {
            
        }
    }

    //this is for deleting customers 
    public function del_customer() {

        $id = $_GET['id'];
        $conditions = array('Supplier.id' => $id);
        $this->Supplier->deleteAll($conditions);
        echo json_encode(array("status" => "1"));
        exit();
    }

    //this is for adding categories
    public function add_cat() {
        $this->autoLayout = false;

        if (isset($_GET['save_cat'])) {
            $cat_data = $_GET['data']['Category'];
            $cat_data['inst_id'] = $this->Session->read('inst_id');
            $cat_data['site_id'] = $this->Session->read('site_id');

            $this->Category->save($cat_data);
            echo json_encode(array("status" => "1"));
            exit();
        } else if (isset($_GET['id']) && $_GET['edit_cat'] == 'true') {

            $id = $_GET['id'];
            $cat = $this->Category->find("first", array("conditions" => array("Category.id" => $id)));
            $this->set(compact('cat'));
        } else {
            // echo "Current Site--".Configure::read("inst_id");
        }
    }

    //this is for  viewing the categories list
    public function cat_list($paginate_link = null) {

        $this->autoLayout = false;

        $filter = isset($_GET['filter']) && $_GET['filter'] != "null" ? $_GET['filter'] : "";



        $conditions_array = array(
            'Category.inst_id' => $this->Session->read('inst_id'),
            'Category.site_id' => $this->Session->read('site_id'),

            'OR' => array(
                'Category.long_name LIKE' => "%" . $filter . "%"
                ));

        if ($paginate_link != null) {

            $page_array = explode($paginate_link, ":");
            $this->paginate = array(
                'Category' => array(
                    'conditions' => $conditions_array,
                    'order' => array('Category.id' => 'desc'),
                    'page' => $page_array[1],
                    'limit' => 10));


            $cats = $this->paginate('Category');
        } else {
            $this->paginate = array(
                'Category' => array(
                    'conditions' => $conditions_array,
                    'order' => array('Category.id' => 'desc'),
                    'limit' => 10));
            $cats = $this->paginate('Category');
        }


        $this->set(compact('cats'));
    }

    public function view_products() {

        $layout_title = "View Products";
        $this->set(compact('layout_title'));
    }
    
    public function view_products_back() {

        $layout_title = "View Products";
        $this->set(compact('layout_title'));
    }
    
    public function view_products_merc() {

        $layout_title = "View Products";
        $this->set(compact('layout_title'));
    }

    //this is for adding new products to the inventory system
    public function add_product() {
        $this->autoLayout = false;
        $inst_id = $this->Session->read('inst_id');
        $site_id = $this->Session->read('site_id');
        $memberdata = $this->Session->read('memberData');
        $conditions_array = array(
            'Category.inst_id' => $this->Session->read('inst_id'),
            'Category.site_id' => $this->Session->read('site_id')
            );
      

        if (isset($_GET['save_prod'])) {
            $prod_data = $_GET['data']['Product'];
            $prod_data['inst_id'] = $this->Session->read('inst_id');
            $prod_data['site_id'] = $this->Session->read('site_id');
            $prod_data['user_id'] = $memberdata['User']['id'];


            if ($prod_data['id'] == "") {
                $prod_data['date_created'] = date('Y-m-d H:i:s');
            }
            $this->Product->save($prod_data);
            echo json_encode(array('status' => 1));
            exit();
        } else if (isset($_GET['edit_prod'])) {
            $id = $_GET['id'];
            $product = $this->Product->find('first', array('conditions' => array('Product.id' => $id)));
            $categories = $this->Category->find('list', array(
            'conditions'=>$conditions_array,
            'fields' => array('id', 'long_name')));
            $this->set(compact('inst_id', 'site_id', 'categories', 'product'));
        } else {	 
            $categories = $this->Category->find('list',array(
             'conditions'=>$conditions_array,
             'fields' => array('id', 'long_name')));
            $this->set(compact('inst_id', 'site_id', 'categories'));
        }
    }

    //this is for the batch addition of transaction depending on the transaction type 
    //have to recreate the object into a form in which i can understand
    //have to save up the recipt before adding it to the product transaction object
    //have to fix up the saveMany and also fix up the autocommit stuff!!!
    //i may be on my way after that 
    //receipt has to be added to the whole system . 
    //code has to be also added to see the differnece between different transaction types
    //i have to edit hte front end so the same datatype is sent for single transactions
    // work on receipts printing ,add pagination,stock updates .. part 1 will be done by then  
    //
   //sales-- receipt,decrease in stock,precalculated effect on sales record
    //rec--   no receipt(invoince),increase rather than decrease in stock, precalculated effect on sale record
    //invoince --no receipt,no effect on stock ,no effect stock, precalculated normal effect on sales record 
    ///total sale  rcord  shouldent be calculated from client 
    //reversal is similar tosales but  is a combination of 
    //should be  calculated from d from server side 
//ideally corect costs for each  for each of the items should be recalculated
    /**
     */
    public function batch_transaction() {

        $this->autoLayout = false;
		//$this->autoRender = false ;
		   
   
      
        
        $transaction_object = json_decode($_POST['data']);
        $transaction_items = $transaction_object->transaction_items;


        $dataSourceProduct = $this->Product->getDataSource();
        $dataSourceSale = $this->Sale->getDataSource();
        $dataSourceProductsTransaction = $this->ProductTransaction->getDataSource();
        $dataSurceReceipt = $this->Receipt->getDataSource();

        $dataSourceProduct->begin($this->Product);
        

        if ($this->prepare_product($transaction_items, $transaction_object->transaction_type)) {

            $dataSourceSale->begin($this->Sale);
            $status = $this->save_sale($transaction_object);
            if ($status['status']) {

                //if transaction is a sale a receipt is created is made based on the item type before commit is made
                //if transaction isnt a receipt the transactin is commited at once without the receipt type
                if ($transaction_object->transaction_type == "add_sales") {
                    $dataSurceReceipt->begin($this->Receipt);
                    //    public function prepare_receipt($receipt_type,$amount_paid,$amount_paid_prev, $sale_id, $balance_due) {
                    //$recpt_type = "other";

                    if ($transaction_object->amount_paid > 0 && $transaction_object->amount_paid < $transaction_object->rtotal_transaction) {
                        $recpt_type = "part_pay";
                    } else if ($transaction_object->amount_paid > 0 && $transaction_object->amount_paid == $transaction_object->rtotal_transaction) {
                        $recpt_type = "full_pay";
                    } else if ($transaction_object->amount_paid > 0 && $transaction_object->amount_paid > $transaction_object->rtotal_transaction) {
                        $recpt_type = "excess";
                    } else if ($transaction_object->amount_paid == 0) {
                        $recpt_type = "pending";
                    }
                    $rec_status = $this->prepare_receipt($recpt_type, $transaction_object->amount_paid, $transaction_object->amount_paid, $status['sale_id'], $transaction_object->amount_balance_due);
                    if ($rec_status['status']) {

                        $dataSourceProductsTransaction->begin($this->ProductTransaction);
                        $sale_status = $this->save_product_tran($status['sale_id'], $transaction_items, $transaction_object->transaction_type, $rec_status['rec_id']);
                        if ($sale_status) {
                            $dataSourceProduct->commit($this->Product);
                            $dataSourceSale->commit($this->Sale);
                            $dataSurceReceipt->commit($this->Receipt);
                            $dataSourceProductsTransaction->commit($this->ProductTransaction);

                            /*                             * , 
                              'ProductTransaction'=>array('price','quantity',''),* */
                            $receipt_data = $this->get_receipt_print($rec_status['rec_id']);
                            echo json_encode(array('status' => 'fuck_yeah', 'message' => 'Data Saved Succesfully', 'rec_data' => $receipt_data));
                            exit();
                        }
                    } else {
                        $dataSourceProduct->rollback($this->Product);
                        $dataSourceProductsTransaction->rollback($this->ProductTransaction);
                        $dataSourceSale->rollback($this->Sale);
                        $dataSurceReceipt->rollback($this->Receipt);
                        echo json_encode(array('status' => 'shit', 'message' => 'Please Check Quantity Of Items'));
                        exit();
                    }
                } else {

                    $dataSourceProductsTransaction->begin($this->ProductTransaction);
                    $sale_status = $this->save_product_tran($status['sale_id'], $transaction_items, $transaction_object->transaction_type);
                    if ($sale_status) {
                        $dataSourceProduct->commit($this->Product);
                        $dataSourceSale->commit($this->Sale);
                        $dataSourceProductsTransaction->commit($this->ProductTransaction);
                        echo json_encode(array('status' => 'fuck_yeah', 'message' => 'Data Saved Succesfully'));
                        exit();
                    } else {
                        $dataSourceProduct->rollback($this->Product);
                        $dataSourceProductsTransaction->rollback($this->ProductTransaction);
                        $dataSourceSale->rollback($this->Sale);
                        echo json_encode(array('status' => 'shit', 'message' => 'Please Check Quantity Of Items'));
                        exit();
                    }
                }
            } else {

                $dataSourceProduct->rollback($this->Product);
                $dataSourceSale->rollback($this->Sale);
                echo json_encode(array('status' => 'shit', 'message' => 'Please Check Quantity Of Items'));
                exit();
            }
        } else {
            $dataSourceProduct->rollback($this->Product);
            echo json_encode(array('status' => 'shit', 'message' => 'Please Check Quantity Of Items'));
            exit();
        }
    }

    //this is the generic public function for getting summary of sales data given a sales id 
    public function get_sales_info($sale_id, $rec_id = null) {

        if ($rec_id !== null) {
            $conditions_array = array('Receipt.id' => $rec_id);
        } else {
            $conditions_array = array();
        }

        return $this->Sale->find('first', array('conditions' => array('Sale.id' => $sale_id),
                    'contain' => array(
                        'User' => array('fields' => array('User.fname', 'User.lname')),
                        'Receipt' => array('fields' => array('id', 'transaction_timestamp', 'amount_paid', 'balance_due'), 'conditions' => $conditions_array),
                        'ProductTransaction' => array('fields' => array('ProductTransaction.price', 'ProductTransaction.quantity'), 'Product' => array('product_name'))
                        )));
    }
// 
    public function get_sales_info_list() {
        $print_layout = "false";
        if (isset($_GET['print']) && $_GET['print'] == 'true') {
            $this->layout = "print";
            $print_layout = "true";
        } else {
            $this->autoLayout = false;
        }

        $rec_id = null;
        if (isset($_GET['rec_id'])) {
           // $sale_id = mysql_real_escape_string($_GET['id']);
           // $rec_id = mysql_real_escape_string($_GET['rec_id']);
             $sale_id = $_GET['id'];
            $rec_id = $_GET['rec_id'];
        } else if (isset($_GET['id'])) {
            //$sale_id = mysql_real_escape_string($_GET['id']);
              $sale_id = $_GET['id'];

            $rec_id = null;
        }
        $data = $this->get_sales_info($sale_id, $rec_id);
        $this->set(compact('rec_id', 'data', 'print_layout'));
    }

    public function get_print_info_list() {

        $this->layout = "print";
        $print_layout = "true";
        $layout_title = "Transaction Copy";
        $site_info = $this->Session->read('memberData');
        $rsite_info = $site_info['Site'];
        $rec_id = null;
        if (isset($_GET['rec_id'])) {
           // $sale_id = mysql_real_escape_string($_GET['id']);
          //  $rec_id = mysql_real_escape_string($_GET['rec_id']);
            $sale_id = $_GET['id'];
            $rec_id = $_GET['rec_id'];
        } else if (isset($_GET['id'])) {
            //$sale_id = mysql_real_escape_string($_GET['id']);
            $sale_id = $_GET['id'];

            $rec_id = null;
        }
        $data = $this->get_sales_info($sale_id, $rec_id);
        $this->set(compact('rec_id', 'data', 'print_layout', 'layout_title', 'rsite_info'));
    }

    //this  is for getting the information needed for printing given a receipt
    public function get_receipt_print($receipt_id) {

        return $this->Receipt->find('first', array(
                    'conditions' => array('Receipt.id' => $receipt_id), 'contain' => array(
                        'ProductTransaction' => array('fields' => array('ProductTransaction.price', 'ProductTransaction.quantity'), 'Product' => array('product_name')),
                        'Sale',
                        /* 'Sale' => array('Sale.transaction_timestamp', 'Sale.vat_per', 'Sale.total_transaction', 'Sale.vat_transaction', 'Sale.total_items', 'Sale.total_bvat', 'Sale.comment', 'Sale.total_amount_paid', 'Sale.total_balance_due'),
                         * */ 'User' => array('fields' => array('fname', 'lname'), 'Site' => array('site_name', 'address', 'city', 'email', 'phone')))));
    }

    public function get_receipt_print_json($rec_id) {
        $receipt_data = $this->get_receipt_print($rec_id);
        echo json_encode(array('status' => 'fuck_yeah', 'rec_data' => $receipt_data));
        exit();
    }

    //prepare receipt to be used for the transaction
    ////receipt type is also based on the amount the customer has paid
    ##sale_id
    ##staff_id
    ##transaction_timestamp
    ##paid_status
    ##amount_paid
    ##comment_cancelled
    ##balance_due
    ##total_amount_paid
    public function prepare_receipt($receipt_type, $amount_paid, $amount_paid_prev, $sale_id, $balance_due) {

        $receipt_data = array();
        $memberdata = $this->Session->read('memberData');

        $receipt_data['sale_id'] = $sale_id;
        $receipt_data['staff_id'] = $memberdata['User']['id'];
        $receipt_data['transaction_timestamp'] = date('Y-m-d H:i:s');
        $receipt_data['paid_status'] = $receipt_type;
        $receipt_data['amount_paid'] = $amount_paid;
        $receipt_data['balance_due'] = $balance_due;
        $receipt_data['total_amount_paid_prev'] = $amount_paid_prev;
        $receipt_data['inst_id'] = $this->Session->read('inst_id');
        $receipt_data['site_id'] = $this->Session->read('site_id');
        $this->Receipt->set($receipt_data);
        if ($this->Receipt->save()) {
            return array('status' => true, 'rec_id' => $this->Receipt->id);
        } else {
            return array('status' => false);
        }
    }

    //parse input_data .everything is recalculated 
    //unit price as well as products in stock before the transction is made
    ///this is for updating a product when a sale is made;
    public function prepare_product($products_data, $transaction_type) {

        $array_query = array();
        $prequery = "SELECT id,stock_available FROM products WHERE ";
        $query_end_test = array();
        $insert_product_query = array();

        //this part will be different depeding on the transaction type
        //sale,receivables,invoice
        ///sale=stock_available >=quant_transact
        //receivalbe=just calculate current stock and use
        //invoince =same as receivable but no  increase in stock
        //reversal.calculate current stock and use add_revr
        $query_params=array();
        foreach ($products_data as $val) {
            //$quant_transact = mysql_real_escape_string($val->quant_sale);
            
           // $id = mysql_real_escape_string($val->id);
            
            $quant_transact = $val->quant_sale;
		    $id = $val->id;

            if ($transaction_type == "add_sales") {
	       $query_params[]= $id ;
           $query_params[]=$quant_transact;
                $array_query [] = " (id = ? and stock_available >= ?)";
            } else if ($transaction_type == "add_recv" || $transaction_type == "add_inv" || $transaction_type == "add_revr") {
				$query_params[]= $id ;
                $array_query [] = "(id = ?)";
            } else {
                
            }
        }

        $prequery = $prequery . implode($array_query, 'or') . " FOR UPDATE;";
        $response = $this->Product->getDataSource()->fetchAll($prequery,$query_params);
	
	// print_r($response);
	// echo sizeof($response)."-------------";
	// exit();

        if (sizeof($response) < sizeof($products_data)) {

            return false;
        } else if (sizeof($response) == sizeof($products_data)) {


			$status_cont=true;
            foreach ($response as $val_new) {
                foreach ($products_data as $bval) {
                    if ($bval->id == $val_new['products']['id']) {

                        if ($transaction_type == "add_sales") {

                            $new_stock = $val_new['products']['stock_available'] - $bval->quant_sale;
                           // $insert_product_query[] = "WHEN id = '$bval->id' THEN '$new_stock'";
                           $stat_return=$this->update_stock($bval->id,$new_stock);
                          // exit();
                            if(!$stat_return){
								$status_cont=false;
								break;
								}
                            $bval->new_stock_product = $new_stock;
                        } else if ($transaction_type == "add_recv") {
                            $new_stock = $val_new['products']['stock_available'] + $bval->quant_sale;
                           // $insert_product_query[] = "WHEN id = '$bval->id' THEN '$new_stock'";
                           $stat_return=$this->update_stock($bval->id,$new_stock);
                            if(!$stat_return){
								$status_cont=false;
								break;
								}
                            $bval->new_stock_product = $new_stock;
                        } else if ($transaction_type == "add_inv") {
                            $new_stock = $val_new['products']['stock_available'];
                            //$insert_product_query[] = "WHEN id = '$bval->id' THEN '$new_stock'";
                            $stat_return=$this->update_stock($bval->id,$new_stock);
                            if(!$stat_return){
								$status_cont=false;
								break;
								}
                            $bval->new_stock_product = $new_stock;
                        } else if ($transaction_type == "add_revr") {
                            $new_stock = $val_new['products']['stock_available'] - $bval->quant_sale;
                            ///$insert_product_query[] = "WHEN id = '$bval->id' THEN '$new_stock'";
                          $stat_return=$this->update_stock($bval->id,$new_stock);
                            if(!$stat_return){
								$status_cont=false;
								break;
								}
                            $bval->new_stock_product = $new_stock;
                        }

                        $query_end_test[] = $bval->id;
                    }
                }
            }

       
                     
            return $status_cont;            
        
        }
    }

  /// this function is for updating stock
    public function update_stock($id_old_stock,$new_stock){
		$stock=array();
        $stock['id'] = $id_old_stock;
        $stock['stock_available'] = $new_stock;
         $this->Product->clear();
        $this->Product->set($stock);
		if($this->Product->save())
		{
			return true;
			}
			else{
			return false ;
			}
		}

    //this is the public function for saving the sale of a product
    public function save_sale($transaction_object) {


        $sale_array = array();
        $memberdata = $this->Session->read('memberData');
        $sale_array['total_transaction'] = $transaction_object->rtotal_transaction;
        $sale_array['total_items'] = $transaction_object->total_quantity_items;
        $sale_array['total_bvat'] = $transaction_object->total_transaction;
        $sale_array['total_amount_paid'] = $transaction_object->amount_paid;
        $sale_array['total_balance_due'] = $transaction_object->amount_balance_due;
        $sale_array['vat_per'] = $transaction_object->vat_percentage;
        $sale_array['vat_transaction'] = $transaction_object->vat_transaction;
        $sale_array['transaction_type'] = $transaction_object->transaction_type;
        $sale_array['transaction_timestamp'] = date('Y-m-d H:i:s');
        $sale_array['user_id'] = $memberdata['User']['id'];
        $sale_array['reverse_reason'] = $transaction_object->reverse_reason;
        $sale_array['supplier_id'] = $transaction_object->supplier;
        $sale_array['inst_id'] = $this->Session->read('inst_id');
        $sale_array['site_id'] = $this->Session->read('site_id');

        $this->Sale->set($sale_array);
        if ($this->Sale->save()) {
            return array('status' => true, 'sale_id' => $this->Sale->id);
        } else {
            return array('status' => false);
        }
    }

    //this is for saving the product data
    public function save_product_tran($sale_id, $transaction_items, $transaction_type, $receipt_id = NULL) {

        $memberdata = $this->Session->read('memberData');
        $params_query=array();
          $data = array();
        foreach ($transaction_items as $val) {
       $data[]=array('ProductTransaction' => array(
            'product_id' =>  $val->id,
            'quantity' => $val->quant_sale,
            'price' => $val->unit_price ,
            'new_stock_product' => $val->new_stock_product,
            'transaction_timestamp' => date('Y-m-d H:i:s'),
            'user_id' => $memberdata['User']['id'],
            'inst_id' =>  $this->Session->read('inst_id'),
            'site_id' => $this->Session->read('site_id'),
            'sale_id' => $sale_id,
            'transaction_type' => $transaction_type ,
            'receipt_id'=>$receipt_id
            ));
}
         
     if($this->ProductTransaction->saveMany($data)){
    return true;
    }
    else{
    return false;
    }
    
    }

    //this is for creating a receipt object
    // ($receipt_type, $amount_paid, $amount_paid_prev, $sale_id, $balance_due) {
    public function save_receipt() {

        $transaction_object = $_POST;
        $dataSourceSale = $this->Sale->getDataSource();
        $dataSourceRecipt = $this->Receipt->getDataSource();
        $dataSourceSale->begin($this->Sale);
        $response = $this->check_save($transaction_object);


        if ($response) {
            $recp_type = ($transaction_object['tran_type'] == "part_pay") ? "part_pay" : "refund";
            $dataSourceRecipt->begin($this->Sale);
            $rec_status = $this->prepare_receipt($recp_type, $transaction_object['amount_paid'], $transaction_object['total_paid'], $transaction_object['sale_id'], $transaction_object['total_due_new']);
            if ($rec_status['status']) {
                $dataSourceSale->commit($this->Sale);
                $dataSourceRecipt->commit($this->Receipt);
                $receipt_data = $this->get_receipt_print($rec_status['rec_id']);
                echo json_encode(array('status' => 'fuck_yeah', 'message' => 'Data Saved Succesfully', 'rec_data' => $receipt_data));
                exit();
            } else {
                $dataSourceSale->rollback($this->Sale);
                $dataSourceRecipt->rollback($this->Receipt);
                echo json_encode(array('status' => 'shit', 'message' => 'Please Check If Changes Were Made To Old Transaction'));
                exit();
            }
        } else {
            $dataSourceSale->rollback($this->Sale);
            echo json_encode(array('status' => 'shit', 'message' => 'Please Check If Changes Were Made To Old Transaction'));
            exit();
        }
    }


    public function check_save($sale_data) {

        $sale_id = "'" . $sale_data['sale_id'] . "'";
        $total_transaction = "'" . $sale_data['total_amount'] . "'";
        $total_amount_paid = "'" . $sale_data['total_paid'] . "'";
        $total_balance_due = "'" . $sale_data['total_due'] . "'";
        $total_balance_due_new = "'" .$sale_data['total_due_new'] . "'";
        $total_amount_paid_new = "'" . $sale_data['total_pay_new'] . "'";


        $prequery = "SELECT id,total_transaction FROM sales WHERE ID=? AND total_transaction=?";
        $prequery = $prequery . " AND total_amount_paid= ? AND total_balance_due=? AND transaction_type='add_sales' FOR UPDATE";
      
        $params=array($sale_data['sale_id'],$sale_data['total_amount'],$sale_data['total_paid'],$sale_data['total_due']);                      
        $response = $this->Sale->getDataSource()->fetchAll($prequery,$params);

        if (sizeof($response) == 1) {
			
	    $this->Sale->clear();          
        $sale_data['id'] = $sale_data['sale_id'];
        $sale_data['total_amount_paid'] = $sale_data['total_pay_new'];
        $sale_data['total_balance_due'] = $sale_data['total_due_new'];
        $this->Sale->set($sale_data);
        
        
        if ($this->Sale->save()){
                return true;
            } else {
                return false;
            }
        } {
            return false;
        }
    }

    //this is for editing stock
    //this will affect the product/product_transactions table
    public function edit_stock() {


        $this->autoLayout = false;
        $inst_id = $this->Session->read('inst_id');
        $site_id = $this->Session->read('site_id');


        if (isset($_GET['edit_stock'])) {
            $id = $_GET['id'];
            $product = $this->Product->find('first', array('conditions' => array('Product.id' => $id)));
            //   print_r($product);
            $this->set(compact('product'));
            // exit;
        } else if (isset($_GET['save_stock'])) {
            //     print_r($_GET['data']['Product']);
            //      exit();
            $prod_tran_data = $_GET['data']['ProductTransaction'];
            $prod_data = $_GET['data']['Product'];
            $memberdata = $this->Session->read('memberData');
            $prod_tran_data['user_id'] = $memberdata['User']['id'];
            $prod_tran_data['transaction_timestamp'] = date('Y-m-d H:i:s');
            $prod_tran_data['inst_id'] = $this->Session->read('inst_id');
            $prod_tran_data['price'] = $prod_data['selling_price'];

            $this->ProductTransaction->save($prod_tran_data);
            $this->Product->save($prod_data);
            echo json_encode(array('status' => 1));
            exit;
        };
    }

    //this public function will enable you to see the receips and the various transactions tied to those receipts

    public function view_receipt_trans() {

        $layout_title = "View Summary Receipt";
        $this->set(compact('layout_title'));
    }

    //this is for viewing receipt list 
    public function receipt_history($paginate_link = null) {

        $this->autoLayout = false;

        $search_trans_type = isset($_GET['search_trans_type']) && $_GET['search_trans_type'] != "null" ? $_GET['search_trans_type'] : "";
        $search_trans_date = isset($_GET['search_trans_date']) && $_GET['search_trans_date'] != "null" ? $_GET['search_trans_date'] : "";
        $search_trans_amount = isset($_GET['search_trans_amount']) && $_GET['search_trans_amount'] != "null" ? $_GET['search_trans_amount'] : "";
        $search_trans_user = isset($_GET['search_trans_user']) && $_GET['search_trans_user'] != "null" ? $_GET['search_trans_user']: "";
        $search_trans_rec = isset($_GET['search_rec_ref']) && $_GET['search_rec_ref'] != "null" ? $_GET['search_rec_ref'] : "";
        $search_trans_sale = isset($_GET['search_sale_ref']) && $_GET['search_sale_ref'] != "null" ? $_GET['search_sale_ref'] : "";



        $amount_key = ($search_trans_amount == "") ? "LIKE" : "<=";
        $amount_value = ($search_trans_amount == "") ? "%" . $search_trans_amount . "%" : $search_trans_amount;
        $rec_key = ($search_trans_rec == "") ? "LIKE" : "";
        $rec_value = ($search_trans_rec == "") ? "%" . $search_trans_rec . "%" : $search_trans_rec;
        $sale_key = ($search_trans_sale == "") ? "LIKE" : "";
        $sale_val = ($search_trans_sale == "") ? "%" . $search_trans_sale . "%" : $search_trans_sale;

        // echo $search_trans_quan . " -- " . $search_trans_amount."/n";;
        // echo $search_key . " -- "  . $amount_key;exit();

        $conditions_array = array(
            'Receipt.inst_id' => $this->Session->read('inst_id'),
            'Receipt.site_id' => $this->Session->read('site_id'),

            'Sale.transaction_type' => 'add_sales',

            'AND' => array(
                'Receipt.paid_status LIKE' => "%" . $search_trans_type . "%",
                'Receipt.transaction_timestamp LIKE' => "%" . $search_trans_date . "%",
                "Receipt.amount_paid $amount_key" => $amount_value,
                "Receipt.id $rec_key" => $rec_value,
                "Sale.id $sale_key" => $sale_val,
                'User.fname LIKE' => "%" . $search_trans_user . "%"
            )
        );



        if ($paginate_link != null) {

            $page_array = explode($paginate_link, ":");
            $this->paginate = array(
                'Receipt' => array(
                    'conditions' => $conditions_array,
                    'order' => array('Receipt.transaction_timestamp' => 'desc'),
                    //   'contain' => array('Sale'),
                    'page' => $page_array[1],
                    'limit' => 10));

            $transactions = $this->paginate('Receipt');
        } else {
            $this->paginate = array(
                'Receipt' => array(
                    'conditions' => $conditions_array,
                    //   'contain' => array('Sale'),
                    'order' => array('Receipt.transaction_timestamp' => 'desc'),
                    'limit' => 10));
            $transactions = $this->paginate('Receipt');
        }

        $this->set(compact('transactions'));
    }

    //this public function will enable you to view your main transactions

    public function view_real_trans() {

        $layout_title = "View Summary Transactions";
        $this->set(compact('layout_title'));
    }

    //this is for finding the real transaction history
    //this side is using the sales table
    //have to filter out the data first .shit very important!!!!
    public function real_transaction_history($paginate_link = null) {

        $this->autoLayout = false;


        $search_trans_type = isset($_GET['search_trans_type']) && $_GET['search_trans_type'] != "null" ? $_GET['search_trans_type'] : "";
        $search_trans_date = isset($_GET['search_trans_date']) && $_GET['search_trans_date'] != "null" ? $_GET['search_trans_date'] : "";
        $search_trans_quan = isset($_GET['search_trans_quan']) && $_GET['search_trans_quan'] != "null" ? $_GET['search_trans_quan'] : "";
        $search_trans_amount = isset($_GET['search_trans_amount']) && $_GET['search_trans_amount'] != "null" ? $_GET['search_trans_amount'] : "";
        $search_trans_user = isset($_GET['search_trans_user']) && $_GET['search_trans_user'] != "null" ? $_GET['search_trans_user'] : "";
        $sale_num = isset($_GET['sale_num']) && $_GET['sale_num'] != "null" ? $_GET['sale_num'] : "";


        $search_key = ($search_trans_quan == "") ? "LIKE" : "<=";
        $amount_key = ($search_trans_amount == "") ? "LIKE" : "<=";
        $search_value = ($search_trans_quan == "") ? "%" . $search_trans_quan . "%" : $search_trans_quan;
        $amount_value = ($search_trans_amount == "") ? "%" . $search_trans_amount . "%" : $search_trans_amount;
        // echo $search_trans_quan . " -- " . $search_trans_amount."/n";;
        // echo $search_key . " -- "  . $amount_key;exit();

        $conditions_array = array(
            'Sale.inst_id' => $this->Session->read('inst_id'),
            'Sale.site_id' => $this->Session->read('site_id'),

            'AND' => array(
                'Sale.id LIKE' => "%" . $sale_num . "%",
                'Sale.transaction_type LIKE' => "%" . $search_trans_type . "%",
                'Sale.transaction_timestamp LIKE' => "%" . $search_trans_date . "%",
                "Sale.total_items $search_key" => $search_value,
                "Sale.total_transaction $amount_key" => $amount_value,
                'User.fname LIKE' => "%" . $search_trans_user . "%"
            )
        );

        //print_r($conditions_array);
        // exit();

        if ($paginate_link != null) {

            $page_array = explode($paginate_link, ":");
            $this->paginate = array(
                'Sale' => array(
                    'conditions' => $conditions_array,
                    'order' => array('Sale.transaction_timestamp' => 'desc'),
                    //'contain' => array('Product' => array('product_name')),
                    'page' => $page_array[1],
                    'limit' => 10));


            $transactions = $this->paginate('Sale');
        } else {
            $this->paginate = array(
                'Sale' => array(
                    'conditions' => $conditions_array,
                    //'contain' => array('Product' => array('product_name')),
                    'order' => array('Sale.transaction_timestamp' => 'desc'),
                    'limit' => 10));
            $transactions = $this->paginate('Sale');
        }

        // print_r($transactions);
        // exit();

        $this->set(compact('transactions'));
    }

    public function view_transaction() {
        $layout_title = "View Transactions";
        $this->set(compact('layout_title'));
    }

    public function transaction_history($paginate_link = null) {
        $this->autoLayout = false;

        $filter = isset($_GET['filter']) && $_GET['filter'] != "null" ? $_GET['filter'] : "";
        $sfilter = isset($_GET['sfilter']) && $_GET['sfilter'] != "null" ? $_GET['sfilter'] : "";
        $tfilter = isset($_GET['tfilter']) && $_GET['tfilter'] != "null" ? $_GET['tfilter'] : "";
        $ufilter = isset($_GET['ufilter']) && $_GET['ufilter'] != "null" ? $_GET['ufilter'] : "";


        $conditions_array = array(
            'ProductTransaction.inst_id' => $this->Session->read('inst_id'),
            'ProductTransaction.site_id' => $this->Session->read('site_id'),

            'AND' => array(
                'ProductTransaction.transaction_type LIKE' => "%" . $sfilter . "%",
                'ProductTransaction.transaction_timestamp LIKE' => "%" . $tfilter . "%",
                'Product.product_name LIKE' => "%" . $filter . "%",
                'User.fname LIKE' => "%" . $ufilter . "%",
            )
        );

        /** 'AND' => array(
          'ProductTransaction.transaction_type LIKE' => "%" . $sfilter . "%",
          'ProductTransaction.transaction_timestamp LIKE' => "%" . $tfilter . "%",
          'Product.product_name LIKE' => "%" . $filter . "%",
          'User.fname LIKE' => "%" . $filter . "%",
          'User.lname LIKE' => "%" . $filter . "%"
          )* */
        if ($paginate_link != null) {

            $page_array = explode($paginate_link, ":");
            $this->paginate = array(
                'ProductTransaction' => array(
                    'conditions' => $conditions_array,
                    'order' => array('ProductTransaction.transaction_timestamp' => 'desc'),
                    'page' => $page_array[1],
                    'limit' => 10));


            $transactions = $this->paginate('ProductTransaction');
        } else {
            $this->paginate = array(
                'ProductTransaction' => array(
                    'conditions' => $conditions_array,
                    'order' => array('ProductTransaction.transaction_timestamp' => 'desc'),
                    'limit' => 10));
            $transactions = $this->paginate('ProductTransaction');
        }


        $this->set(compact('transactions'));
    }

    //this is for printing various stuff
    public function print_stuff() {
        $this->autoLayout = "print";
    }

    //this is for archiving products
    public function archive_product() {

        $this->autoLayout = false;

        if (isset($_GET['archive']) && isset($_GET['id'])) {

            if ($_GET['archive']) {
                $this->Product->set(array(
                    'id' => $_GET['id'],
                    'archive_status' => ($_GET['archive'] && $_GET['archive'] == "archive_prod") ? "1" : "0"
                ));
                if ($this->Product->save()) {
                    echo json_encode(array('status' => "1", 'message' => "Data Saved Successfully"));
                    exit();
                } else {
                    echo json_encode(array('status' => "0", 'message' => "Error Saving . Please Try Again"));
                    exit();
                }
            }
        }
    }

    //this is for viewing the percentage of stock 
    public function min_stock_notif() {


        $this->autoLayout = false;

        $stock_data = $this->Product->find('all', array('recursive' => -1,
            'fields' => array('id', 'product_name', 'stock_available', 'max_stock_notif', 'min_stock_notif'),
            'conditions' => array('Product.stock_available < Product.min_stock_notif',
            'Product.inst_id' => $this->Session->read('inst_id'),
            'Product.site_id' => $this->Session->read('site_id'),
            )));
        $this->set(compact('stock_data'));
    }

    public function product_list($paginate_link = null) {

        $this->autoLayout = false;
        $categories = $this->Category->find('list', array('fields' => array('id', 'long_name')));
        $filter = isset($_GET['filter']) && $_GET['filter'] != "null" ? $_GET['filter'] : "";
        $arch_stat = isset($_GET['arch_stat']) && $_GET['arch_stat'] != "" ? $_GET['arch_stat'] : "";


        $conditions_array = array(
        
            'Product.inst_id' => $this->Session->read('inst_id'),
            'Product.site_id' => $this->Session->read('site_id'),
            'Product.archive_status LIKE' => "%" . $arch_stat . "%",
            'OR' => array(
                'Product.product_name LIKE' => "%" . $filter . "%"
                ));

        if ($paginate_link != null) {

            $page_array = explode($paginate_link, ":");
            $this->paginate = array(
                'Product' => array(
                    'conditions' => $conditions_array,
                    'order' => array('Product.product_name' => 'asc'),
                    'page' => $page_array[1],
                    'limit' => 10));
            $prods = $this->paginate('Product');
            echo ($paginate_link);
        } else {
            $this->paginate = array(
                'Product' => array(
                    'conditions' => $conditions_array,
                    'order' => array('Product.product_name' => 'asc'),
                    'limit' => 10));
            $prods = $this->paginate('Product');
            echo ($paginate_link);
        }


        $this->set(compact('prods', 'categories'));
    }

}

?>
