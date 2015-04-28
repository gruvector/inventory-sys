<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Supplier extends AppModel {

    var $name = 'Supplier';
    var $actsAs = array("Containable");
    var $belongsTo = array(
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
