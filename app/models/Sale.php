<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Sale extends AppModel {
    var $name = 'Sale';
    var $hasMany = array( 'ProductTransaction' => array(
    'className' => 'ProductTransaction',
    'foreignKey' => 'sale_id',
    'conditions' => '',
    'order' => '',
    'limit' => '',
    'dependent' => true
    ));
}

?>
