<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ReceptionController extends AppController {

    var $name = 'Reception';
    var $components = array('RequestHandler', 'Session');
    var $uses = array("User", 'Event', 'Batch', 'Ticket', 'Category', 'TicketType');
    var $layout = 'dashboard_layout';
    public $helpers = array('Form', 'Html', 'Js', 'Time', 'Paginator');

    function beforeFilter() {

        parent::beforeFilter();
    }

    //this code is used for verfying tickes
    // most if it is however done using sockets so this is just a front end
    function verify_tickets() {

        $layout_title = 'Verify Tickets';
        $this->set(compact('layout_title'));
    }

    //this is the landing page to be used by the application
    function landing_page() {
        $layout_title = 'WELCOME';
        $this->set(compact('layout_title'));
    }

    function event_list($paginate_link = null) {
        $this->autoLayout = false;

        $filter = isset($_GET['filter']) && $_GET['filter'] != "null" ? $_GET['filter'] : "";
        $archive_status = isset($_GET['event_archive_status']) && $_GET['event_archive_status'] != "null" ? $_GET['event_archive_status'] : "";

        $conditions_array = array(
            'Event.site_id' => $this->Session->read('site_id'),
            'OR' => array(
                'Event.event_name LIKE' => "%" . $filter . "%",
                'Event.event_location LIKE' => "%" . $filter . "%",
            ),
            'AND' => array(
                'Event.event_archive_status' => $archive_status
            )
        );

        if ($paginate_link != null) {

            $page_array = explode($paginate_link, ":");
            $this->paginate = array(
                'Event' => array(
                    'conditions' => $conditions_array,
                    'order' => array('Event.id' => 'desc'),
                    'page' => $page_array[1],
                    'limit' => 5));


            $events = $this->paginate('Event');
        } else {
            $this->paginate = array(
                'Event' => array(
                    'conditions' => $conditions_array,
                    'order' => array('Event.id' => 'desc'),
                    'limit' => 5));
            $events = $this->paginate('Event');
        }


        $this->set(compact('events'));
    }

    function batch_list($paginate_link = null) {

        $this->autoLayout = false;
        $filter = isset($_GET['filter']) && $_GET['filter'] != "null" ? $_GET['filter'] : "";
        $conditions_array = array(
            'Batch.site_id' => $this->Session->read('site_id'),
            'OR' => array(
                'Batch.batch_name LIKE' => "%" . $filter . "%"/* ,
              'Event.event_location LIKE' => "%" . $filter . "%"* */
                ));

        if ($paginate_link != null) {

            $page_array = explode($paginate_link, ":");
            $this->paginate = array(
                'Batch' => array(
                    'conditions' => $conditions_array,
                    'order' => array('Batch.id' => 'desc'),
                    'page' => $page_array[1],
                    'limit' => 5));


            $batches = $this->paginate('Batch');
        } else {
            $this->paginate = array(
                'Batch' => array(
                    'conditions' => $conditions_array,
                    'order' => array('Batch.id' => 'desc'),
                    'limit' => 5));
            $batches = $this->paginate('Batch');
        }

        $this->set(compact('layout_title', 'batches'));
    }

    function dashboard() {

        $layout_title = 'Add New Member';
        $this->set(compact('layout_title'));
    }

    function view_events() {
        $layout_title = "Events";
        //  print_r($_SESSION);
        $this->set(compact('layout_title'));
    }

    function view_batches() {

        $layout_title = "Batches";
        $this->set(compact('layout_title'));
    }

    function del_event() {
        $id = $_GET['id'];
        //   $conditions = array("Event.id" => $id);
        //   $this->Event->deleteAll($conditions);
        //  $event_data = array();
        //   $event_data['id'] = $id;
        //    $event_data['site_id'] = $this->Session->read('site_id');
        //      $event_data['event_archive_status'] = 'true';
        $evt = new Event();
        $evt->updateAll(array('Event.event_archive_status' => 'true'), array('Event.id' => $id, 'Event.site_id' => $this->Session->read('site_id')));
        echo json_encode(array("status" => "true"));
        exit();
    }

    /* this is for adding/editing new events to the system */

    function add_event() {
        $this->autoLayout = false;

        if (isset($_GET['save_eve'])) {
            $event_data = $_GET['data']['Event'];
            // print_r($_GET);
            //   print_r($event_data);
            $event_data['event_start'] = $_GET['event_start'];
            $event_data['event_end'] = $_GET['event_end'];
            $event_data['site_id'] = $this->Session->read('site_id');
            $this->Event->save($event_data);
            echo json_encode(array("status" => "1"));
            exit();
        } else if (isset($_GET['edit_url'])) {
            $id = $_GET['id'];
            $event = $this->Event->find("first", array("conditions" => array("Event.id" => $id)));
            $this->set(compact('event'));
        }
    }

    function create_ticket_batch($data) {

        for ($i = 0; $i <= $data['ticket_number']; $i++) {

            $ticket = new Ticket();
            $ticket->set(array(
                'ticket_event_id' => $data['ticket_event_id'],
                'ticket_batch_id' => $data['ticket_batch_id'],
                'ticket_encrypted_value' => 'QWERASDFZXC12347890UYIOPHJK',
                'ticket_value' => 'test'
            ));
            $ticket->save();
        }
    }

    function del_batch() {
        $id = $_GET['id'];
        $conditions = array("Batch.id" => $id);
        $this->Batch->deleteAll($conditions);
        echo json_encode(array("status" => "true"));
        exit();
    }

    function view_eventsales() {

        $layout_title = "Event Sales";
        //print_r($_SESSION);

        $this->set(compact('layout_title'));
    }

    function view_eventsaleslist() {

        $this->autoLayout = false;

        $sales = $this->Ticket->find("all", array(
            'group' => array('Ticket.ticket_event_id'),
            /** 'conditions'=>array('Ticket.site_id' => $this->Session->read('site_id')),* */
            'fields' => array(
                'count(Ticket.id) ticketcount',
                "sum(if(Ticket.ticket_redeem_status in ('1','2'), 1, 0)) ticket_redeem",
                "sum(if(Ticket.ticket_redeem_status = '2', 1, 0)) ticket_verified",
                "sum(if(Ticket.ticket_redeem_status in ('1','2'), 1, 0))- sum(if(Ticket.ticket_redeem_status = '2', 1, 0)) ticket_unverified",
                'Ticket.ticket_event_id'),
            'recursive' => "-1"
                ));


        $events = $this->Event->find('all', array('recursive' => '0', 'fields' => array("Event.id", 'Event.event_name', 'Event.event_start', 'Event.event_end', 'Event.event_location')));
        $evdata = array();

        foreach ($events as $val) {
            $evdata[$val['Event']['id']] = $val['Event'];
        }

        $this->set(compact('sales', 'evdata'));
    }

    function add_batch() {

        $this->autoLayout = false;
        $batch_data = array();

        if (isset($_GET['save_batch'])) {
            $batch_data = $_GET['data']['Batch'];
            $batch_data['site_id'] = $this->Session->read('site_id');
            //  print_r($batch_data);
            //   exit();
            $this->Batch->save($batch_data);
            echo json_encode(array("status" => "1"));
            exit();

            /**
              if (isset($batch_data['id']) && $batch_data['id'] == "") {
              $data = array();
              $data['ticket_event_id'] = $_GET['data']['Batch']['batch_event_id'];
              $data['ticket_batch_id'] = $this->Batch->id;
              $data['ticket_number'] = $_GET['data']['Batch']['batch_ticket_number'];
              $this->create_ticket_batch($data);
              echo json_encode(array("status" => "1"));
              exit();
              } else {
              echo json_encode(array("status" => "1"));
              exit();
              }
             * */
        } else if (isset($_GET['edit_url'])) {
            $id = $_GET['id'];
            $batch = $this->Batch->find("first", array("conditions" => array("Batch.id" => $id)));
            $events = $this->Event->find("all", array("all", "fields" => array("id", "event_name")));
            $tt = $this->TicketType->find("all", array("all", "fields" => array("id", "type_name")));
            $categories = $this->Category->find('all', array('fields' => array('long_name', 'id')));

            $this->set(compact('batch', 'events', 'categories', 'tt'));
        } else {
            $events = $this->Event->find("all", array("all", array('conditions' => array('Event.site_id' => $this->Session->read('site_id')), "fields" => array("id", "event_name"))));
            $categories = $this->Category->find('all', array('fields' => array('long_name', 'id')));
            $tt = $this->TicketType->find("all", array("all", array('conditions' => array('Event.site_id' => $this->Session->read('site_id')), "fields" => array("id", "type_name"))));

            $this->set(compact('events', 'categories', 'tt'));
        }
    }

    function view_stats() {

        $layout_title = "View Statistics";
        $this->set(compact('layout_title'));
    }

    function upload_tickets() {
        $layout_title = "Upload Tickets";
        $this->set
                (compact('layout_title'));
    }

    //this is for viewing the ticket types in the sytem

    function tt_list($paginate_link = null) {

        if ($this->RequestHandler->isAjax()) {

            $this->autoLayout = false;
            $filter = isset($_GET['filter']) && $_GET['filter'] != "null" ? $_GET['filter'] : "";
            $conditions_array = array(
                'TicketType.site_id' => $this->Session->read('site_id'),
                'OR' => array(
                    'TicketType.type_name LIKE' => "%" . $filter . "%",
                    'Event.event_name LIKE' => "%" . $filter . "%"
                    ));

            if ($paginate_link != null) {

                $page_array = explode($paginate_link, ":");
                $this->paginate = array(
                    'TicketType' => array(
                        'conditions' => $conditions_array,
                        'order' => array('TicketType.id' => 'desc'),
                        'page' => $page_array[1],
                        'limit' => 5));


                $tickettypes = $this->paginate('TicketType');
            } else {
                $this->paginate = array(
                    'TicketType' => array(
                        'conditions' => $conditions_array,
                        'order' => array('TicketType.id' => 'desc'),
                        'limit' => 5));
                $tickettypes = $this->paginate('TicketType');
            }

            $this->set(compact('tickettypes'));
        }
    }

    //this is for adding a new ticket type
    function add_tt() {

        $this->autoLayout = false;

        if (isset($_GET['save_tt'])) {
            $tt_data = $_GET['data']['TicketType'];
            $tt_data['site_id'] = $this->Session->read('site_id');
            $tt_data['inst_id'] = $this->Session->read('inst_id');

            $this->TicketType->save($tt_data);
            echo json_encode(array("status" => "1"));
            exit();
        } else if (isset($_GET['edit_tt'])) {
            $id = $_GET['id'];
            $events = $this->Event->find("all", array("all", 'conditions' => array('Event.site_id' => $this->Session->read('site_id')), "fields" => array("id", "event_name")));
            $TicketTypes = $this->TicketType->find('first', array('conditions' => array('TicketType.id' => $id)));
            $site_id = $this->Session->read('site_id');
            $inst_id = $this->Session->read('inst_id');

            $this->set(compact('site_id', 'inst_id', 'events', 'TicketTypes'));
        } else {
            $events = $this->Event->find("all", array("all", 'conditions' => array('Event.site_id' => $this->Session->read('site_id')), "fields" => array("id", "event_name")));
            $this->set(compact('events'));
        }
    }

//this is for viewing the particular ticket type
    function view_tickettype() {
        $layout_title = "Event Ticket Types";
        $this->set
                (compact('layout_title'));
    }

}

?>
