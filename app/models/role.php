<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Role extends AppModel {

    var $name = 'Role';
    var $hasMany = array(
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
