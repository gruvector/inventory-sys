<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppModel', 'Model');


class ReverseReason extends AppModel {

     public $name = 'ReverseReason';
 
     public $hasMany = array(
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
