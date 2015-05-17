<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class ReverseReason extends AppModel {

       var $name = 'ReverseReason';
 
     var $hasMany = array(
        'Sale' => array(
            'className' => 'Sale',
            'foreignKey' => 'reverse_reason',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ));
}


?>
