<?php

 
        $user_links = $this->Session->read('user_links');
        $user_roles = $this->Session->read('role_short_array');
        $mem_data = $this->Session->read('memberData');
        //print_r($user_links);
        //exit();
		$links_array = array();
		//$roles_array = array();


foreach ($user_links as $val) {
    $links_array[$val['Link']['link_category']][] = array('link_controller' => $val['Link']['link_controller'], 'link_action' => $val['Link']['link_action'], 'link_name' => $val['Link']['link_name']);
}
$categories = array_keys($links_array);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>INVENTORY SYS</title>
        <?php
        echo $this->Html->css('login.css');
        echo $this->Html->css('form.css');
        echo $this->Html->css('main.css');
        echo $this->Html->css('jquery-ui.css');
        echo $this->Html->css('ui.theme.css');
        echo $this->Html->css('custom.jq.css');
        echo $this->Html->css('jquery-picklist.css');
        echo $this->Html->css('chosen.css');
        //   echo $this->Html->css('bootstrap.min.css');
        echo $this->Html->css('font-awesome.min.css');
        // echo $this->Html->css('animate.min.css');
        //   echo $this->Html->css('style.css');


        echo $this->Html->script('jquery.min.1.8.js');
        echo $this->Html->script('jquery.main.js');
        echo $this->Html->script('custom.min.js');
        echo $this->Html->script('jquery-ui.js');
        echo $this->Html->script('form.js');
        echo $this->Html->script('jquery.ui.widget.min.js');
        echo $this->Html->script('jquery-picklist.min.js');
        echo $this->Html->script('datepicker.js');

        //    echo $this->Html->script('jquery.ui.datetime.min.js');
        echo $this->Html->script('jquery-ui-timepicker-addon.js');
        echo $this->Html->script('settings.js');
        echo $this->Html->script('chosen.jquery.js');

        ///this part of the code is for the socket.io tests
        echo $this->Html->script('socket.io/socket.io-1.3.5');
        echo $this->Html->script('socket.io/printClient');


        /**
          echo $this->Html->css('jquery-ui-1.10.3.custom');
          echo $this->Html->script('jquery-1.9.1');
          echo $this->Html->script('jquery-ui-1.10.3.custom');
         * */
        ?>

        <style>
            /* css for timepicker */
            .ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
            .ui-timepicker-div dl { text-align: left; }
            .ui-timepicker-div dl dt { float: left; clear:left; padding: 0 0 0 5px; }
            .ui-timepicker-div dl dd { margin: 0 10px 10px 45%; }
            .ui-timepicker-div td { font-size: 90%; }
            .ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }

            .ui-timepicker-rtl{ direction: rtl; }
            .ui-timepicker-rtl dl { text-align: right; padding: 0 5px 0 0; }
            .ui-timepicker-rtl dl dt{ float: right; clear: right; }
            .ui-timepicker-rtl dl dd { margin: 0 45% 10px 10px; }

            .transparent { opacity:1 }

            /*css below is to allow the datepicker to appear infront of the dialog box
            #ui-datepicker-div{z-index:10000 !important;}*/
            div.ui-dialog-buttonpane .ui-button{float:right;}
            .ui-dialog-titlebar-close{display:none;}


            #UL_1 {
                box-sizing: border-box;
                color: rgb(51, 51, 51);
                float: left;
                height: 50px;
                width: 289px;
                perspective-origin: 144.5px 25px;
                transform-origin: 144.5px 25px;
                border: 0px none rgb(51, 51, 51);
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                margin: 0px;
                outline: rgb(51, 51, 51) none 0px;
                padding: 0px;
            }/*#UL_1*/

            #UL_1:after {
                box-sizing: border-box;
                clear: both;
                color: rgb(51, 51, 51);
                display: table;
                width: 1px;
                perspective-origin: 0.5px 0px;
                transform-origin: 0.5px 0px;
                content: ' ';
                border: 0px none rgb(51, 51, 51);
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(51, 51, 51) none 0px;
            }/*#UL_1:after*/

            #UL_1:before {
                box-sizing: border-box;
                color: rgb(51, 51, 51);
                display: table;
                width: 1px;
                perspective-origin: 0.5px 0px;
                transform-origin: 0.5px 0px;
                content: ' ';
                border: 0px none rgb(51, 51, 51);
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(51, 51, 51) none 0px;
            }/*#UL_1:before*/

            #LI_2 {
                box-sizing: border-box;
                color: rgb(51, 51, 51);
                display: block;
                float: left;
                height: 50px;
                position: relative;
                width: 43px;
                perspective-origin: 21.5px 25px;
                transform-origin: 21.5px 25px;
                border: 0px none rgb(51, 51, 51);
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(51, 51, 51) none 0px;
            }/*#LI_2*/

            #A_3 {
                background-position: 0px 0px;
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                display: block;
                height: 50px;
                position: relative;
                text-align: left;
                text-decoration: none;
                width: 43px;
                perspective-origin: 21.5px 25px;
                transform-origin: 21.5px 25px;
                background: rgba(0, 0, 0, 0) none repeat scroll 0px 0px / auto padding-box border-box;
                border: 0px none rgb(94, 94, 94);
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(94, 94, 94) none 0px;
                padding: 15px;
                transition: all 0.25s ease 0s;
            }/*#A_3*/

            #I_4 {
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                display: inline-block;
                height: 14px;
                text-align: left;
                width: 13px;
                perspective-origin: 6.5px 7px;
                transform-origin: 6.5px 7px;
                border: 0px none rgb(94, 94, 94);
                font: normal normal normal normal 14px/14px FontAwesome;
                list-style: none outside none;
                outline: rgb(94, 94, 94) none 0px;
            }/*#I_4*/

            #I_4:before {
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                text-align: left;
                content: '';
                border: 0px none rgb(94, 94, 94);
                font: normal normal normal normal 14px/14px FontAwesome;
                list-style: none outside none;
                outline: rgb(94, 94, 94) none 0px;
            }/*#I_4:before*/

            #SPAN_5 {
                box-sizing: border-box;
                color: rgb(255, 255, 255);
                display: block;
                height: 16px;
                position: absolute;
                right: 5px;
                text-align: center;
                top: 7px;
                white-space: nowrap;
                width: 18px;
                align-self: stretch;
                perspective-origin: 9px 8px;
                transform-origin: 9px 8px;
                background: rgb(240, 173, 78) none repeat scroll 0% 0% / auto padding-box border-box;
                border: 0px none rgb(255, 255, 255);
                border-radius: 2.5px 2.5px 2.5px 2.5px;
                font: normal normal bold normal 10px/10px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(255, 255, 255) none 0px;
                padding: 2px;
            }/*#SPAN_5*/

            #UL_6, #UL_35, #UL_81 {
                box-shadow: rgba(0, 0, 0, 0.0980392) 0px 3px 6px 0px;
                box-sizing: border-box;
                color: rgb(51, 51, 51);
                display: none;
                float: left;
                height: auto;
                min-width: 160px;
                position: absolute;
                right: 0px;
                text-align: left;
                top: 100%;
                width: 270px;
                z-index: 2300;
                align-self: stretch;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                background: rgb(255, 255, 255) none repeat scroll 0% 0% / auto padding-box padding-box;
                border: 1px solid rgb(207, 207, 207);
                border-radius: 4px 4px 4px 4px;
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                margin: 0px;
                outline: rgb(51, 51, 51) none 0px;
                padding: 0px;
                width: 100%;
                padding: 10px;
            }/*#UL_6, #UL_35, #UL_81*/

            #UL_81{

                display: block;
                width: 300px;
                height:281px;
                padding: 20px !important;   
            }
            #UL_86{
                overflow-y: auto !important;
            }
            #LI_7, #LI_36, #LI_82 {
                box-shadow: rgb(255, 255, 255) 0px 1px 0px 0px inset;
                box-sizing: border-box;
                color: rgb(68, 68, 68);
                height: auto;
                text-shadow: rgb(255, 255, 255) 1px 1px 0px;
                width: auto;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                background: rgb(245, 245, 245) none repeat scroll 0% 0% / auto padding-box border-box;
                border: 0px none rgb(68, 68, 68);
                border-radius: 4px 4px 0 0;
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(68, 68, 68) none 0px;
                padding: 10px;
            }/*#LI_7, #LI_36, #LI_82*/

            #I_8 {
                box-sizing: border-box;
                color: rgb(105, 105, 105);
                display: inline-block;
                text-align: left;
                text-shadow: rgb(255, 255, 255) 1px 1px 0px;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                border: 0px none rgb(105, 105, 105);
                font: normal normal normal normal 14px/14px FontAwesome;
                list-style: none outside none;
                margin: 0px 5px 0px 0px;
                outline: rgb(105, 105, 105) none 0px;
            }/*#I_8*/

            #I_8:before {
                box-sizing: border-box;
                color: rgb(105, 105, 105);
                text-align: left;
                text-shadow: rgb(255, 255, 255) 1px 1px 0px;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                content: '';
                border: 0px none rgb(105, 105, 105);
                font: normal normal normal normal 14px/14px FontAwesome;
                list-style: none outside none;
                outline: rgb(105, 105, 105) none 0px;
            }/*#I_8:before*/

            #LI_9, #LI_12, #LI_15, #LI_18, #LI_21, #LI_24, #LI_29, #LI_38, #LI_41, #LI_49, #LI_57, #LI_65, #LI_75, #LI_84, #LI_87, #LI_93, #LI_99, #LI_105, #LI_113, #LI_121, #LI_124, #LI_127 {
                /* box-sizing: border-box;**/
                color: rgb(51, 51, 51);
                height: auto;
                width: auto;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                border: 0px none rgb(51, 51, 51)  !important;
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(51, 51, 51) none 0px;
                width:100%;
                background-color: none;
            }/*#LI_9, #LI_12, #LI_15, #LI_18, #LI_21, #LI_24, #LI_29, #LI_38, #LI_41, #LI_49, #LI_57, #LI_65, #LI_75, #LI_84, #LI_87, #LI_93, #LI_99, #LI_105, #LI_113, #LI_121, #LI_124, #LI_127*/

            #DIV_10, #DIV_39, #DIV_85 {
                box-sizing: border-box;
                color: rgb(51, 51, 51);
                height: 210px;
                position: relative;
                text-align: left;
                width: auto;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                border: 0px none rgb(51, 51, 51);
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(51, 51, 51) none 0px;
                overflow: hidden;
            }/*#DIV_10, #DIV_39, #DIV_85*/

            #UL_11, #UL_40, #UL_86 {
                box-sizing: border-box;
                color: rgb(51, 51, 51);
                height: 210px;
                text-align: left;
                width: 100%;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                border: 0px none rgb(51, 51, 51);
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                margin: 0px;
                outline: rgb(51, 51, 51) none 0px;
                overflow: hidden;
                padding: 0px;
            }/*#UL_11, #UL_40, #UL_86*/

            #A_13, #A_16, #A_19, #A_22, #A_25 {
                background-position: 0px 0px;
                box-sizing: border-box;
                color: rgb(68, 68, 68);
                display: block;
                text-align: left;
                text-decoration: none;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                background: rgba(0, 0, 0, 0) none repeat scroll 0px 0px / auto padding-box border-box;
                border-top: 0px none rgb(68, 68, 68);
                border-right: 0px none rgb(68, 68, 68);
                border-bottom: 1px solid rgb(240, 240, 240);
                border-left: 0px none rgb(68, 68, 68);
                font: normal normal normal normal 12px/17.142858505249px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(68, 68, 68) none 0px;
                padding: 7px 0px;
                transition: all 0.25s ease 0s;
            }/*#A_13, #A_16, #A_19, #A_22, #A_25*/

            #I_14 {
                box-sizing: border-box;
                color: rgb(255, 255, 255);
                display: inline-block;
                text-align: center;
                white-space: nowrap;
                width: 25px;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                background: rgb(39, 174, 96) none repeat scroll 0% 0% / auto padding-box border-box;
                border: 0px none rgb(255, 255, 255);
                border-radius: 4px 4px 4px 4px;
                font: normal normal normal normal 12px/12px FontAwesome;
                list-style: none outside none;
                margin: 5px;
                outline: rgb(255, 255, 255) none 0px;
                padding: 6px 0px;
            }/*#I_14*/

            #I_14:before {
                box-sizing: border-box;
                color: rgb(255, 255, 255);
                text-align: center;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                content: '';
                border: 0px none rgb(255, 255, 255);
                font: normal normal normal normal 12px/12px FontAwesome;
                list-style: none outside none;
                outline: rgb(255, 255, 255) none 0px;
            }/*#I_14:before*/

            #I_17 {
                box-sizing: border-box;
                color: rgb(255, 255, 255);
                display: inline-block;
                text-align: center;
                white-space: nowrap;
                width: 25px;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                background: rgb(52, 152, 219) none repeat scroll 0% 0% / auto padding-box border-box;
                border: 0px none rgb(255, 255, 255);
                border-radius: 4px 4px 4px 4px;
                font: normal normal normal normal 12px/12px FontAwesome;
                list-style: none outside none;
                margin: 5px;
                outline: rgb(255, 255, 255) none 0px;
                padding: 6px 0px;
            }/*#I_17*/

            #I_17:before {
                box-sizing: border-box;
                color: rgb(255, 255, 255);
                text-align: center;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                content: '';
                border: 0px none rgb(255, 255, 255);
                font: normal normal normal normal 12px/12px FontAwesome;
                list-style: none outside none;
                outline: rgb(255, 255, 255) none 0px;
            }/*#I_17:before*/

            #I_20 {
                box-sizing: border-box;
                color: rgb(255, 255, 255);
                display: inline-block;
                text-align: center;
                white-space: nowrap;
                width: 25px;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                background: rgb(243, 156, 18) none repeat scroll 0% 0% / auto padding-box border-box;
                border: 0px none rgb(255, 255, 255);
                border-radius: 4px 4px 4px 4px;
                font: normal normal normal normal 12px/12px FontAwesome;
                list-style: none outside none;
                margin: 5px;
                outline: rgb(255, 255, 255) none 0px;
                padding: 6px 0px;
            }/*#I_20*/

            #I_20:before {
                box-sizing: border-box;
                color: rgb(255, 255, 255);
                text-align: center;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                content: '';
                border: 0px none rgb(255, 255, 255);
                font: normal normal normal normal 12px/12px FontAwesome;
                list-style: none outside none;
                outline: rgb(255, 255, 255) none 0px;
            }/*#I_20:before*/

            #I_23 {
                box-sizing: border-box;
                color: rgb(255, 255, 255);
                display: inline-block;
                text-align: center;
                white-space: nowrap;
                width: 25px;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                background: rgb(39, 174, 96) none repeat scroll 0% 0% / auto padding-box border-box;
                border: 0px none rgb(255, 255, 255);
                border-radius: 4px 4px 4px 4px;
                font: normal normal normal normal 12px/12px FontAwesome;
                list-style: none outside none;
                margin: 5px;
                outline: rgb(255, 255, 255) none 0px;
                padding: 6px 0px;
            }/*#I_23*/

            #I_23:before {
                box-sizing: border-box;
                color: rgb(255, 255, 255);
                text-align: center;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                content: '';
                border: 0px none rgb(255, 255, 255);
                font: normal normal normal normal 12px/12px FontAwesome;
                list-style: none outside none;
                outline: rgb(255, 255, 255) none 0px;
            }/*#I_23:before*/

            #I_26 {
                box-sizing: border-box;
                color: rgb(255, 255, 255);
                display: inline-block;
                text-align: center;
                white-space: nowrap;
                width: 25px;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                background: rgb(231, 76, 60) none repeat scroll 0% 0% / auto padding-box border-box;
                border: 0px none rgb(255, 255, 255);
                border-radius: 4px 4px 4px 4px;
                font: normal normal normal normal 12px/12px FontAwesome;
                list-style: none outside none;
                margin: 5px;
                outline: rgb(255, 255, 255) none 0px;
                padding: 6px 0px;
            }/*#I_26*/

            #I_26:before {
                box-sizing: border-box;
                color: rgb(255, 255, 255);
                text-align: center;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                content: '';
                border: 0px none rgb(255, 255, 255);
                font: normal normal normal normal 12px/12px FontAwesome;
                list-style: none outside none;
                outline: rgb(255, 255, 255) none 0px;
            }/*#I_26:before*/

            #DIV_27, #DIV_73 {
                box-sizing: border-box;
                color: rgb(51, 51, 51);
                height: auto;
                opacity: 0.400000005960465;
                position: absolute;
                right: 1px;
                text-align: left;
                top: 0px;
                width: 3px;
                z-index: 99;
                align-self: stretch;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                background: rgb(0, 0, 0) none repeat scroll 0% 0% / auto padding-box border-box;
                border: 0px none rgb(51, 51, 51);
                border-radius: 7px 7px 7px 7px;
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(51, 51, 51) none 0px;
            }/*#DIV_27, #DIV_73*/

            #DIV_28, #DIV_74, #DIV_112 {
                box-sizing: border-box;
                color: rgb(51, 51, 51);
                display: none;
                height: 100%;
                opacity: 0.200000002980232;
                position: absolute;
                right: 1px;
                text-align: left;
                top: 0px;
                width: 3px;
                z-index: 90;
                align-self: stretch;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                background: rgb(51, 51, 51) none repeat scroll 0% 0% / auto padding-box border-box;
                border: 0px none rgb(51, 51, 51);
                border-radius: 7px 7px 7px 7px;
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(51, 51, 51) none 0px;
            }/*#DIV_28, #DIV_74, #DIV_112*/

            #A_30, #A_76, #A_114 {
                background-position: 0px 0px;
                box-sizing: border-box;
                clear: both;
                color: rgb(68, 68, 68);
                display: block;
                text-align: center;
                text-decoration: none;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                background: rgb(245, 245, 245) none repeat scroll 0px 0px / auto padding-box border-box;
                border: 0px none rgb(68, 68, 68);
                border-radius: 0 0 4px 4px;
                font: normal normal normal normal 12px/17.142858505249px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(68, 68, 68) none 0px;
                padding: 8px;
                transition: all 0.25s ease 0s;
            }/*#A_30, #A_76, #A_114*/

            #LI_31, #LI_77 {
                box-sizing: border-box;
                color: rgb(51, 51, 51);
                display: block;
                float: left;
                height: 50px;
                position: relative;
                width: 44px;
                perspective-origin: 22px 25px;
                transform-origin: 22px 25px;
                border: 0px none rgb(51, 51, 51);
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(51, 51, 51) none 0px;
            }/*#LI_31, #LI_77*/

            #A_32, #A_78 {
                background-position: 0px 0px;
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                display: block;
                height: 50px;
                position: relative;
                text-align: left;
                text-decoration: none;
                width: 44px;
                perspective-origin: 22px 25px;
                transform-origin: 22px 25px;
                background: rgba(0, 0, 0, 0) none repeat scroll 0px 0px / auto padding-box border-box;
                border: 0px none rgb(94, 94, 94);
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(94, 94, 94) none 0px;
                padding: 15px;
                transition: all 0.25s ease 0s;
            }/*#A_32, #A_78*/

            #I_33 {
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                display: inline-block;
                height: 14px;
                text-align: left;
                width: 14px;
                perspective-origin: 7px 7px;
                transform-origin: 7px 7px;
                border: 0px none rgb(94, 94, 94);
                font: normal normal normal normal 14px/14px FontAwesome;
                list-style: none outside none;
                outline: rgb(94, 94, 94) none 0px;
            }/*#I_33*/

            #I_33:before {
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                text-align: left;
                content: '';
                border: 0px none rgb(94, 94, 94);
                font: normal normal normal normal 14px/14px FontAwesome;
                list-style: none outside none;
                outline: rgb(94, 94, 94) none 0px;
            }/*#I_33:before*/

            #SPAN_34 {
                box-sizing: border-box;
                color: rgb(255, 255, 255);
                display: block;
                height: 16px;
                position: absolute;
                right: 5px;
                text-align: center;
                top: 7px;
                white-space: nowrap;
                width: 18px;
                align-self: stretch;
                perspective-origin: 9px 8px;
                transform-origin: 9px 8px;
                background: rgb(92, 184, 92) none repeat scroll 0% 0% / auto padding-box border-box;
                border: 0px none rgb(255, 255, 255);
                border-radius: 2.5px 2.5px 2.5px 2.5px;
                font: normal normal bold normal 10px/10px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(255, 255, 255) none 0px;
                padding: 2px;
            }/*#SPAN_34*/

            #I_37 {
                box-sizing: border-box;
                color: rgb(105, 105, 105);
                display: inline-block;
                text-align: left;
                text-shadow: rgb(255, 255, 255) 1px 1px 0px;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                border: 0px none rgb(105, 105, 105);
                font: normal normal normal normal 14px/14px FontAwesome;
                list-style: none outside none;
                margin: 0px 5px 0px 0px;
                outline: rgb(105, 105, 105) none 0px;
            }/*#I_37*/

            #I_37:before {
                box-sizing: border-box;
                color: rgb(105, 105, 105);
                text-align: left;
                text-shadow: rgb(255, 255, 255) 1px 1px 0px;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                content: '';
                border: 0px none rgb(105, 105, 105);
                font: normal normal normal normal 14px/14px FontAwesome;
                list-style: none outside none;
                outline: rgb(105, 105, 105) none 0px;
            }/*#I_37:before*/

            #A_42, #A_50, #A_58, #A_66 {
                background-position: 0px 0px;
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                display: block;
                text-align: left;
                text-decoration: none;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                background: rgba(0, 0, 0, 0) none repeat scroll 0px 0px / auto padding-box border-box;
                border-top: 0px none rgb(94, 94, 94);
                border-right: 0px none rgb(94, 94, 94);
                border-bottom: 1px solid rgb(240, 240, 240);
                border-left: 0px none rgb(94, 94, 94);
                border-radius: 4px 4px 4px 4px;
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(94, 94, 94) none 0px;
                padding: 10px 5px;
                transition: all 0.25s ease 0s;
            }/*#A_42, #A_50, #A_58, #A_66*/

            #A_42:after, #A_50:after, #A_58:after, #A_66:after {
                box-sizing: border-box;
                clear: both;
                color: rgb(94, 94, 94);
                display: table;
                text-align: left;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                content: ' ';
                border: 0px none rgb(94, 94, 94);
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(94, 94, 94) none 0px;
            }/*#A_42:after, #A_50:after, #A_58:after, #A_66:after*/

            #A_42:before, #A_50:before, #A_58:before, #A_66:before {
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                display: table;
                text-align: left;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                content: ' ';
                border: 0px none rgb(94, 94, 94);
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(94, 94, 94) none 0px;
            }/*#A_42:before, #A_50:before, #A_58:before, #A_66:before*/

            #DIV_43, #DIV_51, #DIV_59, #DIV_67 {
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                float: left;
                height: auto;
                text-align: left;
                white-space: nowrap;
                width: auto;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                border: 0px none rgb(94, 94, 94);
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(94, 94, 94) none 0px;
            }/*#DIV_43, #DIV_51, #DIV_59, #DIV_67*/

            #IMG_44, #IMG_52, #IMG_60, #IMG_68 {
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                height: 40px;
                text-align: left;
                vertical-align: middle;
                white-space: nowrap;
                width: 40px;
                border: 0px none rgb(94, 94, 94);
                border-radius: 6px 6px 6px 6px;
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                margin: auto 10px auto auto;
                outline: rgb(94, 94, 94) none 0px;
            }/*#IMG_44, #IMG_52, #IMG_60, #IMG_68*/

            #H4_45, #H4_53, #H4_61, #H4_69 {
                box-sizing: border-box;
                color: rgb(68, 68, 68);
                height: auto;
                text-align: left;
                white-space: nowrap;
                width: auto;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                border: 0px none rgb(68, 68, 68);
                font: normal normal 500 normal 15px/16.5px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                margin: 0px 0px 0px 45px;
                outline: rgb(68, 68, 68) none 0px;
            }/*#H4_45, #H4_53, #H4_61, #H4_69*/

            #SMALL_46, #SMALL_54, #SMALL_62, #SMALL_70 {
                box-sizing: border-box;
                color: rgb(153, 153, 153);
                display: block;
                float: right;
                text-align: left;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                border: 0px none rgb(153, 153, 153);
                font: normal normal normal normal 10px/10px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                margin: -15px 0px 0px;
                outline: rgb(153, 153, 153) none 0px;
            }/*#SMALL_46, #SMALL_54, #SMALL_62, #SMALL_70*/

            #I_47, #I_55, #I_63, #I_71 {
                box-sizing: border-box;
                color: rgb(153, 153, 153);
                display: inline-block;
                text-align: left;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                border: 0px none rgb(153, 153, 153);
                font: normal normal normal normal 10px/10px FontAwesome;
                list-style: none outside none;
                outline: rgb(153, 153, 153) none 0px;
            }/*#I_47, #I_55, #I_63, #I_71*/

            #I_47:before, #I_55:before, #I_63:before, #I_71:before {
                box-sizing: border-box;
                color: rgb(153, 153, 153);
                text-align: left;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                content: '';
                border: 0px none rgb(153, 153, 153);
                font: normal normal normal normal 10px/10px FontAwesome;
                list-style: none outside none;
                outline: rgb(153, 153, 153) none 0px;
            }/*#I_47:before, #I_55:before, #I_63:before, #I_71:before*/

            #P_48, #P_56, #P_72 {
                box-sizing: border-box;
                color: rgb(136, 136, 136);
                height: auto;
                text-align: left;
                white-space: nowrap;
                width: auto;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                border: 0px none rgb(136, 136, 136);
                font: normal normal normal normal 12px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                margin: 0px 0px 0px 45px;
                outline: rgb(136, 136, 136) none 0px;
            }/*#P_48, #P_56, #P_72*/

            #P_64 {
                box-sizing: border-box;
                color: rgb(136, 136, 136);
                height: auto;
                text-align: left;
                white-space: nowrap;
                width: auto;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                border: 0px none rgb(136, 136, 136);
                font: normal normal normal normal 12px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                margin: 0px 0px 0px 45px;
                outline: rgb(136, 136, 136) none 0px;
            }/*#P_64*/

            #I_79 {
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                display: inline-block;
                height: 14px;
                text-align: left;
                width: 14px;
                perspective-origin: 7px 7px;
                transform-origin: 7px 7px;
                border: 0px none rgb(94, 94, 94);
                font: normal normal normal normal 14px/14px FontAwesome;
                list-style: none outside none;
                outline: rgb(94, 94, 94) none 0px;
            }/*#I_79*/

            #I_79:before {
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                text-align: left;
                font-family:FontAwesome;
                content: '';
                border: 0px none rgb(94, 94, 94);
                font: normal normal normal normal 14px/14px FontAwesome;
                list-style: none outside none;
                outline: rgb(94, 94, 94) none 0px;
            }/*#I_79:before*/

            #SPAN_80 {
                box-sizing: border-box;
                color: rgb(255, 255, 255);
                display: block;
                height: 16px;
                position: absolute;
                right: 5px;
                text-align: center;
                top: 7px;
                white-space: nowrap;
                width: 18px;
                align-self: stretch;
                perspective-origin: 9px 8px;
                transform-origin: 9px 8px;
                background: rgb(217, 83, 79) none repeat scroll 0% 0% / auto padding-box border-box;
                border: 0px none rgb(255, 255, 255);
                border-radius: 2.5px 2.5px 2.5px 2.5px;
                font: normal normal bold normal 10px/10px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(255, 255, 255) none 0px;
                padding: 2px;
            }/*#SPAN_80*/

            #I_83 {
                box-sizing: border-box;
                color: rgb(105, 105, 105);
                display: inline-block;
                text-align: left;
                text-shadow: rgb(255, 255, 255) 1px 1px 0px;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                border: 0px none rgb(105, 105, 105);
                font: normal normal normal normal 14px/14px FontAwesome;
                list-style: none outside none;
                margin: 0px 5px 0px 0px;
                outline: rgb(105, 105, 105) none 0px;
            }/*#I_83*/

            #I_83:before {
                box-sizing: border-box;
                color: rgb(105, 105, 105);
                text-align: left;
                text-shadow: rgb(255, 255, 255) 1px 1px 0px;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                font-family:FontAwesome;
                content: '';
                border: 0px none rgb(105, 105, 105);
                font: normal normal normal normal 14px/14px FontAwesome;
                list-style: none outside none;
                outline: rgb(105, 105, 105) none 0px;
            }/*#I_83:before*/

            #A_88, #A_94, #A_100, #A_106 {
                background-position: 0px 0px;
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                display: block;
                text-align: left;
                text-decoration: none;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                background: rgba(0, 0, 0, 0) none repeat scroll 0px 0px / auto padding-box border-box;
                border-top: 0px none rgb(94, 94, 94);
                border-right: 0px none rgb(94, 94, 94);
                /**  border-bottom: 1px solid rgb(240, 240, 240);**/
                border-left: 0px none rgb(94, 94, 94);
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(94, 94, 94) none 0px;
                padding: 10px;
                transition: all 0.25s ease 0s;
            }/*#A_88, #A_94, #A_100, #A_106*/

            #H3_89, #H3_95, #H3_101, #H3_107 {
                box-sizing: border-box;
                color: rgb(102, 102, 102);
                height: auto;
                text-align: left;
                white-space: nowrap;
                width: auto;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                border: 0px none rgb(102, 102, 102);
                font: normal normal 500 normal 14px/15.3999996185303px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                margin: 0px 0px 10px;
                outline: rgb(102, 102, 102) none 0px;
            }/*#H3_89, #H3_95, #H3_101, #H3_107*/

            #SMALL_90, #SMALL_96, #SMALL_102, #SMALL_108 {
                box-sizing: border-box;
                color: rgb(119, 119, 119);
                display: block;
                float: right;
                text-align: left;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                border: 0px none rgb(119, 119, 119);
                font: normal normal normal normal 9.10000038146973px/9.10000038146973px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                margin: -10px 0px 0px;
                outline: rgb(119, 119, 119) none 0px;
            }/*#SMALL_90, #SMALL_96, #SMALL_102, #SMALL_108*/

            #DIV_91, #DIV_97, #DIV_103, #DIV_109 {
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                height: 10px;
                text-align: left;
                white-space: nowrap;
                width: auto;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                background: rgb(235, 237, 239) none repeat scroll 0% 0% / auto padding-box border-box;
                border: 0px none rgb(94, 94, 94);
                border-radius: 32px 32px 32px 32px;
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(94, 94, 94) none 0px;
                overflow: hidden;
            }/*#DIV_91, #DIV_97, #DIV_103, #DIV_109*/

            #DIV_92 {
                box-sizing: border-box;
                color: rgb(255, 255, 255);
                float: left;
                height: 100%;
                text-align: center;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                /** background: rgb(46, 204, 113) none repeat scroll 0% 0% / auto padding-box border-box;**/
                border: 0px none rgb(255, 255, 255);
                font: normal normal normal normal 12px/12px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(255, 255, 255) none 0px;
                transition: width 0.6s ease 0s;
            }/*#DIV_92*/

            .progress-bar-info {
                background-color: #3498db;
            }
            .progress-bar-success {
                background-color: #2ecc71;
            }
            .progress-bar-warning {
                background-color: #f0ad4e;
            }
            .progress-bar-danger {
                background-color: #d9534f;
            }

            #DIV_98 {
                box-sizing: border-box;
                color: rgb(255, 255, 255);
                float: left;
                height: 100%;
                text-align: center;
                white-space: nowrap;
                width: 14%;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                background: rgb(241, 196, 15) none repeat scroll 0% 0% / auto padding-box border-box;
                border: 0px none rgb(255, 255, 255);
                font: normal normal normal normal 12px/12px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(255, 255, 255) none 0px;
                transition: width 0.6s ease 0s;
            }/*#DIV_98*/

            #DIV_104 {
                box-sizing: border-box;
                color: rgb(255, 255, 255);
                float: left;
                height: 100%;
                text-align: center;
                white-space: nowrap;
                width: 65%;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                background: rgb(52, 152, 219) none repeat scroll 0% 0% / auto padding-box border-box;
                border: 0px none rgb(255, 255, 255);
                font: normal normal normal normal 12px/12px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(255, 255, 255) none 0px;
                transition: width 0.6s ease 0s;
            }/*#DIV_104*/

            #DIV_110 {
                box-sizing: border-box;
                color: rgb(255, 255, 255);
                float: left;
                height: 100%;
                text-align: center;
                white-space: nowrap;
                width: 80%;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                background: rgb(231, 76, 60) none repeat scroll 0% 0% / auto padding-box border-box;
                border: 0px none rgb(255, 255, 255);
                font: normal normal normal normal 12px/12px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(255, 255, 255) none 0px;
                transition: width 0.6s ease 0s;
            }/*#DIV_110*/

            #DIV_111 {
                box-sizing: border-box;
                color: rgb(51, 51, 51);
                display: none;
                height: 196.875px;
                opacity: 0.400000005960465;
                position: absolute;
                right: 1px;
                text-align: left;
                top: 0px;
                width: 3px;
                z-index: 99;
                align-self: stretch;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                background: rgb(0, 0, 0) none repeat scroll 0% 0% / auto padding-box border-box;
                border: 0px none rgb(51, 51, 51);
                border-radius: 7px 7px 7px 7px;
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(51, 51, 51) none 0px;
            }/*#DIV_111*/

            #LI_115 {
                box-sizing: border-box;
                color: rgb(51, 51, 51);
                display: block;
                float: left;
                height: 50px;
                position: relative;
                width: 148px;
                perspective-origin: 74px 25px;
                transform-origin: 74px 25px;
                background: rgb(240, 240, 240) none repeat scroll 0% 0% / auto padding-box border-box;
                border: 0px none rgb(51, 51, 51);
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                margin: 0px 0px 0px 10px;
                outline: rgb(51, 51, 51) none 0px;
            }/*#LI_115*/

            #A_116 {
                background-position: 0px 0px;
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                display: block;
                height: 50px;
                position: relative;
                text-align: left;
                text-decoration: none;
                width: 148px;
                perspective-origin: 74px 25px;
                transform-origin: 74px 25px;
                background: rgba(0, 0, 0, 0) none repeat scroll 0px 0px / auto padding-box border-box;
                border: 0px none rgb(94, 94, 94);
                font: normal normal bold normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(94, 94, 94) none 0px;
                padding: 15px;
                transition: all 0.25s ease 0s;
                text-align: center;
            }/*#A_116*/

            #IMG_117 {
                box-shadow: rgb(255, 255, 255) 0px 0px 0px 2px;
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                display: block;
                float: left;
                height: 30px;
                text-align: left;
                vertical-align: middle;
                width: 30px;
                perspective-origin: 15px 15px;
                transform-origin: 15px 15px;
                border: 0px none rgb(94, 94, 94);
                font: normal normal bold normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                margin: -5px 10px 0px 0px;
                outline: rgb(94, 94, 94) none 0px;
            }/*#IMG_117*/

            #SPAN_118 {
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                text-align: left;
                border: 0px none rgb(94, 94, 94);
                font: normal normal bold normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(94, 94, 94) none 0px;
            }/*#SPAN_118*/

            #I_119 {
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                display: inline-block;
                height: 14px;
                text-align: left;
                width: 8px;
                perspective-origin: 4px 7px;
                transform-origin: 4px 7px;
                border: 0px none rgb(94, 94, 94);
                font: normal normal normal normal 14px/14px FontAwesome;
                list-style: none outside none;
                outline: rgb(94, 94, 94) none 0px;
            }/*#I_119*/

            #I_119:before {
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                text-align: left;
                content: '';
                border: 0px none rgb(94, 94, 94);
                font: normal normal normal normal 14px/14px FontAwesome;
                list-style: none outside none;
                outline: rgb(94, 94, 94) none 0px;
            }/*#I_119:before*/

            #UL_120 {
                box-shadow: rgba(0, 0, 0, 0.0980392) 0px 3px 6px 0px;
                box-sizing: border-box;
                color: rgb(51, 51, 51);
                display: none;
                float: left;
                height: auto;
                max-width: 100px;
                min-width: 160px;
                position: absolute;
                right: 0px;
                text-align: left;
                top: 100%;
                width: 270px;
                z-index: 2300;
                align-self: stretch;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                background: rgb(255, 255, 255) none repeat scroll 0% 0% / auto padding-box padding-box;
                border: 1px solid rgb(207, 207, 207);
                border-radius: 4px 4px 4px 4px;
                font: normal normal normal normal 14px/20px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                margin: 0px;
                outline: rgb(51, 51, 51) none 0px;
                padding: 0px;
            }/*#UL_120*/

            #A_122, #A_125 {
                background-position: 0px 0px;
                box-sizing: border-box;
                clear: both;
                color: rgb(94, 94, 94);
                display: block;
                text-align: left;
                text-decoration: none;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                background: rgba(0, 0, 0, 0) none repeat scroll 0px 0px / auto padding-box border-box;
                border-top: 0px none rgb(94, 94, 94);
                border-right: 0px none rgb(94, 94, 94);
                border-bottom: 1px solid rgb(240, 240, 240);
                border-left: 0px none rgb(94, 94, 94);
                font: normal normal bold normal 12px/17.142858505249px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(94, 94, 94) none 0px;
                padding: 10px;
                transition: all 0.25s ease 0s;
            }/*#A_122, #A_125*/

            #I_123 {
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                display: inline-block;
                text-align: left;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                border: 0px none rgb(94, 94, 94);
                font: normal normal normal normal 12px/12px FontAwesome;
                list-style: none outside none;
                margin: 0px 10px 0px 0px;
                outline: rgb(94, 94, 94) none 0px;
            }/*#I_123*/

            #I_123:before {
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                text-align: left;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                content: '';
                border: 0px none rgb(94, 94, 94);
                font: normal normal normal normal 12px/12px FontAwesome;
                list-style: none outside none;
                outline: rgb(94, 94, 94) none 0px;
            }/*#I_123:before*/

            #I_126 {
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                display: inline-block;
                text-align: left;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                border: 0px none rgb(94, 94, 94);
                font: normal normal normal normal 12px/12px FontAwesome;
                list-style: none outside none;
                margin: 0px 10px 0px 0px;
                outline: rgb(94, 94, 94) none 0px;
            }/*#I_126*/

            #I_126:before {
                box-sizing: border-box;
                color: rgb(94, 94, 94);
                text-align: left;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                font-family:FontAwesome;
                content: '';
                border: 0px none rgb(94, 94, 94);
                font: normal normal normal normal 12px/12px FontAwesome;
                list-style: none outside none;
                outline: rgb(94, 94, 94) none 0px;
            }/*#I_126:before*/

            #A_128 {
                background-position: 0px 0px;
                box-sizing: border-box;
                clear: both;
                color: rgb(68, 68, 68);
                display: block;
                text-align: left;
                text-decoration: none;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                /** background: rgb(245, 245, 245) none repeat scroll 0px 0px / auto padding-box border-box; ***/
                border-top: 0px none rgb(68, 68, 68);
                border-right: 0px none rgb(68, 68, 68);
                border-bottom: 1px solid rgb(240, 240, 240);
                border-left: 0px none rgb(68, 68, 68);
                border-radius: 0 0 4px 4px;
                font: normal normal bold normal 12px/17.142858505249px 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
                list-style: none outside none;
                outline: rgb(68, 68, 68) none 0px;
                padding: 10px;
                transition: all 0.25s ease 0s;
            }/*#A_128*/

            #I_129 {
                box-sizing: border-box;
                color: rgb(68, 68, 68);
                display: inline-block;
                text-align: left;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                border: 1px none rgb(68, 68, 68);
                font: normal normal normal normal 12px/12px FontAwesome;
                list-style: none outside none;
                margin: 0px 10px 0px 0px;
                outline: rgb(68, 68, 68) none 0px;
            }/*#I_129*/

            #I_129:before {
                box-sizing: border-box;
                color: rgb(68, 68, 68);
                text-align: left;
                white-space: nowrap;
                perspective-origin: 50% 50%;
                transform-origin: 50% 50%;
                font-family:FontAwesome;
                content: '';
                border: 0px none rgb(68, 68, 68);
                font: normal normal normal normal 12px/12px FontAwesome;
                list-style: none outside none;
                outline: rgb(68, 68, 68) none 0px;
            }/*#I_129:before*/


        </style>
    </head>
    <body class="hasInterface hasGradient hasSidebar">
        <input type="hidden" name="add_user_url" id="add_user_url" value="<?php echo $this->Html->url(array('controller' => 'User', 'action' => 'add_user')); ?>" />
        <input type="hidden" name="stock_notif_url" id="stock_notif_url" value="<?php echo $this->Html->url(array('controller' => 'Customer', 'action' => 'min_stock_notif')); ?>" />
	        <input type="hidden" name="update_pass_url" id="update_pass_url" value="<?php echo $this->Html->url(array('controller' => 'User', 'action' => 'update_password')); ?>" />
	        <input type="hidden" name="make_def_url" id="make_def_url" value="<?php echo $this->Html->url(array('controller' => 'Site', 'action' => 'change_def_site')); ?>" />

 
        <div id="oaHeader">
            <div id="oaNavigationExtraTop">

                <ul id="UL_1">

					                              <?php /** 				                              
        $user_roles = $this->Session->read('role_short_array');

                    if ( isset($user_roles) && (in_array('SADM', $user_roles))) {
                        ?>    

                        <li class="infoUser">
							<a href="<?php echo $this->Html->url(array('controller' => 'Admin', 'action' => 'change_inst')); ?>" class="change_inst" >Change Site</a>
					  </li>

                    <?php } 
    
                  **/   ?>
                    <li id="LI_77">
                        <a href="#" id="A_78"><i id="I_79"></i><span id="SPAN_80"></span></a>
                    </li>
                    <li id="LI_115">
                        <a href="#" id="A_116" ><span id="SPAN_118">                              
                                <?php
                                echo  $mem_data['User']['fname'];
