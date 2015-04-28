<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>


</br>

<form class="login_form" id="login_form" name="login_form" method="POST" action="<?php echo $html->url(array('controller' => 'Dashboard', 'action' => 'index')); ?>">
    <input type="hidden" name="oa_cookiecheck" value="f945ece3f107bdada06d197c97b5af3f" />
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td width="80"><img src="/mticket/img/login-welcome.gif">&nbsp;&nbsp;</td>
            <td width="100%" >
                <span class="tab-s">&nbsp;</span><br/>

                <span class="tab-s">&nbsp;</span><br />
                <span class="<?php if (isset($user_login)) {
    echo "install_error";
} else {
    echo "install";
} ?>"><?php echo $msg; ?></span><br />


                <img class="break" src="<?php echo $html->url('/mticket/img/login-welcome.gif') ?>" width="400" height="1" vspace="8" />
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <table cellpadding="0" cellspacing="0" border="0">
                    <tr height="24">
                        <td>Username:&nbsp;</td>
                        <td><input class="flat" type="text" name="username" id="username" tabindex="1" /></td>
                    </tr>
                    <tr height="24">
                        <td>Password:&nbsp;</td>
                        <td><input class="flat" type="password" name="password" id="password" tabindex="2" /></td>
                    </tr>
                    <tr height="24">
                        <td>&nbsp;</td>
                        <td><input type="submit" name="login" id="login" value="Login" tabindex="3" /></td>
                    </tr>
                </table>
                <img class="break" src="/mticket/img/login-welcome.gif" width="400" height="1" vspace="8" />

            </td>
        </tr>
    </table>
</form> 
