<?php

class AdminController extends AppController {

    public $name = 'Admin';
    public $components = array('RequestHandler', 'Session');
    public $uses = array("ReportCategory","ReportParameter","ReportRole","Report","User", 'Event', 'Batch', 'Ticket', 'Site', 'Role', 'UserRole', 'Institution');
    public $layout = 'dashboard';
    public $helpers = array('Form', 'Html','Session');

    function beforeFilter() {
//will have to check whether the user logged in is an adminstrator/superadmin
// first before allowing the user to access
//$this->Session->delete('role_short_array');
        // $this->Session->delete('user_links');

        parent::beforeFilter();
             $this->loadModel('ReportParameter');
             $this->loadModel('ReportRole');
             $this->loadModel('Institution');


    }

    function view_roles() {
        $layout_title = "Roles";
        $this->set(compact('layout_title'));
    }

    function view_inst() {
        $layout_title = "Institutions";
        $this->set(compact('layout_title'));
    }

    function role_list($paginate_link = null) {
        $this->autoLayout = false;
        $filter = isset($_GET['filter']) && $_GET['filter'] != "null" ? $_GET['filter'] : "";
        $conditions_array = array(
            'OR' => array(
                'Role.role_short_name LIKE' => "%" . $filter . "%",
                'Role.role_long_name LIKE' => "%" . $filter . "%"
                ));
        if ($paginate_link != null) {
            $page_array = explode($paginate_link, ":");
            $this->paginate = array(
                'Role' => array(
                    'conditions' => $conditions_array,
                    'order' => array('Role.id' => 'desc'),
                    'page' => $page_array[1],
                    'limit' => 10));
            $roles = $this->paginate('Role');
        } else {
            $this->paginate = array(
                'Role' => array(
                    'conditions' => $conditions_array,
                    'order' => array('Role.id' => 'desc'),
                    'limit' => 10));
            $roles = $this->paginate('Role');
        }
        // print_r($roles);
        $this->set(compact('roles'));
    }

    function add_role() {
        $this->autoLayout = false;

        if (isset($_GET['save_role'])) {
            $role_data = $_GET['data']['Role'];
            $this->Role->save($role_data);
            echo json_encode(array("status" => "1"));
            exit();
        } else if (isset($_GET['id']) && $_GET['edit_role'] == 'true') {

            $id = $_GET['id'];
            $roles = $this->Role->find("first", array("conditions" => array("Role.id" => $id)));
            $this->set(compact('roles'));
        } else {
            // echo "Current Site--".Configure::read("inst_id");
        }
    }

    function inst_list($paginate_link = null) {

        $this->autoLayout = false;

        $filter = isset($_GET['filter']) && $_GET['filter'] != "null" ? $_GET['filter'] : "";
        $conditions_array = array(
            'OR' => array(
                'Institution.inst_short_name LIKE' => "%" . $filter . "%",
                'Institution.inst_long_name LIKE' => "%" . $filter . "%",
                'Institution.city LIKE' => "%" . $filter . "%",
                'Institution.phone LIKE' => "%" . $filter . "%",
                'Institution.fax LIKE' => "%" . $filter . "%",
                'Institution.email LIKE' => "%" . $filter . "%"
                ));

        if ($paginate_link != null) {

            $page_array = explode($paginate_link, ":");
            $this->paginate = array(
                'Institution' => array(
                    'conditions' => $conditions_array,
                    'order' => array('Institution.id' => 'desc'),
                    'page' => $page_array[1],
                    'limit' => 10));


            $insts = $this->paginate('Institution');
        } else {
            $this->paginate = array(
                'Institution' => array(
                    'conditions' => $conditions_array,
                    'order' => array('Institution.id' => 'desc'),
                    'limit' => 10));
            $insts = $this->paginate('Institution');
        }
        //   print_r($insts);
        $this->set(compact('insts'));
    }

    function add_inst() {
        $this->autoLayout = false;

        if (isset($_GET['save_inst'])) {
            $inst_data = $_GET['data']['Institution'];
            $this->Institution->save($inst_data);
            $inst_id = $this->Institution->id;
            $inst = new Institution();
            $inst_data = $inst->find("first", array('conditions' => array("Institution.id" => $inst_id)));
            $this->Site->set(array(
                'site_inst_id' => $inst_data['Institution']['id'],
                'site_name' => $inst_data['Institution']['inst_short_name'] . " Default Site",
                'phone' => $inst_data['Institution']['phone'],
                'fax' => $inst_data['Institution']['fax'],
                'email' => $inst_data['Institution']['email'],
                'city' => $inst_data['Institution']['city'],
                'address' => $inst_data['Institution']['address']
            ));
            $this->Site->save();
            echo json_encode(array("status" => "1"));
            exit();
        } else if (isset($_GET['id']) && $_GET['edit_inst'] == 'true') {

            $id = $_GET['id'];
            $institutions = $this->Institution->find("first", array("conditions" => array("Institution.id" => $id)));
            $this->set(compact('institutions'));
        } else {
            // echo "Current Site--".Configure::read("inst_id");
        }
    }

