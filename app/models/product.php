<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Product extends AppModel {

    var $name = 'Product';
    var $hasMany = array(
        'ProductTransaction' => array(
            'className' => 'ProductTransaction',
            'foreignKey' => 'product_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
 var $belongsTo = array(
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
