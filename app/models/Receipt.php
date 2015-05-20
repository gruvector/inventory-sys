<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Receipt extends AppModel {

    var $name = 'Receipt';
    var $actsAs = array('Containable');
    var $belongsTo = array(
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
    var $hasMany = array('ProductTransaction' => array(
            'className' => 'ProductTransaction',
            'foreignKey' => 'receipt_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));

}

?>
