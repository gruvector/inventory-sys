<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class CustomerController extends AppController {

    var $name = 'Customer';
    var $components = array('RequestHandler', 'Session');
    var $uses = array("ReverseReason", "Invoice", "Reversal", "Receive", "Sale", "Receipt", "Taxe", "Supplier", "Category", 'Site', 'Product', 'ProductTransaction');
    var $layout = 'dashboard_layout';

    //var $transaction_timestamp = ;

    function beforeFilter() {
        parent::beforeFilter();
    }

    //this is for viewing customers
    function view_cust() {
        $layout_title = "View Suppliers";
        $this->set
                (compact('layout_title'));
    }

    //this is for viewing categoriee
    function view_cat() {
        $layout_title = "View Category";
        $this->set
                (compact('layout_title'));
    }

    //this is for viewing customer list
    function customer_list($paginate_link = null) {

        $this->autoLayout = false;

        $filter = isset($_GET['filter']) && $_GET['filter'] != "null" ? $_GET['filter'] : "";

        $conditions_array = array(
            'Site.site_inst_id' => $this->Session->read('inst_id'),
            'OR' => array(
                'Supplier.email LIKE' => "%" . $filter . "%",
                'Supplier.cell_number LIKE' => "%" . $filter . "%",
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
                    'limit' => 5));


            $Suppliers = $this->paginate('Supplier');
        } else {
            $this->paginate = array(
                'Supplier' => array(
                    'conditions' => $conditions_array,
                    'contain' => array('Category', 'Site'),
                    'order' => array('Supplier.id' => 'desc'),
                    'limit' => 5));
            $Suppliers = $this->paginate('Supplier');
        }


        $this->set(compact('Suppliers'));
    }

    //this is for adding customer
    function add_customer() {
        $this->autoLayout = false;

        if (isset($_GET['save_cust'])) {
            $cust_data = $_GET['data']['Supplier'];
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
    function add_sales() {

        $this->autoLayout = false;
        $inst_id = $this->Session->read('inst_id');
        $site_id = $this->Session->read('site_id');

        if (isset($_GET['perform_sales'])) {
            
        } else {
            $products = $this->Product->find('all', array('recursive' => '-1', 'fields' => array('selling_price', 'id', 'product_name', 'category_product', 'stock_available')));
            $vat = $this->Taxe->find('first', array('recursive', 'conditions' => array('Taxe.vat_category' => 'sales')));
            $reverse = $this->ReverseReason->find('list', array('fields' => array('id', 'reason')));
            $suppliers = $this->Supplier->find('all');

            $this->set(compact('categ', 'suppliers', 'reverse', 'categories', 'products', 'vat'));
        }
    }

    //this is for adding new receivables
    function add_recv() {

        $this->autoLayout = false;
        $inst_id = $this->Session->read('inst_id');
        $site_id = $this->Session->read('site_id');

        if (isset($_GET['perform_recv'])) {
            
        } else {
            
        }
    }

    //this is for deleting customers 
    function del_customer() {

        $id = $_GET['id'];
        $conditions = array('Supplier.id' => $id);
        $this->Supplier->deleteAll($conditions);
        echo json_encode(array("status" => "1"));
        exit();
    }

    //this is for adding categories
    function add_cat() {
        $this->autoLayout = false;

        if (isset($_GET['save_cat'])) {
            $cat_data = $_GET['data']['Category'];
            $cat_data['inst_id'] = $this->Session->read('inst_id');
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
    function cat_list($paginate_link = null) {

        $this->autoLayout = false;

        $filter = isset($_GET['filter']) && $_GET['filter'] != "null" ? $_GET['filter'] : "";

        $conditions_array = array(
            'Category.inst_id' => $this->Session->read('inst_id'),
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
                    'limit' => 5));


            $cats = $this->paginate('Category');
        } else {
            $this->paginate = array(
                'Category' => array(
                    'conditions' => $conditions_array,
                    'order' => array('Category.id' => 'desc'),
                    'limit' => 5));
            $cats = $this->paginate('Category');
        }


        $this->set(compact('cats'));
    }

    function view_products() {

        $layout_title = "View Products";
        $this->set(compact('layout_title'));
    }

    //this is for adding new products to the inventory system
    function add_product() {
        $this->autoLayout = false;
        $inst_id = $this->Session->read('inst_id');
        $site_id = $this->Session->read('site_id');

        if (isset($_GET['save_prod'])) {
            $prod_data = $_GET['data']['Product'];
            $prod_data['inst_id'] = $this->Session->read('inst_id');
            $prod_data['site_id'] = $this->Session->read('site_id');

            // print_r($prod_data);
            $this->Product->save($prod_data);
            echo json_encode(array('status' => 1));
            exit();
        } else if (isset($_GET['edit_prod'])) {
            $id = $_GET['id'];
            $product = $this->Product->find('first', array('conditions' => array('Product.id' => $id)));
            $categories = $this->Category->find('list', array('fields' => array('id', 'long_name')));
            $this->set(compact('inst_id', 'site_id', 'categories', 'product'));
        } else {
            $categories = $this->Category->find('list', array('fields' => array('id', 'long_name')));
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
    function batch_transaction() {

        $this->autoLayout = false;

        $transaction_object = json_decode($_POST['data']);
        $transaction_items = $transaction_object->transaction_items;


        $dataSourceProduct = $this->Product->getDataSource();
        $dataSourceSale = $this->Sale->getDataSource();
        $dataSourceProductsTransaction = $this->ProductTransaction->getDataSource();


        $dataSourceProduct->begin($this->Product);

        if ($this->prepare_product($transaction_items, $transaction_object->transaction_type)) {

            $dataSourceSale->begin($this->Sale);
            $status = $this->save_sale($transaction_object);
            if ($status['status']) {

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

    ///this is for updating a product when a sale is made;
    function prepare_product($products_data, $transaction_type) {

        $array_query = array();
        $prequery = "SELECT id,stock_available FROM products WHERE ";
        $data = array();
        $insert_product = "UPDATE products SET stock_available = CASE ";
        $query_end = " END WHERE id IN ";
        $query_end_test = array();
        $insert_product_query = array();

        //this part will be different depeding on the transaction type
        //sale,receivables,invoice
        ///sale=stock_available >=quant_transact
        //receivalbe=just calculate current stock and use
        //invoince =same as receivable but no  increase in stock
        //reversal.calculate current stock and use add_revr
        foreach ($products_data as $val) {
            $quant_transact = mysql_real_escape_string($val->quant_sale);
            $id = mysql_real_escape_string($val->id);

            if ($transaction_type == "add_sales") {
                $array_query [] = " (id = '$id' and stock_available >= '$quant_transact')";
            } else if ($transaction_type == "add_recv" || $transaction_type == "add_inv" || $transaction_type == "add_revr") {
                $array_query [] = "(id = '$id')";
            } else {
                
            }
        }

        $prequery = $prequery . implode($array_query, 'or') . " LOCK IN SHARE MODE;";
        $response = $this->Product->query($prequery);


        if (sizeof($response) < sizeof($products_data)) {

            return false;
        } else if (sizeof($response) == sizeof($products_data)) {

            foreach ($response as $val_new) {
                foreach ($products_data as $bval) {
                    if ($bval->id == $val_new['products']['id']) {

                        if ($transaction_type == "add_sales") {

                            $new_stock = $val_new['products']['stock_available'] - $bval->quant_sale;
                            $insert_product_query[] = "WHEN id = '$bval->id' THEN '$new_stock'";
                        } else if ($transaction_type == "add_recv") {
                            $new_stock = $val_new['products']['stock_available'] + $bval->quant_sale;
                            $insert_product_query[] = "WHEN id = '$bval->id' THEN '$new_stock'";
                        } else if ($transaction_type == "add_inv") {
                            $new_stock = $val_new['products']['stock_available'];
                            $insert_product_query[] = "WHEN id = '$bval->id' THEN '$new_stock'";
                        } else if ($transaction_type == "add_revr") {

                            $new_stock = $val_new['products']['stock_available'] - $bval->quant_sale;
                            $insert_product_query[] = "WHEN id = '$bval->id' THEN '$new_stock'";
                        }

                        $query_end_test[] = $bval->id;
                    }
                }
            }

            $insert_product = $insert_product . implode("\n", $insert_product_query) . $query_end . " (" . implode(",", $query_end_test) . ")";

            if ($this->Product->query($insert_product)) {
                //    echo "canbus,it are crazy";
                //   exit();
                return true;
            } else {
                //     echo "lil wayne,kanye west !!!! da horror";
                //     exit();
                return false;
            }
        }
    }

    //this is the function for saving the sale of a product
    function save_sale($transaction_object) {


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


        $this->Sale->set($sale_array);
        if ($this->Sale->save()) {
            return array('status' => true, 'sale_id' => $this->Sale->id);
        } else {
            return array('status' => false);
        }
    }

    //this is for saving the product data
    function save_product_tran($sale_id, $transaction_items, $transaction_type) {
        //$array_items = array();
        $data = array();
        $memberdata = $this->Session->read('memberData');
        $saleProd = new ProductTransaction();
        $rquery = "INSERT into product_transactions(product_id,quantity,price,transaction_type,
            transaction_timestamp,user_id,inst_id,sale_id) VALUES";
        $query = array();

        foreach ($transaction_items as $val) {
            $val_id = "'" . mysql_real_escape_string($val->id) . "'";
            $sale_q = "'" . mysql_real_escape_string($val->quant_sale) . "'";
            $unit_p = "'" . mysql_real_escape_string($val->unit_price) . "'";
            $date_trans = "'" . mysql_real_escape_string(date('Y-m-d H:i:s')) . "'";
            $mem_data = "'" . mysql_real_escape_string($memberdata['User']['id']) . "'";
            $session_inst_id = "'" . mysql_real_escape_string($this->Session->read('inst_id')) . "'";
            $sale_data = "'" . mysql_real_escape_string($sale_id) . "'";
            $tran_type = "'" . mysql_real_escape_string($transaction_type) . "'";
            $subarray = array($val_id, $sale_q, $unit_p, $tran_type, $date_trans, $mem_data, $session_inst_id, $sale_data);
            $query[] = '(' . implode(",", $subarray) . ")";
        };
        // if ($this->ProductTransaction->query($data, array('atomic' => true))) {
        $rquery = $rquery . implode(",", $query) . ";";
        // exit();

        if ($this->ProductTransaction->query($rquery)) {

            return true;
        } else {
            return false;
        }
    }

    //this is for creating a receipt object
    function save_receipt($data) {
        
    }

    //this is for editing stock
    //this will affect the product/product_transactions table
    function edit_stock() {




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

    function view_transaction() {
        $layout_title = "View Transactions";
        $this->set(compact('layout_title'));
    }

    function transaction_history($paginate_link = null) {
        $this->autoLayout = false;

        $filter = isset($_GET['filter']) && $_GET['filter'] != "null" ? $_GET['filter'] : "";
        $sfilter = isset($_GET['sfilter']) && $_GET['sfilter'] != "null" ? $_GET['sfilter'] : "";
        $tfilter = isset($_GET['tfilter']) && $_GET['tfilter'] != "null" ? $_GET['tfilter'] : "";
        $ufilter = isset($_GET['ufilter']) && $_GET['ufilter'] != "null" ? $_GET['ufilter'] : "";


        $conditions_array = array(
            'ProductTransaction.inst_id' => $this->Session->read('inst_id'),
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
                    'limit' => 5000));


            $transactions = $this->paginate('ProductTransaction');
        } else {
            $this->paginate = array(
                'ProductTransaction' => array(
                    'conditions' => $conditions_array,
                    'order' => array('ProductTransaction.transaction_timestamp' => 'desc'),
                    'limit' => 5000));
            $transactions = $this->paginate('ProductTransaction');
        }


        $this->set(compact('transactions'));
    }

    function product_list($paginate_link = null) {

        $this->autoLayout = false;
        $categories = $this->Category->find('list', array('fields' => array('id', 'long_name')));
        $filter = isset($_GET['filter']) && $_GET['filter'] != "null" ? $_GET['filter'] : "";

        $conditions_array = array(
            'Product.inst_id' => $this->Session->read('inst_id'),
            'OR' => array(
                'Product.product_name LIKE' => "%" . $filter . "%"
                ));

        if ($paginate_link != null) {

            $page_array = explode($paginate_link, ":");
            $this->paginate = array(
                'Product' => array(
                    'conditions' => $conditions_array,
                    'order' => array('Product.id' => 'desc'),
                    'page' => $page_array[1],
                    'limit' => 5000));


            $prods = $this->paginate('Product');
        } else {
            $this->paginate = array(
                'Product' => array(
                    'conditions' => $conditions_array,
                    'order' => array('Product.id' => 'desc'),
                    'limit' => 5000));
            $prods = $this->paginate('Product');
        }


        $this->set(compact('prods', 'categories'));
    }

}

?>
