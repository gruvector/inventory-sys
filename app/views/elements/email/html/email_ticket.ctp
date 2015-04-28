<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Test</title>
        <style type="text/css">
            body {

                font:13px Helvetica, Arial, sans-serif;
                color: #333;
            }

            table thead th {
                text-align: left;
            }

            #wrapper {
                width: 80%;
                margin: 10px auto;
                -moz-border-radius: 6px;
                -webkit-border-radius: 6px;
                border-radius: 6px;
                background-color: #fff;
                padding: 20px;
                border-color:#0a76b7; 
                border-style:none;
            }

            #content {
                min-height: 400px;
            }

            .newPassword {
                font-size: 14px;
                font-weigth: bold;
            }

            h2 {
                background-color: #333;
                color: #fff;
                -moz-border-radius: 4px;
                -webkit-border-radius: 4px;
                border-radius: 4px;	
                padding: 10px;	
            }

            .logo a {
                color: #0a76b7;
                text-shadow: 1px 1px 1px #333;
                text-decoration: none;
            }

            table 
            {
                width:85%;
            }

            div#bottom {
                overflow: hidden;
                border-top: dotted #444 1px;
                margin-top: 10px;
            }

            div#links {
                padding: 10px;
                font-size: 15px;
                color: #069;
                float: left;
                width: 40%;
            }

            div#links a {
                display: inline-block;
                vertical-align: middle;
                padding: 5px 5px;
            }

            div#footer {
                float: right;
                color: #444;
                width: 40%;
            }
            #lilmsg{
                font-style:italic;
                font:9px Helvetica, Arial, sans-serif;
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <h1 class="logo"><a href="#">TEST</a></h1>             
            </div>

            <h2>&nbsp;TEST EMAIL<b>

                </b>
            </h2>

            <table style="border-color: #666;" border="0" cellpadding="5" cellspacing="5">
                <thead>
                    <tr style='background: #fff; font-weight: bold;'>
                        <th>TEST</th>
                        <th>TEST</th>
                        <th>TEST</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td><?php echo $dataObj['member_info']['Member']['email']; ?></td>
                        <td><?php echo $dataObj['member_data']; ?></td>
                        <td>test</td>
                    </tr>


                </tbody>
            </table>
            <div id="ad_spacer" name="ad_spacer">
                <img src="cid:<?php echo $ticket_image; ?>" alt="Facebook" />
            </div>

            <div style="margin-top: 20px; overflow: hidden; ">
                For additional info on upcoming events and deals, visit <a href="http://www.topgolf.com"> www.topgolf.com</a>.
                <br /><br />
                Text <b>ALLEN</b> to <b> 68633</b> to sign up for mobile alerts and receive one free game!
            </div>
            <span id="lilmsg">
                <i>*Message and data rates may apply.</i>
            </span>
            <div id="bottom">
                <div id="links">

                </div>
                <div id="footer">
                    <p style="padding-top:10px; display: none; ">Copyright &copy; <?php echo date('Y'); ?> TopGolf. All rights reserved.</p>
                </div>
            </div>
            <p>Copyright &copy; <?php echo date('Y'); ?> TopGolf. All rights reserved.</p>
        </div>
    </body>
</html>
