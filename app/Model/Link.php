<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

class Link extends AppModel {

    public $name = 'Link';
    public $uses = array('UserRole');
    public $hasMany = array(
        'RoleLink' => array(
            'className' => 'RoleLink',
            'foreignKey' => 'link_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        )
    );
    
    
    function getLinks($link_data) {

     
        return $this->find('all', array(
                    'recursive' => 1, 'conditions' => array('Link.link_allow' => 'true')));
    }

}

?>
