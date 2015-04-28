<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Link extends AppModel {

    var $name = 'Link';
    var $uses = array('UserRole');

    
    var $hasMany = array(
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
