<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');


class Sale extends AppModel {

    public $name = 'Sale';
    public $actsAs = array('Containable');
    public $hasMany = array(
        'ProductTransaction' => array(
            'className' => 'ProductTransaction',
            'foreignKey' => 'sale_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
        'Receipt' => array(
            'className' => 'Receipt',
            'foreignKey' => 'sale_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
    public $belongsTo = array(
        'ReverseReason' => array(
            'className' => 'ReverseReason',
            'foreignKey' => 'reverse_reason',
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
