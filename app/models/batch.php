<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Batch extends AppModel {

    var $name = 'Batch';
    var $actsAs = array("Containable");
    var $belongsTo = array(
        'Event' => array(
            'className' => 'Event',
            'foreignKey' => 'batch_event_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ), 
        'TicketType' => array(
            'className' => 'TicketType',
            'foreignKey' => 'ticketype',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ) ,
            'Category' => array(
                'className' => 'Category',
                'foreignKey' => 'batch_category',
                'conditions' => '',
                'order' => '',
                'limit' => '',
                'dependent' => true
        )
    );

    function findBatches() {
        return $this->find('all', array(
                    'contain' => array('Event'),
                    'order' => array('Batch.id' => "DESC"),
                ));
    }

}

?>
