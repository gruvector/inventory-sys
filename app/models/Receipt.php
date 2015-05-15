<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Receipt extends AppModel {
    
    var $name ='Receipt';
     var $hasMany = array( 'ProductTransaction' => array(
    'className' => 'ProductTransaction',
    'foreignKey' => 'receipt_id',
    'conditions' => '',
    'order' => '',
    'limit' => '',
    'dependent' => true
    ));
    
}

?>
