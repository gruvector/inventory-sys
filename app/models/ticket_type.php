<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class TicketType extends AppModel {

    var $name = 'TicketType';
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $actsAs = array("Containable");
    var $hasMany = array(
        'Batch' => array(
            'className' => 'Batch',
            'foreignKey' => 'ticketype',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
        'Ticket' => array(
            'className' => 'Ticket',
            'foreignKey' => 'ticket_type',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        )
    );
    var $belongsTo = array(
        'Site' => array(
            'className' => 'Site',
            'foreignKey' => 'site_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ), 'Event' => array(
            'className' => 'Event',
            'foreignKey' => 'event_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        )
    );

}

?>
