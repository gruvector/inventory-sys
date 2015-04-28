<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Institution extends AppModel {

    var $name = 'Institution';
    var $hasMany = array(
        'Site' => array(
            'className' => 'Site',
            'foreignKey' => 'site_inst_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        )
    );

}

?>
