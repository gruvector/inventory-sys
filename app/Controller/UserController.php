<?php

App::uses('AppController', 'Controller');

class UserController extends AppController {

    public $name = 'User';
    public $components = array('RequestHandler', 'Session');
    public $uses = array('User', 'Site', 'Role', 'UserRole');
    public $layout = 'dashboard';
    public $helpers = array('Form', 'Html', 'Time', 'Session','Paginator');

    function beforeFilter() {
// first before allowing the user to access
//checking ajax links to make sure they can be authenticated and only legitimate users are allowed to access ajax links has to be added .
//differnt link  has to be made for editing your own personal info


        parent::beforeFilter();
        $this->loadModel('User');
        $this->loadModel('UserRole');

        
    }

    function view_users() {
        // print_r($_SESSION);
        $layout_title = "Staff";
        $this->set(compact('layout_title'));
    }

    function update_password() {
                $this->autoLayout = false;
               Security::setHash('blowfish');
               $mem_data = $this->Session->read('memberData');
               $old_pass=$_GET['old_pass'];
               $new_pass=$_GET['new_pass'];
               $repeat_new=$_GET['repeat_new'];
               $mem_user_data=$mem_data['User'];                       
               if($new_pass!=$repeat_new)
               {
			  echo json_encode(array("status" => "false","message"=>"Repeat Password Isnt Correct"));
			   }
			   else{
               $user_check = $this->User->find('first', array(
               'contain'=>array(),
               'fields' => array('User.password'),"conditions" => array("User.id" => $mem_user_data['id'])));
               $newHash = Security::hash($old_pass, 'blowfish',$user_check['User']['password']); 
				 if ($newHash==$user_check['User']['password']) {
                    $pass_new_hash=Security::hash($new_pass);
                    $user = new User();
                    $user->set(array(
                        'id' => $mem_user_data['id'],
                        'password' => $pass_new_hash
                    ));
                    $user->save();
                    echo json_encode(array("status" => "true"));              
        }else{
		echo json_encode(array("status" => "false","message"=>"Old PassWord Incorrect"));
			
			 }
			 }
               
     exit();
    }

 //stupiddumb passgenerator for basic passes due to use case
   public function generatePass() {
        $len = 5;
        $base = "abcdefghijklmnopqrstuvwxzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $max = strlen($base) - 1;
        $passcode = '';
        mt_srand((double) microtime() * 1000000);
        while (strlen($passcode) < $len + 2)
            $passcode.=$base{mt_rand(0, $max)};
        return $passcode;
    }



    //have to first check whether a user exists first before the user is added
    function add_user() {
        $this->autoLayout = false;

        if (isset($_GET['add_user']) && $_GET['add_user'] == '1') {

            $mem_data = $this->Session->read('memberData');
            $user_data=$mem_data['User'];
            $data = $_GET['data']['User'];
            if (isset($_GET['data']['User']['id']) && $_GET['data']['User']['id'] != '') {
                
                
                    $add_user_data = $this->User->editUser($data);
                  echo json_encode(array("status" => "false"));
            } else {

                $User = $this->User->find("first", array("conditions" => array("User.user_email" => $data['user_email'])));
                if ($User) {
                    echo json_encode(array("status" => "false",
                        "message_code" => "UAE",
                        "message" => "User Already Exists . Please Change Email"));
                } else {
					//print_r($data);
					$data['site_id']=$this->Session->read('site_id');
					$data['inst_id']=$this->Session->read('inst_id');	
                    $pass =    $this->generatePass();
                    Security::setHash('blowfish');
                    $pass_hash=Security::hash($pass);
					$data['password']=$pass_hash;						
                    $add_user_data = $this->User->addUser($data);
                    
                  if($add_user_data!=false){     
                    //$data = array('id' => $add_user_data['id'], 'pass' => $add_user_data['pass']);
                    // $this->email_user_pass('new', $data);
                    echo json_encode(array("new_pass" => $pass, "status" => "true", "name" => $add_user_data['name']));
               }
              else if($add_user_data==false){     
				   echo json_encode(array("status" => "false",
                        "message_code" => "error",
                        "message" => "Error Saving.<br>Please Try Again After Checking Fields"));
				  }
                }

                //email will have to sent to new user at this point containing pass
            }
            exit();
        }
        if (isset($_GET['id']) && $_GET['edit_user'] == 'true') {

            $id = $_GET['id'];
            $User = $this->User->find("first", array("conditions" => array("User.id" => $id)));
            $sites = $this->Site->find("all", array("conditions" => array("Site.site_inst_id" => $this->Session->read('inst_id'))));
            $this->set(compact('sites', 'User'));
        } else {
            // echo "Current Site--".$this->Session->read('inst_id');
            $sites = $this->Site->find("all", array("conditions" => array("Site.site_inst_id" => $this->Session->read('inst_id'))));
            $this->set(compact('sites'));
        }
    }

