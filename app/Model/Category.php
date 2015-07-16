<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 App::uses('AppModel', 'Model');


class Category extends AppModel {

    public $name = 'Category';
    public $hasMany = array(
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
