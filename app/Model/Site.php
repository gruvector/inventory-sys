<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');


class Site extends AppModel {

    public $name = 'Site';
    public $hasMany = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'site_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
        'Supplier' => array(
            'className' => 'Supplier',
            'foreignKey' => 'site_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        )
    );
    public $belongsTo = array(
        'Institution' => array(
            'className' => 'Institution',
            'foreignKey' => 'site_inst_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        )
    );

}

?>
