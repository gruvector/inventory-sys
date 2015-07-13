<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');


class Product extends AppModel {

    public $name = 'Product';
    public $hasMany = array(
        'ProductTransaction' => array(
            'className' => 'ProductTransaction',
            'foreignKey' => 'product_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
 public $belongsTo = array(
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'category_product',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ));
			
			}
    
?>
