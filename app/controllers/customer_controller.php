<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class CustomerController extends AppController {

    var $name = 'Customer';
    var $components = array('RequestHandler', 'Session');
    var $uses = array("Taxe", "Supplier", "Category", 'Site', 'Product', 'ProductTransaction');
    var $layout = 'dashboard_layout';

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
            $this->set(compact('categories', 'products', 'vat'));
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
    function batch_transaction() {

        $transaction_object = json_decode($_POST['data']);
        $transaction_items = $transaction_object->transaction_items;
        print_r($transaction_object);
        echo 'tt-transaction--' . $transaction_object->total_transaction;



        exit();
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
