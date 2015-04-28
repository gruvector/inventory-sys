<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Event extends AppModel {

    var $name = 'Event';
    var $actsAs = array("Containable");
    var $hasMany = array(
        'Batch' => array(
            'className' => 'Batch',
            'foreignKey' => 'batch_event_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
        'Ticket' => array(
            'className' => 'Ticket',
            'foreignKey' => 'ticket_event_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        )
        ,
        'TicketType' => array(
            'className' => 'TicketType',
            'foreignKey' => 'event_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        )
    );

    function findEvents() {
        return $this->find('all', array(
                    'order' => array('Event.id' => "DESC"),
                    'recursive' => -1
                ));
    }

}

?>
