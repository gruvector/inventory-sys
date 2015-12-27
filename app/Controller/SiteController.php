<?php

class SiteController extends AppController {

    public $name = 'Site';
    public $components = array('RequestHandler', 'Session');
    public $uses = array("User",  'Site', 'Role', 'UserRole');
    public $helpers = array('Form', 'Html', 'Time','Session', 'Paginator');
    public $layout = 'dashboard';

    function beforeFilter() {
//will have to check whether the user logged in is an adminstrator/superadmin
// first before allowing the user to access
//$this->Session->delete('role_short_array');
        // $this->Session->delete('user_links');

        parent::beforeFilter();
    }

    function view_sites() {

        $layout_title = "Sites";
        $this->set(compact('layout_title'));
    }


   //this is for changing the default site and institution to a differnt site

   function change_def_site(){
	   
	   $this->autoLayout = false;   
	   $site_id=$_POST['site_id'];
	   $mem_data_roles = $this->Session->read('role_short_array');
               if (in_array('SADM', $mem_data_roles) || in_array('ADM',$mem_data_roles)) {
       
     $sites_allow = $this->Site->find("first", array("conditions" => array("Site.id"=>$site_id,"Site.site_inst_id" => $this->Session->read('inst_id'))));

          if(sizeof($sites_allow)>0){

        $this->Session->write('site_id', $site_id);
		echo json_encode(array("status" => "true","message"=>"Default Site Changed"));
			  
			  }
			  else{

		echo json_encode(array("status" => "true","message"=>"You Can Only Change Sites In Your Institution"));
	     
				  }
     
	   }else{
	    echo json_encode(array("status" => "false","message"=>"Permission Denied"));
  
		   }
	   
	   
	   exit();
	   
	   
	   }

    function site_list($paginate_link = null) {

		$site_id=$this->Session->read("site_id");
        $this->autoLayout = false;

        $filter = isset($_GET['filter']) && $_GET['filter'] != "null" ? $_GET['filter'] : "";
        $conditions_array = array(
            'Site.site_inst_id' => $this->Session->read('inst_id'),
            'OR' => array(
                'Site.site_name LIKE' => "%" . $filter . "%",
                'Site.city LIKE' => "%" . $filter . "%",
                'Site.phone LIKE' => "%" . $filter . "%",
                'Site.fax LIKE' => "%" . $filter . "%",
                'Site.email LIKE' => "%" . $filter . "%"
                ));

        if ($paginate_link != null) {

            $page_array = explode($paginate_link, ":");
            $this->paginate = array(
                'Site' => array(
                    'conditions' => $conditions_array,
                    'order' => array('Site.id' => 'desc'),
                    'page' => $page_array[1],
                    'limit' => 10));


            $sites = $this->paginate('Site');
        } else {
            $this->paginate = array(
                'Site' => array(
                    'conditions' => $conditions_array,
                    'order' => array('Site.id' => 'desc'),
                    'limit' => 10));
            $sites = $this->paginate('Site');
        }
        $this->set(compact('sites','site_id'));
    }

    function change_status() {

        $this->autoLayout = false;
        $type = $_GET['type'];
        $id = $_GET['id'];


        switch ($type) {
            case "lock":
                $this->Site->set(array('id' => $id,
                    'site_lock' => '0'));
                $this->Site->save();
                break;

            case "unlock" :
                $this->Site->set(array('id' => $id,
                    'site_lock' => '1'));
                $this->Site->save();
                break;

            default:
                break;
        }

        echo json_encode(array("status" => "true"));
        exit();
    }

    function add_site() {
        $this->autoLayout = false;

        if (isset($_GET['save_site'])) {
            $site_data = $_GET['data']['Site'];
            $site_data['site_inst_id'] = $this->Session->read('inst_id');
            $this->Site->save($site_data);
            echo json_encode(array("status" => "1"));
            exit();
        } else if (isset($_GET['id']) && $_GET['edit_site'] == 'true') {

            $id = $_GET['id'];
            $sites = $this->Site->find("first", array("conditions" => array("Site.id" => $id)));
            $this->set(compact('sites'));
        } else {
            // echo "Current Site--".$this->Session->read('inst_id');
        }
    }

    function delete_site() {
        
    }

}