    function inst_status_change() {

        $this->autoLayout = false;
        $type = $_GET['type'];
        $id = $_GET['id'];


        switch ($type) {
            case "lock":
                $this->Institution->set(array('id' => $id,
                    'inst_lock' => '0'));
                $this->Institution->save();
                break;

            case "unlock" :
                $this->Institution->set(array('id' => $id,
                    'inst_lock' => '1'));
                $this->Institution->save();
                break;

            default:
                break;
        }

        echo json_encode(array("status" => "true"));
        exit();
    }

    function change_inst() {
        if ($this->RequestHandler->isAjax()) {
            // $this->autoLayout = false;
            // $this->autoRender = false;
            $data = $this->Session->read('role_short_array');
            if (isset($data) && in_array("SADM", $data)) {
                $insts = $this->Institution->find("all", array('contain' => 'Site'));
            } else if (isset($data) && in_array("ADM", $data) && !in_array("SADM", $data)) {
                $insts = $this->Institution->find("all", array('contain' => 'Institution', 'conditions' => array("Institution.id" => Configure::read("inst_id"))));
            } else {
                $insts = array();
            }
            $site_id = $this->Session->read('site_id');
            $this->set(compact('insts', 'site_id'));
        }
    }

    function change_password() {
        if ($this->RequestHandler->isAjax()) {
            
        }
    }

    function change_inst_config() {

        if ($this->RequestHandler->isAjax()) {
            $this->autoLayout = false;
            $this->autoRender = false;
            $site_id = $_GET['site_id'];
            $inst_id = $_GET['inst_id'];
            // echo "site--id" . $site_id . "--inst_id--" . $inst_id;
            //  echo "odl site--id" . Configure::read('site_id') . "-- old inst_id--" . Configure::write('inst_id');

            $this->Session->write('site_id', $site_id);
            $this->Session->write('inst_id', $inst_id);

            //   echo "new site--id" . Configure::read('site_id') . "-- new inst_id--" . Configure::write('inst_id');
            // exit();

            echo json_encode(array('status' => 'true'));
        }
    }



    //this is for viewing reports in the system
    //this is supposed to be set up so that you have a list of reports 
    //list reports,search for reports by category,--move reports to category
    /// add parameters when generating reports
    // you should also be able to pdf,excel,email,view reports,
    function reports_list() {
        
    }

    function view_reports() {
        $layout_title = "View Reports";
        $this->set(compact('layout_title'));
    }

    //this is where reports will be configurred
    //crud system for generating reports
    //add parameters here also
    // view sample reports
//view roles which have access to reports 
// prevent reports from being seen by anyone except admin
    function configure_reports_list($paginate_link = null) {

        $this->autoLayout = false;
        $filter = isset($_GET['filter']) && $_GET['filter'] != "null" ? $_GET['filter'] : "";
        $conditions_array = array(
            'OR' => array(
                'Report.title LIKE' => "%" . $filter . "%",
            /**   'Institution.inst_long_name LIKE' => "%" . $filter . "%" * */
                ));

        if ($paginate_link != null) {

            $page_array = explode($paginate_link, ":");
            $this->paginate = array(
                'Report' => array(
                    'conditions' => $conditions_array,
                    'order' => array('Report.id' => 'desc'),
                    'page' => $page_array[1],
                    'limit' => 10));


            $reports = $this->paginate('Report');
        } else {
            $this->paginate = array(
                'Report' => array(
                    'conditions' => $conditions_array,
                    'order' => array('Report.id' => 'desc'),
                    'limit' => 10));
            $reports = $this->paginate('Report');
        }
        $categories = $this->ReportCategory->find('list', array('recursive' => -1));
        $this->set(compact('reports', 'categories'));
    }

    //this is where the list will will show the reports 
    function configure_reports() {
        $layout_title = "Configure Reports";

        $this->set(compact('layout_title', 'reports'));
    }

