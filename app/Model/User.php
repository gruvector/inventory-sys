<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');


class User extends AppModel {
	
	
/** 
	 public $validate = array(
	 
'user_email' => array(
'email_test' => array('rule' => 'email','required' => true,'allowEmpty' => false),
'uniq_test' => array('rule' => 'isUnique')
)

   'user_email' => array(
    'rule' => 'email',
    'required' => true,
    'allowEmpty' => false
)

     );**/


    public $name = 'User';
    public $actsAs = array('Containable');
    public $belongsTo = array(
        'Site' => array(
            'className' => 'Site',
            'foreignKey' => 'site_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        )
    );
    public $hasMany = array(
        'UserRole' => array(
            'className' => 'UserRole',
            'foreignKey' => 'role_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
        'Receipt' => array(
            'className' => 'Receipt',
            'foreignKey' => 'staff_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
        'ProductTransaction' => array(
            'className' => 'ProductTransaction',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
        'Sale' => array(
            'className' => 'Sale',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        )
    );

    function findUserData($userid) {
        $users = $this->find('all', array(
            'conditions' => array('User.id' => $userid),
            'recursive' => -1
                ));
        return $users;
    }

    function checkUser($username, $password) {
        $users = $this->find('first', array(
            'conditions' => array('User.user_email' => trim($username), 'User.password' => $password)
         //    'conditions' => array('User.user_email' =>$username, 'User.password' => $password)

                ));
        return $users;
    }

    function getdefPass() {
        return $this->$def_pass();
    }

    function addUser($data) {
        $this->set($data);         
        if($this->save()){
        $data_return = array('name' => $data['fname'] . " " . $data['lname']);
        return $data_return;
	}else{
		return false;
		}
    }



   function  create_pass(){
	   }
   
  function   get_pass(){
	  }

   
    function removeUser() {
        
    }

   
    function editUser($data) {
        
        if($this->save($data)){
        $data_return = array('name' => $data['fname'] . " " . $data['lname'], 'id' => $this->id, 'user_email' => $data['user_email']);        
        return $data_return;
	}{
		return false ;
	 }
    }

}

?>
