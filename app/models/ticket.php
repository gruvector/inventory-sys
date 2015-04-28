<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ticket extends AppModel {

    var $name = 'Ticket';
    var $actsAs = array("Containable");
    var $belongsTo = array(
        'Batch' => array(
            'className' => 'Batch',
            'foreignKey' => 'ticket_batch_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
        'Event' => array(
            'className' => 'Event',
            'foreignKey' => 'ticket_event_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ), 'TicketType' => array(
            'className' => 'TicketType',
            'foreignKey' => 'ticket_type',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        )
    );

    function findTickets() {
        return $this->find('all', array(
                    'order' => array('Ticket.id' => "DESC"),
                ));
    }

}

?>
