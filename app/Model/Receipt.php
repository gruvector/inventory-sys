<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');


class Receipt extends AppModel {

    public $name = 'Receipt';
    public $actsAs = array('Containable');
    public $belongsTo = array(
        'Sale' => array(
            'className' => 'Sale',
            'foreignKey' => 'sale_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'staff_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    public $hasMany = array('ProductTransaction' => array(
            'className' => 'ProductTransaction',
            'foreignKey' => 'receipt_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));

}

?>
