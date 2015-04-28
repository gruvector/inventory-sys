<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class RoleLink extends AppModel {

    var $name = 'RoleLink';
    //The Associations below have been created with all possible keys, those that are not needed can be removed



    var $belongsTo = array(
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
