<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Category extends AppModel {

    var $name = 'Category';
    var $hasMany = array(
        'Batch' => array(
            'className' => 'Batch',
            'foreignKey' => 'batch_category',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
         'Supplier' => array(
            'className' => 'Supplier',
            'foreignKey' => 'cat_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
		  'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'category_product',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        )
    );
}




?>
