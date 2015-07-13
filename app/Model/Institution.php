<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

class Institution extends AppModel {

    public $name = 'Institution';
    public $hasMany = array(
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
