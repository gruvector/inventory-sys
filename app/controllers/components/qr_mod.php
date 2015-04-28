<?php

App::import('Vendor', 'WOL', array('file' => 'phpqrcode' . DS . 'qrlib.php'));

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class QrModComponent extends Object {
    //encryption of the ticket data will be done here also 
    //this is for initializing the qrmode component
    function initialize(&$controller, $settings = array()) {
        // saving the controller reference for later use
        $this->controller = & $controller;
    }

    //this is for creating the qr code for the ticket
    function create_barcode_ticket($string) {
        $tmpfname = tempnam("/tmp", "qr");
        QRcode::png($string, $tmpfname, 'L', 4, 2);
        $fp = fopen($tmpfname, 'r');
        $content = addslashes(fread($fp, filesize($tmpfname)));
        fclose($fp);
        return $content;
    }
 //this is for decrypting and decompressing the contents of teh qr code
    function decrypt_contents($data,$prkey){}
 
//this is for encrypting the contentss of the the qr code
    function encrypt_contents($data,$pukey){
        
    }
    
     
       function create_ticket_data() {
        $len = 10;
        $base = '!ABCDEFGHKLMNOPQRSTWXYZ1234567890~?abcdefghijklmnopqrstuvwxyz!@#$%^&*,.';
        $max = strlen($base) - 1;
        $data_ticket = '';
        $rt_value = '';
        mt_srand((double) microtime() * 1000000);
        while (strlen($data_ticket) < $len + 2)
            $data_ticket.=$base{mt_rand(0, $max)};
        $rt_value = Security::hash($data_ticket . String::uuid());
        return $rt_value;
    }
}

?>
