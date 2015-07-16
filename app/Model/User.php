<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');


class User extends AppModel {

    public $name = 'User';
    public $def_pass = '12345!@#';
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
            'conditions' => array('User.user_email' => trim($username), 'User.password' => hash('sha256', $password))
         //    'conditions' => array('User.user_email' =>$username, 'User.password' => $password)

                ));
        return $users;
    }

    function getdefPass() {
        return $this->$def_pass();
    }

    function addUser($data) {
        $this->save($data);
        $pass = $this->generatePass();
        $this->set(array('password' => hash('sha256', $pass)));
        $this->save();
        $data_return = array('name' => $data['fname'] . " " . $data['lname'], 'id' => $this->id, 'pass' => $pass, 'user_email' => $data['user_email']);
        return($data_return);
    }

    function removeUser() {
        
    }

    function generatePass() {
        $len = 4;
        $base = 'ABCDEFGHKLMNOPQRSTWXYZ1234567890';
        $max = strlen($base) - 1;
        $passcode = '';
        mt_srand((double) microtime() * 1000000);
        while (strlen($passcode) < $len + 2)
            $passcode.=$base{mt_rand(0, $max)};
        return $passcode;
    }

    function editUser($data) {
        $this->save($data);
        $data_return = array('name' => $data['fname'] . " " . $data['lname'], 'id' => $this->id, 'user_email' => $data['user_email']);

        return ($data_return);
    }

}

?>
