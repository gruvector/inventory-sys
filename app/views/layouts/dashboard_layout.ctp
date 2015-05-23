<?php
$links_array = array();
$roles_array = array();
foreach ($_SESSION['user_links'] as $val) {
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
        echo $html->css('login.css');
        echo $html->css('form.css');
        echo $html->css('main.css');
        echo $html->css('jquery-ui.css');
        echo $html->css('ui.theme.css');
        echo $html->css('custom.jq.css');
        echo $html->css('jquery-picklist.css');
        echo $html->css('chosen.css');


        echo $html->script('jquery.min.1.8.js');
        echo $html->script('jquery.main.js');
        echo $html->script('custom.min.js');
        echo $html->script('jquery-ui.js');
        echo $html->script('form.js');
        echo $html->script('jquery.ui.widget.min.js');
        echo $html->script('jquery-picklist.min.js');
        echo $html->script('datepicker.js');

        //    echo $html->script('jquery.ui.datetime.min.js');
        echo $html->script('jquery-ui-timepicker-addon.js');
        echo $html->script('settings.js');
        echo $html->script('chosen.jquery.js');



        /**
          echo $html->css('jquery-ui-1.10.3.custom');
          echo $html->script('jquery-1.9.1');
          echo $html->script('jquery-ui-1.10.3.custom');
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
        </style>
    </head>
    <body class="hasInterface hasGradient hasSidebar">
        <input type="hidden" name="add_user_url" id="add_user_url" value="<?php echo $html->url(array('controller' => 'User', 'action' => 'add_user')); ?>" />

        <div id="oaHeader">
            <div id="oaNavigationExtraTop">
                <ul>              
                    <li class="infoUser"> <?php echo "hello " . $_SESSION['memberData']['User']['fname']; ?></li>

                    <?php
                    if (isset($_SESSION['role_short_array']) && (
                            in_array('SADM', $_SESSION['role_short_array']) ||
                            in_array('ADM', $_SESSION['role_short_array'])

                            )
                    ) {
                        ?>    

                         <!--   <li class="infoUser"><a href="<?php echo $html->url(array('controller' => 'Admin', 'action' => 'change_inst')); ?>" class="change_inst" >Change Site</a></li>-->

                    <?php } ?>
                    <li class="infoUser"><a name="<?php echo $_SESSION['memberData']['User']['fname'] . " " . $_SESSION['memberData']['User']['lname'] ?>" href="<?php echo $html->url(array('controller' => 'User', 'action' => 'add_user')); ?>" class="stn" id="<?php echo $_SESSION['memberData']['User']['id'] ?>">Settings</a></li>
                    <li class="buttonLogout"><a name="logout_url" id="logout_url" href="<?php echo $html->url(array('controller' => 'Dashboard', 'action' => 'logoutUser')); ?>">Logout</a></li>
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
                                        <a href="<?php echo $html->url(array("controller" => $val['link_controller'], "action" => $val['link_action'])); ?>">
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
