<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */
class AppController extends Controller {

    var $helpers = array('Html', 'Form', 'javascript', 'ajax', 'Paginator', 'Session');
    var $components = array('RequestHandler', 'Session');
    var $paginate = array('limit' => 10);

    function beforeFilter() {


        $this->check_priv();
    }

    function check_priv() {
        //have to work out how i am going to work out the ajax functionlity for hte request handler
// may have to write a javascript function which will logout you out after some timeout session

        $user_links = $this->Session->read('user_links');
        $user_roles = $this->Session->read('role_short_array');
        $mem_data = $this->Session->read('memberData');



        ///this is a genral chech for sessions
        if (!$mem_data) {
            //$this->redirect('/');
            $this->redirect(array('controller' => 'Dashboard', 'action' => 'index'));
        }



        if ($this->action == 'landing_page' && !$this->RequestHandler->isAjax()) {
            $this->redirect(array('controller' => 'Dashboard', 'action' => 'index'));
        }



        if ($this->action != 'display' 
                && $this->name != 'Pages' 
                && $this->action != 'unauth_page' 
           /**     && $this->action != 'get_sales_info_list' **/
                && $this->action != 'landing_page'
                && $this->action != 'get_print_info_list'
                && !$this->RequestHandler->isAjax()) {

///this is fore redirectiong to login page if user isnt logged in 
           $status_link = false;
            //this is fore checking if the user has the correct roles to be able to access page 
            foreach ($user_links as $val) {

                if ($val['Link']['link_controller'] == $this->name && $val['Link']['link_action'] == $this->action) {
                    $status_link = true;
                    break;
                }
            }

            if ($status_link == false) {
                $this->redirect(array('controller' => 'User', 'action' => 'unauth_page'));
                exit;
            }
        }


        //will have to put the generic functionlity that all users are allowd to perform into another cont
        //will  have to set up the ajax  part also very  very well;
        //
        //
        //for mostly ajax stuff
        //this is for checking if  the use has the
        // correct privilges to be able to access  and chang site info




        /**
          if (
          ($this->name == 'User') && ($this->action == 'unauth_page' || $this->action == 'add_user')

          ) {

          } else {

          if ($this->name == 'Site' || $this->name == 'User') {
          //  print_r($user_roles);
          //
          if (!(in_array('SADM', $user_roles) || in_array('ADM', $user_roles) )) {
          $this->redirect(array('controller' => 'User', 'action' => 'unauth_page'));
          }
          }

          //this is for  checking and for making sure that the administrator is the only one
          // whom has accesss to the
          if ($this->name == 'Admin') {
          //  print_r($user_roles);
          //
          //
          //this is for checking and allowing admin to change the sites but
          // not have access to  other admin stuff
          if ($this->action == 'change_inst') {
          if (!(in_array('SADM', $user_roles) || in_array('ADM', $user_roles))) {
          $this->redirect(array('controller' => 'User', 'action' => 'unauth_page'));
          }
          }
          //this is for only superadmin stuff!!! for the ultimate bossus
          else if (!$this->action == 'change_inst') {
          if (!(in_array('SADM', $user_roles))) {
          $this->redirect(array('controller' => 'User', 'action' => 'unauth_page'));
          }
          }
          }
          }
         * */
    }

}

?>