// ." ".$_SESSION['memberData']['User']['lname']; 
                                ?> </span>
                            <i id="I_119" class="fa fa-cog"></i>
                        </a>
                        <ul id="UL_120">     
                            <li id="LI_124" >
                          <a class="infoUser stn" style="text-decoration:none;color: #444;" 
                          href="<?php echo $this->Html->url(array('controller' => 'Admin', 'action' => 'change_password')); ?>" >
                       <i id="I_126"></i>Change Password</a>
                            </li>
                               
                            <li id="LI_127" class="buttonLogout  footer">
                                <a href="<?php echo $this->Html->url(array('controller' => 'Dashboard', 'action' => 'logoutUser')); ?>" id="A_128">
                                    <i id="I_129"></i>Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>


        </div>

        <div id="oaNavigation">
            <ul id="oaNavigationTabs">
                <li class="active first last">
                    <div class="left">
                        <div class="right">
                            <a href="#" accesskey="Home">Home</a>
                        </div></div>
                </li>

                <!--<li class="passive after-active">
                    <div class="left"><div class="right">
                            <a href="#" accesskey="Home"></a>
                        </div></div>
                </li>
                -->
            </ul>


        </div>
        <div id="firstLevelContent">
            <div id="secondLevelNavigation">
                <ul class="navigation first">


                    <?php
                    foreach ($categories as $cat) {
                        ?>

                        <li class="active">
                            <a href="#">
                                <?php echo $cat; ?>
                                <span class="top"></span>
                                <span class="bottom"></span>
                            </a>
                            <ul class="navigation">

                                <?php
                                foreach ($links_array[$cat] as $val) {
                                    ?>

                                    <li class="passive">
                                        <a href="<?php echo $this->Html->url(array("controller" => $val['link_controller'], "action" => $val['link_action'])); ?>">
                                            <?php echo $val['link_name'] ?>
                                            <span class="top"></span>
                                            <span class="bottom"></span>
                                        </a>
                                    </li>

                                    <?php
                                }
                                ?>
                            </ul></li>

                        <?php
                    }
                    ?>
                </ul>
            </div>

            <div id="secondLevelContent">
                <div id="thirdLevelHeader">
                    <div class="breadcrumb hasIcon iconBannersLarge ">
                        <h3 class="noBreadcrumb">

                            <span class="label"><?php echo $layout_title; ?></span>
                        </h3>
                    </div>
                </div>
                <div id="thirdLevelContent" style="min-height: 456px;">
                    <!--this is where status messages will be put
                    <div id="thirdLevelTools">
                        <div id="messagePlaceholder" class="messagePlaceholder"></div>
                        <ul class="contextContainer"></ul>
                    </div> -->
                    <?php echo $content_for_layout; ?>
                    <!--this is where the actual content of hte layout will also be put --->
                </div>
            </div>
        </div>
        <div name="setting_dialog-message" id="setting_dialog-message" title="Message">
            <p class="messsage">
            </p>
        </div>
        <div name="setting_dialog-confirm" id="setting_dialog-confirm  title="Confirmation">
             <p class="messsage">
            </p>
        </div>
    </body>
</html>
