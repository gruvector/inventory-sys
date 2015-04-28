<?php

App::import('Vendor', 'swift_required', array('file' => 'swiftemail' . DS . 'swift_required.php'));

/**
 * MOBITICKETZ GENERIC EMAIL COMPONENT
 */
class TicketGenericEmailComponent extends Object {

    var $name = 'TicketGenericEmail';
    var $mail_setup_transport;
    var $smtp_host = "smtp.gmail.com";
    var $smtp_port = "465";
    var $smtp_username = "mticket12345@gmail.com";
    var $smtp_pass = "MtZxckvt123098!@#Zxc&(*)";
    var $mailer;
    var $email_to_from = array('mobisupport@MOBITICKETZ.com' => 'MOBITICKETZ');
    var $bounce_address = 'nayibor@gmail.com';
    var $read_receipt_email = 'nayibor@gmail.com';

    //this will be used for setthing up  /antiflooding/throothling of emails
    //loggin can be instantiated also here
    //decorators may not be intiilized here 


    function initialize(&$controller, $settings = array()) {
        // saving the controller reference for later use
        $this->controller = & $controller;
       // $this->mail_setup_transport = Swift_SmtpTransport::newInstance($this->smtp_host, $this->smtp_port, 'ssl')->setUsername($this->smtp_username)->setPassword($this->smtp_pass);

        //for testing purposes mailer will be  used in real time
        $this->mail_setup_transport = Swift_SmtpTransport::newInstance('localhost', 25);


        // Use AntiFlood to re-connect after 100 emails
        $this->mail_setup_transport->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100));
// And specify a time in seconds to pause for (30 secs)
        $this->mail_setup_transport->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100, 30));

        //anti throttle settings
        // Rate limit to 100 emails per-minute
        $this->mail_setup_transport->registerPlugin(new Swift_Plugins_ThrottlerPlugin(
                        100, Swift_Plugins_ThrottlerPlugin::MESSAGES_PER_MINUTE
        ));
// Rate limit to 10MB per-minute
        $this->mail_setup_transport->registerPlugin(new Swift_Plugins_ThrottlerPlugin(
                        1024 * 1024 * 10, Swift_Plugins_ThrottlerPlugin::BYTES_PER_MINUTE
        ));
    }

    //will have to heavily customize this class in the future 
    function send($email_body, $email_address, $dataObj, $title, $params = NULL) {


        $replacements = array();
        foreach ($email_address as $val) {
            if (isset($dataObj['keys_replace'])) {

                $replacements[$val] = $dataObj['keys_replace'];
            }
        }
        //print_r($replacements);

        $decorator = new Swift_Plugins_DecoratorPlugin($replacements);
        $this->mailer = Swift_Mailer::newInstance($this->mail_setup_transport);

        $this->mailer->registerPlugin($decorator);
        $message = Swift_Message::newInstance();
        $message->setSubject($title);
        $message->addPart(str_replace("\r\n", "", $email_body), 'text/html');

// Add alternative parts with addPart()
        $message->addPart($email_body, 'text/plain');

// Create the attachment for an email
        if (isset($dataObj['attachments'])) {
            foreach ($dataObj['attachments'] as $val) {
                if ($val['type'] == "raw") {
                    $attachment = Swift_Attachment::newInstance($val['data'], $val['name'], $val['ctype']);
// Attach it to the message
                    $message->attach($attachment);
                }
            }
        }
        foreach ($email_address as $val) {
            $message->addTo($val);
        }
        $message->setFrom($this->email_to_from)->setReturnPath($this->bounce_address)->setReadReceiptTo($this->read_receipt_email);
        // Send email
        $message->setPriority(2);
        //  echo $email;
        ///   exit();
        $result = $this->mailer->send($message);
        return $result;
    }

}

?>
