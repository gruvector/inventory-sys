<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');


class Role extends AppModel {

    public $name = 'Role';
    public $hasMany = array(
        'UserRole' => array(
            'className' => 'UserRole',
            'foreignKey' => 'role_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
        'RoleLink' => array(
            'className' => 'RoleLink',
            'foreignKey' => 'role_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
        'ReportRole' => array(
            'className' => 'ReportRole',
            'foreignKey' => 'role_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        )
    );

}

?>
