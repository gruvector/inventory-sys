<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class UserRole extends AppModel {

    var $name = 'UserRole';
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    var $belongsTo = array(
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'role_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}

?>