    function configure_reports_roles() {
        if (isset($_GET['roles_report'])) {
            $this->autoLayout = false;
            $report_id = $_GET['id'];
            //  echo $report_id;
            //find all roles possible
            $roles = $this->Role->find("all", array("recursive" => "0"));
            $user_roles = $this->ReportRole->find("list", array('fields' => 'role_id', "conditions" => array("ReportRole.report_id" => $report_id), "recursive" => 0));
            //   print_r(array($roles,$user_roles));
            //    exit();
            $this->set(compact('roles', 'user_roles'));
        }
    }

//this is used for saving the various roles for the reports
    function save_reports_roles() {
        $this->autoLayout = false;

        $id = $_GET['id'];
        $roles = $_GET['roles'];
        $roles_user = explode(",", $roles);

        $conditions = array("ReportRole.report_id" => $id);
        $this->ReportRole->deleteAll($conditions);
        foreach ($roles_user as $val) {
            $reportrole = new ReportRole();
            $reportrole->set(array("role_id" => $val,
                "report_id" => $id));
            $reportrole->save();
        }
        echo json_encode(array("status" => "true"));
        exit();
    }

    //this is for viewing the reports with the parameters to be used as 
    //filters
    function view_report_gen($report_id) {
        $this->autoLayout = false;
        $report_data = $this->Report->find("first",array('contain' =>'ReportParameter','conditions'=> array("Report.id" => $report_id)));
        print_r($report_data);
        exit();
    }

    function configure_reports_add($report_data = null) {
        $this->autoLayout = false;
        if (isset($_POST) && isset($_POST['data']['Report'])) {
            //

            $report_data = $_POST['data']['Report'];
            $this->Report->set(array(
                'title' => $report_data['title'],
                'params' => $report_data['params'],
                'report_category_id' => $report_data['report_category_id'],
                'id' => isset($report_data['id']) ? $report_data['id'] : ""
            ));
            $report_id = $this->Report->save();

            if (isset($report_data['id'])) {
                $id = $report_data['id'];
                $conditions = array('ReportParameter.report_id' => $id);
                $this->ReportParameter->deleteAll($conditions);
            }
            if (isset($report_data['param'])) {
                $param_array = array();
                $i = 0;
                $params_keys = array_keys($report_data['param']);
                foreach ($params_keys as $val_keys) {
                    foreach ($report_data['param'][$val_keys] as $val) {
                        $param_array[$i][$val_keys] = $val;
                        $i++;
                    }
                    $i = 0;
                }
                $report_id = $this->Report->id;
                foreach ($param_array as $val) {
                    $rpt = new ReportParameter();
                    $rpt->set(array('type' => $val['name'],
                        'label' => $val['label'],
                        'name' => $val['val_name'],
                        'report_id' => $report_id));
                    $rpt->save();
                }
            };
            echo json_encode(array("status" => "1"));
            exit;
        } elseif (isset($_GET['edit_report'])) {
            $reports = $this->Report->find('first', array('contain' => 'ReportParameter', 'conditions' => array('Report.id' => $_GET['id'])));
            $report_category = $this->ReportCategory->find("all", array("recursive" => "-1"));
            //  print_r($reports);
            //   exit;
            $this->set(compact('report_category', 'reports'));
        }
        //this is for adding normal requests
        else {
            $report_category = $this->ReportCategory->find("all", array("recursive" => "-1"));
            $this->set(compact('report_category'));
        }
    }

    public function admin_create_report($report_id = null, $type = null, $params_data = null) {

        $conditions = "";
        $cont_array = array();
        $params = array();
        if (isset($_GET['params'])) {
            $params = get_object_vars(json_decode($_GET['params']));
        } else if ($params_data != null) {
            $dt = urldecode($params_data);
            // print_r(json_decode($dt));
            $params = get_object_vars(json_decode($dt));
        }

        if (sizeof($params) > 0) {
            foreach ($params as $key => $val) {
                $cont_array[] = $key . " like '%" . $val . "%'";
            }
            $conditions = " where " . $conditions . implode(" and ", $cont_array);
        }

        $query = $this->Report->find("first", array("conditions" => array("Report.id" => $report_id)));
        $columns = array();
        $keys = array();
        $title = $query['Report']['title'];
        $results = $this->Report->query($query['Report']['params'] . $conditions);
        if (count($results) > 0) {

            foreach ($results[0] as $val) {
                foreach ($val as $key => $keyval) {

                    $columns[] = $key;
                }
            }
        }

        return array('title' => $title, "res" => $results, "col" => $columns);
    }

    public function admin_vreport($report_id = null, $type = null, $params_data = null) {

        $this->autoLayout = false;

        $data = $this->admin_create_report($report_id, $type, $params_data);
        $results = $data['res'];
        $columns = $data['col'];
        $title = $data['title'];

        if ($type == "download" and $type != null) {
            $this->Pdf->download($data['title'], '/admin/dreport', array("title" => $data['title'], "report_id" => $report_id, 'results' => $data['res'], 'columns' => $data['col']));
        } else {
            $this->set(compact('results', 'columns', 'title'));
        }
    }

    //this is for viewing audit trails of what staff members are doing within the application
    function view_audit_trails() {
        
    }

}

?>
