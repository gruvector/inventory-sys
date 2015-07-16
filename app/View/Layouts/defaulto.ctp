<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//$controllerObj = new AppController();
//if ($this->Session->check('memberData')) {
//  $controllerObj->redirect(array('controller' => 'Reception', 'action' => 'dashboard'));
//}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>INVENTORY SYSCMS</title>
        <?php
        echo $this->Html->css('login.css');
        echo $this->Html->css('main.css');

        //  echo $this->Html->css('bootstrap.min.css');
       // echo $this->Html->css('font-awesome.min.css');
       // echo $this->Html->css('animate.min.css');
       // echo $this->Html->css('style.css');
        echo $this->Html->script('jquery-1.4.4.min.js');
        echo $this->Html->script('jquery.main.js');
        echo $this->Html->script('jquery-ui.js');
        echo $this->Html->script('login.js');
        ?>
    </head>
    <body class="hasInterface hasGradient hasSidebar">
        <div id="oaHeader">
            <!--<div id="oaHeaderBranding" class="brandingAdServer">ISMS</div>-->
            <div id="oaNavigationExtraTop">

            </div>


        </div>

        <div id="oaNavigation">
            <ul id="oaNavigationTabs">
                <li class="active  first last">
                    <div class="left"><div class="right">
                            <a href="#" accesskey="Home">Authentication</a>
                        </div></div>
                </li>
            </ul>


        </div>
        <div id="firstLevelContent">
            <div id="secondLevelContent">


                <?php echo $content_for_layout; ?>
            </div></div>
        <input type="hidden" name="verify_cred_url" id="verify_cred_url" value="<?php echo $this->Html->url(array('controller' => 'Dashboard', 'action' => 'checkCred')); ?>" />
        <input type="hidden" name="dashboard_url" id="dashboard_url" value="<?php echo $this->Html->url(array('controller' => 'Dashboard', 'action' => 'login')); ?>" />
    </body>
</html>
