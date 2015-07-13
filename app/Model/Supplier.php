<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');


class Supplier extends AppModel {

    public $name = 'Supplier';
    public $actsAs = array("Containable");
    public $belongsTo = array(
        'Site' => array(
            'className' => 'Site',
            'foreignKey' => 'site_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'cat_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        )
    );

}

?>
