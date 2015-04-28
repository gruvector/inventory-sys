<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ProductTransaction extends AppModel {
    var $name = 'ProductTransaction';
   var $belongsTo = array(
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
        )
    );
}

?>