    function edit_roles($user_id) {

        $this->autoLayout = false;

        //find all roles possible
        $roles = $this->Role->find("all", array("recursive" => "0"));
        $user_roles = $this->UserRole->find("list", array('fields' => 'role_id', "conditions" => array("UserRole.user_id" => $user_id), "recursive" => 0));

        $this->set(compact('roles', 'user_roles'));
        // find roles which have been given to current user 
    }

    function user_list($paginate_link = null) {

        $this->autoLayout = false;

        $filter = isset($_GET['filter']) && $_GET['filter'] != "null" ? $_GET['filter'] : "";
        $conditions_array = array(
            'Site.site_inst_id' => $this->Session->read('inst_id'),
            'OR' => array(
                'User.fname LIKE' => "%" . $filter . "%",
                'User.lname LIKE' => "%" . $filter . "%",
                'User.user_email LIKE' => "%" . $filter . "%"
                ));

        if ($paginate_link != null) {

            $page_array = explode($paginate_link, ":");
            $this->paginate = array(
                'User' => array(
                    'conditions' => $conditions_array,
                    'contain' => 'Site',
                    'order' => array('User.id' => 'desc'),
                    'page' => $page_array[1],
                    'limit' => 10));


            $users = $this->paginate('User');
        } else {
            $this->paginate = array(
                'User' => array(
                    'conditions' => $conditions_array,
                    'contain' => 'Site',
                    'order' => array('User.id' => 'desc'),
                    'limit' => 10));
            $users = $this->paginate('User');
        }
        // print_r($users);
        $this->set(compact('users'));
    }

    function email_user_pass($type, $data) {
        $user_data = $this->User->find('first', array("recursive" => -1, 'fields' => array('fname', 'lname', 'user_email'), 'conditions' => array('User.id' => $data['id'])));
        $pass = $data['pass'];
        if ($type == 'reset') {
            $body_email = '<br>Hello ' . $user_data['User']['fname'] . ','
                    . '<br>Your Password Has Been Reset'
                    . '<br>Your New Password Is ' . $pass
                    . '<br>Than You !!';
        } else if ($type == 'new') {
            $body_email = '<br>Hello ' . $user_data['User']['fname'] . ','
                    . '<br>You Are A Proud Member Of Mobiticketz '
                    . '<br>Your User Credentials Are'
                    . '<br>Username :' . $user_data['User']['user_email']
                    . '<br>Your New Password Is ' . $pass
                    . '<br>Welcome !!'
                    . '<br>Than You !!';
        }
        $title = 'Password Reset';
        $email = $user_data['User']['user_email'];
       // $email_status = $this->TicketGenericEmail->send($body_email, array($email), $dataObj = array(), $title, $params = NULL);
    }

    function edit_status() {
        if ($this->RequestHandler->isAjax()) {
            $this->autoLayout = false;

            $type = $_GET['type'];
            $id = $_GET['id'];

            $user = new User();

            switch ($type) {

                case "reset_pass":
                                    
                    $pass = $this->generatePass();
                    Security::setHash('blowfish');
                    $pass_hash=Security::hash($pass);
                    $user->set(array(
                        'id' => $id,
                        'password' => $pass_hash
                    ));
                    $user->save();
                    $data = array('pass' => $pass, 'id' => $id);
                    echo json_encode(array("new_pass" => $pass));
                    //    $this->email_user_pass('reset', $data);
                    //email will have to sent to new user at this point containing pass

                    break;
                case "lock":
                    $user->set(array(
                        'id' => $id,
                        'lock_status' => '5'
                    ));
                    $user->save();

                    break;
                case "unlock":
                    $user->set(array(
                        'id' => $id,
                        'lock_status' => '0'
                    ));
                    $user->save();

                    break;
            }
            exit();
        }
    }

    function save_roles() {
        $this->autoLayout = false;

        $id = $_GET['id'];
        $roles = $_GET['roles'];
        $roles_user = explode(",", $roles);

        $conditions = array("UserRole.user_id" => $id);
        $this->UserRole->deleteAll($conditions);
        foreach ($roles_user as $val) {
            $role = new UserRole();
            $role->set(array("role_id" => $val,
                "user_id" => $id));
            $role->save();
        }
        echo json_encode(array("status" => "true"));
        exit();
    }

    function unauth_page() {
        $layout_title = "OOPS!!";
        $this->set(compact('layout_title'));
    }

}

?>
