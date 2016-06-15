<?php

/*
  //shortcut for  login
  //have to also work on the site and hte institution lock --later
 * //may have to add some capthca to the login page --later
 */

class DashboardController extends Controller {

    public $name = 'Dashboard';
    public $helpers = array('Html','Form','Session');
    public $components = array('RequestHandler', 'Session', 'Cookie');
    public $paginate = array('limit' => 10);
    public $uses = array('User', 'Link', 'UserRole', 'RoleLink');
    public $layout = "defaulto";

    function beforeFilter() {
		
        $this->checkMainCred();
        $this->loadModel('User');
    }

    //this used for checking the main page to see whether  u have to be redirected to  reception
    function checkMainCred() {


        if ($this->Session->check('memberData') && $this->action != 'logoutUser') {
            $this->redirect(array('controller' => 'Customer', 'action' => 'view_products'));
        }
    }

    //shortcut for  logout
    function logoutUser() {
        $this->Session->delete('memberData');
        $this->Session->delete('role_short_array');
        $this->Session->delete('user_links');
        $this->Session->delete('site_id');
        $this->Session->delete('inst_id');
        $this->redirect(array('controller' => 'Dashboard', 'action' => 'index'));
    }

    function loginUser($user) {
		
		$user['User']['password']='';
		$user['User']['user_email']='';
		$this->Session->write('memberData', $user);
        $this->Session->write('site_id', $user['User']['site_id']);
        $this->Session->write('inst_id', $user['Site']['site_inst_id']);
        $this->getLinks($user['User']['id']);
        $this->redirect(array('controller' => 'Customer', 'action' => 'view_products'));
    }

    function getLinks($userid) {

        $roles = $this->UserRole->find('all', array("conditions" => array("UserRole.user_id" => $userid)));

        //$roles_user = array();
        //$conditions_array = array();
        $links = array();
        $role_short_array = array();
        foreach ($roles as $val) {
            $roles_user[] = $val['Role']['id'];
        }

        // print_r($roles_user) ;

        $condition_array['RoleLink.role_id'] = $roles_user;
        $links = $this->RoleLink->find("all", array("conditions" => $condition_array));
        foreach ($links as $val) {
            if (!in_array($val['Role']['role_short_name'], $role_short_array)) {
                $role_short_array[] = $val['Role']['role_short_name'];
            }
        }


        $this->Session->write('user_links', $links);
        $this->Session->write('role_short_array', $role_short_array);
    }

    //shortcut for checking login for users at login page
    function index() {
		
        if (isset($_POST['username']) && isset($_POST['password']) && $_POST['username'] != "" && $_POST['password'] != "") {
         $user_check = $this->User->find('first', array(
        'fields' => array('User.user_email','User.site_id','User.id','User.fname','User.lname','User.password','User.lock_status'),
        'contain' => array('Site'=>array('fields'=>array('Site.address','Site.email','Site.phone','Site.city','Site.site_lock','Site.site_inst_id','Site.id','Site.site_name'))),
         "conditions" => array("User.user_email" => $_POST['username'])));         
                    
             if (isset($user_check) && sizeof($user_check) > 1 ){               
             $newHash = Security::hash($_POST['password'], 'blowfish',$user_check['User']['password']); 
                if ($newHash==$user_check['User']['password']) {
                //will have to check for a  site lock as well as an institution lock here
                if ($user_check['User']['lock_status'] >= 3) {
                    $user_login = "false";
                    $msg = "Please Enter Correct Username and Password To Login";
                    $this->set(compact('user_login', 'msg'));
                } else if ($user_check['User']['lock_status'] < 3) {
                    //login user
                    //will check if the site hasnt been locked 
                    if ($user_check['Site']['site_lock'] == '0') {
                        $user_login = "false";
                        $msg = "Please Enter Correct Username and Password To Login";
                        $this->set(compact('user_login', 'msg'));
                    } else {
                        $user_check_login = new User();
                        $user_check_login->set(array('id' => $user_check['User']['id'], 'lock_status' => '0'));
                        $user_check_login->save();
                        $this->loginUser($user_check);
                    }
                }
            
            }           
             else {
                //user wasnt able to login but other stuff is being tested 
                // a captcha may have to be shown here to make sure the user stuff is correct and no 
               //hacks are being attempted	
                if (isset($user_check) && sizeof($user_check) > 1 && $user_check['User']['lock_status'] < 3) {
                    // echo "user-statushere" . $user['User']['lock_status'];
                    $new_lock_number = intval($user_check['User']['lock_status']) + 1;
                    $user_check_save = new User();
                    $user_check_save->set(array(
                        'id' => $user_check['User']['id'],
                        'lock_status' => $new_lock_number
                    ));
                    $user_check_save->save();
                    $user_login = "false";
                    $msg = "Please Enter Correct Username and Password To Login";
                } else if (isset($user_check) && sizeof($user_check) > 1 && $user_check['User']['lock_status'] >= 3) {
                    $user_login = "false";
                    $msg = "Please Enter Correct Username and Password To Login";
                }else{
				    $user_login = "false";
                    $msg = "Please Enter Correct Username and Password To Login";	
					}
                $this->set(compact('user_login', 'msg'));
            }
        
	}	
	else{
		
		  $user_login = "false";
            $msg = "Please Enter Correct Username and Password To Login";
            $this->set(compact('user_login', 'msg'));
		}       
        } else {
            $user_login = "false";
            $msg = "Please Enter Correct Username and Password To Login";
            $this->set(compact('user_login', 'msg'));
        }
    }

}

?>
