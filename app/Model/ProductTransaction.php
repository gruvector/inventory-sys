<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');


class ProductTransaction extends AppModel {

    public $name = 'ProductTransaction';
    public $actsAs = array('Containable');
    public $belongsTo = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'product_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Sale' => array(
            'className' => 'Sale',
            'foreignKey' => 'sale_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Receipt' => array(
            'className' => 'Receipt',
            'foreignKey' => 'receipt_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}

?>
