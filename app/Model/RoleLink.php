<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');


class RoleLink extends AppModel {

    public $name = 'RoleLink';
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $belongsTo = array(
        'Link' => array(
            'className' => 'Link',
            'foreignKey' => 'link_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'role_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        )
    );

}

?>
